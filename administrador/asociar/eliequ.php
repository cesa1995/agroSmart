<?php

session_start();
    if(isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include "../../funcionesSql.php";
        $idfinca = $_GET['idfin'];
        $fincaequid = $_GET['fincaequid'];
        sql::rmFincaequByID($fincaequid);
        header("location: asociar.php?id=".$idfinca."&div=1");
    }else{
        header("location: ../../");
    }

?>