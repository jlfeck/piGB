<?php
	
class Evento extends Connection
{
	private $id = 0;
	private $txDescricao = "";
	private $dtInicio = ""; 
	private $dtFim = "";
	private $hrInicio = "";
	private $hrFim = ""; 
	private $stAtivo = "";
	private $salasId = "";
	private $flSegunda = ""; 
	private $flTerca = "";
	private $flQuarta = ""; 
	private $flQuinta = "";
	private $flSexta = "";
	private $flSabado = ""; 
	private $flDomingo = "";

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getTxDescricao()
	{
		return $this->txDescricao;
	}

	public function setTxDescricao($txDescricao)
	{
		$this->txDescricao = $txDescricao;
	}

	public function getDtInicio()
	{
		return $this->dtInicio;
	}

	public function setDtInicio($dtInicio)
	{
		$this->dtInicio = $dtInicio;
	}

	public function getDtFim()
	{
		return $this->dtFim;
	}

	public function setDtFim($dtFim)
	{
		$this->dtFim = $dtFim;
	}

	public function getHrInicio()
	{
		return $this->hrInicio;
	}

	public function setHrInicio($hrInicio)
	{
		$this->hrInicio = $hrInicio;
	}

	public function getHrFim()
	{
		return $this->hrFim;
	}

	public function setHrFim($hrFim)
	{
		$this->hrFim = $hrFim;
	}

	public function getStAtivo()
	{
		return $this->stAtivo;
	}

	public function setStAtivo($stAtivo)
	{
		$this->stAtivo = $stAtivo;
	}

	public function getSalasId()
	{
		return $this->salasId;
	}

	public function setSalasId($salasId)
	{
		$this->salasId = $salasId;
	}

	public function getFlSegunda()
	{
		return $this->flSegunda;
	}

	public function setFlSegunda($flSegunda)
	{
		$this->flSegunda = $flSegunda;
	}

	public function getFlTerca()
	{
		return $this->flTerca;
	}

	public function setFlTerca($flTerca)
	{
		$this->flTerca = $flTerca;
	}

	public function getFlQuarta()
	{
		return $this->flQuarta;
	}

	public function setFlQuarta($flQuarta)
	{
		$this->flQuarta = $flQuarta;
	}

	public function getFlQuinta()
	{
		return $this->flQuinta;
	}

	public function setFlQuinta($flQuinta)
	{
		$this->flQuinta = $flQuinta;
	}

	public function getFlSexta()
	{
		return $this->flSexta;
	}

	public function setFlSexta($flSexta)
	{
		$this->flSexta = $flSexta;
	}

	public function getFlSabado()
	{
		return $this->flSabado;
	}

	public function setFlSabado($flSabado)
	{
		$this->flSabado = $flSabado;
	}

	public function getFlDomingo()
	{
		return $this->flDomingo;
	}

	public function setFlDomingo($flDomingo)
	{
		$this->flDomingo = $flDomingo;
	}
	
