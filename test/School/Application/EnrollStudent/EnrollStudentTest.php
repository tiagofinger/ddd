<?php

namespace Example\Ddd\Test\School\Application\EnrollStudent;
use Example\Ddd\School\Application\EnrollStudent\EnrollStudent;
use Example\Ddd\School\Infrastructure\Student\StudentRepositoryPdo;
use Example\Ddd\Shared\Domain\Event\EventPublisher;
use Example\Ddd\School\Application\EnrollStudent\Dto\EnrollStudent as EnrollStudentDto;
use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;
use PDO;
use PHPUnit\Framework\TestCase;

class EnrollStudentTest extends TestCase
{
    private PDO $connection;

    public function setUp(): void
    {
        parent::setUp();
        $this->connection = new PDO("sqlite:./db.sqlite");
        $this->connection->exec('DELETE FROM students');
        $this->connection->exec('DELETE FROM phones');
    }

    public function testStudentShouldBeAdded()
    {
        $enrollStudentDto = new EnrollStudentDto(
          '123.456.789-10',
          'Teste',
          'email@example.com',
        );
        $studentRepositoryPdo = new StudentRepositoryPdo($this->connection);
        $enrollStudent = new EnrollStudent(
          $studentRepositoryPdo,
          $this->createStub(EventPublisher::class)
        );

        $enrollStudent->execute($enrollStudentDto);

        $student = $studentRepositoryPdo->findByCpf(new Cpf('123.456.789-10'));
        $this->assertSame('Teste', $student->name());
        $this->assertSame('email@example.com', (string) $student->email());
        $this->assertEmpty($student->phones());
    }
}
