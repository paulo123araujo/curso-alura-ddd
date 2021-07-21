<?php

namespace Tests\Domain\Student;

use DomainException;
use PHPUnit\Framework\TestCase;
use School\Domain\Student\Email;

class EmailTest extends TestCase
{
    public function invalidEmails(): array
    {
        return [
            ['test'],
            ['test.com'],
            ['test@gmail'],
            ['test@123.421']
        ];
    }

    /**
     * @test
     * @dataProvider invalidEmails
     */
    public function shouldFailsIfEmailIsInvalid($email)
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This email is invalid.');

        Email::create($email);
    }

    public function shouldBeOkWithCorrectData()
    {
        $email = 'test@gmail.com';
        $tested = Email::create($email);
        $this->assertInstanceOf(Email::class, $tested);
        $this->assertSame($email, (string) $tested);
    }
}
