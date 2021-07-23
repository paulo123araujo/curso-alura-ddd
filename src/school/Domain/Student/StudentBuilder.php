<?php

declare(strict_types=1);

namespace School\Domain\Student;

class StudentBuilder
{
    /**
     * @var Student $student
     */
    private $student;

    public function default(string $name, string $cpf, string $email): StudentBuilder
    {
        $this->student = new Student(CPF::create($cpf), $name, Email::create($email));
        return $this;
    }

    public function withPassword(string $encryptedPassword): StudentBuilder
    {
        $this->student->definePassword($encryptedPassword);
        return $this;
    }

    public function withPhone(string $phone): StudentBuilder
    {
        $this->student->addPhone(Phone::create($phone));
        return $this;
    }

    public function build(): Student
    {
        return $this->student;
    }
}
