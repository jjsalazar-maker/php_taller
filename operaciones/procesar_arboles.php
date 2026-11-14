<?php

function crearArbol(array $numeros, string $recorrido): ?array
{
    if (count($numeros) === 0) {
        return null;
    }

    $cantidad = count($numeros);

    if ($recorrido === 'preorden') {
        $raiz = $numeros[0];

        $restantes = array_slice($numeros, 1);
        $mitad = intdiv(count($restantes), 2);

        $izquierda = array_slice($restantes, 0, $mitad);
        $derecha = array_slice($restantes, $mitad);

    } elseif ($recorrido === 'inorden') {
        $mitad = intdiv($cantidad, 2);
        $raiz = $numeros[$mitad];

        $izquierda = array_slice($numeros, 0, $mitad);
        $derecha = array_slice($numeros, $mitad + 1);

    } else { //si el recorrido es postorden, no lo puse porque por descarte se puede asumir

        $raiz = $numeros[$cantidad - 1];

        $restantes = array_slice($numeros, 0, $cantidad - 1);
        $mitad = intdiv(count($restantes), 2);

        $izquierda = array_slice($restantes, 0, $mitad);
        $derecha = array_slice($restantes, $mitad);
    }

    return [
        'valor' => $raiz,
        'izquierda' => crearArbol($izquierda, $recorrido),
        'derecha' => crearArbol($derecha, $recorrido)
    ];
}


function recorrer(?array $nodo, string $tipo): array
{
    if ($nodo === null) {
        return [];
    }

    $raiz = [$nodo['valor']];
    $izquierda = recorrer($nodo['izquierda'], $tipo);
    $derecha = recorrer($nodo['derecha'], $tipo);

    if ($tipo === 'preorden') {
        return array_merge($raiz, $izquierda, $derecha);
    }

    if ($tipo === 'inorden') {
        return array_merge($izquierda, $raiz, $derecha);
    }

    return array_merge($izquierda, $derecha, $raiz);
}


function dibujarArbol(?array $nodo): void
{
    if ($nodo === null) {
        return;
    }

    echo '<li>';
    echo '<span class="nodo">'
        . htmlspecialchars((string)$nodo['valor'], ENT_QUOTES, 'UTF-8')
        . '</span>';

    if (
        $nodo['izquierda'] !== null ||
        $nodo['derecha'] !== null
    ) {
        echo '<ul>';

        if ($nodo['izquierda'] !== null) {
            dibujarArbol($nodo['izquierda']);
        } else {
            echo '<li class="vacio"><span>∅</span></li>';
        }

        if ($nodo['derecha'] !== null) {
            dibujarArbol($nodo['derecha']);
        } else {
            echo '<li class="vacio"><span>∅</span></li>';
        }

        echo '</ul>';
    }

    echo '</li>';
}


// 1. Verificar que el formulario se haya enviado mediante POST.

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: arboles.php');
    exit;
}


// 2. Recuperar y validar los recorridos.

$secuencia = trim($_POST['secuencia'] ?? '');
$recorrido1 = $_POST['recorrido1'] ?? '';
$recorrido2 = $_POST['recorrido2'] ?? '';

$permitidos = ['preorden', 'inorden', 'postorden'];

if (
    !in_array($recorrido1, $permitidos, true) ||
    !in_array($recorrido2, $permitidos, true)
) {
    exit('Error: selecciona recorridos válidos.');
}

if ($recorrido1 === $recorrido2) {
    exit('Error: debes seleccionar dos recorridos diferentes.');
}


// 3. Validar y convertir la secuencia en un arreglo de enteros.

if ($secuencia === '') {
    exit('Error: la secuencia no puede estar vacía.');
}

$partes = preg_split('/[\s,]+/', $secuencia);

if ($partes === false || count($partes) > 100) {
    exit('Error: la secuencia no es válida o supera los 100 nodos.');
}

$numeros = [];

foreach ($partes as $parte) {
    if (!preg_match('/^[+-]?\d+$/', $parte)) {
        exit('Error: todos los elementos deben ser números enteros.');
    }

    $numero = filter_var($parte, FILTER_VALIDATE_INT);

    if ($numero === false) {
        exit('Error: uno de los números está fuera del rango permitido.');
    }

    $numeros[] = $numero;
}


// 4. Exigir valores únicos para simplificar la interpretación.

if (count(array_unique($numeros, SORT_REGULAR)) !== count($numeros)) {
    exit('Error: no se permiten números repetidos.');
}


// 5. Construir los dos árboles.

$arbol1 = crearArbol($numeros, $recorrido1);
$arbol2 = crearArbol($numeros, $recorrido2);


// 6. Obtener las secuencias de los recorridos originales de cada árbol.

$resultado1 = recorrer($arbol1, $recorrido1);
$resultado2 = recorrer($arbol2, $recorrido2);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de árboles binarios</title>
    <link rel="stylesheet" href="../css/flexbox.css">
</head>
<body>
    <main class="contenedor resultados">

        <h1>Árboles binarios construidos</h1>

        <p>
            Secuencia de entrada:
            <strong>
                <?= htmlspecialchars(implode(', ', $numeros), ENT_QUOTES, 'UTF-8') ?>
            </strong>
        </p>

        <section class="tarjeta">
            <h2>Árbol 1: <?= ucfirst($recorrido1) ?></h2>

            <div class="diagrama">
                <ul class="arbol">
                    <?php dibujarArbol($arbol1); ?>
                </ul>
            </div>

            <h3>Recorrido <?= ucfirst($recorrido1) ?></h3>

            <p class="secuencia">
                <?= htmlspecialchars(implode(' → ', $resultado1), ENT_QUOTES, 'UTF-8') ?>
            </p>
        </section>

        <section class="tarjeta">
            <h2>Árbol 2: <?= ucfirst($recorrido2) ?></h2>

            <div class="diagrama">
                <ul class="arbol">
                    <?php dibujarArbol($arbol2); ?>
                </ul>
            </div>

            <h3>Recorrido <?= ucfirst($recorrido2) ?></h3>

            <p class="secuencia">
                <?= htmlspecialchars(implode(' → ', $resultado2), ENT_QUOTES, 'UTF-8') ?>
            </p>
        </section>

        <a class="boton" href="arboles.php">Construir otros árboles</a>

    </main>
</body>
</html>