<?php

namespace App\Core;

use PDO;
use PDOException;

class Db
{
    public function make($container)
    {
    	$config = $container['config']['database'];

        try {
            return new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
}