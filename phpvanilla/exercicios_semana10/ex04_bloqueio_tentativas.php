<?php
declare(strict_types=1);

session_id('exercicio04');
session_start();

// Senha de teste
$senhaCorreta = password_hash('Senha@123', PASSWORD_DEFAULT);

// Verifica se o usuário está bloqueado
$tempoRestante = ($_SESSION['bloqueado_ate'] ?? 0) - time();

if ($tempoRestante > 0) {
    echo "Acesso bloqueado. Tente novamente em "
        . $tempoRestante . " segundos.\n";
    exit;
}

// Solicita a senha
echo "Digite a senha: ";
$senha = trim((string) fgets(STDIN));

// Verifica a senha
if (password_verify($senha, $senhaCorreta)) {
    $_SESSION['tentativas'] = 0;
    $_SESSION['bloqueado_ate'] = 0;

    echo "Login realizado com sucesso!\n";
} else {
    $_SESSION['tentativas'] =
        ($_SESSION['tentativas'] ?? 0) + 1;

    echo "Senha incorreta!\n";

    if ($_SESSION['tentativas'] >= 3) {
        $_SESSION['bloqueado_ate'] = time() + 60;
        echo "Muitas tentativas. Acesso bloqueado por 60 segundos.\n";
    } else {
        echo "Tentativas restantes: "
            . (3 - $_SESSION['tentativas']) . "\n";
    }
}