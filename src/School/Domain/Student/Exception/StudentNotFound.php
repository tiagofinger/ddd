<?php

namespace Example\Ddd\School\Domain\Student\Exception;

use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;
use DomainException;

class StudentNotFound extends DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Student with CPF $cpf not found");
    }
}
