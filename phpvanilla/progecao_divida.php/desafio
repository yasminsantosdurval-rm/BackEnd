<?php

$categoria = 'B';
$divida = 1000;
$dividaAtual = $divida;

$taxa = match ($categoria) {
    'A' => 0.01,
    'B' => 0.02,
    'C' => 0.03,
    default => 0.05,
};

echo "Taxa: " . ($taxa * 100) . "%";

for ($mes = 1; $mes <= 12; $mes++) {

    if ($mes == 6) {
        echo "Mês 6: Isenção de juros (Anistia)";
        continue;
    }

    $juros = $dividaAtual * $taxa;
    $dividaAtual = $dividaAtual + $juros;

    echo "Mês $mes: Juros R$ $juros | Saldo R$ $dividaAtual";
}
