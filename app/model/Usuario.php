<?php
	
	class Usuario{
		private $id = 0;
		private $tx_login = "";
		private $tx_nome = ""; 
		private $md5_password = "";

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTx_login ($tx_login)
		{
			$this->tx_login = $tx_login;
		}
		public function setTx_nome ($tx_nome)
		{
			$this->tx_nome = $tx_nome;
		}
		public function setMd5_password ($md5_password)
		{
			$this->md5_password = $md5_password;
		}
		
		//GETS
		public function getId ()
		{
			return $this->id;
		}
		public function getTx_login ()
		{
			return $this->tx_login;	
		}
		public function getTx_nome ()
		{
			return $this->tx_nome;			
		}
		public function getMd5_password ()
		{
			return $this->md5_password;			
		}
}