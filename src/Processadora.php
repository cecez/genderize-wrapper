<?php

namespace Cecez\GenderizeWrapper;

class Processadora
{
    private readonly string $nomeSanitizado;

    public function __construct(
        private readonly string $nomeOriginal
    ) {}

    public function sanitiza()
    {
        $this->nomeSanitizado = trim($this->nomeOriginal);
    }

    /**
     * @throws \Exception
     */
    public function valida()
    {
        if (empty($this->nomeSanitizado)) {
            throw new \Exception("O nome não pode estar em branco.", 3);
        }

        if (count(explode(" ", $this->nomeSanitizado)) > 1) {
            throw new \Exception("O nome não pode conter espaços.", 2);
        }
    }

    public function urlDaRequisicao()
    {
        $parametroNome = urlencode($this->nomeSanitizado);
        return "https://api.genderize.io?name=$parametroNome";
    }
}