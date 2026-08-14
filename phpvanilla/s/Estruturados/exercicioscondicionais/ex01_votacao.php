<?php
declare(strict_types=1);

// Variável mockada para teste
$idade = 10;

if ($idade < 16) {
    echo "Voto Proibido";
} elseif (($idade >= 16 && $idade <= 17) || $idade >= 70) {
    echo "Voto Facultativo";
} else {
    echo "Voto Obrigatório";
}
?>