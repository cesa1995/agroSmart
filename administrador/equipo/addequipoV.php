<?php
    session_start();
    require_once('../../NoCSRF/nocsrf.php');
    if (isset($_POST["_token"]) and $_SESSION['nivel']==0) {
        if (NoCSRF::check('_token',$_POST,false,60*10,false)) {
            include '../../request.php';
            $nombre=$_POST["nombre"];
            $descripcion=$_POST["descripcion"];
            $type=$_POST["tipo"];
            $request=new request();
            $request->data=json_encode(array(
                "nombre"=>$nombre,
                "devicetype"=>$type,
                "descripcion"=>$descripcion,
                "jwt"=>$_SESSION['jwt']
            ));
            $request->url="http://localhost/agroSmart/api/equipos/create.php";
            $result=json_decode($request->sendPost(),true);
            header("location: addequipo.php?error=".$result['message']);
        }else{
            header("location: addequipo.php?error=2");
        }
    }else {
        header("location: ../../");
    }
?>