<?php

namespace Example\Ddd\School\Application\EnrollStudent;

use Example\Ddd\School\Domain\Student\Contract\StudentRepository;
use Example\Ddd\School\Domain\Student\Event\EnrolledStudent;
use Example\Ddd\School\Domain\Student\ValueObject\Student;
use Example\Ddd\Shared\Domain\Event\EventPublisher;
use Example\Ddd\School\Application\EnrollStudent\Dto\EnrollStudent as EnrollStudentDto;

class EnrollStudent
{
    public function __construct(private StudentRepository $studentRepository, private EventPublisher $eventPublisher)
    {
    }

    public function execute(EnrollStudentDto $obj): void
    {
        $student = Student::withCpfNameEmail($obj->cpf, $obj->name, $obj->email);
        if ($obj->ddd && $obj->phone)
        {
            $student->addPhone($obj->ddd, $obj->phone);
        }
        $this->studentRepository->add($student);

        $event = new EnrolledStudent($student->cpf());
        $this->eventPublisher->publish($event);
    }
}
