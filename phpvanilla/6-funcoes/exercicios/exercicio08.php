<?php

declare(strict_types=1);

function limparCPF(string $cpf): string
{
    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);

    return $cpf;
}

function cpfValido(string $cpf): bool
{
    $cpf = limparCPF($cpf);

    return strlen($cpf) === 11 && is_numeric($cpf);
}

$cpf = "123.456.789-00";

echo "CPF limpo: " . limparCPF($cpf) . "<br>";

if (cpfValido($cpf)) {
    echo "CPF válido";
} else {
    echo "CPF inválido";
}