<?php
	
	class Turma extends Connection{
		private $id = 0;
		private $txDescricao = "";
		private $txSemestre = ""; 
		private $cursoId = "";

		//SETS
		public function setId ($id)
		{
			$this->id = $id;
		}
		public function setTxDescricao ($txDescricao)
		{
			$this->txDescricao = $txDescricao;
		}
		public function setTxSemestre ($txSemestre)
		{
			$this->txSemestre = $txSemestre;
		}
		public function setCursoId ($cursoId)
		{
			$this->cursoId = $cursoId;
		}
		
		//GETS
		public function getId ()
		{
			return $this->id;
		}
		public function getTxDescricao ()
		{
			return $this->txDescricao;	
		}
		public function getTxSemestre ()
		{
			return $this->txSemestre;			
		}
		public function getCursoId ()
		{
			return $this->cursoId;			
		}
}