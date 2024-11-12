<?php

namespace App\Shared\Domain\Contract;

use App\Shared\Domain\Collection\Collection;

interface PaginatorInterface
{
    public function items(): Collection;
    public function currentPage(): int;
    public function lastPage(): int;
    public function perPage(): int;
    public function total(): int;
}
