<?php

namespace App\Shared\Domain\Collection;

abstract class Collection
{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        /*
        return array_map(function ($item) {
            return $item->toArray();
        }, $this->items);
        */
        return $this->items;
    }
}
