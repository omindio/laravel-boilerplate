<?php

namespace App\BoundedContext\Authorization\Application\Response;

class GetAllRolesResponse
{
    private array $roles;
    private int $currentPage;
    private int $lastPage;
    private int $perPage;
    private int $total;

    public function __construct(array $roles, int $currentPage, int $lastPage, int $perPage, int $total)
    {
        $this->roles = $roles;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->perPage = $perPage;
        $this->total = $total;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function toArray(): array
    {
        return [
            'items' => $this->roles,
            'currentPage' => $this->currentPage,
            'lastPage' => $this->lastPage,
            'perPage' => $this->perPage,
            'total' => $this->total,
        ];
    }
}
