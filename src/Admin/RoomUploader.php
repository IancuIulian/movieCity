<?php
declare(strict_types = 1);

namespace Admin;

use Database\DatabaseConnection;
use Model\Repository\CinemaRepository;
use Model\Repository\RoomRepository;
use Model\Room;

class RoomUploader
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

    private function insertRoom($entry): void
    {
        $roomRepo   = new RoomRepository();
        $cinemaRepo = new CinemaRepository();
        $cinema     = $cinemaRepo->getByName($entry[1]);
        $room       = new Room($entry[0], (int)$cinema->getId());
        $roomRepo->insert($room);


//        $seats = array(
//            id, row, col, roomId
//            array('1', '1', '1', $room->getId())
//        );

//        $seatRepo = new \SeatRepository();
//        foreach ($seats as $seat) {
//            $seatObject = new Seat();
//            $seatRepo->insert($seatObject);
//        }
    }

    public function upload(): void
    {
        foreach ($this->dataArray as $entry) {
            if (!$this->adminHelper->roomExists($entry) && $entry[0] !== 'name') {
                $this->insertRoom($entry);
            }
        }
    }
}
