<?php

namespace Cecez\GenderizeWrapper;

class Api
{
    /**
     * @throws \Exception
     */
    public static function getGender(string $name): Gender
    {
        $objeto = new Processadora($name);
        $objeto->sanitiza();
        $objeto->valida();
        $url = $objeto->urlDaRequisicao();

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