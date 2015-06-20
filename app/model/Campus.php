<?php

class Campus extends Connection
{
    private $id = 0;
    private $txNome = "";

    public function setId($id){
    	$this->id = $id;
    }
    public function getId(){
    	return $this->id;
    }
    
    public function setTxNome($txNome){
        $this->txNome = $txNome;
    }
    public function getTxNome(){
        return $this->txNome;
    }
    
    // verifica se o campus já existe
    public function hasCampus($id) {
        $sql = 'SELECT * FROM campus WHERE id = ?';
        try {
            $hasCampus = Connection::prepare($sql);
            $hasCampus->bindParam(1, $id);
            $hasCampus->execute();
            $result = !$hasCampus->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um campus no banco
    public function insertCampus() {
        $sql = 'INSERT INTO campus (tx_nome)';
        $sql.= 'VALUES (:tx_nome)';
        try {
            if ($this->hasCampus($this->getTxNome())) {
                
                $data = array(
                    'msg' => 'Usuário já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_campus = Connection::prepare($sql);
                $insert_campus->bindValue(':tx_nome', $this->getTxNome(), PDO::PARAM_STR);
                $insert_campus->execute();
                
                $data = array(
                    'msg' => 'Campus inserido com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar um novo Campus ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto campus
    public function loadCampus($id) {
        $sql = 'SELECT * FROM campus WHERE id = ?';
        try {
            $load_campus = Connection::prepare($sql);
            $load_campus->bindParam(1, $id);
            $load_campus->execute();
            $result = $load_campus->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (PDOException $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um campus no banco
    public function updateCampus($id) {
        $sql = 'UPDATE campus SET tx_nome = :tx_nome WHERE id = :id';
        try {
                $update_campus = Connection::prepare($sql);
                $update_campus->bindValue(':tx_nome', $this->getTxNome(), PDO::PARAM_STR);
                $update_campus->bindParam(':id', $id);
                $update_campus->execute();
                $data = array(
                    'msg' => 'Campus atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar campus '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um usuário do banco
    public function deleteCampus($id) {
        $sql = 'DELETE FROM campus WHERE id = :id';
        try {
            $delete_campus = Connection::prepare($sql);
            $delete_campus->bindValue(":id", $id);
            $delete_campus->execute();
            $data = array(
                'msg' => 'Campus deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar campus '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }

}