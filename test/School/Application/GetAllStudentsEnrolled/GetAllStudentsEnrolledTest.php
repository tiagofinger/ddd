<?php

namespace Example\Ddd\Test\School\Application\GetAllStudentsEnrolled;

use Example\Ddd\School\Application\EnrollStudent\Dto\EnrollStudent as EnrollStudentDto;
use Example\Ddd\School\Application\EnrollStudent\EnrollStudent;
use Example\Ddd\School\Application\GetAllStudentsEnrolled\GetAllStudentsEnrolled;
use Example\Ddd\School\Infrastructure\Student\StudentRepositoryPdo;
use Example\Ddd\Shared\Domain\Event\EventPublisher;
use PHPUnit\Framework\TestCase;
use PDO;

class GetAllStudentsEnrolledTest extends TestCase
{
    private PDO $connection;

    public function setUp(): void
    {
        parent::setUp();
        $this->connection = new PDO("sqlite:./db.sqlite");
        $this->connection->exec('DELETE FROM students');
        $this->connection->exec('DELETE FROM phones');
    }

    public function testGetAllStudent()
    {
        $enrollStudentDto1 = new EnrollStudentDto(
          '123.456.789-10',
          'Teste 1',
          'email1@example.com',
        );
        $enrollStudentDto2 = new EnrollStudentDto(
          '123.456.789-11',
          'Teste 2',
          'email2@example.com',
        );
        $studentRepositoryPdo = new StudentRepositoryPdo($this->connection);
        $enrollStudent = new EnrollStudent(
          $studentRepositoryPdo,
          $this->createStub(EventPublisher::class)
        );

        $enrollStudent->execute($enrollStudentDto1);
        $enrollStudent->execute($enrollStudentDto2);

        $useCase = new GetAllStudentsEnrolled(
          new StudentRepositoryPdo(new \PDO("sqlite:./db.sqlite")),
          $this->createStub(EventPublisher::class)
        );
        $response = $useCase->execute();
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey(1, $response);
        $this->assertSame('123.456.789-10', $response[0]->cpf()->__toString());
        $this->assertSame('Teste 1', $response[0]->name());
        $this->assertSame('email1@example.com', $response[0]->email());
        $this->assertSame('123.456.789-11', $response[1]->cpf()->__toString());
        $this->assertSame('Teste 2', $response[1]->name());
        $this->assertSame('email2@example.com', $response[1]->email());
    }
}