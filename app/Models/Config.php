<?php

namespace App\Models;

use App\Models\Model;

class Config extends Model {

	private $pdo;

	protected $table = 'config';

	public function __construct()
    {
        $this->pdo = new Model();
    }
	
	public function fetch()
	{
		return 'lindomar save';
	}

	public function getAll()
    {
        $query = 'SELECT * FROM ' . $this->table .  ' ORDER BY config_id ASC';
        $result = $this->pdo->executeQuery($query);

		var_dump($result);
    }
}