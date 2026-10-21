<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/float.css">
    <title>DecimalBinario</title>
</head>
<body>
    <header class="encabezado">
        <h1>Conversor decimal a binario</h1>
        <p>Transforma números decimales a su equivalente binario.</p>
    </header>

    <main class="contenedor">
        <section class="columna-principal">
            <form action="../operaciones/binario.php" method="post">
                <label for="Decimal">ingrese un número entero</label>
                <input type="number" name="decimal" id="decimal" min=0 required>
                <button type="submit">Transformar binario</button>
            </form>
        </section>
    </main>
</body>
</html>