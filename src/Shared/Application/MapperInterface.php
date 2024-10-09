<?php

namespace App\Shared\Application\Mapper;

interface MapperInterface
{
    public static function fromEntityToDTO($entity);
    public static function fromArrayToDTO(array $data);
    public static function fromCommandToEntity($command);
}
