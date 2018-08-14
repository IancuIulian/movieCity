<?php
declare(strict_types = 1);

namespace Controller;


use Database\DatabaseConnection;
use View\View;

class FrontController
{
    public function homePage(){
        $loginView = new View('home');
        $loginView->render(array());
    }

    public function loginPage(){
        $loginView = new View('login');
        $loginView->render([]);
    }

    public function loginTemplatePage(){
        $loginView = new View('login-template');
        $loginView->render([]);
    }

    public function logoutPage(){
        $loginView = new View('logout');
        $loginView->render([]);
    }

    public function registerPage(){
        $loginView = new View('register');
        $loginView->render([]);
    }

    public function error404Page(){
        $loginView = new View('404');
        $loginView->render([]);
    }

    public function listMovies(){
        $dbConnection = new DatabaseConnection();
        $movieController = new MovieController($dbConnection);
        $movieController->showAll();
    }
}