<?php

	class Predio extends Connection{
		private $id = 0;
		private $txIdentificacao = "";
		private $campusId = 0;

		//SETS
		public function setId($id){
			$this->id = $id;
		}
		public function setTxIdentificacao($txIdentificacao){
			$this->txIdentificacao = $txIdentificacao;
		}
		public function setCampusId($campusId){
			$this->campusId = $campusId;
		}

		//GETS
		public function getId(){
			return $this->id;
		}
		public function getTxIdentificacao(){
			return $this->txIdentificacao;
		}
		public function getCampusId(){
			return $this->campusId;
		}
	
	// verifica se o Predio já existe
    public function hasPredio($txIdentificacao) {
        $sql = 'SELECT * FROM predio WHERE tx_identificacao = ?';
        try {
            $has_Predio = Connection::prepare($sql);
            $has_Predio->bindParam(1, $txIdentificacao);
            $has_Predio->execute();
            $result = !$hasPredio->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Predio no banco
    public function insertPredio() {
        $sql = 'INSERT INTO predio (tx_identificacao, campus_id) ';
        $sql.= 'VALUES (:tx_identificacao,:campus_id)';
        try {
            if ($this->hasPredio($this->getTxIdentificacao())) {
                
                $data = array(
                    'msg' => 'Prédio já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Predio = Connection::prepare($sql);
                $insert_Predio->bindValue(':tx_identificacao', $this->getTxIdentificacao(), PDO::PARAM_STR);
                $insert_Predio->bindValue(':campus_id', $this->getCampusId(), PDO::PARAM_STR);
                $insert_Predio->execute();
                
                $data = array(
                    'msg' => 'Prédio inserido com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar um novo prédio ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Predio
    public function loadPredio($id) {
        $sql = 'SELECT * FROM predio WHERE id = ?';
        try {
            $load_Predio = Connection::prepare($sql);
            $load_Predio->bindParam(1, $id);
            $load_Predio->execute();
            $result = $load_Predio->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Predio no banco
    public function updatePredio($id) {
        $sql = 'UPDATE  predio SET  tx_identificacao = :tx_identificacao, campus_id = :campus_id WHERE  id = :id';
        try {
                $update_Predio = Connection::prepare($sql);
                $update_Predio->bindValue(':tx_identificacao', $this->getTxIdentificacao(), PDO::PARAM_STR);
                $update_Predio->bindValue(':campus_id', $this->getCampusId(), PDO::PARAM_STR);
                $update_Predio->bindParam(':id', $id);
                $update_Predio->execute();
                $data = array(
                    'msg' => 'Prédio atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar pré '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Predio do banco
    public function deletePredio($id) {
        $sql = 'DELETE FROM predio WHERE id = :id';
        try {
            $delete_Predio = Connection::prepare($sql);
            $delete_Predio->bindValue(":id", $id);
            $delete_Predio->execute();
            $data = array(
                'msg' => 'Predio deletada com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar prédio'.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}