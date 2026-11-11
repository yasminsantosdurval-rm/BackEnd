<?php
declare(strict_types=1);

session_start();

// Verifica se o usuário tem a permissão necessária
function verificarPermissao(string $perfilMinimo): void
{
    $perfilUsuario = $_SESSION['perfil'] ?? '';

    if ($perfilUsuario !== $perfilMinimo) {
        http_response_code(403);
        echo "Erro 403: Acesso negado. Permissão insuficiente.\n";
        exit;
    }
}

// Simula um usuário OPERADOR
$_SESSION['perfil'] = 'OPERADOR';

echo "Verificando acesso à área ADMIN...\n";

verificarPermissao('ADMIN');

echo "Acesso permitido!\n";