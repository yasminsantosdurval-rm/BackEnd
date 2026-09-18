<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$recados = [];
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (strlen($nome) < 3) {
        $erro = 'O nome deve ter pelo menos 3 caracteres.';
    } elseif (strlen($mensagem) < 5) {
        $erro = 'A mensagem deve ter pelo menos 5 caracteres.';
    } else {
        $recados[] = [
            'nome' => $nome,
            'mensagem' => $mensagem
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mural de Recados</title>
</head>
<body>

<h1>Mural de Recados</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome">

    <br><br>

    <label>Mensagem:</label>
    <textarea name="mensagem"></textarea>

    <br><br>

    <button type="submit">Enviar</button>
</form>

<hr>

<?php foreach ($recados as $recado): ?>
    <p>
        <strong><?= e($recado['nome']) ?></strong>
    </p>

    <p><?= nl2br(e($recado['mensagem'])) ?></p>

    <hr>
<?php endforeach; ?>

</body>
</html>