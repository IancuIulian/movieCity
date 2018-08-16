<?php
declare(strict_types = 1);

namespace Admin;


use Database\DatabaseConnection;


class Admin
{
    const RESOURCE_PATH = 'Resources/';
    protected $dbConnection;
    protected $pdo;
    protected $adminHelper;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
        $this->pdo          = $this->dbConnection->getHandler();
        $this->adminHelper  = new AdminHelper();
    }


    private function readCSV(string $filename): array
    {
        $content   = [];
        $delimiter = ",";

        if (file_exists($filename) && ($handle = fopen($filename, "r")) !== false) {
            if (strpos($filename, 'movie') !== false) {
                $delimiter = "|";
            }
            while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $content[] = $data;
            }
            fclose($handle);
        }

        return $content;
    }

    public function run()
    {
        $options             = [
            "1 - Upload Genres",
            "2 - Upload Movies (filename must contain the word 'movie' and be a pipe separated value file)",
            "3 - Upload Rooms",
            "4 - Define Showtime",
        ];
        $fileRequiredOptions = [1, 2, 3];

        echo PHP_EOL . "Welcome!" . PHP_EOL . PHP_EOL;
        $isDone = false;

        while (!$isDone) {
            $error = false;

            echo "Available options: " . PHP_EOL;
            foreach ($options as $option) {
                echo $option . PHP_EOL;
            }
            echo "x - Exit" . PHP_EOL;
            echo PHP_EOL . "Choose between options 1-" . count($options) . ": ";
            $userOption = readline();

            if ($userOption === 'x' || $userOption === 'exit' || $userOption === 'quit') {
                die();
            }

            $fileContent = [];
            if (in_array($userOption, $fileRequiredOptions)) {
                echo 'Enter file name: ';
                $userFile = readline();

                $fileContent = $this->readCSV(self::RESOURCE_PATH . $userFile);
                if (empty($fileContent)) {
                    echo PHP_EOL . "File not found or empty." . PHP_EOL . PHP_EOL;
                    $error = true;
                }
            }

            if ($error) {
                continue;
            }

            switch ($userOption) {
                case 1:
                    $uploader = new GenreUploader($fileContent, $this->pdo);
                    echo PHP_EOL . "Loading...";
                    $uploader->upload();
                    echo PHP_EOL . "Genres uploaded successfully!" . PHP_EOL . PHP_EOL;
                    break;

                case 2:
                    $uploader = new MovieUploader($fileContent);
                    echo PHP_EOL . "Loading...";
                    $uploader->upload();
                    echo PHP_EOL . "Movies uploaded successfully!" . PHP_EOL . PHP_EOL;
                    break;

                case 3:
                    $uploader = new RoomUploader($fileContent);
                    echo PHP_EOL . "Loading...";
                    $uploader->upload();
                    echo PHP_EOL . "Rooms uploaded successfully!" . PHP_EOL . PHP_EOL;
                    break;

                case 4:
                    echo PHP_EOL ."To define a showtime you need to enter the movie name, desired date and room." . PHP_EOL;

                    echo "Enter movie name: ";
                    $userMovie = readline();

                    echo "Enter date (yyyy-mm-dd hh:mm): ";
                    $userDate = readline();

                    echo "Enter room name: ";
                    $userRoom = readline();
                    $data     = [
                        'movie'     => $userMovie,
                        'datetime'  => $userDate,
                        'room'      => $userRoom,
                    ];
                    $uploader = new ShowtimeDefiner($data);
                    $uploader->upload();
                    echo PHP_EOL . "Showtimes uploaded successfully" . PHP_EOL . PHP_EOL;
                    break;

                default:
                    $isDone = true;
                    echo "Program will now exit. Have a nice day!" . PHP_EOL;
            }
        }
    }

}