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

class NotificadorEmail implements NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool {
        echo "E-mail enviado para {$titular->nome}: $mensagem<br>";
        return true;
    }
}

class NotificadorSMS implements NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool {
        echo "SMS enviado para {$titular->nome}: $mensagem<br>";
        return true;
    }
}

class NotificadorWhatsApp implements NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool {
        echo "WhatsApp enviado para {$titular->nome}: $mensagem<br>";
        return true;
    }
}

// Teste das notificações
$titular = new Titular('Maria da Silva', '12345678901');

$conta = new ContaPoupanca(
    '0001',
    '2000-1',
    $titular,
    1000.00
);

$conta->adicionarNotificador(new NotificadorEmail());
$conta->adicionarNotificador(new NotificadorSMS());
$conta->adicionarNotificador(new NotificadorWhatsApp());

$conta->depositar(200.00);
$conta->sacar(100.00);

echo '<br>Saldo atual: R$ ' . number_format(
    $conta->getSaldo(),
    2,
    ',',
    '.'
);