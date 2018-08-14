<?php
declare(strict_types = 1);

namespace Controller;


use Collection\Collection;


interface IController
{
    function add(Object $object): bool;

    function getById(int $id): Object;

    function getAll(): Collection;
}