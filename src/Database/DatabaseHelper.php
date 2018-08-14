<?php
declare(strict_types = 1);

namespace Database;


use Controller\UserController;
use Model\User;
use Util\Util;

class DatabaseHelper
{
    protected $dbConnection;


    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function userExists(User $user): bool
    {
        $userController = new UserController($this->dbConnection);
        $userCollection = $userController->getAll();

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

}