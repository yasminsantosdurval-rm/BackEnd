<?php

declare(strict_types=1);

$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];

$totalEntradas = 0;
$totalSaidas = 0;

foreach ($extrato as $transacao) {

    if ($transacao["tipo"] == "Entrada") {
        $totalEntradas = $totalEntradas + $transacao["valor"];
    }

    if ($transacao["tipo"] == "Saida") {
        $totalSaidas = $totalSaidas + $transacao["valor"];
    }
}

$saldoAtual = $totalEntradas - $totalSaidas;

echo "<h2>Entradas</h2>";
echo "R$ " . number_format($totalEntradas, 2, ",", ".");

echo "<h2>Saídas</h2>";
echo "R$ " . number_format($totalSaidas, 2, ",", ".");

echo "<h2>Saldo Atual</h2>";

if ($saldoAtual < 0) {
    echo "<p style='color: red;'>R$ " . number_format($saldoAtual, 2, ",", ".") . "</p>";
} else {
    echo "<p style='color: green;'>R$ " . number_format($saldoAtual, 2, ",", ".") . "</p>";
}

echo "<table border='1'>";

echo "<tr>";
echo "<th>Data</th>";
echo "<th>Descrição</th>";
echo "<th>Tipo</th>";
echo "<th>Valor</th>";
echo "</tr>";

foreach ($extrato as $transacao) {

    echo "<tr>";

    echo "<td>" . $transacao["data"] . "</td>";
    echo "<td>" . $transacao["descricao"] . "</td>";
    echo "<td>" . $transacao["tipo"] . "</td>";
    echo "<td>R$ " . number_format($transacao["valor"], 2, ",", ".") . "</td>";

    echo "</tr>";
}

echo "</table>";

$gastosAltos = array_filter(
    $extrato,
    fn($transacao) =>
        $transacao["tipo"] == "Saida" &&
        $transacao["valor"] > 100
);

echo "<h2>Atenção: Gastos Altos do Mês</h2>";

foreach ($gastosAltos as $gasto) {
    echo $gasto["descricao"] . " - R$ ";
    echo number_format($gasto["valor"], 2, ",", ".");
    echo "<br>";
}