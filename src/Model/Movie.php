<?php
declare(strict_types = 1);

namespace Model;


class Movie
{
    protected $id;
    protected $name;
    protected $year;
    protected $image;
    protected $description;
    protected $genres;


    public function __construct(string $name, int $year, string $image, string $description)
    {
        $this->name = $name;
        $this->year = $year;
        $this->image = $image;
        $this->description = $description;
    }

//    public function __construct(){
//        $a = func_get_args();
//        $i = func_num_args();
//        if (method_exists($this, $f='__construct'.$i)){
//            call_user_func_array(array($this, $f),$a);
//        }
//    }
//
//    public function __construct2(string $name, int $year)
//    {
//        $this->name = $name;
//        $this->year = $year;
//        $this->image = '-';
//        $this->description = '';
//    }
//
//    public function __construct3(string $name, int $year, string $description)
//    {
//        $this->name = $name;
//        $this->year = $year;
//        $this->description = $description;
//    }
//
//    public function __construct4(string $name, int $year, string $image, string $description)
//    {
//        $this->name = $name;
//        $this->year = $year;
//        $this->image = $image;
//        $this->description = $description;
//    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear($year): void
    {
        $this->year = $year;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }


}