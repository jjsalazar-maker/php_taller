<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constructor de árboles binarios</title>
</head>
<body>

    <h1>Árbol binario</h1>

    <p>Ingrese al menos dos recorridos.</p>
    <p>Separe los nodos con comas: A,B,D,E,C</p>

    <form action="../operaciones/construir_arbol.php"
          method="POST">

        <label for="preorden">Preorden:</label>
        <input type="text" id="preorden" name="preorden">

        <br><br>

        <label for="inorden">Inorden:</label>
        <input type="text" id="inorden" name="inorden">

        <br><br>

        <label for="postorden">Postorden:</label>
        <input type="text" id="postorden" name="postorden">

        <br><br>

        <button type="submit">Construir árbol</button>

    </form>

    <a href="../index.php">Volver al menú</a>

</body>
</html>