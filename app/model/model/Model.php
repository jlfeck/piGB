<?php
// include_once('config/config.php');
class User extends Connection
{
    private $id;
    private $user;
    private $pass;
    private $name;
    private $email;
    // Getteres and Setters
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getUser() {
        return $this->user;
    }
    public function setUser($user) {
        $this->user = $user;
    }
    public function getPass() {
        return $this->pass;
    }
    public function setPass($pass) {
        $this->pass = $pass;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    // verifica se usuário e senha é valido
    public function checkUser($user, $pass) {
        $sql = 'SELECT * FROM usuario WHERE user = ? AND pass = ?';
        try {
            $load_user = Connection::prepare($sql);
            $load_user->bindParam(1, $user);
            $load_user->bindParam(2, $pass);
            $load_user->execute();
            
            $result = $load_user->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $error_check) {
            $data = array(
                'msg' => 'Usuário não cadastrado '.$error_check->getMessage()
            );
            return $data;
        }
    }
    // verifica se o usuário já existe
    public function hasUser($user) {
        $sql = 'SELECT * FROM usuario WHERE tx_login = ?';
        try {
            $hasUser = Connection::prepare($sql);
            $hasUser->bindParam(1, $user);
            $hasUser->execute();
            $result = !$hasUser->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um usuário no banco
    public function insertUser() {
        $sql = 'INSERT INTO users (user, pass, name, email) ';
        $sql.= 'VALUES (:user,:pass,:name,:email)';
        try {
            if ($this->hasUser($this->getUser())) {
                
                $data = array(
                    'msg' => 'Usuário já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_user = Connection::prepare($sql);
                $insert_user->bindValue(':user', $this->getUser(), PDO::PARAM_STR);
                $insert_user->bindValue(':pass', $this->getPass(), PDO::PARAM_STR);
                $insert_user->bindValue(':name', $this->getName(), PDO::PARAM_STR);
                $insert_user->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
                $insert_user->execute();
                
                $data = array(
                    'msg' => 'Usuário inserido com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar um novo usuário ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto user
    public function loadUser($id) {
        $sql = 'SELECT * FROM users WHERE id = ?';
        try {
            $load_user = Connection::prepare($sql);
            $load_user->bindParam(1, $id);
            $load_user->execute();
            $result = $load_user->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um usuário no banco
    public function updateUser($id) {
        $sql = 'UPDATE  users SET  user = :user, pass = :pass, name = :name, email = :email WHERE  id = :id';
        try {
                $update_user = Connection::prepare($sql);
                $update_user->bindValue(':user', $this->getUser(), PDO::PARAM_STR);
                $update_user->bindValue(':pass', $this->getPass(), PDO::PARAM_STR);
                $update_user->bindValue(':name', $this->getName(), PDO::PARAM_STR);
                $update_user->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
                $update_user->bindParam(':id', $id);
                $update_user->execute();
                $data = array(
                    'msg' => 'Usuário atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar usuário '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um usuário do banco
    public function deleteUser($id) {
        $sql = 'DELETE FROM users WHERE id = :id';
        try {
            $delete_user = Connection::prepare($sql);
            $delete_user->bindValue(":id", $id);
            $delete_user->execute();
            $data = array(
                'msg' => 'Usuário deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar usuário '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    
}
