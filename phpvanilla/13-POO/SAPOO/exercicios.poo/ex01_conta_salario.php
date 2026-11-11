<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Exceptions/ContaException.php';
require_once __DIR__ . '/../src/Exceptions/SaldoInsuficienteException.php';
require_once __DIR__ . '/../src/Exceptions/ValorInvalidoException.php';
require_once __DIR__ . '/../src/Dominio/Titular.php';
require_once __DIR__ . '/../src/Dominio/Transacao.php';
require_once __DIR__ . '/../src/Dominio/NotificadorInterface.php';
require_once __DIR__ . '/../src/Dominio/ContaBancaria.php';

final class ContaSalario extends ContaBancaria
{
    private int $saquesNoMes = 0;
    private string $mesAtual;

    public function __construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        private readonly string $cnpjEmpregador,
        float $saldoInicial = 0.0
    ) {
        parent::__construct($agencia, $numeroConta, $titular, $saldoInicial);
        $this->mesAtual = date('m/Y');
    }

    public function depositar(float $valor): void
    {
        throw new ContaException(
            'Depósito permitido somente pelo empregador.'
        );
    }

    public function depositarDoEmpregador(
        string $cnpj,
        float $valor
    ): void {
        if (!hash_equals($this->cnpjEmpregador, $cnpj)) {
            throw new ContaException('Empregador não autenticado.');
        }

        parent::depositar($valor);
    }

    #[Override]
    public function sacar(float $valor): void
    {
        $this->atualizarMes();

        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }

        $tarifa = $this->saquesNoMes >= 2 ? 4.00 : 0.00;
        $total = $valor + $tarifa;

        if ($total > $this->saldo) {
            throw new SaldoInsuficienteException($this->saldo, $total);
        }

        $this->saldo -= $total;
        $this->saquesNoMes++;

        $this->registrarTransacao('Saque salário', $total);
        $this->notificarTodos('Saque realizado na conta salário.');
    }

    public function transferir(
        float $valor,
        ContaBancaria $destino
    ): void {
        if ($destino->titular !== $this->titular) {
            throw new ContaException(
                'A transferência só pode ser feita para conta do mesmo titular.'
            );
        }

        parent::transferir($valor, $destino);
    }

    private function atualizarMes(): void
    {
        $mes = date('m/Y');

        if ($mes !== $this->mesAtual) {
            $this->saquesNoMes = 0;
            $this->mesAtual = $mes;
        }
    }
}

// Teste da conta salário
$titular = new Titular('Maria da Silva', '12345678901');

$conta = new ContaSalario(
    '0001',
    '3000-1',
    $titular,
    '12.345.678/0001-90',
    1000.00
);

$conta->depositarDoEmpregador('12.345.678/0001-90', 500.00);
$conta->sacar(100.00);

echo 'Saldo: R$ ' . number_format(
    $conta->getSaldo(),
    2,
    ',',
    '.'
);