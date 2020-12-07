<?php

namespace Skaffold\Console\Notification;

use Skaffold\Console\Facade\Facade;

class NotificationFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'notification';
    }
}
