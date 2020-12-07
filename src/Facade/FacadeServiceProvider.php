<?php

namespace Skaffold\Console\Facade;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Skaffold\Console\Facade\FacadeManager;

class FacadeServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'Skaffold\Console\Facade\FacadeManager',
    ];

    public function register()
    {
        $this->getContainer()
            ->add(FacadeManager::class)
            ->addArgument($this->getContainer())
            ->addArgument('config')
            ->setShared();
    }
}
