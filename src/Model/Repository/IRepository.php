<?php
declare(strict_types = 1);

namespace Model\Repository;


use Collection\Collection;

interface IRepository
{
    function insert(Object $object): bool;

    function getById(int $id): Object;

    function getAll(): Collection;
}