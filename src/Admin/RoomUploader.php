<?php
declare(strict_types = 1);

namespace Admin;

use Database\DatabaseConnection;
use Model\Repository\CinemaRepository;
use Model\Repository\RoomRepository;
use Model\Repository\SeatRepository;
use Model\Room;
use Model\Seat;

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

    private function insertRoom(array $entry): void
    {
        $roomRepo   = new RoomRepository();
        $cinemaRepo = new CinemaRepository();
        $cinema     = $cinemaRepo->getByName($entry[1]);
        $room       = new Room($entry[0], (int)$cinema->getId());
        $roomRepo->insert($room);
        $room->setId($roomRepo->getByName($room->getName())->getId());

        $seatRepo = new SeatRepository();
        $seats = explode(' ', $entry[2]);
        foreach ($seats as $key => $seat){
            list($row, $col) = explode(',', $seat);
            $seats[$key] = [
                'row' => $row,
                'col' => $col,
            ];
            $seatObject = new Seat((int)$seats[$key]['row'], (int)$seats[$key]['col'], (int)$room->getId());
            $seatRepo->insert($seatObject);
        }
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
