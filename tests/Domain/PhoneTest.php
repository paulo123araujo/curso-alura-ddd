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
}
