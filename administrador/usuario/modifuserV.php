<?php
session_start();
require_once('../../NoCSRF/nocsrf.php');
if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
	include '../../funcionesSql.php';
	if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$nivel = $_POST['nivel'];
			$id = $_POST['id'];
			sql::upUsuariosByID($nombre,$apellido,$nivel,$id);
			header("location: modifuser.php?id=".$id."&error=0");
	}else{
		die(header("location: modifuser.php?id=".$id."&error=2"));
	}
}else {
	header("location: ../../");
}
?>