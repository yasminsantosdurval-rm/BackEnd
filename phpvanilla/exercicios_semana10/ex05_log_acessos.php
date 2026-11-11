<?php
declare(strict_types=1);

require_once __DIR__ . '/../12-autenticacao/SAAutenticacao/src/ConexaoBanco.php';

try {
    $caminhoConfig = __DIR__ .
        '/../12-autenticacao/SAAutenticacao/config/database.ini';

    $conexao = ConexaoBanco::obterConexao($caminhoConfig);

    echo "E-mail do usuário: ";
    $email = trim((string) fgets(STDIN));

    echo "Login foi bem-sucedido? (s/n): ";
    $resposta = strtolower(trim((string) fgets(STDIN)));

    $sucesso = $resposta === 's';

    $ip = '127.0.0.1';
    $userAgent = 'Acesso pelo terminal';

    $sql = "INSERT INTO auditoria_logins
            (email, ip, user_agent, sucesso)
            VALUES (:email, :ip, :user_agent, :sucesso)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':email' => $email,
        ':ip' => $ip,
        ':user_agent' => $userAgent,
        ':sucesso' => $sucesso
    ]);

    echo "\nAcesso registrado com sucesso!\n";

    // Exibe os registros de auditoria
    $consulta = $conexao->query(
        "SELECT * FROM auditoria_logins ORDER BY id DESC"
    );

    echo "\n--- LOG DE ACESSOS ---\n";

    foreach ($consulta->fetchAll() as $registro) {
        echo "E-mail: " . $registro['email'] . "\n";
        echo "IP: " . $registro['ip'] . "\n";
        echo "Sucesso: " . ($registro['sucesso'] ? 'Sim' : 'Não') . "\n";
        echo "Data: " . $registro['data_hora'] . "\n";
        echo "----------------------\n";
    }

} catch (Throwable $erro) {
    echo "Erro: " . $erro->getMessage() . "\n";
}