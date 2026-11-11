<?php
declare(strict_types=1);

// Recebe o hash pelo terminal
echo "Digite o hash da senha: ";
$hash = trim((string) fgets(STDIN));

// Verifica as informações do hash
$info = password_get_info($hash);

if ($info['algoName'] === 'unknown') {
    echo "Hash inválido.\n";
    exit;
}

// Separa as partes do hash
$partes = explode('$', $hash);

echo "\n--- INFORMAÇÕES DO HASH ---\n";
echo "Algoritmo: " . $info['algoName'] . "\n";
echo "Versão: " . ($partes[2] ?? 'Não identificada') . "\n";
echo "Custo de memória: " . ($info['options']['memory_cost'] ?? 'Não disponível') . "\n";
echo "Custo de tempo: " . ($info['options']['time_cost'] ?? 'Não disponível') . "\n";
echo "Salt: " . ($partes[4] ?? 'Não identificado') . "\n";
echo "Hash: " . $hash . "\n";