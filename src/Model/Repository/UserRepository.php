<?php
declare(strict_types = 1);

namespace Model\Repository;


use Collection\Collection;
use Collection\UserCollection;
use Database\DatabaseConnection;
use Database\DatabaseHelper;
use Model\User;

class UserRepository implements IRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
    }


    public function insert(Object $user): bool
    {
        $dbHelper = new DatabaseHelper();

        if (!$dbHelper->validUser($user)) {
            return false;
        }

        $this->dbConnection->query("INSERT INTO user (email, password) VALUES (:email, :password);");
        $this->dbConnection->bind(':email', $user->getEmail());
        $this->dbConnection->bind(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
        $this->dbConnection->execute();

        return true;
    }

    public function getById(int $id): Object
    {
        $this->dbConnection->query("SELECT * FROM user WHERE id = :id");
        $this->dbConnection->bind(':id', $id);
        $result = $this->dbConnection->resultSet();
        $user   = new User($result[0]['email'], $result[0]['password']);
        $user->setId($id);

        return $user;
    }

    function getByName(string $name): Object
    {
        $this->dbConnection->query("SELECT * FROM user WHERE name = :name");
        $this->dbConnection->bind(':name', $name);
        $result = $this->dbConnection->resultSet();
        $user   = new User($result[0]['email'], $result[0]['password']);
        $user->setId($result[0]['id']);

        return $user;
    }

    public function getAll(): Collection
    {
        $this->dbConnection->query("SELECT * FROM user;");
        $result         = $this->dbConnection->resultSet();
        $userCollection = new UserCollection([]);
        foreach ($result as $userItem) {
            $user = new User($userItem['email'], $userItem['password']);
            $user->setId($userItem['id']);
            $userCollection->add($user);
        }

        return $userCollection;
    }

    public function login(string $email, string $password)
    {
        $users = $this->getAll();

        foreach ($users as $user) {
            if ($user->getEmail() === $email && password_verify($password, $user->getPassword())) {
                return $user;
            }
        }

        return false;
    }

    public function register(string $email, string $password)
    {
        $user = new User($email, $password);
        if ($this->insert($user)){
            return $user;
        }

        return false;
    }
}