<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\EmptyPerPageException;

class PerPage
{
    private int $perPage;

    public function __construct(int $perPage)
    {
        if (empty($perPage)) {
            throw new EmptyPerPageException();
        }

        $this->perPage = $perPage;
    }

    public function value(): int
    {
        return $this->perPage;
    }
}
