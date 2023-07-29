<?php

namespace App\Controllers;

use App\Core\App;

class Controller
{
	protected $model;

	protected function view($filepath, $data = null)
	{
		if(!empty($data)) {
            extract($data);
        }
		$body = require __DIR__ . "/../views/{$filepath}.phtml";
    	return @file_get_contents($body);
	}

	public function model($name){
		 $this->model = new $name;
		 return $this->model;            
	}
}