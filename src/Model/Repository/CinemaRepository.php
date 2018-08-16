<?php
declare(strict_types = 1);

namespace Model\Repository;


use Collection\CinemaCollection;
use Collection\Collection;
use Database\DatabaseConnection;
use Model\Cinema;

class CinemaRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    function insert(Object $cinema): bool
    {
        $this->dbConnection->query("INSERT INTO CINEMA (name) VALUES (:name);");
        $this->dbConnection->bind(':name', $cinema->getName());
        $this->dbConnection->execute();
        return true;
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM CINEMA WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $cinema = new Cinema($result[0]['name']);
        $cinema->setId($id);
        return $cinema;
    }

    function getByName(string $name): Object
    {
        $this->dbConnection->query("SELECT * FROM CINEMA WHERE name = :name");
        $this->dbConnection->bind(':name', $name);
        $result = $this->dbConnection->resultSet();
        $cinema = new Cinema($result[0]['name']);
        $cinema->setId($result[0]['id']);
        return $cinema;
    }

    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM CINEMA;");
        $result = $this->dbConnection->resultSet();
        $cinemaCollection = new CinemaCollection([]);
        foreach ($result as $cinemaItem){
            $cinema = new Cinema($cinemaItem['name']);
            $cinema->setId($cinemaItem['id']);
            $cinemaCollection->add($cinema);
        }
        return $cinemaCollection;
    }
}