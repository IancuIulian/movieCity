<?php
declare(strict_types=1);


class Application
{
    private $router;

    public function __construct()
    {
        session_start();
        $router = new Router();
        $router->resolve();
    }

    public function run()
    {
//        ???
    }

}