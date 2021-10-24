<?php

namespace Example\Ddd\Test\School\Domain\Student\ValueObject;

use Example\Ddd\School\Domain\Student\ValueObject\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testEmailIsInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectDeprecationMessage('E-mail address is invalid');
        new Email('test');
    }

    public function testEmailShouldBeOk()
    {
        $email = new Email('test@gmail.com');
        $this->assertSame('test@gmail.com', (string) $email);
    }
}
