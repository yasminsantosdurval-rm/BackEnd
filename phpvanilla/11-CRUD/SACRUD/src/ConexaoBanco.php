<?php
declare(strict_types=1);

final class ConexaoBanco {

    private static ?PDO $instancia = null;

    private function __construct() {}

    private function __clone(): void {}

    public function __wakeup(): void {
        throw new \Exception("Desserializacao nao permitida.");
    }

    public static function obterConexao(string $caminhoConfig): PDO {
        if (self::$instancia === null) {
            $config = self::carregarConfig($caminhoConfig);
            self::$instancia = self::criarConexao($config);
        }
        return self::$instancia;
    }

    private static function carregarConfig(string $caminho): array {
        if (!file_exists($caminho)) {
            throw new \RuntimeException("Arquivo de configuracao ausente.");
        }
        $dados = parse_ini_file($caminho, true);
        if ($dados === false || !isset($dados['database'])) {
            throw new \RuntimeException("Secao [database] invalida no arquivo INI.");
        }
        return $dados['database'];
    }

    private static function criarConexao(array $cfg): PDO {
        $dsn = sprintf("%s:host=%s;port=%s;dbname=%s",
            $cfg['db_driver'], $cfg['db_host'], $cfg['db_port'], $cfg['db_name']);

        $opcoes = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 5
        ];

        return new PDO($dsn, $cfg['db_user'], $cfg['db_pass'], $opcoes);
    }
}