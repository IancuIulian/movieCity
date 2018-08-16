<?php
declare(strict_types = 1);


class Application
{
    private $router;

    public function __construct()
    {
        session_start();
    }

    public function run()
    {
        $this->router = new Router();
        return $this->router->resolve();
    }

}