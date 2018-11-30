<?php
	session_start();
	require_once('../../NoCSRF/nocsrf.php');
	if (isset($_SESSION["nivel"]) && $_SESSION["nivel"]==0){
		include '../../request.php';
		if (isset($_GET["id"])) {
			$id=$_GET['id'];
			$request= new request();
			$request->data=json_encode(array(
				"id"=>$id,
				"jwt"=>$_SESSION['jwt']
			));
			$request->url="http://localhost/agroSmart/api/fincas/delete.php";
			$result=json_decode($request->sendPost(),true);
			header("location: editfinca.php");
		}else{
			header("location: editfinca.php");
		}
	}else{
		header("location: ../../");
	}

 ?>