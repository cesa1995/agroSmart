<?php
    session_start();
    if(isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include "../../funcionesSql.php";
        $idfinca=$_GET['idfin'];
        $idusuario=$_GET['idusu'];
        $result=sql::usuarioValidByID($idusuario);
        foreach($result as $row);
        if (empty($row['usuarioid'])){
            sql::addFincausu($idfinca,$idusuario);
            header("location: asociar.php?id=".$idfinca."&div=0");
        }else{
            header("location: asociar.php?id=".$idfinca."&div=0&error=0");
        }
    }else{
        header("location: ../../");
    }

?>