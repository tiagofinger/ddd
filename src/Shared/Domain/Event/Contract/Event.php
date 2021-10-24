<?php

namespace Example\Ddd\Shared\Domain\Event\Contract;

use JsonSerializable;
use DateTimeImmutable;

interface Event extends JsonSerializable
{
    public function now(): DateTimeImmutable;
}
