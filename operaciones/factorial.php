 <?php
 $numero = $_POST['numero'];

class Factorial
{
    private int $numero;

    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }

    public function mostrarFactorial(): string
    {

        $factorial = 1;
        $secuencia = "";

        for ($i = 1; $i <= $this->numero; $i++) {
            $factorial *= $i;
            $secuencia .= $i;

            if ($i < $this->numero) {
                $secuencia .= "x";
            }
        }

        if ($this->numero === 0) {
            return "0! = 1";
        }

        $secuencia .= " = " . $factorial;
        return $secuencia;
    }
}

$numero = $_POST['numero'] ?? 0;

$factorial = new Factorial($numero);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/grid.css">
    <title>Factorial</title>
</head>
<body>
    <div class="menu-apps">
        <h2>Factorial de <?php echo $numero?></h2>
        <p><?php echo $factorial->mostrarFactorial()?></p>
        <a href="../index.php">volver al menú</a>
        <a href="../aplicaciones/fibofac.php">volver al formulario</a>
    </div>
</body>
</html>
