<?php

declare(strict_types=1);

// Registra mensagens no arquivo de log
function registrarLog(string $nivel, string $mensagem): void
{
    $niveis = ['INFO', 'WARNING', 'ERROR'];

    if (!in_array($nivel, $niveis, true)) {
        return;
    }

    $data = date('Y-m-d H:i:s');
    $linha = "[$data] [$nivel] $mensagem" . PHP_EOL;

    file_put_contents('logs/sistema.log', $linha, FILE_APPEND);
}

// Lê os dados do arquivo de configuração
$config = parse_ini_file('config/database.ini');

try {
    // Tenta conectar no banco
    $pdo = new PDO(
        "pgsql:host={$config['db_host']};port={$config['db_port']};dbname={$config['db_name']}",
        $config['db_user'],
        $config['db_password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    registrarLog('INFO', 'Conexão realizada com sucesso.');
    echo "Conexão realizada com sucesso.\n";

} catch (PDOException $e) {
    registrarLog('ERROR', 'Falha na conexão com o banco.');
    echo "Não foi possível conectar ao banco.\n";
}

// Simula uma falha de conexão
try {
    $pdoTeste = new PDO(
        'pgsql:host=127.0.0.1;port=5432;dbname=banco_inexistente',
        $config['db_user'],
        $config['db_password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    registrarLog('ERROR', 'Falha de conexão simulada.');
    echo "Falha simulada registrada no log.\n";
}