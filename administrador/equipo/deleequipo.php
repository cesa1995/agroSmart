<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION['nivel']) && $_SESSION["nivel"]==0){
		include '../../request.php';
		if (isset($_GET["id"])) {
			$id=$_GET['id'];
			$request=new request();
			$request->data=json_encode(array(
				"id"=>$id,
				"jwt"=>$_SESSION['jwt']
			));
			$request->url="http://localhost/agroSmart/api/equipos/delete.php";
			$result=json_decode($request->sendPost(),true);
			header("location: editequipo.php?error=".$result['message']);
		}else{
			header("location: editequipo.php");
		}
	}else{
		header("location: ../../");
	}

 ?>