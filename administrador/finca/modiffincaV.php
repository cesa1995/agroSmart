<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		include '../../request.php';
		if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$telefono=$_POST["telefono"];
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$direccion = $_POST['adress'];
			$request= new request();
			$request->data=json_encode(array(
				"id"=>$id,
				"nombre"=>$nombre,
				"telefono"=>$telefono,
				"direccion"=>$direccion,
				"jwt"=>$_SESSION['jwt']
			));
			$request->url="http://localhost/agroSmart/api/fincas/update.php";
			$result=json_decode($request->sendPost(),true);
			header("location: modiffinca.php?id=$id&error=".$result['message']);
		}else{
			die(header("location: modiffinca.php?id=$id&error=2"));
		}
	}else {
		header("location: ../../");
	}
?>
