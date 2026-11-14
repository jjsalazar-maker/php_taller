<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora  </title>
    <link rel="stylesheet" href="../css/float.css">
</head>

<body>
    <div>
        <form action="../operaciones/operar.php" method="post">
            <label for="primero">Primer cifra</label>
            <input type="number" name="primero" id="primero" step="any">

            <label for="segundo">Segunda cifra</label>
            <input type="number" name="segundo" id="segundo" step="any">

            <label for="operacion">Operación:</label>

            <select name="operacion" id="operacion" required>
                <option value="+">Suma (+)</option>
                <option value="-">Resta (-)</option>
                <option value="*">Multiplicación (*)</option>
                <option value="/">División (/)</option>
                <option value="%">Modulo (%)</option>
            </select>

            <button type="submit">realizar operacion</button>
        </form>

        <a href="../index.php">Volver al menú</a>
        
    </div>    
</body>
</html>