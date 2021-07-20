<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class Email
{
    private function __construct(private string $email)
    {
        $this->validate($email);
    }

    public static function create(string $email): Email
    {
        return new self($email);
    }

    private function validate(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException('This email is invalid.');
        }
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
