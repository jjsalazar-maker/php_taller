<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../aplicaciones/conjuntos.php");
    exit;
}

// Obtener los datos enviados.
$entradaA = trim($_POST["conA"] ?? "");
$entradaB = trim($_POST["conB"] ?? "");

// Función para convertir una entrada en un conjunto de números reales.
function crearConjunto(string $entrada): array
{
    if ($entrada === "") {
        throw new InvalidArgumentException("Debes ingresar los números de ambos conjuntos.");
    }

    $partes = explode(",", $entrada);
    $conjunto = [];

    foreach ($partes as $parte) {
        $parte = trim($parte);

        // Validar que cada elemento sea un número.
        if ($parte === "" || !is_numeric($parte)) {
            echo '<a href="../aplicaciones/conjuntos.php">volver al formulario</a>';
            throw new InvalidArgumentException(
            "Todos los elementos deben ser números y separados por comas.");
        }

        $numero = (float) $parte;

        if (!is_finite($numero)) {
            echo '<a href="../aplicaciones/conjuntos.php">volver al fomrulario</a>';
            throw new InvalidArgumentException("Los números deben ser finitos.");

        }

        // Evitar elementos repetidos.
        if (!in_array($numero, $conjunto, true)) {
            $conjunto[] = $numero;
        }
    }

    return $conjunto;
}

try {
    $conA = crearConjunto($entradaA);
    $conB = crearConjunto($entradaB);
} catch (InvalidArgumentException $e) {
    exit("Error: " . htmlspecialchars($e->getMessage()));
}

// 1. UNION: elementos de A y B, sin repetir.
$union = array_values(array_unique(
    array_merge($conA, $conB),
    SORT_REGULAR
));

// 2. INTERSECCION: elementos comunes a A y B.
$interseccion = [];

foreach ($conA as $numero) {
    if (in_array($numero, $conB, true)) {
        $interseccion[] = $numero;
    }
}

// 3. DIFERENCIA A - B: elementos de A que no están en B.
$diferenciaAB = [];

foreach ($conA as $numero) {
    if (!in_array($numero, $conB, true)) {
        $diferenciaAB[] = $numero;
    }
}

// 4. DIFERENCIA B - A: elementos de B que no están en A.
$diferenciaBA = [];

foreach ($conB as $numero) {
    if (!in_array($numero, $conA, true)) {
        $diferenciaBA[] = $numero;
    }
}

// Función para mostrar los conjuntos.
function mostrarConjunto(array $conjunto): string
{
    if (empty($conjunto)) {
        return "∅";
    }

    return "{ " . implode(", ", $conjunto) . " }";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones con conjuntos</title>
    <link rel="stylesheet" href="../css/float.css">
</head>
<body>

    <h1>Resultados de las operaciones</h1>

    <p><strong>Conjunto A:</strong>
        <?= htmlspecialchars(mostrarConjunto($conA)) ?>
    </p>

    <p><strong>Conjunto B:</strong>
        <?= htmlspecialchars(mostrarConjunto($conB)) ?>
    </p>

    <hr>

    <h2>Unión (A ∪ B)</h2>
    <p><?= htmlspecialchars(mostrarConjunto($union)) ?></p>

    <h2>Intersección (A ∩ B)</h2>
    <p><?= htmlspecialchars(mostrarConjunto($interseccion)) ?></p>

    <h2>Diferencia (A - B)</h2>
    <p><?= htmlspecialchars(mostrarConjunto($diferenciaAB)) ?></p>

    <h2>Diferencia (B - A)</h2>
    <p><?= htmlspecialchars(mostrarConjunto($diferenciaBA)) ?></p>

    <a href="../index.php">volver al menú</a>

</body>
</html>