<?php

declare(strict_types=1);

namespace School\Domain\Student;

class StudentFactory
{
    public static function new(string $name, string $cpf, string $email): Student
    {
        return new Student(CPF::create($cpf), $name, Email::create($email));
    }
}
