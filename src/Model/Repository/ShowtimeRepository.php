<?php
declare(strict_types = 1);

namespace Model\Repository;


use Collection\Collection;
use Collection\ShowTimeCollection;
use Database\DatabaseConnection;
use Model\Showtime;

class ShowtimeRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    function insert(Object $showtime): bool
    {
        $this->dbConnection->query("INSERT INTO showtime (datetime, movie_id, room_id) VALUES (:datetime, :movie_id, :room_id);");
        $this->dbConnection->bind(':datetime', $showtime->getDatetime());
        $this->dbConnection->bind(':movie_id', $showtime->getMovieId());
        $this->dbConnection->bind(':room_id', $showtime->getRoomId());
        $this->dbConnection->execute();

        return true;
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM showtime WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $showtime = new Showtime($result[0]['datetime'], $result[0]['movie_id'], $result[0]['room_id']);
        $showtime->setId($id);

        return $showtime;
    }

    function getUpcoming(): Collection
    {
        $this->dbConnection->query("SELECT * FROM showtime WHERE datetime > NOW();");
        $result = $this->dbConnection->resultSet();
        $showtimeCollection = new ShowTimeCollection([]);
        foreach ($result as $showtimeItem){
            $showtime = new Showtime($showtimeItem['datetime'], (int)$showtimeItem['movie_id'], (int)$showtimeItem['room_id']);
            $showtime->setId($showtimeItem['id']);
            $showtimeCollection->add($showtime);
        }

        return $showtimeCollection;
    }

    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM showtime;");
        $result = $this->dbConnection->resultSet();
        $showtimeCollection = new ShowTimeCollection([]);
        foreach ($result as $showtimeItem){
            $showtime = new Showtime($showtimeItem['datetime'], (int)$showtimeItem['movie_id'], (int)$showtimeItem['room_id']);
            $showtime->setId($showtimeItem['id']);
            $showtimeCollection->add($showtime);
        }

        return $showtimeCollection;
    }
}