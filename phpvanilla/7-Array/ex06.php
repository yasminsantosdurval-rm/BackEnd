<?php

declare(strict_types=1);

$extrato = [
    [
        "data" => "2026-09-01",
        "descricao" => "Salário",
        "tipo" => "Entrada",
        "valor" => 4000.00
    ],
    [
        "data" => "2026-09-02",
        "descricao" => "Supermercado",
        "tipo" => "Saida",
        "valor" => 450.50
    ],
    [
        "data" => "2026-09-05",
        "descricao" => "Pix João",
        "tipo" => "Entrada",
        "valor" => 200.00
    ],
    [
        "data" => "2026-09-10",
        "descricao" => "Conta de Luz",
        "tipo" => "Saida",
        "valor" => 120.00
    ],
    [
        "data" => "2026-09-12",
        "descricao" => "Cinema",
        "tipo" => "Saida",
        "valor" => 65.00
    ]
];

$totalEntradas = 0;
$totalSaidas = 0;

foreach ($extrato as $transacao) {

    if ($transacao["tipo"] == "Entrada") {

        $totalEntradas = $totalEntradas + $transacao["valor"];

    } else {

        $totalSaidas = $totalSaidas + $transacao["valor"];
    }
}

$saldoAtual = $totalEntradas - $totalSaidas;

if ($saldoAtual < 0) {
    $corSaldo = "red";
} else {
    $corSaldo = "green";
}

echo "<h1>Dashboard Financeiro</h1>";

echo "<div style='display: flex; gap: 20px;'>";

echo "<div style='border: 1px solid black; padding: 20px;'>";
echo "<h3>Entradas</h3>";
echo "<p style='color: green;'>R$ " .
    number_format($totalEntradas, 2, ",", ".") .
    "</p>";
echo "</div>";

echo "<div style='border: 1px solid black; padding: 20px;'>";
echo "<h3>Saídas</h3>";
echo "<p style='color: red;'>R$ " .
    number_format($totalSaidas, 2, ",", ".") .
    "</p>";
echo "</div>";

echo "<div style='border: 1px solid black; padding: 20px;'>";
echo "<h3>Saldo Atual</h3>";
echo "<p style='color: $corSaldo;'>R$ " .
    number_format($saldoAtual, 2, ",", ".") .
    "</p>";
echo "</div>";

echo "</div>";

echo "<br>";

echo "<h2>Extrato do Mês</h2>";

echo "<table border='1' cellpadding='10'>";

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

    echo "<td>R$ " .
        number_format($transacao["valor"], 2, ",", ".") .
        "</td>";

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

echo "<table border='1' cellpadding='10'>";

echo "<tr>";
echo "<th>Data</th>";
echo "<th>Descrição</th>";
echo "<th>Valor</th>";
echo "</tr>";

foreach ($gastosAltos as $gasto) {

    echo "<tr>";

    echo "<td>" . $gasto["data"] . "</td>";

    echo "<td>" . $gasto["descricao"] . "</td>";

    echo "<td>R$ " .
        number_format($gasto["valor"], 2, ",", ".") .
        "</td>";

    echo "</tr>";
}

echo "</table>";