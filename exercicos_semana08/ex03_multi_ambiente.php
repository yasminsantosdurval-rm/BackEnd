<?php

declare(strict_types=1);

// Carrega o ambiente escolhido no arquivo .ini
function carregarAmbiente(string $ambiente): array
{
    $config = parse_ini_file('config/database.ini', true);

    if ($config === false || !isset($config[$ambiente])) {
        throw new Exception("Ambiente não encontrado.");
    }

    return $config[$ambiente];
}

try {
    // Escolhe o ambiente
    $dados = carregarAmbiente('development');

    // Monta a conexão com o banco escolhido
    $dsn = "pgsql:host={$dados['db_host']};";
    $dsn .= "port={$dados['db_port']};";
    $dsn .= "dbname={$dados['db_name']}";

    $pdo = new PDO(
        $dsn,
        $dados['db_user'],
        $dados['db_password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    echo "Ambiente conectado com sucesso!\n";
    echo "Banco: " . $dados['db_name'] . "\n";

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco.\n";
} catch (Exception $e) {
    echo "Erro ao carregar o ambiente.\n";
}