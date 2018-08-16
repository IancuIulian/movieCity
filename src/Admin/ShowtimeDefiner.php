<?php
declare(strict_types = 1);

namespace Admin;


use Database\DatabaseConnection;

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

    public function upload() : void
    {
        $sql = $this->generateSQL($this->dataArray);
        $this->pdo->exec($sql);
    }

    private function generateSQL($dataArray) : string
    {
        return "INSERT INTO `SHOWTIME` (`movie_id`, `room_id`, `datetime`) VALUES ({$this->pdo->quote($dataArray['movie'])},{$this->pdo->quote($dataArray['room'])},{$this->pdo->quote($dataArray['date'])})";
    }
}
