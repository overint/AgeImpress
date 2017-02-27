<?php namespace Core;

use PDO;

class Database
{
    static function connect()
    {
        try {
            $dbh = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';' , DB_USER, DB_PASSWD);
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch(PDOException $e) {
            die('DB Connection Issue');
        }
        return $dbh;
    }

}