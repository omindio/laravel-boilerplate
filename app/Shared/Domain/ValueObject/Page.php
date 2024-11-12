<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\EmptyPageException;

class Page
{
    private int $page;

    public function __construct(int $page)
    {
        if (empty($page)) {
            throw new EmptyPageException();
        }

        $this->page = $page;
    }

    public function value(): int
    {
        return $this->page;
    }
}
