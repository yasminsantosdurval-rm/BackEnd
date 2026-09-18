<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$nome = '';
$linkValido = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $url = trim($_POST['url'] ?? '');

    if ($nome === '') {
        $erro = 'Informe o nome.';
    } elseif (
        filter_var($url, FILTER_VALIDATE_URL) === false
        || (!str_starts_with($url, 'http://')
        && !str_starts_with($url, 'https://'))
    ) {
        $erro = 'Informe uma URL válida com http:// ou https://.';
    } else {
        $linkValido = $url;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Validador de Links</title>
</head>
<body>

<h1>Portfólio</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= e($nome) ?>">

    <br><br>

    <label>Link:</label>
    <input type="text" name="url">

    <br><br>

    <button type="submit">Cadastrar</button>
</form>

<?php if ($linkValido !== ''): ?>
    <p><?= e($nome) ?></p>

    <a href="<?= e($linkValido) ?>" target="_blank">
        Visitar Portfólio
    </a>
<?php endif; ?>

</body>
</html>