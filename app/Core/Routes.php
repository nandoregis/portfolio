<?php

namespace app\Core;

use app\Factory\Request;

class Routes
{
    private $dir;
    private $routes = [];

    public function __construct() 
    {   
        $this->dir = str_replace('Core', 'Modules', __DIR__ );
        $this->list_routes($this->get_modules($this->dir));  
    }

    protected function run()
    {   
     
        foreach ($this->routes as $key => $metodo) {
          
            foreach ($metodo as $key_sec => $value) 
            {
                $dirPrincipalRoute = strtolower($key);
                $path = $value['route'] === '/' ? "" : $value['route'];
                $route = '/' . $dirPrincipalRoute . str_replace(['{', '}'], ['$',''], $path);
                $http = $value['http'];
                $controller = $value['controller'];
                $method = $value['method'];
                $middlewares = $value['middlewares'];
                $active = $value['active'];

                if(!$active) continue;

                 foreach ($http as $key_ter => $value) 
                {   

                    switch ($value) {
                        case 'GET':
                            $this->set_route_get($route,$controller,$method,$middlewares);
                            break;

                        case 'POST':
                            $this->set_route_post($route,$controller,$method,$middlewares);
                            break;
                        
                        default:
                            # code...
                            break;
                    }

                }

            }
        }
    }

    protected function get_routes()
    {
        return  $this->routes;
    }


    private function set_route_get(String $route, Object $controller, String $method, Array $middlewares) 
    {
        get($route, function () use ($controller , $method, $middlewares) {

            $controllerCallable = fn($req) => $controller->$method($req);

            $app = Pipeline::pip($middlewares, $controllerCallable);

            $req = new Request();
            
            $app($req);
        });
                    
    }

    private  function set_route_post(String $route, Object $controller, String $method, Array $middlewares)
    {
        post($route, function () use ($controller , $method, $middlewares) {

            $controllerCallable = fn($req) => $controller->$method($req);

            $app = Pipeline::pip($middlewares, $controllerCallable);

            $req = new Request();
            
            $app($req);
        });
    }

    private function get_modules(String $path)
    {
        $dirs = [];

        foreach (scandir($path) as $item) {
            if (
                $item === '.' || $item === '..' ||
                !is_dir($path . DIRECTORY_SEPARATOR . $item)
            ) continue;

            $dirs[] = $item;
        }

        return $dirs;
    }

    private function list_routes(Array $modules)
    {
        
        foreach ($modules as $module) {
            $routesPath = $this->dir . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'routes.php';

            if (file_exists($routesPath)) {
                $controllerClass = require $routesPath;
                $this->routes[$module] = $controllerClass;
            } else {
                echo "Arquivo routes.php não encontrado no módulo: $module\n";
            }
        }

    }
}