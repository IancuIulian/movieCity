<?php
declare(strict_types = 1);

namespace Model;


class Seat
{
    protected $id;
    protected $row;
    protected $col;
    protected $room_id;
    private $booked = false;

    public function __construct(int $row, int $col, int $room_id)
    {
        $this->row = $row;
        $this->col = $col;
        $this->room_id = $room_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @param int $row
     */
    public function setRow(int $row): void
    {
        $this->row = $row;
    }

    /**
     * @return int
     */
    public function getCol(): int
    {
        return $this->col;
    }

    /**
     * @param int $col
     */
    public function setCol(int $col): void
    {
        $this->col = $col;
    }

    /**
     * @return int
     */
    public function getRoomId(): int
    {
        return $this->room_id;
    }

    /**
     * @param int $room_id
     */
    public function setRoomId(int $room_id): void
    {
        $this->room_id = $room_id;
    }



    public function book()
    {
        $this->booked = true;
    }

}