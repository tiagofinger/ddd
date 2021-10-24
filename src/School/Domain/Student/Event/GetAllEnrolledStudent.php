<?php

namespace Example\Ddd\School\Domain\Student\Event;

use DateTimeImmutable;
use Example\Ddd\Shared\Domain\Event\Contract\Event;

class GetAllEnrolledStudent implements Event
{
    private DateTimeImmutable $now;

    public function __construct(private array $data)
    {
        $this->now = new DateTimeImmutable();
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
