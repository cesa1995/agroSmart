<?php
	session_start();
	require_once('NoCSRF/nocsrf.php');
	if (isset($_SESSION["usuario"]) and isset($_SESSION["id"])) {
		if ($_SESSION["nivel"]==0) {
			header("location: administrador/administrador.php");
		}elseif ($_SESSION["nivel"]==1) {
			header("location: agronomo/agronomo.php");
		}else{
			header("location: cliente/cliente.php");
		}

	}else{
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Inicio de seccion</title>
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<img class="logo" src="img/logo.png">
		<?php
			if (isset($_GET["error"])) {
				if ($_GET["error"]==1) {
					echo "<h4 class=\"msg\">Usuario o contrase&ntilde;a invalidas</h4>";
				}
			}
		 ?>
		<form method="post" action="validacion.php">
		  <input type="email" name="email" placeholder="Email"/>
		  <input type="password" name="passwd" placeholder="Contrase&ntilde;a" />
		  <input type="hidden" name="_token" value="<?php echo NoCSRF::generate('_token'); ?>">
		  <input type="submit" value="Entrar" />
		</form>
	</body>
</html>
<?php
}
 ?>