<?php

namespace engine\model;

use engine\init\Conexao;

class Model extends Conexao {
    
    const PATH = "../config/config.ini";
    
    protected static function getConexao() {
        parent::openconfig(self::PATH);
        return parent::conectar();
    }

}
