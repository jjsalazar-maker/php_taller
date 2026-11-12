<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci/Factorial</title>
    <link rel="stylesheet" href="../css/float.css">
</head>

<body>
    <form method="post">
        <label for="numero">Ingrese un número:</label>
        <input type="number" name="numero" id="numero" min="0" required>

        <br><br>

        <p>¿Que desea obtener?</p>

        <div>
            <button formaction="../operaciones/fibonacci.php">Fibonacci</button>

            <button formaction="../operaciones/factorial.php">Factorial</button>
            
        </div>

    </form>
    
</body>
</html>