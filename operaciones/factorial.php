 <?php
 $numero = $_POST['numero'];

class Factorial
{
    private int $numero;

    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }

    public function mostrarFactorial(): void
    {

        $factorial = 1;
        $secuencia = "";

        for ($i = 1; $i <= $this->numero; $i++) {
            $factorial *= $i;
            $secuencia .= $i;

            if ($i < $this->numero) {
                $secuencia .= "x";
            }
        }
        echo "<h2>Factorial de {$this->numero}</h2>";
         echo "<p>{$this->numero}! = {$secuencia} = {$factorial}</p>";
    }
}

$numero = $_POST['numero'] ?? 0;

$factorial = new Factorial((int)$numero);
$factorial->mostrarFactorial();
