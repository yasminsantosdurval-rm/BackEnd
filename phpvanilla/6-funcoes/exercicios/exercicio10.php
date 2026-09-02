<?php

declare(strict_types=1);

function retirarEstoque(array &$produto, int $quantidade): bool
{
    if ($quantidade <= 0) {
        return false;
    }

    if ($quantidade > $produto["estoque"]) {
        return false;
    }

    $produto["estoque"] = $produto["estoque"] - $quantidade;

    return true;
}

$produto = [
    "nome" => "Caderno",
    "estoque" => 10
];

if (retirarEstoque($produto, 3)) {
    echo "Retirada permitida.<br>";
    echo "Estoque atual: " . $produto["estoque"];
} else {
    echo "Retirada recusada.";
}

echo "<hr>";

if (retirarEstoque($produto, 20)) {
    echo "Retirada permitida.";
} else {
    echo "Retirada recusada. Estoque insuficiente.";
}