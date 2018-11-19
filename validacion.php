<?php
session_start();
require_once('NoCSRF/nocsrf.php');

if (isset($_POST["_token"]) AND isset($_POST['email'])) {
	if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			require 'funcionesSql.php';
			$email = $_POST['email'];
			$password = $_POST['passwd'];
			$result = sql::login($email);
			foreach ($result as $row);
			if (password_verify($password, $row['contrasena'])){

				if ($row['nivel'] == 0) {
					$_SESSION["usuario"]=$row['nombre'];
					$_SESSION["id"]=$row['id'];
					$_SESSION["nivel"]=$row['nivel'];
					header("location: administrador/administrador.php");
				}else if($row['nivel'] == 1){
					$_SESSION["usuario"]=$row['nombre'];
					$_SESSION["id"]=$row['id'];
					$_SESSION["nivel"]=$row['nivel'];
					header("location: agronomo/agronomo.php");
				}else {
					$_SESSION["usuario"]=$row['nombre'];
					$_SESSION["id"]=$row['id'];
					$_SESSION["nivel"]=$row['nivel'];
					header("location: cliente/cliente.php");
				}

			}else{
				header("location: index.php?error=1");
			}

		}else{
			header("location: index.php");
		}
}else {
	header("location: index.php");
}
?>