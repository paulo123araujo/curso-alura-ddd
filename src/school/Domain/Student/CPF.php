<?php

declare(strict_types=1);

namespace School\Domain\Student;

use DomainException;

class CPF
{
    private string $cpf;

    private function __construct(string $cpf)
    {
        $this->validate($cpf);
        $this->cpf = $cpf;
    }

    public static function create(string $cpf): CPF
    {
        return new self($cpf);
    }

    private function validate(string $cpf): void
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if ($this->isDigitCountWrong($cpf)) {
            throw new DomainException('This CPF is invalid.');
        }

        if ($this->isRepeatedDigits($cpf)) {
            throw new DomainException('This CPF is invalid.');
        }

      // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new DomainException('This CPF is invalid.');
            }
        }
    }

    private function isRepeatedDigits(string $cpf): bool
    {
        return preg_match('/(\d)\1{10}/', $cpf);
    }

    private function isDigitCountWrong(string $cpf): bool
    {
        return strlen($cpf) !== 11;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
