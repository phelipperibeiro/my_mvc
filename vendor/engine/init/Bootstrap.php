<?php

namespace engine\init;

abstract class Bootstrap {

    private $routes;

    public function __construct() {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    protected function setRoutes(array $routes) {
        $this->routes = $routes;
    }

    protected function run($url) {

        array_walk($this->routes, function($route) use($url) {
            if ($url == $route['route']) {
                $class = "\\app\\controllers\\" . ucfirst($route['controller']);
                $controller = new $class;
                $controller->$route['action']();
            }else{
                //echo 'controller nao encontrado ';
            }
        });
    }

    /*
     * metodo para descobrir a rota que esta sendo ultilizada
     */

    protected function getUrl() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

}
