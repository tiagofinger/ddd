<?php

namespace Example\Ddd\Test\School\Domain\Student\ValueObject;

use Example\Ddd\School\Domain\Student\ValueObject\Email;
use Example\Ddd\School\Domain\Student\ValueObject\Student;
use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;
use DomainException;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private Student $student;

    protected function setUp(): void
    {
        $this->student = new Student(
          $this->createStub(Cpf::class),
          '',
          $this->createStub(Email::class)
        );
    }

    public function testAddMoreThanTwoPhoneShouldThrowException()
    {
        $this->expectException(DomainException::class);

        $this->student->addPhone('24', '22222222');
        $this->student->addPhone('24', '999999999');
        $this->student->addPhone('24', '12345678');
    }

    public function testAddOnePhoneShouldBeOk()
    {
        $this->student->addPhone('24', '22222222');

        $this->assertCount(1, $this->student->phones());
    }

    public function testAddTwoPhonesShouldBeOk()
    {
        $this->student->addPhone('24', '22222222');
        $this->student->addPhone('24', '999999999');

        $this->assertCount(2, $this->student->phones());
    }
}
