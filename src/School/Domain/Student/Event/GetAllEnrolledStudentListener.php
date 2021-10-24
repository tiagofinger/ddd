<?php

namespace Example\Ddd\School\Domain\Student\Event;

use Example\Ddd\Shared\Domain\Event\Contract\Event;
use Example\Ddd\Shared\Domain\Event\EventListener;

class GetAllEnrolledStudentListener extends EventListener
{
    public function canExecute(Event $event): bool
    {
        return get_class($event) === 'Example\Ddd\School\Domain\Student\Event\GetAllEnrolledStudent';
    }

    public function react(Event $event): void
    {
        print_r($event->jsonSerialize());
    }
}