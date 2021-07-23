<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class PhoneAlreadyExists extends DomainException
{
    public function __construct()
    {
        $this->message = 'Phone number already exists.';
        parent::__construct('Phone number already exists.');
    }
}
