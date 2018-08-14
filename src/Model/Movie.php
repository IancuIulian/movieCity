<?php
declare(strict_types = 1);

namespace Model;


class Movie
{
    protected $id;
    protected $name;
    protected $year;
    protected $genres;


    public function __construct(string $name, int $year)
    {
        $this->name   = $name;
        $this->year   = $year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


}