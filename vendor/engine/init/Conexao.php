<?php

namespace engine\init;

abstract class Conexao {

    private static $user;
    private static $pass;
    private static $db;
    private static $host;
    private static $type;
    private static $instancia = null;

    protected static function conectar() {
        try {
            if (self::$instancia == null):
                switch (self::$type) {
                    case 'pgsql':
                        $port = $port ? $port : '5432';
                        self::$instancia = new \PDO("pgsql:dbname={$name}; user={$user}; password={$pass};
								host=$host;port={$port}");
                        break;
                    case 'mysql':
                        self::$instancia = new \PDO("mysql:host=" . self::$host . ";dbname=" . self::$db . "", self::$user, self::$pass);
                        break;
                    case 'sqlite':
                        self::$instancia = new \PDO("sqlite:{$name}");
                        break;
                    case 'ibase':
                        self::$instancia = new \PDO("firebird:dbname={$name}", $user, $pass);
                        break;
                    case 'oci8':
                        self::$instancia = new \PDO("oci:dbname={$name}", $user, $pass);
                        break;
                    case 'mssql':
                        self::$instancia = new \PDO("mssql:host={$host},1433;dbname={$name}", $user, $pass);
                        break;
                }
                self::$instancia->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instancia->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            endif;
        } catch (PDOException $erro_conecta) {
            echo "erro" . $erro_conecta->getMessage();
        }
        return self::$instancia;
    }

    protected static function openconfig($config) {
        if (file_exists($config)) {
            // lê o INI e retorna um array
            $db = parse_ini_file($config);
        } else {
            // se não existir, lança um erro
            throw new Exception("Arquivo '$config' não encontrado");
        }
        // lê as informações contidas no arquivo
        self::$user = isset($db['user']) ? $db['user'] : NULL;
        self::$pass = isset($db['pass']) ? $db['pass'] : NULL;
        self::$db = isset($db['db']) ? $db['db'] : NULL;
        self::$host = isset($db['host']) ? $db['host'] : NULL;
        self::$type = isset($db['type']) ? $db['type'] : NULL;
    }
    
}

?>