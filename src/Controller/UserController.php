<?php
declare(strict_types = 1);

namespace Controller;

use Model\Repository\UserRepository;
use Router;
use View\View;

class UserController
{

    public function login()
    {
        if (isset($_SESSION['user'])) {
            Router::redirect('home');
        }

        $error = null;
        if (isset($_POST['email'])) {

            $userRepo = new UserRepository();

            $email    = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $user = $userRepo->login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                Router::redirect('home');

            } else {
                $error = 'Incorrect email - password combination.';
            }
        }

        $loginView = new View('login');
        return $loginView->render(['error' => $error]);
    }

    public function loginTemplate()
    {
        if (isset($_SESSION['user'])) {
            Router::redirect('home');
        }

        $error = null;
        if (isset($_POST['email'])) {

            $userRepo = new UserRepository();

            $email    = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $user = $userRepo->login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                Router::redirect('home');

            } else {
                $error = 'Incorrect email - password combination.';
            }
        }

        $loginView = new View('login-template');
        return $loginView->render(['error' => $error]);
    }

    public function register()
    {
        if (isset($_SESSION['user'])) {
            Router::redirect('home');
        }

        $error = null;
        if (isset($_POST['email']) && isset($_POST['password'])) {

            $userRepo = new UserRepository();

            $email    = $_POST['email'];
            $password = $_POST['password'];

            $user = $userRepo->register($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                Router::redirect('home');

            } else {
                $error = 'Chosen email might be invalid or it already exists in our database :(...';
            }
        }

        $registerView = new View('register');
        return $registerView->render(['error' => $error]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        Router::redirect('login');
    }

}