<?php

namespace Example\Ddd\Shared\Domain\Event;

use Example\Ddd\Shared\Domain\Event\Contract\Event;

class EventPublisher
{
    /** @var EventListener[] $listeners */
    private array $listeners = [];

    public function addListener(EventListener $listener): void
    {
        $this->listeners[] = $listener;
    }

    public function publish(Event $event): void
    {
        /** @var EventListener $listener */
        foreach ($this->listeners as $listener)
        {
            $listener->execute($event);
        }
    }
}
