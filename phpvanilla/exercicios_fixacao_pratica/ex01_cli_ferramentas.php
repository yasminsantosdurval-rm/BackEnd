<?php

declare(strict_types=1);

// Cria a conexão com o banco de dados.
function conectarBanco(): PDO

{$dsn = 'pgsql:host=127.0.0.1;port=5432;dbname=almoxarifado_senai';

    return new PDO($dsn, 'postgres', 'postgres', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

// Cadastra uma nova ferramenta.
function cadastrarFerramenta(PDO $pdo): void
{
    $nome = trim((string) readline('Nome da ferramenta: '));
    $quantidade = (int) readline('Quantidade: ');

    $sql = 'INSERT INTO ferramentas (nome, quantidade, ativo)
            VALUES (:nome, :quantidade, TRUE)';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->execute();

    echo "Ferramenta cadastrada com sucesso.\n";
}

// Lista somente as ferramentas ativas.
function listarFerramentas(PDO $pdo): void
{
    $sql = 'SELECT id, nome, quantidade
            FROM ferramentas
            WHERE ativo = TRUE
            ORDER BY id';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    foreach ($stmt->fetchAll() as $ferramenta) {
        echo "{$ferramenta['id']} - {$ferramenta['nome']} - ";
        echo "Quantidade: {$ferramenta['quantidade']}\n";
    }
}

// Apresenta o menu do programa.
function executarMenu(PDO $pdo): void
{
    while (true) {
        echo "\n1 - Cadastrar nova ferramenta\n";
        echo "2 - Listar ferramentas ativas\n";
        echo "3 - Sair\n";

        $opcao = trim((string) readline('Escolha: '));

        if ($opcao === '1') {
            cadastrarFerramenta($pdo);
        } elseif ($opcao === '2') {
            listarFerramentas($pdo);
        } elseif ($opcao === '3') {
            echo "Programa encerrado.\n";
            break;
        } else {
            echo "Opção inválida.\n";
        }
    }
}

// Inicia o programa.
$pdo = conectarBanco();
executarMenu($pdo);
