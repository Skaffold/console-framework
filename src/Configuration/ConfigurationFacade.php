<?php

namespace Skaffold\Console\Configuration;

use Skaffold\Console\Facade\Facade;

class ConfigurationFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'config';
    }
}
