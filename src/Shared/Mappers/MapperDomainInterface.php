<?php

namespace App\Shared\Domain\Mappers;

interface MapperInterface
{
    public static function fromArrayToEntity(array $data);
    //public static function fromEntityToArray($entity): array;
}
