<?php
declare(strict_types=1);

// Variáveis mockadas para teste
$peso = 67.5;
$altura = 1.61;

// Cálculo do IMC
$imc = $peso / ($altura * $altura);

// Classificação
if ($imc < 18.5) {
    echo "Classificação: Abaixo do Peso";
} elseif ($imc >= 18.5 && $imc <= 24.9) {
    echo "Classificação: Peso Normal";
} elseif ($imc >= 25.0 && $imc <= 29.9) {
    echo "Classificação: Sobrepeso";
} elseif ($imc >= 30.0 && $imc <= 34.9) {
    echo "Classificação: Obesidade Grau I";
} else {
    echo "Classificação: Obesidade Grau II ou III";
}
