<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$arquivo = 'chat.json';
$mensagens = [];

if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $mensagens = json_decode($conteudo, true) ?? [];
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remetente = e(trim($_POST['remetente'] ?? ''));
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($mensagem === '') {
        $erro = 'Digite uma mensagem.';
    } elseif (mb_strlen($mensagem) > 250) {
        $erro = 'A mensagem não pode ultrapassar 250 caracteres.';
    } else {
        $mensagens[] = [
            'remetente' => $remetente,
            'mensagem' => $mensagem
        ];

        file_put_contents($arquivo, json_encode($mensagens, JSON_PRETTY_PRINT));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Chat da Operação</title>
</head>
<body>

<h1>Chat da Operação</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="post">
    <label>Remetente:</label>

    <select name="remetente">
        <option value="Operador">Operador</option>
        <option value="Supervisor">Supervisor</option>
    </select>

    <br><br>

    <label>Mensagem:</label>
    <br>

    <textarea name="mensagem"></textarea>

    <br><br>

    <button type="submit">Enviar</button>
</form>

<hr>

<?php foreach ($mensagens as $mensagem): ?>
    <p>
        <strong><?= e($mensagem['remetente']) ?>:</strong>
        <?= nl2br(e($mensagem['mensagem'])) ?>
    </p>
<?php endforeach; ?>

</body>
</html>