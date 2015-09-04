<?php

namespace app\models;

use engine\model\Model;

class Teste extends Model {

    private $conexao = null;

    private function model($sql, $parametro = null, $tabela = null, $tipoAcesso = null) {
        $this->conexao = empty($this->conexao) ? parent::getConexao() : $this->conexao;
        $sth = $this->conexao->prepare($sql);
        $parametro = !empty($parametro) ? $parametro : null;

        if ($sth->execute($parametro)) {
            if (!empty($tipoAcesso) && $tipoAcesso == 'select') {
                return $sth->fetchAll(\PDO::FETCH_OBJ);
            }
            if ($sth->rowCount() == 0) {
                echo $tabela;
                echo '<br>';
                var_dump($this->conexao->errorInfo());
                echo '<br>';
                var_dump($this->conexao->errorCode());
                echo '<br>';
                $sth->debugDumpParams();
                echo '<br>';
                echo '<pre>' . print_r($parametro) . '</pre>';
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function teste_banco() {
        $sql = "SELECT * from tb_posts";

        return $this->model($sql, null, null, 'select');
    }

}
