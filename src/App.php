<?php

namespace Skaffold\Console;

use League\Container\Container;
use Skaffold\Console\Facade\FacadeManager;

/**
 * This class is responsible for constructing the application container.
 */
class App extends Container
{
    protected string $basePath;

    public function __construct(?string $basePath = null)
    {
        parent::__construct();

        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->boot();
        $this->bootServiceProviders();
        $this->bootFacades();
    }

    public function setBasePath(string $path)
    {
        $this->basePath = rtrim($path, '\/');

        // Register paths with container
        $this->add('path', $this->basePath);
        $this->add('path.config', $this->basePath . '/config');
    }

    /**
     * Sets up configuration files, etc.
     */
    protected function boot()
    {
        $this->addServiceProvider('Skaffold\Console\Filesystem\FilesystemServiceProvider');
        $this->addServiceProvider('Skaffold\Console\Configuration\ConfigurationServiceProvider');
    }

    /**
     * Sets up any service providers defined by the configuration.
     */
    protected function bootServiceProviders()
    {
        $config = $this->get('config');

        if (! $config->has('app.providers')) {
            return;
        }

        foreach ($config->get('app.providers') as $provider) {
            $this->addServiceProvider($provider);
        }
    }

    /**
     * Sets up any facades defined by the configuration.
     */
    protected function bootFacades()
    {
        if (! $this->get('config')->has('app.facades')) {
            return;
        }

        $this->get(FacadeManager::class)->registerFacades();
    }
}
