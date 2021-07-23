<?php

namespace Tests\Domain\Student;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use School\Domain\Student\{
    CPF,
    Email,
    Phone,
    PhoneAlreadyExists,
    PhoneCountExceeded,
    Student,
    StudentBuilder
};

class StudentTest extends TestCase
{
    public function studentInputData(): array
    {
        return [
            [
                '226.946.060-08',
                'teste',
                'teste@gmail.com'
            ]
        ];
    }

    /**
     * @test
     * @dataProvider studentInputData
     */
    public function shouldCreateStudentCorrectly($cpf, $name, $email)
    {
        $cpf = CPF::create($cpf);
        $name = $name;
        $email = Email::create($email);
        $registeredAt = new DateTimeImmutable();
        $student = new Student($cpf, $name, $email, $registeredAt);

        $this->assertInstanceOf(Student::class, $student);
        $this->assertSame((string) $cpf, $student->cpf());
        $this->assertSame($name, $student->name());
        $this->assertSame((string) $email, $student->email());
        $this->assertSame($registeredAt, $student->registeredAt());
    }

    /**
     * @test
     * @dataProvider studentInputData
     */
    public function shouldLaunchExceptionIfHasTwoPhones($cpf, $name, $email)
    {
        $studentBuilder = new StudentBuilder();
        $student = $studentBuilder->default($name, $cpf, $email)->build();
        $phones = [Phone::create('(11) 99999-8888'), Phone::create('(34) 1234-5678'), Phone::create('(00) 4321-5678')];
        $this->expectException(PhoneCountExceeded::class);
        foreach ($phones as $phone) {
            $student->addPhone($phone);
        }
    }

    /**
     * @test
     * @dataProvider studentInputData
     */
    public function shouldLaunchExceptionIfPhoneAlreadyExistsInStudent($cpf, $name, $email)
    {
        $studentBuilder = new StudentBuilder();
        $student = $studentBuilder->default($name, $cpf, $email)->build();
        $phones = [Phone::create('(11) 99999-8888'), Phone::create('(11) 99999-8888')];
        $this->expectException(PhoneAlreadyExists::class);
        foreach ($phones as $phone) {
            $student->addPhone($phone);
        }
    }
}
