<?php

namespace Skaffold\Console\Filesystem;

use League\Container\ServiceProvider\AbstractServiceProvider;

class FilesystemServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'Atomastic\Filesystem\Filesystem',
    ];

    public function register()
    {
        $this->getContainer()->add('Atomastic\Filesystem\Filesystem')->setShared();
    }
}
