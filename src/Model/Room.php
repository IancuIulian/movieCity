<?php
declare(strict_types = 1);

namespace Model;


use Collection\SeatCollection;

class Room
{
    protected $id;
    protected $name;
    protected $cinemaId;
    protected $seats;


    public function __construct(string $name, int $cinemaId)
    {
        $this->name      = $name;
        $this->cinemaId = $cinemaId;
//        $this->seats     = new SeatCollection();
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCinemaId(): int
    {
        return $this->cinemaId;
    }

    /**
     * @param int $cinemaId
     */
    public function setCinemaId(int $cinemaId): void
    {
        $this->cinemaId = $cinemaId;
    }

    public function addSeat($seatObject) {
        $this->seats->addItem($seatObject);
    }




}