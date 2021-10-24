<?php

namespace Example\Ddd\School\Domain\Student\Contract;

use Example\Ddd\School\Domain\Student\ValueObject\Student;
use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;

interface StudentRepository
{
    public function add(Student $student): void;
    public function findByCpf(Cpf $cpf): Student;
    /** @return Student[] */
    public function getAll(): array;
}
