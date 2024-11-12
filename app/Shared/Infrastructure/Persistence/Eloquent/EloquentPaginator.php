<?php

namespace App\Shared\Infrastructure\Persistence\Eloquent;

use App\Shared\Domain\Collection\Collection;
use App\Shared\Domain\Contract\PaginatorInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentPaginator implements PaginatorInterface
{
    private LengthAwarePaginator $paginator;
    private Collection $items;

    public function __construct(LengthAwarePaginator $paginator, Collection $items)
    {
        $this->paginator = $paginator;
        $this->items = $items;
    }

    public function items(): Collection
    {
        return $this->items;
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage();
    }

    public function lastPage(): int
    {
        return $this->paginator->lastPage();
    }

    public function perPage(): int
    {
        return $this->paginator->perPage();
    }

    public function total(): int
    {
        return $this->paginator->total();
    }
}
