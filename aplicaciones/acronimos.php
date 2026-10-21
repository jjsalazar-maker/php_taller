<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Acronimos</title>
    <link rel="stylesheet" href="../css/grid.css">
</head>

<body>
    <div class ="menu-apps"> 
        <form action="../operaciones/acronimar.php" method="post">
            <div>
                <label for="phrase">Ingrese una frase:</label>
                <input type="text" name="phrase" id="phrase" required>
            </div>

            <div>
                <button type="submit">crear acronimo</button>
            </div>
        </form>
    </div>
</body>
</html>