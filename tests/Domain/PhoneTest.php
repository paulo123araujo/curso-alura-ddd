<?php

namespace Tests\Domain;

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
}
