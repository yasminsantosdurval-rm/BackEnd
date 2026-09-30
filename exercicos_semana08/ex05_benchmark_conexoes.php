<?php

declare(strict_types=1);

require_once 'ConexaoBanco.php';

const ARQUIVO_CONFIG = 'config/database.ini';

// Lê os dados do ambiente de desenvolvimento
$config = parse_ini_file(ARQUIVO_CONFIG, true);

try {
    $dados = $config['development'];

    // Teste com 50 novas conexões
    $memoriaInicio = memory_get_usage();
    $inicio = microtime(true);

    for ($i = 0; $i < 50; $i++) {
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

        $pdo = null;
    }

    $tempoSemSingleton = microtime(true) - $inicio;
    $memoriaSemSingleton = memory_get_usage() - $memoriaInicio;

    // Teste reutilizando a mesma conexão
    $memoriaInicio = memory_get_usage();
    $inicio = microtime(true);

    for ($i = 0; $i < 50; $i++) {
        ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
    }

    $tempoComSingleton = microtime(true) - $inicio;
    $memoriaComSingleton = memory_get_usage() - $memoriaInicio;

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Benchmark de Conexões</title>
</head>

<body>

    <h1>Benchmark de Conexões</h1>

    <table border="1">
        <tr>
            <th>Teste</th>
            <th>Tempo</th>
            <th>Memória</th>
        </tr>

        <tr>
            <td>50 conexões sem Singleton</td>
            <td><?= number_format($tempoSemSingleton, 6) ?> segundos</td>
            <td><?= $memoriaSemSingleton ?> bytes</td>
        </tr>

        <tr>
            <td>50 chamadas com Singleton</td>
            <td><?= number_format($tempoComSingleton, 6) ?> segundos</td>
            <td><?= $memoriaComSingleton ?> bytes</td>
        </tr>
    </table>

</body>

</html>