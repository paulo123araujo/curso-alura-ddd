<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class PhoneCountExceeded extends DomainException
{
    public function __construct()
    {
        $this->message = 'You can\'t add more phones.';
        parent::__construct('You can\'t add more phones.');
    }
}
