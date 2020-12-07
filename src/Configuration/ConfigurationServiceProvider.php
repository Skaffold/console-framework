<?php

namespace Skaffold\Console\Configuration;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ConfigurationServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'config',
    ];

    public function register()
    {
        $this->getContainer()
            ->add('config', 'Skaffold\Console\Configuration\ConfigurationManager')
            ->addArgument('Atomastic\Filesystem\Filesystem')
            ->addArgument($this->getContainer()->get('path.config'))
            ->setShared();

        $this->getContainer()
            ->get('config')
            ->load();
    }
}
