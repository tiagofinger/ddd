<?php

namespace Example\Ddd\School\Domain\Student\ValueObject;

use InvalidArgumentException;

class Phone
{
    public function __construct(private string $ddd, private string $number)
    {
        $this->setDdd($ddd);
        $this->setNumber($number);
    }

    private function setDdd(string $ddd): void
    {
        if (preg_match('/\d{2}/', $ddd) !== 1)
        {
            throw new InvalidArgumentException('DDD is invalid');
        }
        $this->ddd = $ddd;
    }

    private function setNumber(string $number): void
    {
        if (preg_match('/\d{8,9}/', $number) !== 1)
        {
            throw new InvalidArgumentException('Phone Number is invalid');
        }
        $this->number = $number;
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->number}";
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function number(): string
    {
        return $this->number;
    }
}
