<?php
declare(strict_types=1);

require_once __DIR__ . '/UsuarioDAO.php';
require_once __DIR__ . '/../12-autenticacao/SAAutenticacao/src/ConexaoBanco.php';

// Função para ler os dados no terminal
function lerTexto(string $mensagem): string
{
    echo $mensagem;
    return trim((string) fgets(STDIN));
}

// Verifica a complexidade da senha
function validarSenha(string $senha): bool
{
    return strlen($senha) >= 8
        && preg_match('/[A-Z]/', $senha) === 1
        && preg_match('/[a-z]/', $senha) === 1
        && preg_match('/[0-9]/', $senha) === 1
        && preg_match('/[^a-zA-Z0-9]/', $senha) === 1;
}

try {
    // Recebe os dados do colaborador
    $nome = lerTexto("Nome: ");
    $email = lerTexto("E-mail: ");
    $senha = lerTexto("Senha: ");

    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException("Nome ou e-mail inválido.");
    }

    if (!validarSenha($senha)) {
        throw new RuntimeException("Senha não atende aos requisitos.");
    }

    // Gera o hash seguro da senha
    $senhaHash = password_hash($senha, PASSWORD_ARGON2ID);

    if ($senhaHash === false) {
        throw new RuntimeException("Não foi possível gerar o hash.");
    }

    // Conecta ao banco e cadastra o usuário
    $caminhoConfig = __DIR__ .
        '/../12-autenticacao/SAAutenticacao/config/database.ini';

    $conexao = ConexaoBanco::obterConexao($caminhoConfig);
    $usuarioDAO = new UsuarioDAO($conexao);

    $usuarioDAO->cadastrar($nome, $email, $senhaHash);

    echo "\nColaborador cadastrado com sucesso!\n";

} catch (Throwable $erro) {
    echo "\nErro: " . $erro->getMessage() . "\n";
}