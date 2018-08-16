<?php
declare(strict_types = 1);

namespace Admin;


use Database\DatabaseConnection;
use Database\DatabaseHelper;
use Model\Genre;
use Model\Movie;
use Model\Room;

class AdminHelper
{
    protected $dbConnection;
    protected $dbHelper;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
        $this->dbHelper = new DatabaseHelper();
    }

    public function genreExists(string $genre){
        $genreAsObject = new Genre($genre);
        return $this->dbHelper->genreExists($genreAsObject);
    }

    public function movieExists(array $movie){
        $movieAsObject = new Movie($movie[0], (int)$movie[2], $movie[3], $movie[4]);
        return $this->dbHelper->movieExists($movieAsObject);
    }

    public function roomExists(array $room){
        $roomAsObject = new Room($room[0], (int)$room[1]);
        return $this->dbHelper->roomExists($roomAsObject);
    }

}