<?php
session_start();
require_once('../../NoCSRF/nocsrf.php');
if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
	include '../../funcionesSql.php';
	if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$contrasena=$_POST['ncontrasena'];
			$rcontrasena=$_POST['rcontrasena'];
			$id = $_POST['id'];
			if ($contrasena==$rcontrasena) {
				$password = password_hash($contrasena,PASSWORD_DEFAULT, ['cost' => 12]);
				sql::upUsuarioPassByID($password,$id);
				header("location: modifuser.php?id=$id&error=0");
			}else{
				header("location: resetpass.php?id=$id&error=1");
			}
	}else{
		die(header("location: modifuser.php?id=$id&error=2"));
	}
}else {
	header("location: ../../");
}
?>