<?php

use Example\Ddd\School\Application\EnrollStudent\Dto\EnrollStudent as EnrollStudentDto;
use Example\Ddd\School\Application\GetAllStudentsEnrolled\GetAllStudentsEnrolled;
use Example\Ddd\Shared\Domain\Event\EventPublisher;
use Example\Ddd\School\Infrastructure\Student\StudentRepositoryPdo;

require 'vendor/autoload.php';

$eventPublisher = new EventPublisher();
$useCase = new GetAllStudentsEnrolled(new StudentRepositoryPdo(new \PDO("sqlite:./db.sqlite")), $eventPublisher);
$response = $useCase->execute();

print_r($response);
