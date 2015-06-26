<?php

class Professor extends Connection
{
	private $id = 0;
	private $txNome = 0;

	public function setId ($id){
		$this->id = $id;
	}
	public function getId (){
		return $this->id;
	}

	public function setTxNome ($txNome){
		$this->txNome = $txNome;
	}
	public function getTxNome (){
		return $this->txNome;
	}
	// verifica se o Professor já existe
    public function hasProfessor($txNome)
    {
        $sql = 'SELECT * FROM professor WHERE tx_nome = ?';
        try {
            $hasProfessor = Connection::prepare($sql);
            $hasProfessor->bindParam(1, $txNome);
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
    public function insertProfessor()
    {
        $sql = 'INSERT INTO professor (tx_nome) ';
        $sql.= 'VALUES (:txNome)';
        try {
            if ($this->hasProfessor($this->getTxNome())) {
                
                $data = array(
                    'msg' => 'Professor já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Professor = Connection::prepare($sql);
                $insert_Professor->bindValue(':txNome', $this->getTxNome(), PDO::PARAM_STR);
                $insert_Professor->execute();
                
                $data = array(
                    'msg' => 'Professor cadastrado com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar um novo Professor ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Professor
    public function loadProfessor($id)
    {
        $sql = 'SELECT * FROM professor WHERE id = ?';
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
    public function updateProfessor($id)
    {
        $sql = 'UPDATE  professor SET  tx_nome = :txNome WHERE  id = :id';
        try {
                $update_Professor = Connection::prepare($sql);
                $update_Professor->bindValue(':txNome', $this->getTxNome(), PDO::PARAM_STR);
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
                'msg' => 'Erro ao atualizar Professor '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Professor do banco
    public function deleteProfessor($id)
    {
        $sql = 'DELETE FROM professor WHERE id = :id';
        try {
            $delete_Professor = Connection::prepare($sql);
            $delete_Professor->bindValue(":id", $id);
            $delete_Professor->execute();
            $data = array(
                'msg' => 'Professor deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar Professor'.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
}

////GUILHERME O. FLORES////