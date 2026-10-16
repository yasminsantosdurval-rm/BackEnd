<?php

declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

// Busca cinco peças da página solicitada.
function listarPecas(PDO $pdo, int $pagina): array
{
    $offset = ($pagina - 1) * 5;
    $sql = 'SELECT id, nome, categoria, fornecedor, quantidade FROM pecas_industriais ORDER BY id LIMIT :limite OFFSET :offset';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limite', 5, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Lê e valida o número da página recebido pela URL.
$pagina = (int) ($_GET['p'] ?? 1);
$pagina = max(1, $pagina);

try {
    $pecas = listarPecas(conectarBanco(), $pagina);
} catch (PDOException $erro) {
    exit('Erro ao consultar as peças. Confira a conexão e execute criar_tabelas.sql.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de peças</title>
</head>
<body>
    <h1>Catálogo de peças industriais</h1>
    <p>Página: <?= e((string) $pagina) ?></p>
    <?php if ($pecas === []): ?>
        <p>Não há peças nesta página.</p>
    <?php else: ?>
        <table border="1">
            <thead><tr><th>ID</th><th>Nome</th><th>Categoria</th><th>Fornecedor</th><th>Quantidade</th></tr></thead>
            <tbody>
                <?php foreach ($pecas as $peca): ?>
                    <tr>
                        <td><?= e((string) $peca['id']) ?></td>
                        <td><?= e((string) $peca['nome']) ?></td>
                        <td><?= e((string) $peca['categoria']) ?></td>
                        <td><?= e((string) $peca['fornecedor']) ?></td>
                        <td><?= e((string) $peca['quantidade']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <p>
        <?php if ($pagina > 1): ?>
            <a href="?p=<?= $pagina - 1 ?>">Página anterior</a>
        <?php endif; ?>
        <a href="?p=<?= $pagina + 1 ?>">Próxima página</a>
    </p>
</body>
</html>
