<?php
declare(strict_types = 1);

namespace Model;


class Room
{
    protected $id;
    protected $name;
    protected $cinema_id;
    protected $seats;


    public function __construct(int $id, string $name, int $cinema_id, SeatCollection $seats)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->cinema_id = $cinema_id;
        $this->seats     = $seats;
    }


}