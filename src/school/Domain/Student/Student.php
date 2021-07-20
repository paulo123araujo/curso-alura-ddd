<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class Student
{

    private $phones = [];

    public function __construct(
        private CPF $cpf,
        private string $name,
        private Email $email,
    ) {
    }

    public function addPhone(Phone $phone): void
    {
        if (count($this->phones) >= 2) {
            throw new DomainException('You can\'t add more phones.');
        }

        if (in_array($phone, $this->phones)) {
            throw new DomainException('Phone number already exists.');
        }

        $this->phones[] = $phone;
    }
}
