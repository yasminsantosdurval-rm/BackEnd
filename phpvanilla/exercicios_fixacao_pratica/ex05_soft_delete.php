<?php

declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

class PecaAuditoriaDAO
{
    public function __construct(private PDO $pdo)
    {
    }

    // Desativa a peça sem apagar seu registro do banco.
    public function excluir(int $id): bool
    {
        $sql = 'UPDATE pecas_industriais SET ativo = FALSE WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Lista apenas as peças que continuam ativas.
    public function listarTodos(): array
    {
        $sql = 'SELECT id, nome, quantidade FROM pecas_industriais WHERE ativo = TRUE ORDER BY id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lista todas as peças para conferência de auditoria.
    public function listarTodasParaAuditoria(): array
    {
        $stmt = $this->pdo->prepare('SELECT id, nome, ativo FROM pecas_industriais ORDER BY id');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

// Solicita o ID para demonstrar a exclusão lógica.
try {
    $dao = new PecaAuditoriaDAO(conectarBanco());
    $id = (int) readline('ID da peça que deseja desativar: ');
    echo $dao->excluir($id) ? "Peça desativada.\n" : "ID não encontrado ou peça já inativa.\n";
    echo "\nPeças ativas:\n";
    foreach ($dao->listarTodos() as $peca) {
        echo $peca['id'] . ' - ' . $peca['nome'] . ' - Quantidade: ' . $peca['quantidade'] . "\n";
    }
    echo "\nRegistros mantidos para auditoria:\n";
    foreach ($dao->listarTodasParaAuditoria() as $peca) {
        $status = $peca['ativo'] ? 'ativa' : 'inativa';
        echo $peca['id'] . ' - ' . $peca['nome'] . ' - ' . $status . "\n";
    }
} catch (PDOException $erro) {
    echo "Erro ao acessar o banco: " . $erro->getMessage() . "\n";
}