<?php namespace Core;

use App\Routes;
use Exception;

class Framework
{

    protected $controller;
    protected $dbh;


    function __construct()
    {
        $this->init();
        $this->route();
    }


    private function init()
    {
        define("DS", DIRECTORY_SEPARATOR);
        define('APP_ROOT', dirname(__DIR__));
        require APP_ROOT . '/config.php';
    }


    private function route()
    {
        $routes = Routes::get();
        $path = $this->urlHandler();

        if (array_key_exists($path, $routes))
        {
            $routeData = explode('@', $routes[$path]);
            $controllerName = $routeData[0];
            $controllerNamespaced = 'App\Controllers\\' . $routeData[0];
            $controllerPath = APP_ROOT . '/Controllers/' . $controllerName . '.php';
            $methodName = $routeData[1];

            if (file_exists($controllerPath))
            {
                $this->dbh = Database::connect();
                $this->controller = new $controllerNamespaced($this->dbh);

                if (method_exists($this->controller, $methodName))
                {
                    $this->controller->$methodName();
                } else
                {
                    throw new Exception('Invalid Controller Method');
                }
            } else
            {
                throw new Exception('Invalid Controller Name');
            }
        } else
        {
            http_response_code(404);
            die('404 Not Found');
        }

    }


    private function urlHandler()
    {
        if (isset($_GET['uri']))
        {
            $path = rtrim($_GET['uri'], '/');
        }

        return isset($path) ? $path : '/';
    }

}