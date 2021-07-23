<?php

namespace Tests\Domain\Student;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use School\Domain\Student\{
    CPF,
    Email,
    Student
};

class StudentTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateStudentCorrectly()
    {
        $cpf = CPF::create('226.946.060-08');
        $name = 'Paulo Araújo';
        $email = Email::create('test@gmail.com');
        $registeredAt = new DateTimeImmutable();
        $student = new Student($cpf, $name, $email, $registeredAt);

        $this->assertInstanceOf(Student::class, $student);
        $this->assertSame((string) $cpf, $student->cpf());
        $this->assertSame($name, $student->name());
        $this->assertSame((string) $email, $student->email());
        $this->assertSame($registeredAt, $student->registeredAt());
    }
}
