<?php

class ArbolBinario
{
    private array $preorden = ['A', 'B', 'D', 'E', 'C'];
    private array $inorden = ['D', 'B', 'E', 'A', 'C'];
    private array $postorden = ['D', 'E', 'B', 'C', 'A'];

    public function obtenerRecorridos(): array
    {
        return [
            'preorden' => $this->preorden,
            'inorden' => $this->inorden,
            'postorden' => $this->postorden
        ];
    }

    public function validarRecorrido(
        string $entrada,
        string $tipo
    ): bool {

        $recorridos = $this->obtenerRecorridos();

        if (!isset($recorridos[$tipo])) {
            return false;
        }

        // Aceptar comas, espacios o punto y coma
        $entrada = strtoupper(trim($entrada));

        $nodos = preg_split(
            '/[\s,;]+/',
            $entrada,
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        return $nodos === $recorridos[$tipo];
    }
}