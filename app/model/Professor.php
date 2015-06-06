<?php

	class Professor{
		private $id = 0;
		private $tx_nome = 0;

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTx_nome ($tx_nome)
		{
			$this->tx_nome = $tx_nome;
		}

		//GETS
		public function getId ()
		{
			return $this->id;
		}
		public function getTx_nome ()
		{
			return $this->tx_nome;
		}
}