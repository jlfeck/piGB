<?php
	
class Usuario extends Connection
{
	private $id = 0;
	private $txLogin = "";
	private $txNome = ""; 
	private $md5Password = "";

	public function setId ($id){
		$this->id = $id;
	}
	public function getId (){
		return $this->id;
	}

	public function getTxLogin (){
		return $this->txLogin;	
	}

	public function getTxNome (){
		return $this->txNome;			
	}

	public function getMd5Password (){
		return $this->md5Password;			
	}
}