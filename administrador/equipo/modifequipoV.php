<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_POST["_token"]) and $_SESSION["nivel"]==0) {
		include '../../request.php';
		if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
            $devicetype = $_POST['tipo'];
            $descripcion = $_POST['descripcion'];
			$request=new request();
			$request->data=json_encode(array(
				"id"=>$id,
				"nombre"=>$nombre,
				"devicetype"=>$devicetype,
				"descripcion"=>$descripcion,
				"jwt"=>$_SESSION['jwt']
			));
			$request->url="http://localhost/agroSmart/api/equipos/update.php";
			$result=json_decode($request->sendPost(),true);
			header("location: modifequipo.php?id=$id&error=".$result['message']);
		}else{
			die(header("location: modifequipo.php?id=$id&error=2"));
		}
	}else {
		header("location: ../../");
	}
?>