<?php

declare(strict_types=1);

require_once 'ConexaoBanco.php';

const ARQUIVO_CONFIG = 'config/database.ini';

try {
    // Cria duas variáveis usando a mesma conexão
    $conexao1 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
    $conexao2 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

    // Verifica se as duas conexões são o mesmo objeto
    if ($conexao1 === $conexao2) {
        echo "As duas variáveis usam a mesma conexão.\n";
    } else {
        echo "As conexões são diferentes.\n";
    }

    echo "ID da conexão 1: " . spl_object_id($conexao1) . "\n";
    echo "ID da conexão 2: " . spl_object_id($conexao2) . "\n";

} catch (PDOException $e) {
    echo "Erro na conexão com o banco.\n";
}