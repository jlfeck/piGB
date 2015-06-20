<?php
	
	class Curso extends Connection{
		private $id = 0;
		private $txDescricao = "";
		private $campusId = ""; 

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTxDescricao ($txDescricao)
		{
			$this->txDescricao = $txLogin;
		}
		public function setCampusId ($campusId)
		{
			$this->campusId = $campusId;
		}


		//GETS
		public function getId ()
		{
			return $this->id;
		}
		public function getTxDescricao ()
		{
			return $this->txDescricao;	
		}
		public function getCampusId ()
		{
			return $this->campusId;			
		}
    // verifica se o Curso já existe
    public function hasCurso($txDescricao) {
        $sql = 'SELECT * FROM curso WHERE tx_descricao = ?';
        try {
            $hasCurso = Connection::prepare($sql);
            $hasCurso->bindParam(1, $txDescricao);
            $hasCurso->execute();
            $result = !$hasCurso->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um curso no banco
    public function insertCurso() {
        $sql = 'INSERT INTO curso (tx_descricao, campus_id) ';
        $sql.= 'VALUES (:tx_descricao,:campus_id)';
        try {
            if ($this->hasCurso($this->getTxDescricao())) {
                
                $data = array(
                    'msg' => 'Curso já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Curso = Connection::prepare($sql);
                $insert_Curso->bindValue(':tx_descricao', $this->getTxDescricao(), PDO::PARAM_STR);
                $insert_Curso->bindValue(':campus_id', $this->getCampusId(), PDO::PARAM_STR);
                $insert_Curso->execute();
                
                $data = array(
                    'msg' => 'Curso inserido com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar um novo curso ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto curso
    public function loadCurso($id) {
        $sql = 'SELECT * FROM curso WHERE id = ?';
        try {
            $load_Curso = Connection::prepare($sql);
            $load_Curso->bindParam(1, $id);
            $load_Curso->execute();
            $result = $load_Curso->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um usuário no banco
    public function updateCurso($id) {
        $sql = 'UPDATE  curso SET  tx_descricao = :tx_descricao, campus_id = :campus_id WHERE  id = :id';
        try {
                $update_Curso = Connection::prepare($sql);
                $update_Curso->bindValue(':tx_descricao', $this->getTxDescricao(), PDO::PARAM_STR);
                $update_Curso->bindValue(':campus_id', $this->getCampusId(), PDO::PARAM_STR);
                $update_Curso->bindParam(':id', $id);
                $update_Curso->execute();
                $data = array(
                    'msg' => 'Curso atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar curso '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um usuário do banco
    public function deleteCurso($id) {
        $sql = 'DELETE FROM curso WHERE id = :id';
        try {
            $delete_Curso = Connection::prepare($sql);
            $delete_Curso->bindValue(":id", $id);
            $delete_Curso->execute();
            $data = array(
                'msg' => 'Curso deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar Curso '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}