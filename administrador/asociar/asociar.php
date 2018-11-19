<?php
	session_start();
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"]) and $_SESSION["nivel"]==0){
        include '../../funcionesSql.php';
        $result=sql::fincas();
        foreach($result as $row);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../img/logo.ico" type="image/x-icon">
	<title>Administrador</title>
	<link rel="stylesheet" href="../../css/administrador.css">
    <link rel="stylesheet" href="../../iconos/font/flaticon.css">
    <script src="../../js/asociar.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="emergente" id="agregarusu">
        <h4>Usuarios</h4>
        <div class="agregar"><a onClick="mostraragregar('agregarusu')" style='cursor: pointer;'>X</a></div>
        <input type="text" class="buscar" id="buscarusu" onkeyup="buscar('buscarusu','listausu')" placeholder="Buscar Usuarios">
        <div class="lista">
            <ul id="listausu" class="lista">
        <?php
                $resultusu=sql::usuariosByNivel(1,2);
                foreach ($resultusu as $rowusu) {
                    ?>
                    <li>
                        <p><?php echo $rowusu['email']; ?></p>
                        <p><?php echo $rowusu['nombre']; ?></p>
                        <p><?php
                            if ($rowusu['nivel'] == 1){
                                echo "Agronomo";
                            }else if($rowusu['nivel'] == 2){
                                echo "Cliente";
                            } ?>
                        </p>
                        <a href="addusu.php?idusu=<?php echo $rowusu['id']; ?>&idfin=<?php echo $_GET['id']; ?>">&#43;</a>
                    </li>
                    <?php
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="emergente" id="agregarequ">
        <h4>Equipos</h4>
        <div class="agregar"><a onClick="mostraragregar('agregarequ')" style='cursor: pointer;'>X</a></div>
        <input type="text" class="buscar" id="buscarequ" onkeyup="buscar('buscarequ','listaequ')" placeholder="Buscar Equipos">
        <div class="lista">
            <ul id="listaequ" class="lista">
                <?php
                    $resultequ=sql::equipos();
                    foreach ($resultequ as $rowequ) {
                    ?>
                        <li>
                            <p><?php echo $rowequ['nombre']; ?></p>
                            <a href="addequ.php?idequ=<?php echo $rowequ['id']; ?>&idfin=<?php echo $_GET['id']; ?>">&#43;</a>
                        </li>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </div>
	<header>
        <label for="check" class="flaticon-menu iconmenu"></label>
        <input type="checkbox" id="check" name="check">
        <div class="logo">
            <img src="../../img/logo.png">
            <a>Smart Agroindustry</a>
        </div>
        <nav>
            <div class="item"><a href="../../"><span class="flaticon-inicio"></span>Inicio</a></div>
            <div class="item"><a href="#"><span class="flaticon-usuario"></span>Usuario</a>
            <div class="submenu">
                <a href="../usuario/adduser.php"><span class="flaticon-addusuario"></span>Agregar</a>
                <a href="../usuario/edituser.php"><span class="flaticon-ediusuario"></span>Editar</a></li>
            </div></div>
            <div class="item"><a href="#"><span class="flaticon-finca"></span>Finca</a>
            <div class="submenu">
                <a href="../finca/addfinca.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                <a href="../finca/editfinca.php"><span class="flaticon-editar"></span>Editar</a></li>
            </div></div>
            <div class="item"><a href="#"><span class="flaticon-sensor"></span>Equipos</a>
            <div class="submenu">
                <a href="../equipo/addequipo.php"><span class="flaticon-agregar"></span>Agregar</a></li>
                <a href="../equipo/editequipo.php"><span class="flaticon-editar"></span>Editar</a></li>
            </div></div>
            <div class="item"><a href="#"><span class="flaticon-sincronizar select"></span>Asociar</a></li></div>
            <div class="item"><a href="../../out.php"><span class="flaticon-salir"></span>Salir</a></li></div>
    	</nav>
	</header>
    <main>
		<?php if (isset($_GET["error"])) {
				if ($_GET["error"]==0) {
					echo "<h4 class=\"error\">Este usuario ya ha sido agregado</h4>";
				}
        } ?>
        <div class="minimenu" id="minimenu">
            <a id="aequipos" style='cursor: pointer;'
            onClick="muestra_oculta('equipos','usuarios','aequipos','ausuarios')"
            onMouseOver="mouseOver('aequipos')"
            onMouseOut="mouseOut('aequipos','usuarios')">Finca-Equipos</a>
            <a id="ausuarios" style='cursor: pointer;'
            onClick="muestra_oculta('usuarios','equipos','ausuarios','aequipos')"
            onMouseOver="mouseOver('ausuarios')"
            onMouseOut="mouseOut('ausuarios','equipos')">Finca-Usuarios</a>
        </div>
        <div class="info">
            <div id="fincas" class="asociar">
                <?php
                $resultf=sql::fincasByID($_GET['id']);
                foreach($resultf as $rowf);
            ?>
            <h5><?php
            if(isset($_GET['id'])){
                echo "Finca seleccionada: ".$rowf['nombre'];
            }else{
                echo "Seleccione una finca a configurar";
            } ?></h5>
            <input type="text" class="buscar" id="buscarfin" onkeyup="buscar('buscarfin','listafin')" placeholder="Buscar Equipos">
                <div class="lista">
                    <ul class="lista" id="listafin">
                <?php
                        foreach($result as $row){
                            ?>
                            <li>
                                <p><?php echo $row['nombre'];?></p>
                                <a href="?id=<?php echo $row['id']; ?>">Seleccionar</a>
                            </li>
                            <?php
                        }
                    ?>
                    </ul>
                </div>
            </div>
            <div id="equipos" class="asociar">
                <h5>Usuarios Agregados</h5>
                <div class="agregar"><a onClick="mostraragregar('agregarusu')" style='cursor: pointer;'>&#43;</a></div>
                <input type="text" class="buscar" id="buscarusua" onkeyup="buscar('buscarusua','listausua')" placeholder="Buscar Equipos">
                <div class="lista">
                    <ul class="lista" id="listausua">
                        <?php
                            $resultusus=sql::fincausuByID($_GET['id']);
                            foreach($resultusus as $rowusus){
                               ?>
                                <li>
                                    <p><?php echo $rowusus['nombre'] ?></p>
                                    <p><?php
                                    if($rowusus['nivel']==1){
                                        echo "Agronomo";
                                    }else{
                                        echo "Cliente";
                                    }
                                    ?></p>
                                    <a href="eliusu.php?idfin=<?php echo $_GET['id']; ?>&fincausuid=<?php echo $rowusus['id'];?>">&#45;</a>
                                </li>
                               <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="usuarios" class="asociar">
                <h5>Equipos Agregados</h5>
                <div class="agregar"><a onClick="mostraragregar('agregarequ')" style='cursor: pointer;'>&#43;</a></div>
                <input type="text" class="buscar" id="buscarequa" onkeyup="buscar('buscarequa','listaequa')" placeholder="Buscar Equipos">
                <div class="lista">
                    <ul class="lista" id="listaequa">
                        <?php
                            $resultequs=sql::fincaequByID($_GET['id']);
                            foreach($resultequs as $rowequs){
                               ?>
                                <li>
                                    <p><?php echo $rowequs['nombre'] ?></p>
                                    <p><?php
                                    if($rowequs['estado']==0){
                                        echo "Inactivo";
                                    }else{
                                        echo "Activo";
                                    }?></p>
                                    <a href="eliequ.php?idfin=<?php echo $_GET['id']; ?>&fincaequid=<?php echo $rowequs['id'];?>">&#45;</a>
                                </li>
                               <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        if(!isset($_GET['id'])){
            echo "<script>";
            echo "ocultardiv()";
            echo "</script>";
        }

        if(isset($_GET['div'])){
            if($_GET['div']==0){
                echo "<script>";
                echo "muestra_oculta('equipos','usuarios','aequipos','ausuarios')";
                echo "</script>";
            }elseif($_GET['div']==1){
                echo "<script>";
                echo "muestra_oculta('usuarios','equipos','ausuarios','aequipos')";
                echo "</script>";
            }
        }
        ?>
    </main>
    <footer>
        <p>Smart Agroindustry &copy; 2018 by <span>Cesar Contreras</span></p>
    </footer>
</body>
</html>
<?php
}else{
header("location: ../../");
}
?>