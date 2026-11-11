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

final class ContaInvestimento extends ContaBancaria
{
    public function __construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        float $saldoInicial = 0.0,
        private int $diasInvestidos = 0
    ) {
        parent::__construct($agencia, $numeroConta, $titular, $saldoInicial);
    }

    #[Override]
    public function sacar(float $valor): void
    {
        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }

        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException($this->saldo, $valor);
        }

        $this->saldo -= $valor;
        $this->registrarTransacao('Saque investimento', $valor);
        $this->notificarTodos('Saque realizado no investimento.');
    }

    private function calcularTaxaAdministracao(): float
    {
        if ($this->saldo < 10000.00) {
            return 0.01;
        }

        if ($this->saldo < 50000.00) {
            return 0.0075;
        }

        return 0.005;
    }

    private function calcularIOF(float $valor): float
    {
        if ($this->diasInvestidos >= 30) {
            return 0.0;
        }

        $taxa = (30 - $this->diasInvestidos) / 30;
        return $valor * $taxa * 0.96;
    }

    private function calcularIR(float $valor): float
    {
        if ($this->diasInvestidos <= 180) {
            return $valor * 0.225;
        }

        if ($this->diasInvestidos <= 360) {
            return $valor * 0.20;
        }

        if ($this->diasInvestidos <= 720) {
            return $valor * 0.175;
        }

        return $valor * 0.15;
    }

    public function resgatar(
        float $valor,
        ContaCorrente $destino
    ): void {
        if ($valor <= 0.0 || $valor > $this->saldo) {
            throw new ValorInvalidoException($valor);
        }

        $taxaAdministracao = $valor * $this->calcularTaxaAdministracao();
        $iof = $this->calcularIOF($valor);
        $ir = $this->calcularIR($valor);

        $valorLiquido = $valor - $taxaAdministracao - $iof - $ir;

        if ($valorLiquido <= 0.0) {
            throw new ValorInvalidoException($valorLiquido);
        }

        $this->saldo -= $valor;
        $this->registrarTransacao('Resgate de investimento', $valor);
        $destino->depositar($valorLiquido);

        echo 'Valor resgatado: R$ ' . number_format(
            $valorLiquido,
            2,
            ',',
            '.'
        );
    }
}

// Teste da conta investimento
$titular = new Titular('Maria da Silva', '12345678901');

$investimento = new ContaInvestimento(
    '0001',
    '4000-1',
    $titular,
    10000.00,
    400
);

$contaCorrente = new ContaCorrente(
    '0001',
    '1000-1',
    $titular,
    500.00
);

$investimento->resgatar(1000.00, $contaCorrente);

echo '<br>Saldo do investimento: R$ ' . number_format(
    $investimento->getSaldo(),
    2,
    ',',
    '.'
);

echo '<br>Saldo da conta corrente: R$ ' . number_format(
    $contaCorrente->getSaldo(),
    2,
    ',',
    '.'
);