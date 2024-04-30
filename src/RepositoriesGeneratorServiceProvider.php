<?php

namespace blockers\RepositoriesGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use blockers\RepositoriesGenerator\Commands\RepositoriesGeneratorCommand;

class RepositoriesGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {

        $package
            ->name('repositories-generator')
            ->hasCommand(RepositoriesGeneratorCommand::class);
    }
}
