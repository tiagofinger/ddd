<?php

namespace Example\Ddd\School\Domain\Student\ValueObject;

use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;
use DomainException;

class Student
{
    private array $phones;
    private string $password;

    public static function withCpfNameEmail(string $cpf, string $nome, string $email): self
    {
        return new Student(new Cpf($cpf), $nome, new Email($email));
    }

    public function __construct(private Cpf $cpf, private string $name, private Email $email)
    {
        $this->phones = [];
    }

    public function addPhone(string $ddd, string $number): self
    {
        if (count($this->phones) === 2)
        {
            throw new DomainException('Student already has 2 phone numbers');
        }
        $this->phones[] = new Phone($ddd, $number);
        return $this;
    }

    public function cpf(): Cpf
    {
        return $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    /** @return Phone[] */
    public function phones(): array
    {
        return $this->phones;
    }
}
