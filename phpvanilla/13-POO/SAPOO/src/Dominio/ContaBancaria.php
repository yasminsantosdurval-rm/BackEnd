<?php
declare(strict_types=1);

abstract class ContaBancaria
{
    protected float $saldo;
    protected array $historico = [];
    protected array $notificadores = [];

    public function __construct(
        public readonly string $agencia,
        public readonly string $numeroConta,
        public readonly Titular $titular,
        float $saldoInicial = 0.0
    ) {
        if ($saldoInicial < 0.0) {
            throw new ValorInvalidoException($saldoInicial);
        }

        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }

        $this->saldo += $valor;

        $this->registrarTransacao('Depósito', $valor);

        $this->notificarTodos(
            'Depósito realizado: R$ ' .
            number_format($valor, 2, ',', '.')
        );
    }

    abstract public function sacar(float $valor): void;

    public function transferir(
        float $valor,
        ContaBancaria $contaDestino
    ): void {
        if ($this === $contaDestino) {
            throw new ContaException(
                'Não é possível transferir para a mesma conta.'
            );
        }

        $this->sacar($valor);
        $contaDestino->depositar($valor);
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function adicionarNotificador(
        NotificadorInterface $notificador
    ): void {
        $this->notificadores[] = $notificador;
    }

    protected function registrarTransacao(
        string $tipo,
        float $valor
    ): void {
        $this->historico[] = new Transacao(
            $tipo,
            $valor,
            date('d/m/Y H:i:s'),
            true
        );
    }

    protected function notificarTodos(string $mensagem): void
    {
        foreach ($this->notificadores as $notificador) {
            $notificador->notificar($this->titular, $mensagem);
        }
    }

    public function getExtrato(): array
    {
        return $this->historico;
    }
}