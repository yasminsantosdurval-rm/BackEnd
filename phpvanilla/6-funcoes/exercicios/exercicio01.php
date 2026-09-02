<?php

declare(strict_types=1);

function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}

$imc1 = calcularIMC(60, 1.65);
$imc2 = calcularIMC(75, 1.75);
$imc3 = calcularIMC(90, 1.80);

echo "IMC 1: " . number_format($imc1, 2) . "<br>";
echo "IMC 2: " . number_format($imc2, 2) . "<br>";
echo "IMC 3: " . number_format($imc3, 2);