<?php

namespace App\Core;

// On "importe" PDO
use PDO;
use PDOException;

class Db extends PDO
{
    // Instance unique de la classe
    private static $instance;
    

    private function __construct()
    {
        // DSN de connexion
        $_dsn = 'mysql:dbname='. getenv('DBNAME') . ';host=' . getenv('DBHOST');

        // On appelle le constructeur de la classe PDO
        try{
            parent::__construct($_dsn, getenv('DBUSER'), getenv('DBPASS'));

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }


    public static function getInstance():self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}