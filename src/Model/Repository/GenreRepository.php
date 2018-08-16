<?php
declare(strict_types = 1);

namespace Model\Repository;


use Collection\GenreCollection;
use Collection\Collection;
use Database\DatabaseConnection;
use Model\Genre;

class GenreRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    function insert(Object $genre): bool
    {
        $this->dbConnection->query("INSERT INTO genre (name) VALUES (:name);");
        $this->dbConnection->bind(':name', $genre->getName());
        $this->dbConnection->execute();

        return true;
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM genre WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $genre = new Genre($result[0]['name']);
        $genre->setId($id);

        return $genre;
    }

    function getByName(string $name): Object
    {
        $this->dbConnection->query("SELECT * FROM genre WHERE name = :name");
        $this->dbConnection->bind(':name', $name);
        $result = $this->dbConnection->resultSet();
        $genre = new Genre($result[0]['name']);
        $genre->setId($result[0]['id']);

        return $genre;
    }

    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM genre;");
        $result = $this->dbConnection->resultSet();
        $genreCollection = new GenreCollection([]);
        foreach ($result as $genreItem){
            $genre = new Genre($genreItem['name']);
            $genre->setId($genreItem['id']);
            $genreCollection->add($genre);
        }

        return $genreCollection;
    }
}