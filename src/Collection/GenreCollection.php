<?php
declare(strict_types = 1);

namespace Collection;


class GenreCollection extends Collection
{
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public function add(Object $genre){
        parent::addItem($genre);
    }


}