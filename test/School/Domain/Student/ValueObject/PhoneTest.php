<?php

namespace Example\Ddd\Test\School\Domain\Student\ValueObject;

use Example\Ddd\School\Domain\Student\ValueObject\Phone;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testPhoneShouldBeOk()
    {
        $phone = new Phone('24', '22222222');
        $this->assertSame('(24) 22222222', (string) $phone);
    }

    public function testPhoneIsDddInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectDeprecationMessage('DDD is invalid');
        new Phone('ddd', '22222222');
    }

    public function testPhoneIsInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectDeprecationMessage('Phone Number is invalid');
        new Phone('24', 'number');
    }
}
