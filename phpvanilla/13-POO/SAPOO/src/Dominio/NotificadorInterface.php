<?php
declare(strict_types=1);

interface NotificadorInterface
{
    public function notificar(
        Titular $titular,
        string $mensagem
    ): bool;
}