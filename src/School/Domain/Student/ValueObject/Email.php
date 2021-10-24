<?php

namespace Example\Ddd\School\Domain\Student\ValueObject;

use InvalidArgumentException;

class Email
{
    public function __construct(private string $address)
    {
        if (filter_var($address, FILTER_VALIDATE_EMAIL) === false)
        {
            throw new InvalidArgumentException(
              'E-mail address is invalid'
            );
        }
        $this->setAddress($address);
    }

    private function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
