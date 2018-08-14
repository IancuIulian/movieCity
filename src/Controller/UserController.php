<?php
declare(strict_types = 1);

namespace Controller;

use Collection\Collection;
use Collection\UserCollection;
use Database\DatabaseConnection;
use Database\DatabaseHelper;
use Model\User;
use Util\Util;

class UserController implements IController
{
    protected $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }


    public function add(Object $user): bool
    {
        $dbHelper = new DatabaseHelper($this->dbConnection);

        if (!$dbHelper->validUser($user)){
            return false;
        }

        $this->dbConnection->query("INSERT INTO USER (email, password) VALUES (:email, :password);");
        $this->dbConnection->bind(':email', $user->getEmail());
        $this->dbConnection->bind(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
        $this->dbConnection->execute();
        return true;
    }

    public function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM USER WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $user = new User($result[0]['email'], $result[0]['password']);
        $user->setId($id);
        return $user;
    }

    public function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM USER;");
        $result = $this->dbConnection->resultSet();
        $userCollection = new UserCollection([]);
        foreach ($result as $userItem){
            $user = new User($userItem['email'], $userItem['password']);
            $user->setId($userItem['id']);
            $userCollection->add($user);
        }
        return $userCollection;
    }
}