<?php

	class Campus extends Connection{
		private $id = 0;
		private $txNome = "";

		//SETS
		public function setId($id){
			$this->id = $id;
		}
		public function setTxNome($txNome){
			$this->txNome = $txNome;
		}

		//GETS
		public function getTxNome(){
			return $this->txNome;
		}
		public function getId(){
			return $this->id;
		}
    // verifica se o campus já existe
    public function hasCampus($id) {
        $sql = 'SELECT * FROM Campus WHERE id = ?';
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
        $sql = 'INSERT INTO Campus (txNome) ';
        $sql.= 'VALUES (:txNome)';
        try {
            if ($this->hasCampus($this->getTxNome())) {
                
                $data = array(
                    'msg' => 'Usuário já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Campus = Connection::prepare($sql);
                $insert_Campus->bindValue(':txNome', $this->getTxNome(), PDO::PARAM_STR);
                $insert_Campus->execute();
                
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
        $sql = 'SELECT * FROM Campus WHERE id = ?';
        try {
            $load_Campus = Connection::prepare($sql);
            $load_Campus->bindParam(1, $id);
            $load_Campus->execute();
            $result = $load_Campus->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um campus no banco
    public function updateCampus($id) {
        $sql = 'UPDATE  Campus SET  txNome = :txNome WHERE  id = :id';
        try {
                $update_Campus = Connection::prepare($sql);
                $update_Campus->bindValue(':user', $this->getCampus(), PDO::PARAM_STR);
                $update_Campus->bindParam(':id', $id);
                $update_Campus->execute();
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
    public function deleteUser($id) {
        $sql = 'DELETE FROM CampusCampus id = :id';
        try {
            $delete_Campus = Connection::prepare($sql);
            $delete_Campus->bindValue(":id", $id);
            $delete_Campus->execute();
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