<?php

declare(strict_types=1);

namespace School\Domain\Student;

class StudentFactory
{
    private Student $student;

    public function default(string $name, string $cpf, string $email): StudentFactory
    {
        $this->student = new Student(CPF::create($cpf), $name, Email::create($email));
        return $this;
    }

    public function withPassword(string $encryptedPassword): StudentFactory
    {
        $this->student->definePassword($encryptedPassword);
        return $this;
    }

    public function withPhone(string $phone): StudentFactory
    {
        $this->student->addPhone(Phone::create($phone));
        return $this;
    }

    public function build(): Student
    {
        return $this->student;
    }
}
