<?php

namespace blockers\RepositoriesGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \blockers\RepositoriesGenerator\RepositoriesGenerator
 */
class RepositoriesGenerator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \blockers\RepositoriesGenerator\RepositoriesGenerator::class;
    }
}
