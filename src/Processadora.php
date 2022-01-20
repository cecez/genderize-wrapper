<?php

namespace Cecez\GenderizeWrapper;

use Exception;
use JetBrains\PhpStorm\Pure;

class Processadora
{
    private readonly string $nomeSanitizado;
    private readonly mixed $retornoDecodificado;

    public function __construct(
        private readonly string $nomeOriginal
    ) {}

    /**
     * @throws Exception
     */
    public static function executa(string $name): Gender
    {
        $objeto = new Processadora($name);
        $objeto->sanitiza();
        $objeto->valida();
        $objeto->processaRequisicao();
        return $objeto->processaResultado();
    }

    public function sanitiza()
    {
        $this->nomeSanitizado = trim($this->nomeOriginal);
    }

    /**
     * @throws Exception
     */
    public function valida()
    {
        if (empty($this->nomeSanitizado)) {
            throw new Exception("O nome não pode estar em branco.", 3);
        }

        if (count(explode(" ", $this->nomeSanitizado)) > 1) {
            throw new Exception("O nome não pode conter espaços.", 2);
        }
    }

    private function urlDaRequisicao(): string
    {
        $parametroNome = urlencode($this->nomeSanitizado);
        return "https://api.genderize.io?name=$parametroNome";
    }

    #[Pure] private function enviaRequisicao(): bool|string
    {
        // enviar requisição
        return file_get_contents($this->urlDaRequisicao());
    }

    /**
     * @throws Exception
     */
    public function processaRequisicao()
    {
        // processar requisição
        $retornoBruto = $this->enviaRequisicao();

        if ($retornoBruto === false) {
            throw new Exception("Não foi possível processar requisição", 1);
        }

        $this->retornoDecodificado = json_decode($retornoBruto);
        if (is_null($this->retornoDecodificado)) {
            throw new Exception("Não foi possível decodificar resultado da requisição.", 5);
        }

        if (!isset($this->retornoDecodificado->probability)) {
            throw new Exception("Atributo de probabilidade inexistente.", 6);
        }

        if (!isset($this->retornoDecodificado->gender)) {
            throw new Exception("Atributo de gênero inexistente.", 7);
        }
    }

    public function processaResultado(): Gender
    {
        // processar resultado
        if ($this->retornoDecodificado->probability <= 0.5) {
            return Gender::UNKNOWN;
        }

        if ($this->retornoDecodificado->gender === "male") {
            return Gender::MASCULINE;
        }

        return Gender::FEMININE;
    }
}