<?php
declare(strict_types = 1);

use Controller\FrontController;
use Controller\UserController;


class Router
{
    public function resolve()
    {

        switch ($_SERVER['REQUEST_URI']) {
            case '/':
                $frontController = new FrontController();
                return $frontController->homePage();
            case '/home':
                $frontController = new FrontController();
                return $frontController->homePage();
            case '/login':
                $userController = new UserController();
                return $userController->login();
            case '/login-template':
                $userController = new UserController();
                return $userController->loginTemplate();
            case '/logout':
                $userController = new UserController();
                return $userController->logout();
            case '/register':
                $userController = new UserController();
                return $userController->register();
            case '/movies':
                $frontController = new FrontController();
                return $frontController->listMovies();
            default:
                $frontController = new FrontController();
                return $frontController->error404Page();
        }
    }

    private function normalizePath(string $path): string
    {
        return substr($path, 1);
    }

    static function redirect(string $to)
    {
        header('Location: ' . $to);
        exit;
    }


}