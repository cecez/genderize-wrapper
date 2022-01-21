<?php

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    /** @test */
    public function nome_masculino()
    {
        // arrange

        // act
        $retorno = Cecez\GenderizeWrapper\Api::getGender('Cezar');

        // assert
        self::assertEquals(Cecez\GenderizeWrapper\Gender::MASCULINE, $retorno);
    }

    /** @test */
    public function nome_feminino()
    {
        // arrange

        // act
        $retorno = Cecez\GenderizeWrapper\Api::getGender('Ana');

        // assert
        self::assertEquals(Cecez\GenderizeWrapper\Gender::FEMININE, $retorno);
    }

    /** @test */
    public function nome_desconhecido()
    {
        // arrange

        // act
        $retorno = Cecez\GenderizeWrapper\Api::getGender('Ainsley');

        // assert
        self::assertEquals(Cecez\GenderizeWrapper\Gender::UNKNOWN, $retorno);
    }
}