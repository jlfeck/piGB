<?php

class CampusController
{
	public function insertCampus($data = array())
	{
		try {
			$Campus = new Campus();
			$Campus->setTxNome($data['tx_nome']);
			$Campus->insertCampus();

			$data = array(
					'msg' => 'Registro inserido com sucesso',
					'route' => 'admin/campus/lista/'
			);

			return $data;
			
		} catch (Exception $ex) {
			
			$data = array(
					'msg' => $ex->getMessage(),
					'route' => 'admin/campus/novo/'
			);

			return $data;
		}
	}

	public function updateCampus($data = array())
	{
		try {
			$Campus = new Campus();
			$Campus->setTxNome($data['tx_nome']);
			$Campus->updateCampus($data['id']);

			$data = array(
					'msg' => 'Registro editado com sucesso',
					'route' => 'admin/campus/lista/'
			);

			return $data;

		} catch (Exception $ex) {
			$data = array(
					'msg' => $ex->getMessage(),
					'route' => 'admin/campus/editar/' . $data['id']
			);

			return $data;
		}
	}

	public function deleteCampus($id = null)
	{
		try {
			$Campus = new Campus();
			$Campus->deleteCampus($id);

			$data = array(
					'msg' => 'Registro excluido com sucesso',
					'route' => 'admin/campus/lista/'
			);

			return $data;

		} catch (Exception $ex) {
			
		}

	}

}