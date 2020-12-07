<?php

namespace Skaffold\Console\Console;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ConsoleServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'console',
        'Symfony\Component\Console\Application',
    ];

    public function register()
    {
        $container = $this->getContainer();
        $config    = $container->get('config');

        $container
            ->add('console', 'Symfony\Component\Console\Application')
            ->setShared();

        // If no commands are present in the config, return. Otherwise load them.
        if (! $config->has('commands')) {
            return;
        }

        foreach ($config->get('commands') as $command) {
            if (! class_exists($command)) {
                continue;
            }

            $container->get('console')->add( new $command );
        }
    }
}
