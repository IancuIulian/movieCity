<?php
declare(strict_types = 1);

namespace Admin;

use Database\DatabaseConnection;
use Database\DatabaseHelper;
use Model\Movie;
use Model\Repository\GenreRepository;
use Model\Repository\MovieRepository;

class MovieUploader
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

    private function insertMovie($entry): void
    {
        $movieRepo = new MovieRepository();
        $movie     = new Movie($entry[0], (int)$entry[2], $entry[3], $entry[4]);
        $movieRepo->insert($movie);
    }

    private function insertMovieGenre($entry): void
    {
        $movieRepo = new MovieRepository();
        $genreRepo = new GenreRepository();
        $dbHelper  = new DatabaseHelper();

        $genres = explode(',', $entry[1]);
        foreach ($genres as $key => $genre) {
            $genres[$key] = ucfirst($genre);
            $movieObject  = $movieRepo->getByName($entry[0]);
            $genreObject  = $genreRepo->getByName($genres[$key]);
            $dbHelper->addMovieGenre((int)$movieObject->getId(), (int)$genreObject->getId());
        }

    }

    public function upload(): void
    {
        foreach ($this->dataArray as $entry) {
            if (!$this->adminHelper->movieExists($entry) && $entry[0] !== 'name') {
                $this->insertMovie($entry);
                $this->insertMovieGenre($entry);
            }
        }
    }

}
