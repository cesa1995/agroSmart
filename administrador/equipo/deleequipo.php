<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
		include '../../funcionesSql.php';
		if (isset($_GET["id"])) {
			$id=$_GET['id'];
			sql::rmEquipoByID($id);
			header("location: editequipo.php");
		}else{
			header("location: editequipo.php");
		}
	}else{
		header("location: ../../");
	}

 ?>