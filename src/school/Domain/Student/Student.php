<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DateTimeImmutable;
use DateTimeInterface;

class Student
{

    /** @var Phone[] $phones */
    private array $phones = [];
    private string $password;
    private DateTimeInterface $registeredAt;

    public function __construct(
        private CPF $cpf,
        private string $name,
        private Email $email,
        DateTimeInterface|null $registeredAt = null
    ) {
        if (is_null($registeredAt)) {
            $registeredAt = new DateTimeImmutable();
        }

        $this->registeredAt = $registeredAt;
    }

    public function addPhone(Phone $phone): void
    {
        if (count($this->phones) === 2) {
            throw new PhoneCountExceeded();
        }

        if (in_array((string) $phone, $this->phones())) {
            throw new PhoneAlreadyExists();
        }

        $this->phones[] = $phone;
    }

    public function cpf(): string
    {
        return (string) $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return (string) $this->email;
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
