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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/grid.css">
</head>
<body>
    <p>El Acronimo de " . <?php= $phrase ?> . " es: </p>
    <h2> <?php= $acronimo->generar() ?> </h2>
</body>
</html>

