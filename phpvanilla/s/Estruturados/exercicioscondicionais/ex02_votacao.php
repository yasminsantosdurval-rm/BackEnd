<?php
declare(strict_types=1);

//Variavel mockada para teste
$valorCompra = 200.50;

$statusFrete = ($valorCompra >= 250.00) ? "Frete Grátis" : "Frete R$ 25,00";

echo $statusFrete;

?>