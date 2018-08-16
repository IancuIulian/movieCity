<?php
declare(strict_types = 1);

namespace Model\Repository;

use Collection\Collection;
use Collection\MovieCollection;
use Database\DatabaseConnection;
use Model\Movie;

class MovieRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    function insert(Object $movie): bool
    {
        $this->dbConnection->query("INSERT INTO movie (name, year, image, description) VALUES (:name, :year, :image, :description);");
        $this->dbConnection->bind(':name', $movie->getName());
        $this->dbConnection->bind(':year', $movie->getYear());
        $this->dbConnection->bind(':image', $movie->getImage());
        $this->dbConnection->bind(':description', $movie->getDescription());
        $this->dbConnection->execute();

        return true;
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM movie WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $movie = new Movie($result[0]['name'], $result[0]['year'], $result[0]['image'], $result[0]['description']);
        $movie->setId($id);

        return $movie;
    }

    function getByName(string $name): Object
    {
        $this->dbConnection->query("SELECT * FROM movie WHERE name = :name");
        $this->dbConnection->bind(':name', $name);
        $result = $this->dbConnection->resultSet();
        $movie = new Movie($result[0]['name'], $result[0]['year'], $result[0]['image'], $result[0]['description']);
        $movie->setId($result[0]['id']);

        return $movie;
    }

    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM movie;");
        $result = $this->dbConnection->resultSet();
        $movieCollection = new MovieCollection([]);
        foreach ($result as $movieItem){
            $movie = new Movie($movieItem['name'], $movieItem['year']);
            $movie->setId($movieItem['id']);
            $movieCollection->add($movie);
        }

        return $movieCollection;
    }
}