<?php

namespace App\Shared\Application\Contract;

interface TransactionManagerInterface
{
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
}
