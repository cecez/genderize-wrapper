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
        $retorno = Cecez\GenderizeWrapper\Api::getGender('Ana Paula');

        // assert
        self::assertEquals(Cecez\GenderizeWrapper\Gender::FEMININE, $retorno);
    }
}