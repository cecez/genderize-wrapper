<?php

namespace Cecez\GenderizeWrapper;

use Exception;

class Api
{
    /**
     * @throws Exception
     */
    public static function getGender(string $name): Gender
    {
        return Processadora::executa($name);
    }
}