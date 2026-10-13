<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medidas de Tendencia Central</title>
    <link rel="stylesheet" href="../css/flexbox.css">
</head>
<body>
    <main class="contenedor">
        <h1>Medidas de Tendencia Central</h1>
        <?php
        $tamano = $_POST['tamano'] ?? '';
        if (!$tamano) {
        ?>
            <form method="post" class="formulario-tamano">
                <label for="tamano">Tamaño de la población:</label>
                <input type="number" name="tamano" id="tamano" min="1" required >
                <button type="submit"> Crear población </button>
            </form>

        <?php
        } else {
        ?>
            <form action="../operaciones/estadisticas.php" method="post" class="formulario-datos">

                <input
                    type="hidden"
                    name="tamano"
                    value="<?php echo htmlspecialchars((string)$tamano); ?>"
                >

                <h2>Ingrese los datos de la población</h2>

                <div class="campos-datos">

                    <?php
                    // Genera un campo por cada dato de la población
                    for ($i = 0; $i < (int)$tamano; $i++) {
                        echo "
                        <div class='dato'>
                            <label for='dato_$i'>
                                Dato " . ($i + 1) . ":
                            </label>

                            <input
                                type='number'
                                step='any'
                                id='dato_$i'
                                name='datos[]'
                                required
                            >
                        </div>";
                    }
                    ?>

                </div>

                <button type="submit">
                    Calcular estadísticas
                </button>

            </form>

        <?php
        }
        ?>

    </main>

</body>
</html>