<?php

declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

class PecaMovimentacaoDAO
{
    public function __construct(private PDO $pdo)
    {
    }

    // Registra entrada ou saída dentro de uma transação.
    public function registrarMovimentacao(int $pecaId, int $quantidade, string $tipo): bool
    {
        if ($pecaId < 1 || $quantidade < 1) return false;
        if (!in_array($tipo, ['entrada', 'saida'], true)) return false;
        try {
            $this->pdo->beginTransaction();
            $saldo = $this->buscarQuantidade($pecaId);
            $novoSaldo = $this->calcularSaldo($saldo, $quantidade, $tipo);
            if ($novoSaldo < 0) { $this->pdo->rollBack(); return false; }
            $this->atualizarQuantidade($pecaId, $novoSaldo);
            $this->pdo->commit();
            return true;
        } catch (Throwable $erro) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            return false;
        }
    }

    // Consulta o saldo e bloqueia a linha durante a transação.
    private function buscarQuantidade(int $pecaId): int
    {
        $stmt = $this->pdo->prepare('SELECT quantidade FROM pecas_industriais WHERE id = :id FOR UPDATE');
        $stmt->bindValue(':id', $pecaId, PDO::PARAM_INT);
        $stmt->execute();
        $saldo = $stmt->fetchColumn();
        if ($saldo === false) throw new RuntimeException('Peça não encontrada.');
        return (int) $saldo;
    }

    // Calcula o saldo depois da movimentação.
    private function calcularSaldo(int $saldo, int $quantidade, string $tipo): int
    {
        return $tipo === 'saida' ? $saldo - $quantidade : $saldo + $quantidade;
    }

    // Atualiza o saldo usando parâmetros nomeados.
    private function atualizarQuantidade(int $pecaId, int $quantidade): void
    {
        $sql = 'UPDATE pecas_industriais SET quantidade = :quantidade WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindValue(':id', $pecaId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

// Solicita os dados da movimentação pelo terminal.
try {
    $dao = new PecaMovimentacaoDAO(conectarBanco());
    $id = (int) readline('ID da peça: ');
    $quantidade = (int) readline('Quantidade movimentada: ');
    $tipo = strtolower(trim((string) readline('Tipo (entrada/saida): ')));
    echo $dao->registrarMovimentacao($id, $quantidade, $tipo)
        ? "Movimentação registrada.\n" : "Movimentação cancelada. Confira o ID, o saldo e os dados.\n";
} catch (PDOException $erro) {
    echo "Erro ao acessar o banco: " . $erro->getMessage() . "\n";
}
