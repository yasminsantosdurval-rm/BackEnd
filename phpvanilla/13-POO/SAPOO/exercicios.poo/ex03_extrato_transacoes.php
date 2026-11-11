<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Exceptions/ContaException.php';
require_once __DIR__ . '/../src/Exceptions/SaldoInsuficienteException.php';
require_once __DIR__ . '/../src/Exceptions/ValorInvalidoException.php';
require_once __DIR__ . '/../src/Dominio/Titular.php';
require_once __DIR__ . '/../src/Dominio/Transacao.php';
require_once __DIR__ . '/../src/Dominio/NotificadorInterface.php';
require_once __DIR__ . '/../src/Dominio/ContaBancaria.php';
require_once __DIR__ . '/../src/Dominio/ContaPoupanca.php';

// Criando a conta
$titular = new Titular('Maria da Silva', '12345678901');

$conta = new ContaPoupanca(
    '0001',
    '2000-1',
    $titular,
    1000.00
);

// Realizando movimentações
$conta->depositar(300.00);
$conta->sacar(150.00);
$conta->renderJuros(1.0);

// Buscando o extrato
$extrato = $conta->getExtrato();

echo '<h2>Extrato bancário</h2>';
echo '<table border="1" cellpadding="8">';
echo '<tr>';
echo '<th>Tipo</th>';
echo '<th>Valor</th>';
echo '<th>Data e hora</th>';
echo '<th>Status</th>';
echo '</tr>';

foreach ($extrato as $transacao) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($transacao->tipo) . '</td>';
    echo '<td>R$ ' . number_format(
        $transacao->valor,
        2,
        ',',
        '.'
    ) . '</td>';
    echo '<td>' . htmlspecialchars($transacao->dataHora) . '</td>';
    echo '<td>' . ($transacao->sucesso ? 'Sucesso' : 'Falha') . '</td>';
    echo '</tr>';
}

echo '</table>';

echo '<h3>Saldo atual: R$ ' . number_format(
    $conta->getSaldo(),
    2,
    ',',
    '.'
) . '</h3>';