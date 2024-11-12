<?php

namespace App\BoundedContext\Authorization\Application\Query;

class GetAllRolesQuery
{
    private ?int $page;
    private ?int $perPage;

    public function __construct(int $page = null, ?int $perPage = null)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }
}
