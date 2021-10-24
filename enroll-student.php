<?php

use Example\Ddd\School\Application\EnrollStudent\Dto\EnrollStudent as EnrollStudentDto;
use Example\Ddd\School\Application\EnrollStudent\EnrollStudent;
use Example\Ddd\Shared\Domain\Event\EventPublisher;
use Example\Ddd\School\Infrastructure\Student\StudentRepositoryPdo;

require 'vendor/autoload.php';

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$phone = $argv[5];

$eventPublisher = new EventPublisher();
$useCase = new EnrollStudent(new StudentRepositoryPdo(new \PDO("sqlite:./db.sqlite")), $eventPublisher);
$useCase->execute(new EnrollStudentDto($cpf, $nome, $email, $ddd, $phone));
