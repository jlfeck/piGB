<?php
	
class ProfessorEvento extends Connection
{
	private $id = 0;
	private $eventoId = "";
	private $professorId = ""; 

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

	public function getProfessorId(){
		return $this->professorId;
	}

	public function setProfessorId($professorId){
		$this->professorId = $professorId;
	}

    // insere um ProfessorEvento no banco
    public function insertProfessorEvento()
    {
        $sql = 'INSERT INTO professor_evento (evento_id, professor_id) ';
        $sql.= 'VALUES (:eventoId,:professorId)';
        try {
                $insert_ProfessorEvento = Connection::prepare($sql);
                $insert_ProfessorEvento->bindValue(':eventoId', $this->getEventoId(), PDO::PARAM_STR);
                $insert_ProfessorEvento->bindValue(':professorId', $this->getProfessorId(), PDO::PARAM_STR);
                $insert_ProfessorEvento->execute();
                
                $data = array(
                    'msg' => 'ProfessorEvento inserido com sucesso',
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
    // retorna um objeto ProfessorEvento
    public function loadProfessorEvento($id)
    {
        $sql = 'SELECT * FROM professor_evento WHERE id = ?';
        try {
            $load_ProfessorEvento = Connection::prepare($sql);
            $load_ProfessorEvento->bindParam(1, $id);
            $load_ProfessorEvento->execute();
            $result = $load_ProfessorEvento->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um ProfessorEvento no banco
    public function updateProfessorEvento($id)
    {
        $sql = 'UPDATE  professor_evento SET  evento_id = :eventoId, professor_id = :professorId WHERE  id = :id';
        try {
                $update_ProfessorEvento = Connection::prepare($sql);
                $update_ProfessorEvento->bindValue(':eventoId', $this->getEventoId(), PDO::PARAM_STR);
                $update_ProfessorEvento->bindValue(':professorId', $this->getProfessorId(), PDO::PARAM_STR);
                $update_ProfessorEvento->bindParam(':id', $id);
                $update_ProfessorEvento->execute();
                $data = array(
                    'msg' => 'ProfessorEvento atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar ProfessorEvento '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um ProfessorEvento do banco
    public function deleteProfessorEvento($id)
    {
        $sql = 'DELETE FROM professor_evento WHERE id = :id';
        try {
            $delete_ProfessorEvento = Connection::prepare($sql);
            $delete_ProfessorEvento->bindValue(":id", $id);
            $delete_ProfessorEvento->execute();
            $data = array(
                'msg' => 'ProfessorEvento deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar ProfessorEvento '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}

////GUILHERME O. FLORES////