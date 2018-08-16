<?php
declare(strict_types = 1);

namespace Collection;


class SeatCollection extends Collection
{
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public function add(Object $seat){
        parent::addItem($seat);
    }
}