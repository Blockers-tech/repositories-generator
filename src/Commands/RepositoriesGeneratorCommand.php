<?php

namespace blockers\RepositoriesGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class RepositoriesGeneratorCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository class';

    public function handle()
    {
        $name = $this->argument('name');
        $repositoryName = "{$name}Repository";
        $filesystem = new Filesystem();

        if (!class_exists("App\Models\\{$name}")) {
            $this->error("{$name} model does not exist!");
            return;
        }
        if (!$this->injectRepositoryToController($name, $repositoryName))
        {
            return;
        }
        // Ensure the Repositories directory exists
        $directoryPath = app_path('Repositories');
        if (!$filesystem->isDirectory($directoryPath)) {
            $filesystem->makeDirectory($directoryPath);
        }

        // Create BaseRepository if it doesn't exist
        $baseRepositoryPath = app_path('Repositories/BaseRepository.php');
        if (!$filesystem->exists($baseRepositoryPath)) {
            $filesystem->put($baseRepositoryPath, $this->baseRepositoryStub());
        }

        // Create the model-specific repository
        $filePath = app_path("Repositories/{$repositoryName}.php");
        if ($filesystem->exists($filePath)) {
            $this->error("{$repositoryName} already exists!");
            return;
        }

        $filesystem->put($filePath, $this->repositoryStub($name));
        $this->info("{$repositoryName} created successfully.");
    }

    protected function baseRepositoryStub()
    {
        return <<<PHP
        <?php

        namespace App\Repositories;

        abstract class BaseRepository
        {
            // BaseRepository content
        }
        PHP;
    }

    protected function repositoryStub($name)
    {
        return <<<PHP
        <?php

        namespace App\Repositories;

        use App\Models\\{$name};

        class {$name}Repository extends BaseRepository
        {
            // {$name}Repository content
        }
        PHP;
    }

    protected function injectRepositoryToController($name, $repositoryName)
    {
        $controllerName = "{$name}Controller";
        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");
        $filesystem = new Filesystem();

        if ($filesystem->exists($controllerPath)) {
            $controllerContent = $filesystem->get($controllerPath);

            // Check if the repository is already injected
            if (!str_contains($controllerContent, $repositoryName)) {
                // Find the place to inject the repository
                $pattern = '/public function __construct\(/';
                if (preg_match($pattern, $controllerContent)) {
                    $replacement = "public function __construct({$repositoryName} \${$name}Repository, ";
                    $controllerContent = preg_replace($pattern, $replacement, $controllerContent, 1);

                    // Add use statement for the repository
                    $useStatement = "use App\\Repositories\\{$repositoryName};\n";
                    $namespacePattern = '/^namespace App\\\\Http\\\\Controllers;/m';
                    $controllerContent = preg_replace($namespacePattern, "$0\n\n$useStatement", $controllerContent, 1);

                    // Save the updated controller content
                    $filesystem->put($controllerPath, $controllerContent);
                    $this->info("Injected {$repositoryName} into {$controllerName}.");
                } else {
                    // No constructor found, so let's add one
                    $constructor = "\n    public function __construct( public {$repositoryName} \${$name}Repository)\n    {\n        \n    }\n";

                    // Find the class definition to add the constructor after
                    $classPattern = "/class {$controllerName} extends Controller\s*{/";
                    if (preg_match($classPattern, $controllerContent)) {
                        $controllerContent = preg_replace($classPattern, "$0\n$constructor", $controllerContent, 1);

                        // Add use statement for the repository
                        $useStatement = "use App\\Repositories\\{$repositoryName};\n";
                        $namespacePattern = '/^namespace App\\\\Http\\\\Controllers;/m';
                        $controllerContent = preg_replace($namespacePattern, "$0\n\n$useStatement", $controllerContent, 1);

                        // Save the updated controller content
                        $filesystem->put($controllerPath, $controllerContent);
                        $this->info("Added new constructor with {$repositoryName} to {$controllerName}.");
                        return true;
                    } else {
                        $this->error("Unable to locate the class definition in {$controllerName}.");
                        return false;
                    }
                }
            } else {
                $this->info("{$repositoryName} is already injected into {$controllerName}.");
                return true;
            }
        } else {
            $this->error("{$controllerName} does not exist!");
            return false;
        }
        return false;
    }
}
