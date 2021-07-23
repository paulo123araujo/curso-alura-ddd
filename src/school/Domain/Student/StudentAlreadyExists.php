<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class StudentAlreadyExists extends DomainException
{
    public function __construct(CPF $cpf)
    {
        $this->message = "Student with cpf $cpf already exists";
        parent::__construct("Student with cpf $cpf already exists");
    }
}
