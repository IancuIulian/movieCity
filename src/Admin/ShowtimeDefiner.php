<?php
declare(strict_types = 1);

namespace Admin;


use Database\DatabaseConnection;
use Model\Repository\MovieRepository;
use Model\Repository\RoomRepository;
use Model\Repository\ShowtimeRepository;
use Model\Showtime;

class ShowtimeDefiner
{
    private $dataArray;
    private $databaseConnection;
    protected $adminHelper;


    public function __construct(array $dataArray)
    {
        $this->dataArray          = $dataArray;
        $this->databaseConnection = new DatabaseConnection();
        $this->adminHelper        = new AdminHelper();
    }

    public function insertShowtime(array $entry){
        $movieRepo = new MovieRepository();
        $movie     = $movieRepo->getByName($entry['movie']);
        $roomRepo = new RoomRepository();
        $room     = $roomRepo->getByName($entry['room']);

        $showtimeRepo = new ShowtimeRepository();
        $showtime = new Showtime($entry['datetime'], (int)$movie->getId(), (int)$room->getId());
        $showtimeRepo->insert($showtime);
    }

    public function upload() : void
    {
        $this->insertShowtime($this->dataArray);
    }

}
