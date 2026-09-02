<?php

declare(strict_types=1);

$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];

$nome = $usuario["nome"];

if ($usuario["premium"] == true) {
    $nome = $nome . "⭐";
}

echo "<div>";

echo "<h2>$nome</h2>";

echo "<p>Idade: " . $usuario["idade"] . "</p>";

echo "<p>Cidade: " . $usuario["cidade"] . " - " . $usuario["estado"] . "</p>";

echo "</div>";