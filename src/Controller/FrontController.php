<?php
declare(strict_types = 1);

namespace Controller;

use View\View;

class FrontController
{
    public function homePage()
    {
        $loginView = new View('home');
        return $loginView->render(array());
    }

    public function error404Page()
    {
        $loginView = new View('404');
        return $loginView->render([]);
    }

    public function listMovies()
    {
        $movieController = new MovieController();
        return $movieController->showAll();
    }
}