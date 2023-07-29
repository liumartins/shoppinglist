<?php

namespace App\Controllers;

use App\Models\Config;
use App\Models\ShoppingList;

class ShoppingController extends Controller
{
    protected $config;


    public function listAction()
    {
       $model = $this->model(ShoppingList::class);
       $data = $model->getAll();
        
       return $this->view('shopping/list', $data);
    }

    public function storeAction()
    {
        return 'store';
    }

    public function updateAction()
    {
        return 'update';
    }

    public function deleteAction()
    {
        return 'update';
    }
}