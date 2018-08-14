<?php
declare(strict_types = 1);

use Controller\FrontController;
use Controller\UserController;
use Database\DatabaseConnection;

class Router
{
    public function resolve()
    {
        $frontController = new FrontController();
        switch ($_SERVER['REQUEST_URI']) {
            case '/':
                $frontController->homePage();
                break;
            case '/home':
                $frontController->homePage();
                break;
            case '/login':
                $frontController->loginPage();
                break;
            case '/login-template':
                $frontController->loginTemplatePage();
                break;
            case '/logout':
                $frontController->logoutPage();
                break;
            case '/register':
                $frontController->registerPage();
                break;
            case '/movies':
                $frontController->listMovies();
                break;
            default:
                $frontController->error404Page();
                die();
        }
    }

    private function normalizePath(string $path): string
    {
        return substr($path, 1);
    }

    static function redirect(string $to)
    {
        header('Location: '.$to);
        exit;
    }

    static function login(): bool
    {
        $dbConnection = new DatabaseConnection();
        $userController = new UserController($dbConnection);
        $users = $userController->getAll();

        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        foreach ($users as $user){
            if ($user->getEmail() === $email && password_verify($password, $user->getPassword())){
                $_SESSION['user'] = $user;
                return true;
            }
        }

        return false;
    }

    static function logout()
    {
        unset($_SESSION['user']);
        Router::redirect('login');
    }
}