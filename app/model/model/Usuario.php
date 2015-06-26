<?php
	
class Usuario extends Connection
{
	private $id = 0;
	private $txLogin = "";
	private $txNome = ""; 
	private $md5Password = "";

	public function setId ($id)
	{
		$this->id = $id;
	}
	public function getId ()
	{
		return $this->id;
	}

	public function getTxLogin ()
	{
		return $this->txLogin;	
	}

	public function getTxNome ()
	{
		return $this->txNome;			
	}

	public function getMd5Password ()
	{
		return $this->md5Password;			
	}
	
	// verifica se o Usuario já existe
    public function hasUsuario($txLogin)
    {
        $sql = 'SELECT * FROM usuario WHERE tx_login = ?';
        try {
            $hasUsuario = Connection::prepare($sql);
            $hasUsuario->bindParam(1, $txLogin);
            $hasUsuario->execute();
            $result = !$hasUsuario->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Usuario no banco
    public function insertUsuario()
    {
        $sql = 'INSERT INTO usuario (tx_login, tx_nome, md5_password) ';
        $sql.= 'VALUES (:txLogin, :txNome, :md5Password)';
        try {
            if ($this->hasUsuario($this->getTxLogin())) {
                
                $data = array(
                    'msg' => 'Usuario já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Usuario = Connection::prepare($sql);
                $insert_Usuario->bindValue(':txLogin', $this->getTxLogin(), PDO::PARAM_STR);
				$insert_Usuario->bindValue(':txNome', $this->getTxNome(), PDO::PARAM_STR);
				$insert_Usuario->bindValue(':md5Password', $this->getMd5Password(), PDO::PARAM_STR);
                $insert_Usuario->execute();
                
                $data = array(
                    'msg' => 'Usuario cadastrado com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar uma nova Usuario ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Usuario
    public function loadUsuario($id)
    {
        $sql = 'SELECT * FROM usuario WHERE id = ?';
        try {
            $load_Usuario = Connection::prepare($sql);
            $load_Usuario->bindParam(1, $id);
            $load_Usuario->execute();
            $result = $load_Usuario->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Usuario no banco
    public function updateTurma($id)
    {
        $sql = 'UPDATE  usuario SET  tx_login = :txLogin, tx_nome = :txNome, md5_password = :md5Password WHERE  id = :id';
        try {
                $update_Usuario = Connection::prepare($sql);
                $update_Usuario->bindValue(':txLogin', $this->getTxLogin(), PDO::PARAM_STR);
				$update_Usuario->bindValue(':txNome', $this->getTxNome(), PDO::PARAM_STR);
				$update_Usuario->bindValue(':md5Password', $this->getMd5Password(), PDO::PARAM_STR);
                $update_Usuario->bindParam(':id', $id);
                $update_Usuario->execute();
                $data = array(
                    'msg' => 'Usuario atualizada com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar Usuario '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Usuario do banco
    public function deleteUsuario($id)
    {
        $sql = 'DELETE FROM usuario WHERE id = :id';
        try {
            $delete_Usuario = Connection::prepare($sql);
            $delete_Usuario->bindValue(":id", $id);
            $delete_Usuario->execute();
            $data = array(
                'msg' => 'Usuario deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar Usuario '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
}

////GUILHERME O. FLORES////