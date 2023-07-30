<?php

namespace App\Models;

use App\Models\Model;

class ShoppingList extends Model {

	private $pdo;

	protected $table = 'shopping_list';

	protected $primaryKey = 'shopping_list_id';

	public function __construct()
    {
        $this->pdo = new Model();
    }

    public function store($data) {
        return $this->pdo->insert($data);
    }

	public function getAll()
    {
        $query = 'SELECT * FROM ' . $this->table .  ' ORDER BY ' . $this->primaryKey . ' ASC';
        $result = $this->pdo->fetchAll($query);

		return $result;
    }

	public function get($id)
    {
        $query = 'SELECT * FROM ' . $this->table .  ' where '. $this->primaryKey=$id .' LIMIT 1';
        $result = $this->pdo->fetch($query);

		return $result;
    }
}