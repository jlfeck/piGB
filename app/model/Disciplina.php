<?php

	class Disciplina{
		private $id = 0;
		private $tx_nome = "";
		private $nr_carga_horaria = "";

		//SETS
		public function setId($id)
		{
			$this->id = $id;
		}
		public function setTx_nome($tx_nome)
		{
			$this->tx_nome = $tx_nome;
		}
	    public function setNr_carga_horaria($nr_carga_horaria)
	    {
			$this->nr_carga_horaria = $nr_carga_horaria;
		}

		//GETS
		public function getId()
		{
			return $this->id;
		}
		public function getTx_nome()
		{
			return $this->tx_nome;
		}
		public function getNr_carga_horaria()
		{
			return $this->nr_carga_horaria;
		}
}