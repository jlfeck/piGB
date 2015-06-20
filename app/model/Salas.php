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
}