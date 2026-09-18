<?php

declare(strict_types=1);

function sanitizarTexto(string $dado): string
{
    return trim(strip_tags($dado));
}

function validarColaborador(array $dados): array
{
    $erros = [];

    if ($dados['nome'] === '') {
        $erros[] = 'Nome obrigatório.';
    }

    if (filter_var($dados['email'], FILTER_VALIDATE_EMAIL) === false) {
        $erros[] = 'E-mail inválido.';
    }

    if (filter_var($dados['matricula'], FILTER_VALIDATE_INT) === false) {
        $erros[] = 'Matrícula inválida.';
    }

    if (filter_var($dados['salario'], FILTER_VALIDATE_FLOAT) === false) {
        $erros[] = 'Salário inválido.';
    }

    return [
        'erros' => $erros,
        'dados' => $dados
    ];
}

$erros = [];
$colaborador = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => sanitizarTexto($_POST['nome'] ?? ''),
        'email' => sanitizarTexto($_POST['email'] ?? ''),
        'matricula' => sanitizarTexto($_POST['matricula'] ?? ''),
        'salario' => sanitizarTexto($_POST['salario'] ?? '')
    ];

    $resultado = validarColaborador($dados);
    $erros = $resultado['erros'];

    if (count($erros) === 0) {
        $colaborador = $resultado['dados'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaborador</title>
</head>
<body>

<h1>Cadastro de Colaborador</h1>

<?php foreach ($erros as $erro): ?>
    <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endforeach; ?>

<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome">

    <br><br>

    <label>E-mail:</label>
    <input type="text" name="email">

    <br><br>

    <label>Matrícula:</label>
    <input type="text" name="matricula">

    <br><br>

    <label>Salário:</label>
    <input type="text" name="salario">

    <br><br>

    <button type="submit">Cadastrar</button>
</form>

<?php if ($colaborador !== null): ?>
    <h2>Cadastro realizado</h2>

    <p>Nome: <?= htmlspecialchars($colaborador['nome'], ENT_QUOTES, 'UTF-8') ?></p>
    <p>E-mail: <?= htmlspecialchars($colaborador['email'], ENT_QUOTES, 'UTF-8') ?></p>
    <p>Matrícula: <?= htmlspecialchars($colaborador['matricula'], ENT_QUOTES, 'UTF-8') ?></p>
    <p>Salário: <?= htmlspecialchars($colaborador['salario'], ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

</body>
</html>