	// verifica se o Evento já existe
    public function hasEvento($id)
    {
        $sql = 'SELECT * FROM evento WHERE id = ?';
        try {
            $hasEvento = Connection::prepare($sql);
            $hasEvento->bindParam(1, $id);
            $hasEvento->execute();
            $result = !$hasEvento->fetchColumn() ? false : true;
            
            return $result;
        } catch (Exception $error_has) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_has->getMessage()
            );
            return $data;
        }
    }
    // insere um Evento no banco
    public function insertEvento()
    {
        $sql = 'INSERT INTO evento (tx_descricao, dt_inicio, dt_fim, hr_inicio, hr_fim, st_ativo, salas_id, fl_segunda, fl_terca,fl_quarta, fl_quinta, fl_sexta, fl_sabado, fl_domingo) ';
        $sql.= 'VALUES (:txDescricao, :dtInicio, :dtFim, :hrInicio, :hrFim, :stAtivo, :salasId, :flSegunda, :flTerca, :flQuarta, :flQuinta, :flSexta, :flSabado, :flDomingo)';
        try {
            if ($this->hasEvento($this->getTxDescricao())) {
                
                $data = array(
                    'msg' => 'Evento já cadastrado',
                    'route' => 'user_new.php'
                );
                
                return $data;
            } else {                
                
                $insert_Evento = Connection::prepare($sql);
                $insert_Evento->bindValue(':txDescricao', $this->getTxDescricao(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':dtInicio', $this->getDtInicio(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':dtFim', $this->getDtFim(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':hrInicio', $this->getHrInicio(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':hrFim', $this->getHrFim(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':stAtivo', $this->getStAtivo(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':salasId', $this->getSalasId(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':flSegunda', $this->getFlSegunda(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':flTerca', $this->getFlTerca(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':flQuarta', $this->getFlQuarta(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':flQuinta', $this->getFlQuinta(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':flSexta', $this->getFlSexta(), PDO::PARAM_STR);	
				$insert_Evento->bindValue(':flSabado', $this->getFlSabado(), PDO::PARAM_STR);
				$insert_Evento->bindValue(':flDomingo', $this->getFlDomingo(), PDO::PARAM_STR);					
                $insert_Evento->execute();
                
                $data = array(
                    'msg' => 'Evento cadastrado com sucesso',
                    'route' => 'login.php'
                );
                
                return $data;
            }
        } catch (PDOException $error_insert) {
            $data = array(
                'msg' => 'Erro ao cadastrar uma nova Evento ' . $error_insert->getMessage()
            );
            return $data;
        }
    }
    // retorna um objeto Evento
    public function loadEvento($id)
    {
        $sql = 'SELECT * FROM evento WHERE id = ?';
        try {
            $load_Evento = Connection::prepare($sql);
            $load_Evento->bindParam(1, $id);
            $load_Evento->execute();
            $result = $load_Evento->fetch(PDO::FETCH_OBJ);
            return $result;
            
        } catch (Exception $error_load) {
            $data = array(
                'msg' => 'Erro ao selecionar dados '.$error_load->getMessage()
            );
            return $data;
        }
    }
    // atualiza um Evento no banco
    public function updateTurma($id)
    {
        $sql = 'UPDATE  evento SET  tx_descricao = :txDescricao, dt_inicio =  :dtInicio, dt_fim = :dtFim, hr_inicio = :hrInicio, hr_fim = :hrFim, st_ativo = :stAtivo, salas_id = :salasId, fl_segunda = :flSegunda, fl_terca = :flTerca,fl_quarta = :flQuarta, fl_quinta = :flQuinta, fl_sexta = :flSexta, fl_sabado = :flSabado, fl_domingo = :flDomingo WHERE id = :id';
        try {
                $update_Evento = Connection::prepare($sql);
                $update_Evento->bindValue(':txDescricao', $this->getTxDescricao(), PDO::PARAM_STR);
				$update_Evento->bindValue(':dtInicio', $this->getDtInicio(), PDO::PARAM_STR);
				$update_Evento->bindValue(':dtFim', $this->getDtFim(), PDO::PARAM_STR);
				$update_Evento->bindValue(':hrInicio', $this->getHrInicio(), PDO::PARAM_STR);
				$update_Evento->bindValue(':hrFim', $this->getHrFim(), PDO::PARAM_STR);
				$update_Evento->bindValue(':stAtivo', $this->getStAtivo(), PDO::PARAM_STR);
				$update_Evento->bindValue(':salasId', $this->getSalasId(), PDO::PARAM_STR);
				$update_Evento->bindValue(':flSegunda', $this->getFlSegunda(), PDO::PARAM_STR);
				$update_Evento->bindValue(':flTerca', $this->getFlTerca(), PDO::PARAM_STR);
				$update_Evento->bindValue(':flQuarta', $this->getFlQuarta(), PDO::PARAM_STR);
				$update_Evento->bindValue(':flQuinta', $this->getFlQuinta(), PDO::PARAM_STR);
				$update_Evento->bindValue(':flSexta', $this->getFlSexta(), PDO::PARAM_STR);	
				$update_Evento->bindValue(':flSabado', $this->getFlSabado(), PDO::PARAM_STR);
				$update_Evento->bindValue(':flDomingo', $this->getFlDomingo(), PDO::PARAM_STR);		
                $update_Evento->bindParam(':id', $id);
                $update_Evento->execute();
                $data = array(
                    'msg' => 'Evento atualizada com sucesso',
                    'route' => 'user_edit.php?id=',
                    'error' => false
                );
                return $data;
        } catch (Exception $error_update) {
            $data = array(
                'msg' => 'Erro ao atualizar Evento '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
    // deleta um Evento do banco
    public function deleteEvento($id)
    {
        $sql = 'DELETE FROM evento WHERE id = :id';
        try {
            $delete_Evento = Connection::prepare($sql);
            $delete_Evento->bindValue(":id", $id);
            $delete_Evento->execute();
            $data = array(
                'msg' => 'Evento deletado com sucesso',
                'route' => 'login.php',
                'error' => false
            );
            return $data;
        } catch (Exception $error_delete) {
            $data = array(
                'msg' => 'Erro ao deletar Evento '.$error_update->getMessage(),
                'error' => true
            );
            return $data;
        }
    }
}

////GUILHERME O. FLORES////