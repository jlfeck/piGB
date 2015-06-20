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
}