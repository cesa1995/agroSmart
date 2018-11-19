<?php
    session_start();
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include '../funcionesSql.php';
        $result=sql::usuarios();
        foreach ($result as $row);
        echo $row['nivel'];
        {
           $iusuarios=$iusuarios+1;
           if ($row['nivel']==0) {
               $iadmin=$iadmin+1;
           }
           if ($row['nivel']==1) {
               $iagro=$iagro+1;
           }
           if ($row['nivel']==2) {
               $icli=$icli+1;
           }
        }
        $result = sql::fincas();
        foreach ($result as $row) {
            $ifincas = $ifincas+1;
        }
        $result = sql::equipos();
        foreach ($result as $row) {
            $iequipos=$iequipos+1;
        }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
	<title>Administrador</title>
	<link rel="stylesheet" href="../css/administrador.css">
	<link rel="stylesheet" href="../iconos/font/flaticon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="contenedor">
        <header>
            <label for="check" class="flaticon-menu iconmenu"></label>
            <input type="checkbox" id="check" name="check">
            <div class="logo">
                <img src="../img/logo.png">
                <a>Smart Agroindustry</a>
            </div>
            <nav>
                <div class="item"><a href="#"><span class="flaticon-inicio select"></span>Inicio</a></div>
                <div class="item"><a href="#"><span class="flaticon-usuario"></span>Usuario</a>
                <div class="submenu">
                    <a href="usuario/adduser.php"><span class="flaticon-addusuario"></span>Agregar</a>
                    <a href="usuario/edituser.php"><span class="flaticon-ediusuario"></span>Editar</a></li>
                </div></div>
                <div class="item"><a href="#"><span class="flaticon-finca"></span>Finca</a>
                <div class="submenu">
                    <a href="finca/addfinca.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                    <a href="finca/editfinca.php"><span class="flaticon-editar"></span>Editar</a></li>
                </div></div>
                <div class="item"><a href="#"><span class="flaticon-sensor"></span>Equipos</a>
                <div class="submenu">
                    <a href="equipo/addequipo.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                    <a href="equipo/editequipo.php"><span class="flaticon-editar"></span>Editar</a></li>
                </div></div>
                <div class="item"><a href="asociar/asociar.php"><span class="flaticon-sincronizar"></span>Asociar</a></li></div>
                <div class="item"><a href="../out.php"><span class="flaticon-salir"></span>Salir</a></li></div>
            </nav>
        </header>
        <main>
            <div class="bienvenida">
                <img src="http://placeimg.com/1000/300/any">
                <h2><?php echo $_SESSION['usuario']; ?> <BR>Bienvenido/a a <br>Smart Agroindustry</h2>
            </div>
            <div class="datacontent">
                <article class="data">
                    <h4>Usuarios</h4><p><?php echo $iusuarios; ?></p>
                    <div class="data2">
                        <div class="dataitem"><h6>Administradores</h6><p><?php echo $iadmin; ?></p></div>
                        <div class="dataitem"><h6>Agronomos</h6><p><?php echo $iagro; ?></p></div>
                        <div class="dataitem"> <h6>Clientes</h6><p><?php echo $icli; ?></p></div>
                    </div>
                </article>
                <article class="data"><h4>Fincas</h4><p><?php echo $ifincas; ?></p></article >
                <article class="data"><h4>Equipos</h4><p><?php echo $iequipos; ?></p></article>
            </div>
        </main>
        <footer>
            <p>Smart Agroindustry &copy; 2018 by <span>Cesar Contreras</span></p>
        </footer>
    </div>
</body>
</html>
<?php
}else{
header("location: ../");
}
 ?>
