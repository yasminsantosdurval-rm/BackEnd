<?php
declare(strict_types=1);

final class ContaPoupanca extends ContaBancaria
{
    #[Override]
    public function sacar(float $valor): void
    {
        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }

        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException(
                $this->saldo,
                $valor
            );
        }

        $this->saldo -= $valor;

        $this->registrarTransacao('Saque', $valor);

        $this->notificarTodos(
            'Saque realizado: R$ ' .
            number_format($valor, 2, ',', '.')
        );
    }

    public function renderJuros(float $percentual): void
    {
        if ($percentual <= 0.0) {
            throw new ValorInvalidoException($percentual);
        }

        $rendimento = $this->saldo * ($percentual / 100);
        $this->saldo += $rendimento;

        $this->registrarTransacao('Rendimento', $rendimento);

        $this->notificarTodos(
            'Rendimento aplicado: R$ ' .
            number_format($rendimento, 2, ',', '.')
        );
    }
}