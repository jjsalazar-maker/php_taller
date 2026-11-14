<?php
class Acronimo
{
    private string $phrase;
    
    public function __construct(string $phrase)
    {
        $this->phrase = $phrase;
    }
    
    public function generar(): string
    {
        //str_replace($buscar, $reemplazar, $cadena), devuelve string
        $texto = str_replace('-', ' ', $this->phrase);
    
        //preg_split($patron, $cadena), devuelve array
        $palabras = preg_split('/\s+/', trim($texto));

        $acronimo = '';
    
        foreach ($palabras as $palabra) {
        $acronimo .= strtoupper($palabra[0]);
        }
    
        return $acronimo;
    }
}

//operador de coalescencia nula
$phrase = $_POST['phrase'] ?? '';

$acronimo = new Acronimo($phrase);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acrónimos</title>
    <link rel="stylesheet" href="../css/grid.css">
</head>
<body>
    <div class="menu-apps">
        <p>El Acronimo de "<?php echo $phrase ?>" es: </p>
        <h2> <?php echo  $acronimo->generar() ?> </h2>
        <a href="../index.php">volver al menú</a>
    </div>
</body>
</html>

