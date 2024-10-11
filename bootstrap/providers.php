<?php

return [
    App\Shared\Provider\SharedServiceProvider::class,
    App\Shared\Infrastructure\Provider\BoundedContextServiceProvider::class,
    App\Shared\Infrastructure\Provider\TransactionServiceProvider::class,
    App\Shared\Infrastructure\Provider\CommandQueryServiceProvider::class,
    App\Shared\Infrastructure\Provider\PasswordServiceProvider::class,
    App\Shared\Infrastructure\Provider\ExceptionServiceProvider::class,
];
