<?php

namespace App\Controllers;

use App\Models\Config;
use App\Models\ShoppingList;

class ShoppingController extends Controller
{
    protected $config;

    public function newAction($params)
    {  

      if($params && $params['id'] !== ''){
          $model = $this->model(ShoppingList::class);
          $data = [
            'config' => ['action' => 'update'],
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
       return header('Location: /shopping/list');
    }

    public function updateAction()
    {
       $model = $this->model(ShoppingList::class);
       $model->change($_POST);
       return header('Location: /shopping/list');
    }

    public function deleteAction()
    {
        return 'update';
    }
}
