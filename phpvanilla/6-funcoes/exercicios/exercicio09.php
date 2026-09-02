<?php

declare(strict_types=1);

function buscarCliente(array $clientes, string $nome): ?array
{
    foreach ($clientes as $cliente) {
        if ($cliente["nome"] === $nome) {
            return $cliente;
        }
    }

    return null;
}

$clientes = [
    [
        "nome" => "Yasmin",
        "idade" => 18
    ],
    [
        "nome" => "Maria",
        "idade" => 20
    ]
];

$cliente = buscarCliente($clientes, "Yasmin");

if ($cliente !== null) {
    echo "Cliente encontrado: " . $cliente["nome"] . "<br>";
    echo "Idade: " . $cliente["idade"];
} else {
    echo "Cliente não encontrado";
}

echo "<hr>";

$cliente = buscarCliente($clientes, "João");

if ($cliente !== null) {
    echo "Cliente encontrado: " . $cliente["nome"];
} else {
    echo "Cliente não encontrado";
}