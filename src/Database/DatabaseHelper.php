<?php
declare(strict_types = 1);

namespace Database;


use Model\Genre;
use Model\Movie;
use Model\Repository\GenreRepository;
use Model\Repository\MovieRepository;
use Model\Repository\RoomRepository;
use Model\Repository\UserRepository;
use Model\Room;
use Model\User;
use Util\Util;

class DatabaseHelper
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }

    public function userExists(User $user): bool
    {
        $userRepo = new UserRepository();
        $userCollection = $userRepo->getAll();

        foreach ($userCollection as $item){
            if ($user->getEmail() === $item->getEmail()){
                return true;
            }
        }

        return false;
    }

    public function validUser(User $user): bool
    {
        if ($this->userExists($user)){
            return false;
        }
        if ( ! Util::validEmailFormat($user->getEmail())){
            return false;
        }

        return true;
    }

    public function genreExists(Genre $genre): bool
    {
        $genreRepo = new GenreRepository();
        $genreCollection = $genreRepo->getAll();

        foreach ($genreCollection as $item){
            if ($genre->getName() === $item->getName()){
                return true;
            }
        }

        return false;
    }

    public function movieExists(Movie $movie): bool
    {
        $movieRepo = new MovieRepository();
        $movieCollection = $movieRepo->getAll();

        foreach ($movieCollection as $item){
            if ($movie->getName() === $item->getName()){
                return true;
            }
        }

        return false;
    }

    public function addMovieGenre(int $movieId, int $genreId): void
    {
        $this->dbConnection->query("INSERT INTO GENRE_MOVIE (movie_id, genre_id) VALUES (:movie_id, :genre_id);");
        $this->dbConnection->bind(':movie_id', $movieId);
        $this->dbConnection->bind(':genre_id', $genreId);
        $this->dbConnection->execute();
    }

    public function roomExists(Room $room): bool
    {
        $roomRepo = new RoomRepository();
        $roomCollection = $roomRepo->getAll();

        foreach ($roomCollection as $item){
            if ($room->getName() === $item->getName()){
                return true;
            }
        }

        return false;
    }

}