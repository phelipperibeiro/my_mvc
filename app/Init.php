<?php
namespace app;

use engine\init\Bootstrap;

class Init extends Bootstrap{
    
    public function initRoutes() {
        $ar['home'] = array(
            'route' => '/',
            'controller' => 'index',
            'action' => 'index'
        );

        $ar['empresa'] = array(
            'route' => '/empresa',
            'controller' => 'index',
            'action' => 'empresa'
        );
        
        $this->setRoutes($ar);
    }
}
