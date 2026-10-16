<?php
declare(strict_types=1);

// Faz a conexão com o banco PostgreSQL.
function conectarBanco(): PDO
{
    $dsn = 'pgsql:host=127.0.0.1;port=5432;dbname=almoxarifado_senai';

    return new PDO($dsn, 'postgres', 'postgres', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

// Protege textos exibidos em páginas HTML.
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}