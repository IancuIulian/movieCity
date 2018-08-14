<?php
declare(strict_types = 1);

namespace Model;


class Cinema
{
    protected $id;
    protected $movies;
    protected $rooms;


    public function __construct(int $id, string $movies, RoomCollection $rooms)
    {
        $this->id     = $id;
        $this->movies = $movies;
        $this->rooms  = $rooms;
    }


}

