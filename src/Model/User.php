<?php
declare(strict_types = 1);

namespace Model;

class User
{
    protected $id;
    protected $email;
    protected $password;

    public function __construct(string $email, string $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}