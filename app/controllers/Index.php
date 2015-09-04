<?php

namespace app\controllers;

use engine\init\Application;

class Index {

    public function index() {
        
        $xicas = Application::loadModel('teste')->teste_banco();       
        echo '<pre>';
        print_r($xicas);
        exit;
        echo 'Controller: Index, Action: Index';
    }

    public function empresa() {
        echo 'Controller: Index, Action: Empresa';
    }
}
