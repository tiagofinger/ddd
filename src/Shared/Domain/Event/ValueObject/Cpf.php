<?php

namespace Example\Ddd\Shared\Domain\Event\ValueObject;
use InvalidArgumentException;

class Cpf
{
    public function __construct(private string $number)
    {
        $this->setNumber($number);
    }

    private function setNumber(string $number): void
    {
        $pattern = [
          'options' => [
            'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/',
          ],
        ];
        if (filter_var($number, FILTER_VALIDATE_REGEXP, $pattern) === false)
        {
            throw new InvalidArgumentException('CPF is not valid');
        }
        $this->number = $number;
    }

    public function __toString(): string
    {
        return $this->number;
    }
}
