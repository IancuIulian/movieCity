<?php

namespace Controller;

use Model\Repository\MovieRepository;
use Model\Repository\ShowtimeRepository;
use View\View;

class MovieController
{

    function showAll()
    {
        $movieRepo  = new MovieRepository();
        $movieCollection     = $movieRepo->getAll();

        $moviesView = new View('movies');
        return $moviesView->render([
            'movieCollection' => $movieCollection,
        ]);
    }

    function showUpcoming()
    {
        $movieRepo       = new MovieRepository();
        $movieCollection = $movieRepo->getUpcoming();

        $showtimeRepo       = new ShowtimeRepository();
        $showtimeCollection = $showtimeRepo->getUpcoming();

        $homeView = new View('home');
        return $homeView->render([
            'movieCollection' => $movieCollection,
            'showtimeCollection' => $showtimeCollection,
        ]);
    }

}