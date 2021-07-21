<?php

namespace Tests\Domain\Student;

use DomainException;
use PHPUnit\Framework\TestCase;
use School\Domain\Student\Phone;

class PhoneTest extends TestCase
{
    /**
     * @test
     */
    public function shouldntCreatePhoneIfLengthIsLowerThanTen()
    {
        $number = '148116746';
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This phone is invalid.');

        Phone::create($number);
    }

    /**
     * @test
     */
    public function shouldntCreatePhoneIfLengthIsGraterThanEleven()
    {
        $number = '149998116746';
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This phone is invalid.');

        Phone::create($number);
    }

    public function invalidPhones(): array
    {
        return [
            ['(14)998116746'],
            ['(14)99811-6746'],
            ['14 998116746'],
            ['14 99811-6746'],
            [' (14) 99811-6746  ']
        ];
    }

    /**
     * @test
     * @dataProvider invalidPhones
     */
    public function shouldntCreatePhoneIfIsFormattedWrong(string $number)
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This phone has invalid format.');

        Phone::create($number);
    }

    public function validPhones(): array
    {
        return [
            ['(14) 99811-6746'],
            ['(11) 3333-4444'],
            ['(09) 98167-4545']
        ];
    }

    /**
     * @test
     * @dataProvider validPhones
     */
    public function shouldCreateCorrectlyWithCorrectPhone(string $phone)
    {
        $tested = Phone::create($phone);
        $this->assertInstanceOf(Phone::class, $tested);
        $this->assertEquals($phone, (string) $tested);
    }

    /**
     * @test
     */
    public function shouldReturnCorrectValues()
    {
        $phone = '(11) 3333-4444';
        $tested = Phone::create($phone);
        $this->assertEquals('11', $tested->DDD());
        $this->assertEquals('33334444', $tested->numberWithoutDDD());
        $this->assertEquals($phone, $tested->number());
    }
}
