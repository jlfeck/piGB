<?php

	class Professor extends Connection{
		private $id = 0;
		private $txNome = 0;

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTxNome ($txNome)
		{
			$this->txNome = $txNome;
		}

		//GETS
		public function getId ()
		{
			return $this->id;
		}
		public function getTxNome ()
		{
			return $this->txNome;
		}
	
	// verifica se o Professor já existe
    public function hasProfessor($txIdentificacao) {
        $sql = 'SELECT * FROM Professor WHERE tx_nome = ?';
        try {
            $hasProfessor = Connection::prepare($sql);
            $hasProfessor->bindParam(1, $txIdentificacao);
            $hasProfessor->execute();
            $result = !$hasProfessor->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Professor no banco
    public function insertProfessor() {
        $sql = 'INSERT INTO Professor (tx_nome) ';
        $sql.= 'VALUES (:tx_nome)';
        try {
            if ($this->hasPredio($this->getTxIdentificacao())) {
                
                $data = array(
                    'msg' => 'Professor já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Professor = Connection::prepare($sql);
                $insert_Professor->bindValue(':tx_nome', $this->getTxIdentificacao(), PDO::PARAM_STR);
                $insert_Professor->execute();
                
                $data = array(
                    'msg' => 'Professor inserido com sucesso',
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
    // retorna um objeto Professor
    public function loadProfessor($id) {
        $sql = 'SELECT * FROM Professor WHERE id = ?';
        try {
            $load_Professor = Connection::prepare($sql);
            $load_Professor->bindParam(1, $id);
            $load_Professor->execute();
            $result = $load_Professor->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Professor no banco
    public function updatePredio($id) {
        $sql = 'UPDATE  Professor SET  tx_nome = :tx_nome WHERE  id = :id';
        try {
                $update_Professor = Connection::prepare($sql);
                $update_Professor->bindValue(':tx_nome', $this->getTxIdentificacao(), PDO::PARAM_STR);
                $update_Professor->bindParam(':id', $id);
                $update_Professor->execute();
                $data = array(
                    'msg' => 'Professor atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar professor '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Professor do banco
    public function deletePredio($id) {
        $sql = 'DELETE FROM Professor WHERE id = :id';
        try {
            $delete_Professor = Connection::prepare($sql);
            $delete_Professor->bindValue(":id", $id);
            $delete_Professor->execute();
            $data = array(
                'msg' => 'Professor deletada com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar professor'.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}