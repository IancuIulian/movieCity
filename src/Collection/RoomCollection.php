<?php
declare(strict_types = 1);

namespace Collection;


class RoomCollection extends Collection
{
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public function add(Object $room){
        parent::addItem($room);
    }

}