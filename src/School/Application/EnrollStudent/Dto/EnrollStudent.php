<?php

namespace Example\Ddd\School\Application\EnrollStudent\Dto;

class EnrollStudent
{
    public function __construct(public string $cpf, public string $name, public string $email, public ?string $ddd = null, public ?string $phone = null)
    {
    }
}
