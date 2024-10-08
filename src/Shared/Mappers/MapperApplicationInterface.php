<?php

namespace App\Shared\Application\Mappers;

interface MapperInterface
{
    public static function fromEntityToDTO($entity);
    public static function fromArrayToDTO(array $data);
}
