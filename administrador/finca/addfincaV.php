<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		if (NoCSRF::check('_token', $_POST, false, 60*10, false)) {
			$telefono=$_POST["telefono"];
			$expresion='/^(\+?[0-9]{9,13})$/';
			if (preg_match($expresion,$telefono)) {
				include '../../funcionesSql.php';
				$nombre=$_POST["nombre"];
				$direccion=$_POST["adress"];
				sql::addFincas($nombre,$telefono,$direccion);
				header("location: addfinca.php?error=0");
			}else{
				header("location: addfinca.php?error=1");
			}
		}else{
			die(header("location: addfinca.php?error=2"));
		}
	}else{
		header("location: ../../");
	}

 ?>
