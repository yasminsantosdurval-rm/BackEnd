<?php
declare(strict_types=1);

// Variáveis mockadas para teste

$cargoUsuario = "Gerente";
$senhaDigitada = "SenhaSegura";

$senhaSistema = "SenhaSegura123";

// Lógica de autenticação com precedência de operadores

if ($senhaDigitada === $senhaSistema && ($cargoUsuario === "Diretor" || $cargoUsuario === "Gerente")) {
    echo "Acesso Liberado";
} else {
    echo "Acesso Negado";
}