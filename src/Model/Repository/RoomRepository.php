<?php

namespace Model\Repository;

use Collection\Collection;
use Collection\RoomCollection;
use Database\DatabaseConnection;
use Model\Room;

class RoomRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    function insert(Object $room): bool
    {
        $this->dbConnection->query("INSERT INTO room (name, cinema_id) VALUES (:name, :cinema_id);");
        $this->dbConnection->bind(':name', $room->getName());
        $this->dbConnection->bind(':cinema_id', $room->getCinemaId());
        $this->dbConnection->execute();

        return true;
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM room WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $room = new Room($result[0]['name'], $result[0]['cinemaId']);
        $room->setId($id);

        return $room;
    }

    function getByName(string $name): Object
    {
        $this->dbConnection->query("SELECT * FROM room WHERE name = :name");
        $this->dbConnection->bind(':name', $name);
        $result = $this->dbConnection->resultSet();
        $room = new Room($result[0]['name'], $result[0]['cinema_id']);
        $room->setId($result[0]['id']);

        return $room;
    }

    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM room;");
        $result = $this->dbConnection->resultSet();
        $roomCollection = new RoomCollection([]);
        foreach ($result as $roomItem){
            $room = new Room($roomItem['name'], (int)$roomItem['cinema_id']);
            $room->setId($roomItem['id']);
            $roomCollection->add($room);
        }

        return $roomCollection;
    }


    public function getSeatsForRoom($room)
    {
        $roomId = $room->getId();

        // select * from seats where room_id = $roomId;

        // turn array into collection of seats

        // return collection
    }
}