<?php

namespace Skaffold\Console\Notification;

use Joli\JoliNotif\Notifier;
use Joli\JoliNotif\NotifierFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;

class NotificationServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'notification',
        'Joli\JoliNotif\Notifier'
    ];

    public function register()
    {
        $container = $this->getContainer();
        
        $container
            ->add(
                Notifier::class,
                NotifierFactory::createOrThrowException()
            )
            ->setShared();

        $container
            ->add('notification', NotificationBuilder::class)
            ->addArgument(Notifier::class)
            ->setShared();
    }
}
