<?php
session_start();

class Calculadora
{
    private float $first;
    private float $second;
    private string $operation;

    public function __construct(
        float $first,
        float $second,
        string $operation
    ) {
        $this->first = $first;
        $this->second = $second;
        $this->operation = $operation;
    }

    public function operar():float{

        switch ($this->operation) {

            case "+":
                return $this->first + $this->second;

            case "-":
                return $this->first - $this->second;

            case "*":
                return $this->first * $this->second;

            case "/":
                if ($this->second == 0) {
                    throw new InvalidArgumentException(
                        "No se puede dividir entre cero."
                    );
                }
                return $this->first / $this->second;

            case "%":
                return $this->first % $this->second;

            default:
                throw new InvalidArgumentException(
                    "La operación seleccionada no es válida."
                );

        }
    }
}

// Inicializar el historial de la sesión.
if (!isset($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}

// Procesar el botón para borrar el historial.
if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "borrar_historial"
) {
    $_SESSION["historial"] = [];

    header("Location: operar.php");
    exit;
}

$resultado = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ( //si se da alguno de los errores al digitar
        !isset($_POST["primero"], $_POST["segundo"], $_POST["operacion"])
        || !is_numeric($_POST["primero"])
        || !is_numeric($_POST["segundo"])
    ) {
        $error = "Debes ingresar dos números válidos.";
    } else { //si el usuario digita cifras validas

        $first = (float) $_POST["primero"];
        $second = (float) $_POST["segundo"];
        $operation = $_POST["operacion"];

        try {

            $calculadora = new Calculadora(
                $first,
                $second,
                $operation
            );

            $resultado = $calculadora->operar();

            $registro = [
                "primero" => $first,
                "operacion" => $operation,
                "segundo" => $second,
                "resultado" => $resultado
            ];

            // Guardar la operación al final del historial.
            $_SESSION["historial"][] = $registro;

        } catch (InvalidArgumentException $e) {
            $error = $e->getMessage();
        }
    }
}

$historial = $_SESSION["historial"];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la calculadora</title>
    <link rel="stylesheet" href="../css/float.css">
</head>

<body>

    <div class="calculadora">

        <h1>Resultado</h1>

        <?php if ($error !== ""): ?>

            <p>
                <?php echo htmlspecialchars($error); ?>
            </p>

        <?php elseif ($resultado !== null): ?>

            <h2>
                <?php
                echo htmlspecialchars(
                    (string) $first . " "
                    . $operation . " "
                    . (string) $second . " = "
                    . (string) $resultado
                );
                ?>
            </h2>

        <?php endif; ?>

        <hr>

        <h2>Historial de operaciones</h2>

        <?php if (empty($historial)): ?>

            <p>No hay operaciones registradas.</p>

        <?php else: ?>

            <ol>
                <?php foreach ($historial as $registro): ?>

                    <li>
                        <?php
                        echo htmlspecialchars(
                            (string) $registro["primero"]
                            . " "
                            . $registro["operacion"]
                            . " "
                            . (string) $registro["segundo"]
                            . " = "
                            . (string) $registro["resultado"]
                        );
                        ?>
                    </li>

                <?php endforeach; ?>
            </ol>

            <form action="operar.php" method="POST">
                <input
                    type="hidden"
                    name="accion"
                    value="borrar_historial"
                >

                <button type="submit">
                    Borrar todo el historial
                </button>
            </form>

        <?php endif; ?>

        <a href="../aplicaciones/calculadora.php">Realizar otra operación </a>

        <a href="../index.php">Volver al menú</a>

    </div>

</body>
</html>