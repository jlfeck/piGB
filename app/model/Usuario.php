<?php
	
	class Usuario extends Connection{
		private $id = 0;
		private $txLogin = "";
		private $txNome = ""; 
		private $md5Password = "";

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTx_login ($txLogin)
		{
			$this->txLogin = $txLogin;
		}
		public function setTx_nome ($txNome)
		{
			$this->txNome = $txNome;
		}
		public function setMd5_password ($md5Password)
		{
			$this->md5Password = $md5Password;
		}
		
		//GETS
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
}