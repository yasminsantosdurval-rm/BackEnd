<?php

declare(strict_types=1);

// Lê o arquivo de configuração
$config = parse_ini_file('config/database.ini', true);

try {
    // Pega os dados do ambiente development
    $dados = $config['development'];

    $dsn = "pgsql:host={$dados['db_host']};";
    $dsn .= "port={$dados['db_port']};";
    $dsn .= "dbname={$dados['db_name']}";

    // Cria a conexão com o PostgreSQL
    $pdo = new PDO(
        $dsn,
        $dados['db_user'],
        $dados['db_password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    // Consulta a versão do PostgreSQL
    $versao = $pdo->query('SELECT version()')->fetchColumn();

    echo "Porta 5432 acessível.\n";
    echo "Banco de dados acessível.\n";
    echo "Conexão realizada com sucesso!\n";
    echo "Versão do PostgreSQL: $versao\n";

} catch (PDOException $e) {
    echo "Erro: não foi possível conectar ao banco.\n";
}