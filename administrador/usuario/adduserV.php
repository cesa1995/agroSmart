<?php
session_start();
require_once('../../NoCSRF/nocsrf.php');
if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
	include '../../funcionesSql.php';
	$email = $_POST['correo'];
	if (email($email)) {
		if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
		$result = sql::login($email);
		foreach ($result as $raw);
			if(empty($raw['email'])){
				$nombre = $_POST['nombre'];
				$apellido = $_POST['apellido'];
				$password = password_hash($_POST['contrasena'],PASSWORD_DEFAULT, ['cost' => 12]);
				$nivel = $_POST['nivel'];
				sql::addUsuario($nombre,$apellido,$email,$password,$nivel);
				header("location: adduser.php?error=0");
			}else{
				header("location: adduser.php?error=1");
			}
		}else{
			die(header("location: adduser.php?error=2"));
		}
	}else{
		header("location: adduser.php?error=3");
	}
}else {
	header("location: ../../");
}
?>