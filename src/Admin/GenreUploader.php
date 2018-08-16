<?php
declare(strict_types = 1);

namespace Admin;

use PDO;

class GenreUploader
{
    protected $adminHelper;
    private $dataArray;
    private $pdo;


    public function __construct(array $dataArray, PDO $pdo)
    {
        $this->adminHelper = new AdminHelper();
        $this->dataArray = $dataArray;
        $this->pdo       = $pdo;
    }


    public function upload() : void
    {
        $sql = $this->generateSQL($this->dataArray);
        if ($sql !== "INSERT INTO `GENRE` (`name`) VALUES"){
            $this->pdo->exec($sql);
        }
    }

    private function generateSQL(array $dataArray) : string
    {
        $sql = "INSERT INTO `GENRE` (`name`) VALUES";
        foreach ($dataArray as $entry) {
            foreach ($entry as $entryValue){
                if (! $this->adminHelper->genreExists(ucfirst($entryValue))){
                    $sql .= "('" . ucfirst($entryValue) . "'),";
                }
            }
        }
        return trim($sql, ',');
    }

}
