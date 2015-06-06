<?php

	class Predio{
		private $id = 0;
		private $tx_identificacao = "";
		private $campus_id = 0;

		//SETS
		public function setId($id){
			$this->id = $id;
		}
		public function setTx_identificacao($tx_identificacao){
			$this->tx_identificacao = $tx_identificacao;
		}
		public function setCampus_id($campus_id){
			$this->predio_id = $predio_id;
		}

		//GETS
		public function getId(){
			return $this->id;
		}
		public function getTx_identificacao(){
			return $this->tx_identificacao;
		}
		public function getCampus_id(){
			return $this->campus_id;
		}
}