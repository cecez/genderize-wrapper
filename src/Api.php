<?php

namespace Cecez\GenderizeWrapper;

class Api
{
    /**
     * @throws \Exception
     */
    public static function getGender(string $name): Gender
    {
        // validar chamada

        // montar requisição para API
        $url = "https://api.genderize.io?name=" . urlencode($name);

        // enviar requisição
        $retornoJSON = file_get_contents($url);

        // processar requisição
        if ($retornoJSON === false) throw new \Exception("Não foi possível processar requisição", 1);
        $retornoDecodificado = json_decode($retornoJSON);

        // processar resultado
        if ($retornoDecodificado->probability <= 0.5) return Gender::UNKNOWN;
        if ($retornoDecodificado->gender === "male") return Gender::MASCULINE;
        return Gender::FEMININE;
    }
}