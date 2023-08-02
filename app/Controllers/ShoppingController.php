<?php

namespace App\Controllers;

use App\Models\Config;
use App\Models\ShoppingList;

class ShoppingController extends Controller
{
    protected $config;

    public function newAction($params)
    {  

      if($params['id'] !== ''){
          $model = $this->model(ShoppingList::class);
          $data = [
            'config' => ['action' => 'udate'],
            'values' => $model->getItem($params['id'])
          ];
       } else {
          $data = [
                'config' => [ 'action' => 'store' ],   
                'values' => []
          ];  
       }

       return $this->view('shopping/form', $data);
    }

    public function listAction()
    {
       $model = $this->model(ShoppingList::class);
       $data = $model->getAll();
        
       return $this->view('shopping/list', $data);
    }

    public function storeAction()
    {
       $model = $this->model(ShoppingList::class);
       $model->store($_POST);
       header('/shopping/list');
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