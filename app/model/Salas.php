<?php

	class Salas{
			private $id = 0;
			private $tx_identificacao = "";
			private $predio_id = 0;

		//SETS
		public function setId($id){
			$this->id = $id;
		}
		public function setTx_identificacao($tx_identificacao){
			$this->tx_identificacao = $tx_identificacao;
		}
		public function setPredio_id($predio_id){
			$this->predio_id = $predio_id;
		}

		//GETS
		public function getId(){
			return $this->id;
		}
		public function getTx_identificacao(){
			return $this->tx_identificacao;
		}
		public function getPredio_id(){
			return $this->predio_id;
		}
}