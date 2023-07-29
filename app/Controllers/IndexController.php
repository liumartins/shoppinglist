<?php

namespace App\Controllers;

use App\Models\Config;
use App\Models\ShoppingList;

class IndexController extends Controller
{
    protected $config;


    public function indexAction()
    {        
       return $this->view('index');
    }
}