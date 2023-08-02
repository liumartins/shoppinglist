<?php

namespace App\Core;

class App
{
    protected $container;

    private $params;


    public function __construct()
    {
        //$this->setParams();
    }

    public function run()
    {
        $urlParams = explode('/', $_SERVER['REQUEST_URI']);
        $urlActionMethod = $_SERVER['REQUEST_METHOD'];
        $controller =  $urlParams[1] ?? null;
        $action = $urlParams[2] ?? null;

       return $this->route(
            $this->prepareController($controller), 
            $this->prepareAction($action), 
            $this->prepareParams($urlParams)
        );
    }

    public function route($controller, $action, $params)  
    {
        $controller = ucfirst($controller).'Controller';
        $action  = $action . 'Action';
        $class = "\\App\Controllers\\{$controller}";
        $controller = new $class($this);
        return call_user_func_array(
            array($controller, $action), 
            array($params)
        );
    }

    public function bind($key, Callable $callable)
	{
		$this->container[$key] = $callable;
	}

    private function prepareAction($action)
    {
        if (!$action) {
            $action = 'index';
        }
        
        return $action;
    }

    private function prepareController($controller)
    {
        if (!$controller) {
            $controller = 'index';
        }

        return $controller;
    }


    private function prepareParams($urlParams)
    {
        $keys = [];
        $values = [];

        if (!$urlParams) {
            return [];
        }

        unset($urlParams[0], $urlParams[1], $urlParams[2]);

        if(count($urlParams) == 1) {
            return [ 'id' => $urlParams[3] ];
        }
       
        $i = 0;
        foreach ($urlParams as $value) {
           if ($i % 2 == 0) {
                $keys[] = $value;
           } else {
                $values[] = $value;
           }
           $i++;
        }



        if (count($keys) == count($values)) {
            $urlParams = array_combine($keys, $values);
        } else {
            return [];
        }

        return $urlParams;

    }
}
