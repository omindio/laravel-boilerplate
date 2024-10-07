<?php

namespace App\Shared\Mappers;

interface MapperInterface
{
    public static function fromModelToEntity($model);
    public static function fromEntityToDTO($entity);
    public static function fromDTOToEntity($dto);
}
