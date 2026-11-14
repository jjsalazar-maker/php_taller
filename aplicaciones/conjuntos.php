<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/float.css">
</head>
<body>
    <form action="../operaciones/conjuntosop.php" method="post">
        <div>
            <label for="Conjuento A">Ingrese numeros para el conjunto A:</label>
            <input type="text" name="conA" id="conA" placeholder="Ej. 1, 2.5, 3, 7" required>
        </div>

          <div>
            <label for="Conjuento B">Ingrese numeros para el conjunto B:</label>
            <input type="text" name="conB" id="conB" placeholder="Ej. 1, 2.5, 3, 7" required>
        </div>

        <button type="submit">operar conjuntos</button>
        <a href="../index.php">volver al menu</a>
    </form>
</body>
</html>