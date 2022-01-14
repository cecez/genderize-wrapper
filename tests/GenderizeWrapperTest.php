<?php

use PHPUnit\Framework\TestCase;

class GenderizeWrapperTest extends TestCase
{
    /** @test */
    public function nao_sei_ainda()
    {
        // arrange

        // act
        $retorno = Cecez\GenderizeWrapper::getGender('Cezar');

        // assert
        self::assertEquals(Cecez\GenderizeWrapper::MASCULINO, $retorno);
    }
}