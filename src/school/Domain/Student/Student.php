<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DateTimeImmutable;
use DateTimeInterface;
use DomainException;

class Student
{

    /** @var Phone[] $phones */
    private array $phones = [];
    private DateTimeInterface $registeredAt;
    private string $password;

    public function __construct(
        private CPF $cpf,
        private string $name,
        private Email $email,
    ) {
        $this->registeredAt = new DateTimeImmutable();
    }

    public function addPhone(Phone $phone): void
    {
        if (count($this->phones) === 2) {
            throw new DomainException('You can\'t add more phones.');
        }

        if (in_array($phone, $this->phones)) {
            throw new DomainException('Phone number already exists.');
        }

        $this->phones[] = $phone;
    }

    /** @return string[] */
    public function phones(): array
    {
        return array_map(fn ($phone) => (string) $phone, $this->phones);
    }

    public function definePassword(string $encryptedPassword): void
    {
        $this->password = $encryptedPassword;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function registeredAt(): DateTimeInterface
    {
        return $this->registeredAt;
    }
}
