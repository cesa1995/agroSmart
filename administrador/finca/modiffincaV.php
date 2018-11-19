<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		include '../../funcionesSql.php';
		if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$telefono=$_POST["telefono"];
			$id = $_POST['id'];
			$expresion='/^(\+?[0-9]{9,13})$/';
			if (preg_match($expresion,$telefono)) {
				$nombre = $_POST['nombre'];
				$direccion = $_POST['adress'];
				sql::upFincasByID($nombre,$telefono,$direccion,$id);
				header("location: modiffinca.php?id=$id&error=0");
			}else{
				header("location: modiffinca.php?id=$id&error=1");
			}
		}else{
			die(header("location: modiffinca.php?id=$id&error=2"));
		}
	}else {
		header("location: ../../");
	}
?>
