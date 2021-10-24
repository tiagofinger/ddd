<?php

namespace Example\Ddd\School\Infrastructure\Student;

use Example\Ddd\School\Domain\Student\Exception\StudentNotFound;
use Example\Ddd\School\Domain\Student\Contract\StudentRepository;
use Example\Ddd\School\Domain\Student\ValueObject\Phone;
use Example\Ddd\School\Domain\Student\ValueObject\Student;
use Example\Ddd\Shared\Domain\Event\ValueObject\Cpf;
use PDO;

class StudentRepositoryPdo implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Student $student): void
    {
        $sql = 'INSERT INTO students VALUES (:cpf, :name, :email);';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('cpf', $student->cpf());
        $stmt->bindValue('name', $student->name());
        $stmt->bindValue('email', $student->email());
        $stmt->execute();
        $sql = 'INSERT INTO phones VALUES (:ddd, :number, :cpf_student)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('cpf_student', $student->cpf());

        /** @var Phone $phones */
        foreach ($student->phones() as $phone)
        {
            $stmt->bindValue('ddd', $phone->ddd());
            $stmt->bindValue('number', $phone->number());
            $stmt->execute();
        }
    }

    public function findByCpf(Cpf $cpf): Student
    {
        $sql = '
            SELECT cpf, name, email, ddd, number as phone_number
              FROM students
         LEFT JOIN phones ON phones.cpf_student = students.cpf
            WHERE students.cpf = ?;
        ';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, (string)$cpf);
        $stmt->execute();
        $studentsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($studentsData) === 0)
        {
            throw new StudentNotFound($cpf);
        }
        return $this->map($studentsData);
    }

    private function map(array $studentData): Student
    {
        $firstRow = $studentData[0];
        $student = Student::withCpfNameEmail($firstRow['cpf'], $firstRow['name'], $firstRow['email']);
        $phones = array_filter($studentData, fn($row) => $row['ddd'] !== null && $row['phone_number'] !== null);
        foreach ($phones as $row)
        {
            $student->addPhone($row['ddd'], $row['phone_number']);
        }
        return $student;
    }

    public function getAll(): array
    {
        $sql = '
            SELECT cpf, name, email, ddd, number as phone_number
              FROM students
         LEFT JOIN phones ON phones.cpf_student = students.cpf;
        ';
        $stmt = $this->connection->query($sql);
        $rsStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $students = [];
        foreach ($rsStudent as $studentData)
        {
            if (!array_key_exists($studentData['cpf'], $students))
            {
                $students[$studentData['cpf']] = Student::withCpfNameEmail(
                  $studentData['cpf'],
                  $studentData['name'],
                  $studentData['email']
                );
            }

            if (isset($studentData['ddd']) && isset($studentData['phone_number']))
            {
                $students[$studentData['cpf']]->addPhone($studentData['ddd'], $studentData['phone_number']);
            }
        }
        return array_values($students);
    }
}
