<?php

namespace Skaffold\Console\Configuration;

use Atomastic\Arrays\Arrays;
use Atomastic\Filesystem\Filesystem;

class ConfigurationManager
{
    protected Arrays $configuration;

    protected Filesystem $filesystem;
    protected string $path;

    public function __construct(Filesystem $filesystem, string $path)
    {
        $this->configuration = Arrays::create();
        $this->filesystem    = $filesystem;
        $this->path          = $path;
    }

    public function get(?string $key = null)
    {
        return $this->configuration->get($key);
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function has(?string $key = null) {
        return $this->configuration->has($key);
    }

    public function load()
    {
        $files = $this->filesystem->find()
            ->in($this->path)
            ->files()
            ->name('*.php');

        foreach ($files as $file) {
            $config = require_once $file->getRealPath();

            if (! is_array($config)) {
                continue;
            }

            $this->configuration->set(
                $file->getFilenameWithoutExtension(),
                $config
            );
        }
    }

    public function set(string $key, $value)
    {
        $this->configuration->set($key, $value);
    }
}
