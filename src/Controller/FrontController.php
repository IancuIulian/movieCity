<?php
declare(strict_types = 1);

namespace Controller;

use View\View;

class FrontController
{

    public function error404Page()
    {
        $loginView = new View('404');
        return $loginView->render([]);
    }

    public function listUpcomingMovies()
    {
        $movieController = new MovieController();
        return $movieController->showUpcoming();
    }

    public function listMovies()
    {
        $movieController = new MovieController();
        return $movieController->showAll();
    }
}