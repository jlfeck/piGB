<?php


function getCampus($twig)
{
	$Campus = new Campus();
	$data = $Campus->listAllCampus();

	echo $twig->render('campus/campus_list.html', array('baseUrl' => Util::baseUrl(),
														'campuss' => $data));
}

function insertCampus($twig)
{	
	if (Util::isPost()) {

		$campus = Util::isEmpty($_POST['tx_nome']);

		$data = array(
			'tx_nome' => $campus
		);

		$CampusController = new CampusController();

		$return = $CampusController->insertCampus($data);
		
		//terminar
		$_SESSION['error'] = $return['msg'];

		$route = Util::baseUrl() . "?op=" . $return['route'];

		header("Location: $route");

	}
	
	echo $twig->render('campus/campus_new.html', array('baseUrl' => Util::baseUrl()));

}

function updateCampus($twig, $id = null)
{
	if (Util::isPost()) {


		$id = Util::isEmpty($_POST['id']);
		$campus = Util::isEmpty($_POST['tx_nome']);

		$data = array(
			'id' => $id,
			'tx_nome' => $campus
		);

		$CampusController = new CampusController();

		$return = $CampusController->updateCampus($data);

		$route = Util::baseUrl() . "?op=" . $return['route'];

		header("Location: $route");

	}

	$Campus = new Campus();
	$data = $Campus->loadCampus($id);

	echo $twig->render('campus/campus_edit.html', array('baseUrl' => Util::baseUrl(),
														'campus' => $data
														));
}

function deteleCampus($twig, $id = null)
{
		$CampusController = new CampusController();

		$return = $CampusController->deleteCampus($id);

		$route = Util::baseUrl() . "?op=" . $return['route'];

		header("Location: $route");
}