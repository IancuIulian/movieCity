<?php

namespace Controller;

use Collection\Collection;
use Collection\MovieCollection;
use Database\DatabaseConnection;
use Model\Movie;
use View\View;

class MovieController implements IController
{
    protected $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    function add(Object $object): bool
    {
        // TODO: Implement add() method.
    }

    function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM MOVIE WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $movie = new Movie($result[0]['name'], $result[0]['year']);
        $movie->setId($id);
        return $movie;
    }

    function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM MOVIE;");
        $result = $this->dbConnection->resultSet();
        $movieCollection = new MovieCollection([]);
        foreach ($result as $movieItem){
            $movie = new Movie($movieItem['name'], $movieItem['year']);
            $movie->setId($movieItem['id']);
            $movieCollection->add($movie);
        }
        return $movieCollection;
    }

    function showAll()
    {
        $movies = $this->getAll();
        $moviesView = new View('movies');
        $moviesView->render(['movies' => $movies]);
    }
}