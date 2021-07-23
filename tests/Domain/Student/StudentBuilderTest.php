<?php

namespace Tests\Domain\Student;

use PHPUnit\Framework\TestCase;
use School\Domain\Student\{
    StudentBuilder,
    Student
};

class StudentBuilderTest extends TestCase
{

    public function studentInputData(): array
    {
        return [
            [
                '226.946.060-08',
                'test@gmail.com',
                'teste'
            ]
        ];
    }

    /**
     * @test
     * @dataProvider studentInputData
     */
    public function shouldReturnStudentIfAllDataIsCorrect($cpf, $email, $name)
    {
        $student = new StudentBuilder();

        $tested = $student->default($name, $cpf, $email)->build();

        $this->assertInstanceOf(Student::class, $tested);
    }

    /**
     * @test
     * @dataProvider studentInputData
     */
    public function shouldAddPasswordCorrectlyToStudent($cpf, $email, $name)
    {
        $password = '!@#$abc';
        $student = new StudentBuilder();

        $tested = $student->default($name, $cpf, $email)->withPassword($password)->build();
        $this->assertSame($password, $tested->password());
    }

    /**
     * @test
     * @dataProvider studentInputData
     */
    public function shouldAddPhoneCorrectlyToStudent($cpf, $email, $name)
    {
        $phone = '(11) 91234-5678';
        $studentBuilder = new StudentBuilder();

        $student = $studentBuilder->default($name, $cpf, $email)->withPhone($phone)->build();
        $tested = $student->phones();
        $this->assertSame($phone, $tested[0]);
        $this->assertCount(1, $tested);
    }
}
