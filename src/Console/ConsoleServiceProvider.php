<?php

namespace Skaffold\Console\Console;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ConsoleServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'Symfony\Component\Console\Application',
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container
            ->add('console', 'Symfony\Component\Console\Application')
            ->setShared();

        // If no commands are present in the config, return. Otherwise load them.
        if (! $container->get('config.commands')) {
            return;
        }

        foreach ($container->get('config.commands') as $command) {
            if (! class_exists($command)) {
                continue;
            }

            $container->get('console')->add( new $command );
        }
    }
}
