<?php
declare(strict_types = 1);

namespace Model;


class Seat
{
    protected $id;
    protected $row;
    protected $column;
    private $booked = false;

    public function __construct(int $row, int $column)
    {
        $this->row    = $row;
        $this->column = $column;
    }


    public function book()
    {
        $this->booked = true;
    }

}