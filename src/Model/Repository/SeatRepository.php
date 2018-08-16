<?php
declare(strict_types = 1);

namespace Model\Repository;


use Collection\Collection;
use Collection\SeatCollection;
use Database\DatabaseConnection;
use Model\Seat;

class SeatRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    function insert(Object $seat): bool
    {
        $this->dbConnection->query("INSERT INTO seat (row, col, room_id) VALUES (:row, :col, :room_id);");
        $this->dbConnection->bind(':row', $seat->getRow());
        $this->dbConnection->bind(':col', $seat->getCol());
        $this->dbConnection->bind(':room_id', $seat->getRoomId());
        $this->dbConnection->execute();

        return true;
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM seat WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $seat = new Seat((int)$result[0]['row'], (int)$result[0]['col'], (int)$result[0]['room_id']);
        $seat->setId($id);

        return $seat;
    }


    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM seat;");
        $result = $this->dbConnection->resultSet();
        $seatCollection = new SeatCollection([]);
        foreach ($result as $seatItem){
            $seat = new Seat((int)$seatItem['row'], (int)$seatItem['col'], (int)$result[0]['room_id']);
            $seat->setId($seatItem['id']);
            $seatCollection->add($seat);
        }

        return $seatCollection;
    }
}