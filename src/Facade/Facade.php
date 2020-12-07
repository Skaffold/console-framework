<?php

namespace Skaffold\Console\Facade;

use Exception;

abstract class Facade
{
    protected static $interface;

    abstract public static function getFacadeAccessor(): string;

    /**
     * Gets the interface for this facade.
     */
    public static function getInterface()
    {
        if (isset(static::$interface)) {
            return static::$interface;
        }

        throw new Exception('The interface for this facade has not been booted!');
    }

    /**
     * Sets an instance of the class this facade represents.
     */
    public static function setInterface($interface)
    {
        static::$interface = $interface;
    }

    /**
     * Passes on the method call.
     */
    public static function __callStatic($name, $arguments)
    {
        return (static::getInterface())->{$name}(...$arguments);
    }
}
