
<?php

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // El formulario envía los datos al archivo de construcción.
    header("Location: ../operaciones/construir_arbol.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/flexbox.css">

    <title>Constructor de árboles binarios</title>

</head>

<body>

    <main class="contenedor-estadisticas">

        <h1>Constructor de árboles binarios</h1>

        <form class="formulario-datos" action="../operaciones/construir_arbol.php" method="POST">

            <h2>Ingrese los números enteros</h2>

            <div class="dato">

                <label for="numeros">
                    Secuencia de números
                </label>

                <input
                    type="text"
                    id="numeros"
                    name="numeros"
                    placeholder="Ejemplo: 7, 4, 3, 5, 9, 8, 12"
                    required
                >

                <small>
                    Separe los números utilizando comas o espacios.
                    No se permiten números repetidos.
                </small>

            </div>

            <h2>Seleccione dos recorridos</h2>

            <div class="seleccion-recorridos">

                <label class="opcion-recorrido">

                    <input type="checkbox" name="recorridos[]" value="preorden">

                    Preorden

                </label>

                <label class="opcion-recorrido">

                    <input type="checkbox" name="recorridos[]" value="inorden">

                    Inorden

                </label>

                <label class="opcion-recorrido">

                    <input type="checkbox" name="recorridos[]" value="postorden">

                    Postorden

                </label>

            </div>

            <button type="submit">
                Construir árboles
            </button>

        </form>

    </main>

</body>

</html>
