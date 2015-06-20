<?php

	class Professor extends Connection{
		private $id = 0;
		private $txNome = 0;

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTxNome ($txNome)
		{
			$this->txNome = $txNome;
		}

		//GETS
		public function getId ()
		{
			return $this->id;
		}
		public function getTxNome ()
		{
			return $this->txNome;
		}
}