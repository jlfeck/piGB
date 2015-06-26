<?php

class Sala extends Connection
{
	private $id = 0;
	private $txIdentificacao = "";
	private $predioId = 0;
	private $nrCapacidade = 0;
	private $nrComputadores = 0;

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}

	public function setTxIdentificacao($txIdentificacao){
		$this->txIdentificacao = $txIdentificacao;
	}
	public function getTxIdentificacao(){
		return $this->txIdentificacao;
	}

	public function setPredioId($predioId){
		$this->predioId = $predioId;
	}
	public function getPredioId(){
		return $this->predioId;
	}

	public function setNrCapacidade($nrCapacidade){
		$this->nrCapacidade = $nrCapacidade;
	}
	public function getNrCapacidade(){
		return $this->nrCapacidade;
	}
	
	public function setNrComputadores($nrComputadores){
		$this->nrComputadores = $nrComputadores;
	}
	public function getNrComputadores(){
		return $this->nrComputadores;
	}
	// verifica se o Sala já existe
    public function hasSala($txIdentificacao)
    {
        $sql = 'SELECT * FROM sala WHERE tx_identificacao = ?';
        try {
            $hasSala = Connection::prepare($sql);
            $hasSala->bindParam(1, $txIdentificacao);
            $hasSala->execute();
            $result = !$hasSala->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Sala no banco
    public function insertSala()
    {
        $sql = 'INSERT INTO sala (tx_identificacao, predio_id, nr_capacidade, nr_computadores) ';
        $sql.= 'VALUES (:txIdentificacao, :predioId, :nrCapacidade, :nrComputadores)';
        try {
            if ($this->hasSala($this->getTxNome())) {
                
                $data = array(
                    'msg' => 'Sala já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Sala = Connection::prepare($sql);
                $insert_Sala->bindValue(':txIdentificacao', $this->getTxIdentificacao(), PDO::PARAM_STR);
				$insert_Sala->bindValue(':predioId', $this->getPredioId(), PDO::PARAM_STR);
				$insert_Sala->bindValue(':nrCapacidade', $this->getNrCapacidade(), PDO::PARAM_STR);
				$insert_Sala->bindValue(':nrComputadores', $this->getNrComputadores(), PDO::PARAM_STR);
                $insert_Sala->execute();
                
                $data = array(
                    'msg' => 'Sala cadastrado com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar uma nova Sala ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Sala
    public function loadSala($id)
    {
        $sql = 'SELECT * FROM sala WHERE id = ?';
        try {
            $load_Sala = Connection::prepare($sql);
            $load_Sala->bindParam(1, $id);
            $load_Sala->execute();
            $result = $load_Sala->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Sala no banco
    public function updateSala($id)
    {
        $sql = 'UPDATE  sala SET  tx_identificacao = :txIdentificacao, predio_id = :predioId, nr_capacidade = :nrCapacidade, nr_computadores = :nrComputadores WHERE  id = :id';
        try {
                $update_Sala = Connection::prepare($sql);
                $update_Sala->bindValue(':txIdentificacao', $this->getTxIdentificacao(), PDO::PARAM_STR);
				$update_Sala->bindValue(':predioId', $this->getPredioId(), PDO::PARAM_STR);
				$update_Sala->bindValue(':nrCapacidade', $this->getNrCapacidade(), PDO::PARAM_STR);
				$update_Sala->bindValue(':nrComputadores', $this->getNrComputadores(), PDO::PARAM_STR);
                $update_Sala->bindParam(':id', $id);
                $update_Sala->execute();
                $data = array(
                    'msg' => 'Sala atualizado com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar Sala '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Sala do banco
    public function deleteSala($id)
    {
        $sql = 'DELETE FROM sala WHERE id = :id';
        try {
            $delete_Sala = Connection::prepare($sql);
            $delete_Sala->bindValue(":id", $id);
            $delete_Sala->execute();
            $data = array(
                'msg' => 'Sala deletada com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar sala '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
}

////GUILHERME O. FLORES////