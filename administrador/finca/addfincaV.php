<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		if (NoCSRF::check('_token', $_POST, false, 60*10, false)) {
			$telefono=$_POST["telefono"];
			include '../../request.php';
			$nombre=$_POST["nombre"];
			$direccion=$_POST["adress"];
			$request=new request();
			$request->data=json_encode(array(
				"nombre"=>$nombre,
				"telefono"=>$telefono,
				"direccion"=>$direccion,
				"jwt"=>$_SESSION['jwt']
			));
			$request->url="http://localhost/agroSmart/api/fincas/create.php";
			$resutl=json_decode($request->sendPost(),true);
			header("location: addfinca.php?error=".$resutl['message']);
		}else{
			die(header("location: addfinca.php?error=2"));
		}
	}else{
		header("location: ../../");
	}

 ?>
