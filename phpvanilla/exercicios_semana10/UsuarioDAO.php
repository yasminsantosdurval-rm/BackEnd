<?php
declare(strict_types=1);

final class UsuarioDAO
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrar(
        string $nome,
        string $email,
        string $senhaHash
    ): bool {
        $sql = "INSERT INTO usuarios
                (nome, email, senha_hash, perfil, ativo, criado_em)
                VALUES
                (:nome, :email, :senha_hash, 'OPERADOR', TRUE, CURRENT_TIMESTAMP)";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha_hash' => $senhaHash
        ]);
    }
}