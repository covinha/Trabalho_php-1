<?php
/**
 * Created by PhpStorm.
 * User: 00925473200
 * Date: 08/03/2018
 * Time: 20:13
 */

namespace App\DAO;


class FechadaDAO extends Conexao

{
    public function inserir($aberta)
    {
        $sql = "insert into aberta (nome, descricao, dataAbertura) VALUES (:nome, :descricao, :dataAbertura)";
        try{
            $i = $this->conexao->prepare($sql);
            $i->bindValue("nome", $aberta->getNome());
            $i->bindValue("descricao", $aberta->getDescricao());
            $i->bindValue("dataAbertura", $aberta->getDataAbertura());
            $i->execute();
            return true;
        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}<\div>";

        }

    }
    public function pesquisar ($aberta = null)
    {
        $sql = "select * from fechada where nome LIKE :nome";
        try{
            $p = $this->conexao->prepare($sql);
            $p->bindValue(":nome", "%".$aberta->getNome()."%");
            $p->execute();
            return $p->fetchAll(\PDO::FETCH_CLASS, "\App\Model\Fechada");

        }catch (\PDOException $e) {
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }
    }
}