<?php

namespace Skaffold\Console\Facade;

use Exception;
use Skaffold\Console\App;
use Skaffold\Console\Configuration\ConfigurationManager;

class FacadeManager
{
    protected App $app;
    protected ConfigurationManager $config;

    public function __construct(App $app, ConfigurationManager $config)
    {
        $this->app    = $app;
        $this->config = $config;
    }

    public function registerFacades()
    {
        foreach ($this->config->get('app.facades') as $alias => $class) {
            $this->registerFacade($alias, $class);
        }
    }

    public function registerFacade(string $alias, string $className)
    {
        if (class_exists($className)) {
            $classProvider = new $className;
        }

        if (isset($classProvider) && $classProvider instanceof Facade && ! class_exists($alias)) {
            $classProvider::setInterface(
                $this->app->get($classProvider::getFacadeAccessor())
            );

            return class_alias($className, $alias);
        }

        throw new Exception('Facade must extend "Skaffold\Console\Facade\Facade"!');
    }
}
