<?php require_once('Connections/conexioncine.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="Css/iniciar-sesion.css" type="text/css" rel="stylesheet">
	<title>Bienvenidos</title>
</head>
<body background="Images/imagen1.jpg">
	<div class="ingresar">
		<form method="POST" action="acceso.php">
			<h2>Iniciar sesión</h2>
			<div class="cajitas">
				<input type="text" placeholder="Ingresar Usuario" name="email" id="email" value="" required></input>
			</div>
			<div class="cajitas">
				<input type="password" placeholder="Ingresar Contraseña" name="password" id="password" value=""></input>
			</div>
				<button type="submit" name="button" id="button" class="btn">Ingresar</button>
				<a href="" class="olv">Olvide mi contraseña</a>
				<a href="" class="reg">Registrarse</a>
		</form>
</div>
</body>
</html>
