<?php

namespace App\Shared\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Shared\Application\Contract\TransactionManagerInterface;

class EloquentTransactionManager implements TransactionManagerInterface
{
    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }
}
