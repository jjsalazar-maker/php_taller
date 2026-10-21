<?php

$decimal = $_POST['decimal'];
$cifra = $_POST['decimal'];

class DecimalBinario
{
    private int $decimal;

    public function __construct(int $decimal)
    {
        $this->decimal = $decimal;
    }

    public function convertir(): string
    {
        if ($this->decimal === 0) {
            return "0";
        }

        $decimal = $this->decimal;
        $binario = "";

        while ($decimal > 0) {
            $residuo = $decimal % 2;
            $binario = $residuo . $binario;
            $decimal = intdiv($decimal, 2);
        }

        return $binario;
    }
}

$ejecutar = new DecimalBinario($decimal);
$binario = $ejecutar->convertir();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/float.css">
    <title>Resultado binario</title>
</head>
<body>
    <header class="encabezado">
        <h1>Conversor decimal a binario</h1>
        <p>Resultado de la conversión</p>
    </header>

    <main class="contenedor">
        <section class="columna-principal">
            <h2>Número convertido</h2>

            <p>El equivalente binario de
                <strong><?php echo $cifra; ?></strong> es:
            </p>

            <p class="resultado">
                <?php echo $binario; ?>
            </p>
        </section>
</body>
</html>