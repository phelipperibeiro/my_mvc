<?php

namespace engine\init;

class Application {

    public static function loadModel($name) {
        $str_class = "\\app\\models\\".ucfirst($name);
        return new $str_class();
    }
}
