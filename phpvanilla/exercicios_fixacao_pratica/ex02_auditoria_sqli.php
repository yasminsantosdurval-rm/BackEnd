<?php

declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

// Demonstra a consulta vulnerável; use somente neste teste controlado.
function buscarVulneravel(string $termo): void
{
    global $pdo;
    $sql = "SELECT id, nome FROM ferramentas WHERE nome = '$termo'";
    try {
        $resultado = $pdo->query($sql)->fetchAll();
        echo 'Vulnerável: ' . count($resultado) . " registro(s) encontrado(s).\n";
    } catch (PDOException $erro) {
        echo "Vulnerável: a consulta gerou um erro.\n";
    }
}

// Consulta de forma segura usando um parâmetro nomeado.
function buscarProtegido(string $termo): void
{
    global $pdo;
    $sql = 'SELECT id, nome FROM ferramentas WHERE nome = :termo';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':termo', $termo);
    $stmt->execute();
    echo 'Protegido: ' . count($stmt->fetchAll()) . " registro(s) encontrado(s).\n";
}

// Executa o exemplo solicitado no enunciado.
try {
    $pdo = conectarBanco();
    $teste = "' OR '1'='1";
    echo "Comparação de SQL Injection\n";
    buscarVulneravel($teste);
    buscarProtegido($teste);
} catch (PDOException $erro) {
    echo "Erro ao acessar o banco: " . $erro->getMessage() . "\n";
}
