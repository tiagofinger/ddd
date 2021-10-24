<?php

namespace Example\Ddd\School\Application\GetAllStudentsEnrolled;

use Example\Ddd\School\Domain\Student\Contract\StudentRepository;
use Example\Ddd\School\Domain\Student\Event\GetAllEnrolledStudent;
use Example\Ddd\Shared\Domain\Event\EventPublisher;
use Example\Ddd\School\Domain\Student\Event\GetAllEnrolledStudentListener;

class GetAllStudentsEnrolled
{
    public function __construct(private StudentRepository $studentRepository, private EventPublisher $eventPublisher)
    {
    }

    public function execute(): array
    {
        $data = $this->studentRepository->getAll();

        $event = new GetAllEnrolledStudent($data);
        $this->eventPublisher->publish($event);

        return $event->jsonSerialize();
    }
}