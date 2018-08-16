<?php
declare(strict_types = 1);

namespace Database;

use PDO;
use PDOException;

class DatabaseConnection
{
    private $dbName = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $host = DB_HOST;

    private $error;
    private $dbHandler;
    private $statementHandler;

    public function __construct()
    {
        $dataSourceName = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbHandler = new PDO($dataSourceName, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query(string $query)
    {
        $this->statementHandler = $this->dbHandler->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value);
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value);
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->statementHandler->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->statementHandler->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->statementHandler->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getHandler(){
        return $this->dbHandler;
    }

}