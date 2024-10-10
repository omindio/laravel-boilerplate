<?php

return [
    App\Shared\Provider\SharedServiceProvider::class,
    App\Shared\Infrastructure\Provider\BoundedContextServiceProvider::class,
    App\Shared\Infrastructure\Provider\TransactionServiceProvider::class,
    App\Shared\Infrastructure\Provider\CommandQueryServiceProvider::class,
];
