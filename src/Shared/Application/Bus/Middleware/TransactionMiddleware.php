<?php

namespace App\Shared\Application\Bus\Middleware;

use App\Shared\Application\Contract\TransactionManagerInterface;
use App\Shared\Application\Contract\BusMiddlewareInterface;

class TransactionMiddleware implements BusMiddlewareInterface
{
    private $transactionManager;

    public function __construct(TransactionManagerInterface $transactionManager)
    {
        $this->transactionManager = $transactionManager;
    }

    public function handle($command, callable $next)
    {
        $this->transactionManager->beginTransaction();

        try {
            $result = $next($command);
            $this->transactionManager->commit();

            return $result;
        } catch (\Throwable $e) {
            $this->transactionManager->rollback();
            throw $e;
        }
    }
}
