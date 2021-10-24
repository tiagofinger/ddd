<?php

namespace Example\Ddd\Shared\Domain\Event;

use Example\Ddd\Shared\Domain\Event\Contract\Event;

abstract class EventListener
{
    public function execute(Event $event): void
    {
        if ($this->canExecute($event))
        {
            $this->react($event);
        }
    }

    abstract public function canExecute(Event $event): bool;
    abstract public function react(Event $event): void;
}
