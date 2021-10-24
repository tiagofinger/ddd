<?php

namespace Example\Ddd\School\Domain\Student\Event;

use DateTimeImmutable;
use Example\Ddd\Shared\Domain\Event\Contract\Event;
use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;

class EnrolledStudent implements Event
{
    private DateTimeImmutable $now;

    public function __construct(private Cpf $cpf)
    {
        $this->now = new DateTimeImmutable();
    }

    public function cpf(): Cpf
    {
        return $this->cpf;
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
