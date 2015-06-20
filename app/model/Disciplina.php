<?php

	class Disciplina extends Connection{
		private $id = 0;
		private $txNome = "";
		private $nrCargaHoraria = "";

		//SETS
		public function setId($id)
		{
			$this->id = $id;
		}
		public function setTxNome($txNome)
		{
			$this->txNome = $txNome;
		}
	    public function setNrCargaHoraria($nrCargaHoraria)
	    {
			$this->nrCargaHoraria = $nrCargaHoraria;
		}

		//GETS
		public function getId()
		{
			return $this->id;
		}
		public function getTxNome()
		{
			return $this->txNome;
		}
		public function getNrCargaHoraria()
		{
			return $this->nrCargaHoraria;
		}

	// verifica se o Disciplina já existe
    public function hasDisciplina($txNome) {
        $sql = 'SELECT * FROM disciplina WHERE tx_nome = ?';
        try {
            $hasDisciplina = Connection::prepare($sql);
            $hasDisciplina->bindParam(1, $txNome);
            $hasDisciplina->execute();
            $result = !$hasDisciplina->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Disciplina no banco
    public function insertDisciplina() {
        $sql = 'INSERT INTO disciplina (tx_nome, nr_carga_horaria) ';
        $sql.= 'VALUES (:tx_nome,:nr_carga_horaria)';
        try {
            if ($this->hasDisciplina($this->getTxNome())) {
                
                $data = array(
                    'msg' => 'Disciplina já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Disciplina = Connection::prepare($sql);
                $insert_Disciplina->bindValue(':tx_nome', $this->getTxNome(), PDO::PARAM_STR);
                $insert_Disciplina->bindValue(':nr_carga_horaria', $this->getNrCargaHoraria(), PDO::PARAM_STR);
                $insert_Disciplina->execute();
                
                $data = array(
                    'msg' => 'Disciplina inserido com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar uma nova disciplina ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Disciplina
    public function loadDisciplina($id) {
        $sql = 'SELECT * FROM disciplina WHERE id = ?';
        try {
            $load_Disciplina = Connection::prepare($sql);
            $load_Disciplina->bindParam(1, $id);
            $load_Disciplina->execute();
            $result = $load_Disciplina->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Disciplina no banco
    public function updateDisciplina($id) {
        $sql = 'UPDATE  disciplina SET  tx_nome = :tx_nome, nr_carga_horaria = :nr_carga_horaria WHERE  id = :id';
        try {
                $update_Disciplina = Connection::prepare($sql);
                $update_Disciplina->bindValue(':tx_nome', $this->getTxNome(), PDO::PARAM_STR);
                $update_Disciplina->bindValue(':nr_carga_horaria', $this->getNrCargaHoraria(), PDO::PARAM_STR);
                $update_Disciplina->bindParam(':id', $id);
                $update_Disciplina->execute();
                $data = array(
                    'msg' => 'Disciplina atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar disciplina '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Disciplina do banco
    public function deleteDisciplina($id) {
        $sql = 'DELETE FROM disciplina WHERE id = :id';
        try {
            $delete_Disciplina = Connection::prepare($sql);
            $delete_Disciplina->bindValue(":id", $id);
            $delete_Disciplina->execute();
            $data = array(
                'msg' => 'Disciplina deletada com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar disciplina '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}