<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
		require '../../funcionesSql.php';

		if (isset($_GET["id"])) {
			sql::rmUsuariosByID($_GET['id']);
			header("location:edituser.php");
		}else{
			header("location: edituser.php");
		}
	}else{
		header("location: ../../");
	}

 ?>