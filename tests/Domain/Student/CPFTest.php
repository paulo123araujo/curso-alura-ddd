<?php

namespace Tests\Domain\Student;

use DomainException;
use PHPUnit\Framework\TestCase;
use School\Domain\Student\CPF;

class CPFTest extends TestCase
{
    public function invalidCPF(): array
    {
        return [
            ['121.111.111-115'],
            ['121.111.111-1'],
            ['123.456.789-11'],
            ['121.212.121-21']
        ];
    }

    /**
     * @test
     * @dataProvider invalidCPF
     */
    public function shouldFailIfCPFAreInvalids($cpf)
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This CPF is invalid.');
        CPF::create($cpf);
    }

    public function shouldReturnCorrectly()
    {
        $cpf = '226.946.060-08';
        $tested = CPF::create($cpf);
        $this->assertInstanceOf(CPF::class, $tested);
        $this->assertSame($cpf, (string) $tested);
    }
}
