<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class Phone
{

    private string $ddd;
    private string $number;

    private function __construct(string $phone)
    {
        $this->validate($phone);
        list($ddd, $number) = $this->separateDDDAndNumber($phone);
        $this->ddd = $ddd;
        $this->number = $number;
    }

    public static function create(string $phone): Phone
    {
        return new self($phone);
    }

  /**
   * @return array<string>
   */
    private function separateDDDAndNumber(string $phone): array
    {
        $splittedPhone = explode(' ', $phone);
        $ddd = substr($splittedPhone[0], 1, 2);
        $number = str_replace('-', '', $splittedPhone[1]);
        return [$ddd, $number];
    }

    private function validate(string $phone): void
    {
        if ($this->phoneHasWrongLength($phone)) {
            throw new DomainException('This phone is invalid.');
        }

        if ($this->phoneHasInvalidFormat($phone)) {
            throw new DomainException('This phone has invalid format.');
        }
    }

    private function phoneHasInvalidFormat(string $phone): bool
    {
        if (!preg_match('/^\([\d]{2}\)\s[\d]{4,5}\-[\d]{4}$/', $phone)) {
            return true;
        }

        return false;
    }

    private function phoneHasWrongLength($phone): bool
    {
        $phoneSanitized = preg_replace('/[^0-9]/is', '', $phone);
        return strlen($phoneSanitized) < 10 || strlen($phoneSanitized) > 11;
    }

    public function DDD(): string
    {
        return $this->ddd;
    }

    public function numberWithoutDDD(): string
    {
        return $this->number;
    }

    public function number(): string
    {
        $numberWithDash = substr_replace($this->number, '-', -5);
        return sprintf('(%s) %s', $this->ddd, $numberWithDash);
    }

    public function __toString(): string
    {
        return $this->number();
    }
}
