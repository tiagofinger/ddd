<?php

namespace Example\Ddd\Test\Shared\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;

class CpfTest extends TestCase
{
    public function testCpfInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        new Cpf('12345678910');
    }

    public function testCpfValid()
    {
        $cpf = new Cpf('123.456.789-10');
        $this->assertSame('123.456.789-10', (string) $cpf);
    }
}