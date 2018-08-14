<?php
declare(strict_types = 1);

namespace Model;


class Genre
{
    protected $id;
    protected $name;


    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }


}