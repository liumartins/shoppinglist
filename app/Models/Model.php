<?php

namespace App\Models;

use PDO;

class Model {

    private static $connection;

    private $debug;
    private $server;
    private $user;
    private $password;
    private $database;
	
    public function __construct() {
        $this->debug = true;
        $this->server   =  DB_HOST;
        $this->user     =  DB_USER;
        $this->password =  DB_PASS;
        $this->database =  DB_NAME;
    }

    public function getConnection()
    {
        try {
            if (self::$connection == null) {
                self::$connection = new PDO("mysql:host={$this->server};dbname={$this->database};charset=utf8", $this->user, $this->password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
            }

            return self::$connection;
        } catch (\PDOException $ex) {
            if ($this->debug)
                echo "<b>Error on getConnection(): </b>" . $ex->getMessage() . "<br/>";

            return null;
        }
    }

    public function fetchAll($sql, $params = null)
    {
        try {
            $stmt = $this->getConnection()->prepare($sql);

            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $ex) {
            if ($this->debug) {
                echo "<b>Error on ExecuteQuery():</b> " . $ex->getMessage() . "<br />";
                echo "<br /><b>SQL: </b>" . $sql . "<br />";

                echo "<br /><b>Parameters: </b>";
                print_r($params) . "<br />";
            }
            return null;
        }
    }
}