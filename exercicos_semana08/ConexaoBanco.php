<?php

declare(strict_types=1);

class ConexaoBanco
{
    private static ?PDO $conexao = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception("Não permitido.");
    }

    public static function obterConexao(string $arquivo): PDO
    {
        if (self::$conexao !== null) {
            return self::$conexao;
        }

        $config = parse_ini_file($arquivo, true);

        if ($config === false) {
            throw new Exception("Arquivo de configuração não encontrado.");
        }

        $dados = $config['development'] ?? $config;

        $dsn = "pgsql:host={$dados['db_host']};";
        $dsn .= "port={$dados['db_port']};";
        $dsn .= "dbname={$dados['db_name']}";

        self::$conexao = new PDO(
            $dsn,
            $dados['db_user'],
            $dados['db_password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        return self::$conexao;
    }
}