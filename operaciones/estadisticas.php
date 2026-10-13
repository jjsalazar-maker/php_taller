<?php

class TendenciaCentral
{
    private array $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    public function media(): float
    {
        return array_sum($this->datos) / count($this->datos);
        // devuelve la sumatoria de los datos en el arreglo y los divide en el tamaño de este mismo
    }

    public function mediana(): float
    {
        $datos = $this->datos;

        sort($datos); //sort ordena los valores del array en orden creciente

        $n = count($datos);

        if ($n % 2 == 0) {

            $centro1 = $datos[$n / 2 - 1];
            $centro2 = $datos[$n / 2];

            return ($centro1 + $centro2) / 2;

        } else {

            return $datos[floor($n / 2)];
        }
    }

    public function moda(): string
    {
        $frecuencias = array_count_values($this->datos);

        $maxFrecuencia = max($frecuencias);

        if ($maxFrecuencia == 1) {
            return "No existe moda";
        }

        $modas = [];

        foreach ($frecuencias as $valor => $frecuencia) {

            if ($frecuencia == $maxFrecuencia) {
                $modas[] = $valor;
            }
        }

        return implode(", ", $modas);
    }

    public function mostrarResultados(): void
    {
        echo '<main class="contenedor-estadisticas">';
        echo '<h1>Medidas de tendencia central</h1>';

        if (empty($this->datos)) {
            echo '<p>No se recibieron datos para calcular.</p>';
        } else {
            echo '<div class="resultados">';

            echo '<div class="tarjeta">';
            echo '<h2>Media</h2>';
            echo '<p>' . $this->media() . '</p>';
            echo '</div>';

            echo '<div class="tarjeta">';
            echo '<h2>Mediana</h2>';
            echo '<p>' . $this->mediana() . '</p>';
            echo '</div>';

            echo '<div class="tarjeta">';
            echo '<h2>Moda</h2>';
            echo '<p>' . $this->moda() . '</p>';
            echo '</div>';

            echo '</div>';
        }

        echo '</main>';
    }
}

$datos = $_POST['datos'] ?? [];

$estadisticas = new TendenciaCentral($datos);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="../css/flexbox.css">
</head>
<body>

    <?php
    $estadisticas->mostrarResultados();
    ?>

    
</body>
</html>