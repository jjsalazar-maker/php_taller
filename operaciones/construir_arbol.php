<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../aplicaciones/arbol.php");
    exit;
}

$error = "";

// Recibir información del formulario.
$entrada = trim($_POST["numeros"] ?? "");
$recorridos = $_POST["recorridos"] ?? [];

//VALIDAR LOS NÚMEROS

$numeros = [];

$partes = preg_split(
    '/[\s,;]+/',
    $entrada,
    -1,
    PREG_SPLIT_NO_EMPTY
);

if (empty($partes)) {

    $error = "Debe ingresar al menos un número.";

} else {

    foreach ($partes as $parte) {

        // Validar números enteros.
        if (!preg_match('/^-?\d+$/', $parte)) {

            $error = "La secuencia solo puede contener números enteros.";
            break;

        }

        $numero = filter_var($parte, FILTER_VALIDATE_INT);

        if ($numero === false) {

            $error = "Uno de los números está fuera del rango permitido.";
            break;

        }

        // No permitir números repetidos.
        if (in_array($numero, $numeros, true)) {

            $error = "No se permiten números repetidos.";
            break;

        }

        $numeros[] = $numero;

    }

}

//VALIDAR LOS RECORRIDOS
$permitidos = ["preorden", "inorden", "postorden"];

if ($error === "") {

    if (!is_array($recorridos)) {
        $error = "Debe seleccionar al menos dos recorridos.";

    } else {

        // Validar que todos sean recorridos permitidos
        foreach ($recorridos as $tipo) {
            if (!is_string($tipo) || !in_array($tipo, $permitidos, true)) {
                $error = "Se seleccionó un recorrido no válido.";
                break;
            }
        }

        if ($error === "") {

            // Eliminar posibles valores duplicados
            $recorridos = array_unique($recorridos);

            if (count($recorridos) < 2) {
                $error = "Debe seleccionar al menos dos recorridos.";

            } elseif (count($recorridos) === 3) {

                // Si seleccionó los tres, utilizar Preorden e Inorden
                $recorridos = ["preorden", "inorden"];
            }
        }
    }
}

// 3. CONSTRUIR UN NODO DEL ÁRBOL
function crearNodo(int $valor): array
{
    return [
        "valor" => $valor,
        "izquierda" => null,
        "derecha" => null
    ];
}

// ======================================
// 4. INSERTAR UN NÚMERO EN EL ABB
// ======================================

function insertarNodo(?array $raiz, int $valor): array
{
    if ($raiz === null) {
        return crearNodo($valor);
    }

    if ($valor < $raiz["valor"]) {

        $raiz["izquierda"] = insertarNodo(
            $raiz["izquierda"],
            $valor
        );

    } else {

        $raiz["derecha"] = insertarNodo(
            $raiz["derecha"],
            $valor
        );

    }

    return $raiz;
}

//CONSTRUIR EL ÁRBOL COMPLETO
function construirArbol(array $numeros): ?array
{
    $raiz = null;

    foreach ($numeros as $numero) {

        $raiz = insertarNodo($raiz, $numero);

    }

    return $raiz;
}

//RECORRIDO PREORDEN
function preorden(?array $nodo): array
{
    if ($nodo === null) {
        return [];
    }

    return array_merge(
        [$nodo["valor"]],
        preorden($nodo["izquierda"]),
        preorden($nodo["derecha"])
    );
}

//RECORRIDO INORDEN

function inorden(?array $nodo): array
{
    if ($nodo === null) {
        return [];
    }

    return array_merge(
        inorden($nodo["izquierda"]),
        [$nodo["valor"]],
        inorden($nodo["derecha"])
    );
}

//RECORRIDO POSTORDEN

function postorden(?array $nodo): array
{
    if ($nodo === null) {
        return [];
    }

    return array_merge(
        postorden($nodo["izquierda"]),
        postorden($nodo["derecha"]),
        [$nodo["valor"]]
    );
}

//OBTENER EL RECORRIDO SELECCIONADO

function obtenerRecorrido(
    ?array $raiz,
    string $tipo
): array {

    switch ($tipo) {

        case "preorden":
            return preorden($raiz);

        case "inorden":
            return inorden($raiz);

        case "postorden":
            return postorden($raiz);

        default:
            return [];

    }
}

// 10. GENERAR EL GRAFO HTML

function dibujarArbol(?array $nodo): string
{
    if ($nodo === null) {
        return "";
    }

    $html = "<li>";

    $html .= '<div class="nodo">';

    $html .= htmlspecialchars(
        (string)$nodo["valor"],
        ENT_QUOTES,
        "UTF-8"
    );

    $html .= "</div>";

    // Comprobar si tiene hijos.
    if (
        $nodo["izquierda"] !== null ||
        $nodo["derecha"] !== null
    ) {

        $html .= "<ul>";

        // Dibujar hijo izquierdo.
        if ($nodo["izquierda"] !== null) {

            $html .= dibujarArbol(
                $nodo["izquierda"]
            );

        }

        // Dibujar hijo derecho.
        if ($nodo["derecha"] !== null) {

            $html .= dibujarArbol(
                $nodo["derecha"]
            );

        }

        $html .= "</ul>";

    }

    $html .= "</li>";

    return $html;
}

// 11. CONSTRUIR LOS DOS ÁRBOLES

if ($error === "") {

    // Árbol 1: secuencia original.
    $arbol1 = construirArbol($numeros);

    // Árbol 2: secuencia invertida.
    $numerosInvertidos = array_reverse($numeros);

    $arbol2 = construirArbol($numerosInvertidos);

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/flexbox_arbol.css">
    <title>Resultado de los árboles</title>
</head>

<body>
    <main class="contenedor-estadisticas">
        <h1>Resultado de los árboles binarios</h1>
        <?php if ($error !== ""): ?>
            <div class="mensaje-error">
                <?php echo htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?>
            </div>
        <?php else: ?>
            <p class="secuencia-original">
                <strong>Secuencia ingresada:</strong>
                <?php echo implode(" → ", $numeros); ?>
            </p>

            <?php
            $arboles = [
                [
                    "titulo" => "Árbol 1",
                    "orden" => "Original",
                    "raiz" => $arbol1
                ],
                [
                    "titulo" => "Árbol 2",
                    "orden" => "Inverso",
                    "raiz" => $arbol2
                ]
            ];

            foreach ($arboles as $indice => $arbolActual):

                $tipo = $recorridos[$indice];
                $raizActual = $arbolActual["raiz"];

                $resultado = obtenerRecorrido(
                    $raizActual,
                    $tipo
                );
            ?>
                <section class="seccion-arbol">

                    <h2>
                        <?php echo $arbolActual["titulo"]; ?>
                        - <?php echo ucfirst($tipo); ?>
                    </h2>

                    <p class="descripcion-arbol">
                        Orden de inserción:
                        <?php echo $arbolActual["orden"]; ?>
                    </p>

                    <div class="arbol-contenedor">

                        <div class="arbol">
                            <ul> <?php echo dibujarArbol($raizActual);?></ul>
                        </div>
                    </div>

                    <div class="recorrido-resultado">
                        <h3> Recorrido <?php echo ucfirst($tipo); ?> </h3>
                        <p> <?php echo implode(" → ", $resultado);?> </p>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>

        <a class="boton-volver" href="../aplicaciones/arbol.php">
            Volver al formulario
        </a>

    </main>

</body>

</html>
