<?php

namespace Controller;

use Model\Repository\MovieRepository;
use View\View;

class MovieController
{

    function showAll()
    {
        $movieRepository = new MovieRepository();
        $movies          = $movieRepository->getAll();
        $moviesView      = new View('movies');
        return $moviesView->render(['movies' => $movies]);
    }
}