<?php

class Turma extends Connection
{
	private $id = 0;
	private $txDescricao = "";
	private $txSemestre = ""; 
	private $cursoId = "";

	public function setId ($id){
		$this->id = $id;
	}
	public function getId (){
		return $this->id;
	}
	
	public function setTxDescricao ($txDescricao){
		$this->txDescricao = $txDescricao;
	}
	public function getTxDescricao (){
		return $this->txDescricao;	
	}

	public function setTxSemestre ($txSemestre){
		$this->txSemestre = $txSemestre;
	}
	public function getTxSemestre (){
		return $this->txSemestre;			
	}

	public function setCursoId ($cursoId){
		$this->cursoId = $cursoId;
	}
	public function getCursoId (){
		return $this->cursoId;			
	}
	
	// verifica se o Turma já existe
    public function hasTurma($txDescricao)
    {
        $sql = 'SELECT * FROM turma WHERE tx_descricao = ?';
        try {
            $hasTurma = Connection::prepare($sql);
            $hasTurma->bindParam(1, $txDescricao);
            $hasTurma->execute();
            $result = !$hasTurma->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Turma no banco
    public function insertTurma()
    {
        $sql = 'INSERT INTO turma (tx_descricao, tx_semestre, curso_id) ';
        $sql.= 'VALUES (:txDescricao, :txSemestre, :cursoId)';
        try {
            if ($this->hasTurma($this->getTxDescricao())) {
                
                $data = array(
                    'msg' => 'Turma já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Turma = Connection::prepare($sql);
                $insert_Turma->bindValue(':txDescricao', $this->getTxDescricao(), PDO::PARAM_STR);
				$insert_Turma->bindValue(':txSemestre', $this->getTxSemestre(), PDO::PARAM_STR);
				$insert_Turma->bindValue(':cursoId', $this->getCursoId(), PDO::PARAM_STR);
                $insert_Turma->execute();
                
                $data = array(
                    'msg' => 'Turma cadastrado com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar uma nova Turma ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Turma
    public function loadTurma($id)
    {
        $sql = 'SELECT * FROM turma WHERE id = ?';
        try {
            $load_Turma = Connection::prepare($sql);
            $load_Turma->bindParam(1, $id);
            $load_Turma->execute();
            $result = $load_Turma->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Turma no banco
    public function updateTurma($id)
    {
        $sql = 'UPDATE  turma SET  tx_descricao = :txDescricao, tx_semestre = :txSemestre, curso_id = :cursoId WHERE  id = :id';
        try {
                $update_Turma = Connection::prepare($sql);
                $update_Turma->bindValue(':txDescricao', $this->getTxDescricao(), PDO::PARAM_STR);
				$update_Turma->bindValue(':txSemestre', $this->getTxSemestre(), PDO::PARAM_STR);
				$update_Turma->bindValue(':cursoId', $this->getCursoId(), PDO::PARAM_STR);
                $update_Turma->bindParam(':id', $id);
                $update_Turma->execute();
                $data = array(
                    'msg' => 'Turma atualizada com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar Turma '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Turma do banco
    public function deleteTurma($id)
    {
        $sql = 'DELETE FROM turma WHERE id = :id';
        try {
            $delete_Turma = Connection::prepare($sql);
            $delete_Turma->bindValue(":id", $id);
            $delete_Turma->execute();
            $data = array(
                'msg' => 'Turma deletada com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar Turma '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
}

////GUILHERME O. FLORES////