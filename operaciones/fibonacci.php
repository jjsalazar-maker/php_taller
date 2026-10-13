<?php
$numero = $_POST['numero'];

 class Fibonacci
{
    private int $numero;

    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }

    public function mostrarSerie(): void
{
    $a = 0;
    $b = 1;

    echo "<h2>Serie Fibonacci</h2>";
    echo "<p>";

    for ($i = 0; $i < $this->numero; $i++) {
        echo $a;

        if ($i < $this->numero - 1) {
            echo ", ";
        }

        $siguiente = $a + $b;
        $a = $b;
        $b = $siguiente;
    }

    echo "</p>";
    }
}

$numero = $_POST['numero'] ?? 0;

$fibonacci = new Fibonacci((int)$numero);
$fibonacci->mostrarSerie();