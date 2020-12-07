<?php

namespace Skaffold\Console\Notification;

use Joli\JoliNotif\Notification;
use Joli\JoliNotif\Notifier;

class NotificationBuilder
{
    protected Notifier $notifier;
    protected Notification $notification;

    public function __construct(Notifier $notifier)
    {
        $this->notifier     = $notifier;
        $this->notification = new Notification;
    }

    public function title(string $title)
    {
        $clone = clone $this;
        $clone->notification->setTitle($title);
        return $clone;
    }

    public function message(string $message)
    {
        $clone = clone $this;
        $clone->notification->setBody($message);
        return $clone;
    }

    public function send()
    {
        $this->notifier->send($this->notification);
    }
}
