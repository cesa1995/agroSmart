<?php
session_start();
    if(isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include "../../funcionesSql.php";
        $idfinca = $_GET['idfin'];
        $fincaequid = $_GET['fincausuid'];
        sql::rmFincausuByID($fincaequid);
        header("location: asociar.php?id=".$idfinca."&div=0");
    }else{
        header("location: ../../");
    }

?>