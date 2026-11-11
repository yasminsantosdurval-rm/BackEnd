<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Exceptions/ContaException.php';
require_once __DIR__ . '/../src/Exceptions/SaldoInsuficienteException.php';
require_once __DIR__ . '/../src/Exceptions/ValorInvalidoException.php';
require_once __DIR__ . '/../src/Dominio/Titular.php';
require_once __DIR__ . '/../src/Dominio/Transacao.php';
require_once __DIR__ . '/../src/Dominio/NotificadorInterface.php';
require_once __DIR__ . '/../src/Dominio/ContaBancaria.php';
require_once __DIR__ . '/../src/Dominio/ContaCorrente.php';
require_once __DIR__ . '/../src/Dominio/ContaPoupanca.php';

$titular = new Titular('Maria da Silva', '12345678901');

$conta = new ContaCorrente(
    '0001',
    '1000-1',
    $titular,
    1000.00
);

$testes = 0;

echo '<h2>Testes de encapsulamento</h2>';

// Teste 1: tentar alterar atributo privado
try {
    $conta->limiteChequeEspecial = 9000.00;
    echo 'Falha: atributo privado foi alterado.<br>';
} catch (Error $erro) {
    echo 'Teste 1: atributo privado protegido.<br>';
    $testes++;
}

// Teste 2: tentar criar uma classe abstrata
try {
    $contaAbstrata = new ContaBancaria(
        '0001',
        '9999-1',
        $titular,
        1000.00
    );

    echo 'Falha: classe abstrata foi criada.<br>';
} catch (Error $erro) {
    echo 'Teste 2: classe abstrata não pode ser criada.<br>';
    $testes++;
}

// Teste 3: tentar fazer depósito negativo
try {
    $conta->depositar(-100.00);
    echo 'Falha: depósito negativo foi aceito.<br>';
} catch (ValorInvalidoException $erro) {
    echo 'Teste 3: depósito negativo foi bloqueado.<br>';
    $testes++;
}

echo '<br>Testes aprovados: ' . $testes . ' de 3.';