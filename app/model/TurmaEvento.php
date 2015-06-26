<?php
	
class TurmaEvento extends Connection
{
	private $id = 0;
	private $eventoId = "";
	private $turmaId = ""; 

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getEventoId(){
		return $this->eventoId;
	}

	public function setEventoId($eventoId){
		$this->eventoId = $eventoId;
	}

	public function getTurmaId(){
		return $this->turmaId;
	}

	public function setTurmaId($turmaId){
		$this->turmaId = $turmaId;
	}

    // insere um TurmaEvento no banco
    public function insertTurmaEvento()
    {
        $sql = 'INSERT INTO turma_evento (evento_id, turma_id) ';
        $sql.= 'VALUES (:eventoId,:turmaId)';
        try {
                $insert_TurmaEvento = Connection::prepare($sql);
                $insert_TurmaEvento->bindValue(':eventoId', $this->getEventoId(), PDO::PARAM_STR);
                $insert_TurmaEvento->bindValue(':turmaId', $this->getTurmaId(), PDO::PARAM_STR);
                $insert_TurmaEvento->execute();
                
                $data = array(
                    'msg' => 'TurmaEvento inserido com sucesso',
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
    // retorna um objeto TurmaEvento
    public function loadTurmaEvento($id)
    {
        $sql = 'SELECT * FROM turma_evento WHERE id = ?';
        try {
            $load_TurmaEvento = Connection::prepare($sql);
            $load_TurmaEvento->bindParam(1, $id);
            $load_TurmaEvento->execute();
            $result = $load_TurmaEvento->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um TurmaEvento no banco
    public function updateTurmaEvento($id)
    {
        $sql = 'UPDATE  turma_evento SET  evento_id = :eventoId, turma_id = :turmaId WHERE  id = :id';
        try {
                $update_TurmaEvento = Connection::prepare($sql);
                $update_TurmaEvento->bindValue(':eventoId', $this->getEventoId(), PDO::PARAM_STR);
                $update_TurmaEvento->bindValue(':turmaId', $this->getTurmaId(), PDO::PARAM_STR);
                $update_TurmaEvento->bindParam(':id', $id);
                $update_TurmaEvento->execute();
                $data = array(
                    'msg' => 'TurmaEvento atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar TurmaEvento '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um TurmaEvento do banco
    public function deleteTurmaEvento($id)
    {
        $sql = 'DELETE FROM turma_evento WHERE id = :id';
        try {
            $delete_TurmaEvento = Connection::prepare($sql);
            $delete_TurmaEvento->bindValue(":id", $id);
            $delete_TurmaEvento->execute();
            $data = array(
                'msg' => 'TurmaEvento deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar TurmaEvento '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}

////GUILHERME O. FLORES////