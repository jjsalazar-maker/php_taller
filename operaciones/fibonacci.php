<?php
$numero = $_POST['numero'];

 class Fibonacci
{
    private int $numero;

    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }

    public function mostrarSerie(): string
    {
        $a = 0;
        $b = 1;
        $serie = "";

        for ($i = 0; $i < $this->numero; $i++) {
            $serie .= $a;

            if ($i < $this->numero - 1) {
                $serie .= ", ";
            }

            $siguiente = $a + $b;
            $a = $b;
            $b = $siguiente;
        }
        return $serie;
    }
}

$numero = $_POST['numero'] ?? 0;

$fibonacci = new Fibonacci((int)$numero);
$fibonacci->mostrarSerie();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/grid.css">
    <title>Fibonnacci</title>
</head>
<body>
    <div class="menu-apps">
        <h2>serie fibonacci de <?php echo $numero?></h2>
        <p><?php echo $fibonacci->mostrarSerie()?></p>
        <a href="../index.php">volver al menú</a>
        <a href="../aplicaciones/fibofac.php">volver al formulario</a>
    </div>
</body>
</html>