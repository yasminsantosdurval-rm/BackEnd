<?php

$produtos = [
    ['id' => 1, 'nome' => 'iPhone 15', 'categoria' => 'Smartphone', 'preco' => 6500.00],
    ['id' => 2, 'nome' => 'Galaxy S24', 'categoria' => 'Smartphone', 'preco' => 5400.00],
    ['id' => 3, 'nome' => 'MacBook Air', 'categoria' => 'Notebook', 'preco' => 8900.00],
    ['id' => 4, 'nome' => 'Monitor Dell 27', 'categoria' => 'Perifericos', 'preco' => 1200.00],
    ['id' => 5, 'nome' => 'Mouse Logitech', 'categoria' => 'Perifericos', 'preco' => 450.00]
];


// Filtrar apenas os Smartphones
$smartphones = array_filter($produtos, function($p) {
    return $p['categoria'] == 'Smartphone';
});


// Dar 15% de desconto
$smartphonesComDesconto = array_map(function($p) {
    $p['preco'] = $p['preco'] * 0.85;
    return $p;
}, $smartphones);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Vitrine TechSenai</title>
</head>

<body>

    <h2>Ofertas Especiais: Smartphones (15% OFF)</h2>

    <?php foreach ($smartphonesComDesconto as $produto) { ?>

        <div>

            <p><?php echo $produto['categoria']; ?></p>

            <h3><?php echo $produto['nome']; ?></h3>

            <p>
                R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
            </p>

        </div>

    <?php } ?>

</body>

</html>
