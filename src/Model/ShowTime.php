<?php
declare(strict_types = 1);

namespace Model;


class ShowTime
{
    protected $id;
    protected $date;
    protected $hour;
    protected $movie_id;
    protected $room_id;


    public function __construct(int $id, string $date, int $hour, int $movie_id, int $room_id)
    {
        $this->id       = $id;
        $this->date     = $date;
        $this->hour     = $hour;
        $this->movie_id = $movie_id;
        $this->room_id  = $room_id;
    }


}