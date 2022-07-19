<?php require_once('Connections/conexioncine.php') ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "prohibido.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!doctype html>
<html>
<head>	
<meta charset="UTF-8">
	<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css" type="text/css" >
<title>Documento sin título</title>
</head>

<body>
	<br>
<h1 align="center">Bienvenido <?php echo ObtenerNombreUsuario($_SESSION['cine-lunes_UserId']);?><br>
	<?php echo ObtenerCargoUsuario($_SESSION['cine-lunes_Cargo']);?>
	</h1>
	<br>	
	<a href="usuario-cerrar.php">  Cerrar sesión</a>
	
	<table  border="1" align="center" class="tabla1" width="400px">
		<tr>
			<td>Listado de actores</td>
			<td><a href="actores.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Actores por Pelicula</td>
			<td><a href="actorporpelicula.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Asientos</td>
			<td><a href="asientos.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Clasificaciones</td>
			<td><a href="clasificacionpelicula.php">Ver</a></td>				
		</tr>
		
		<tr>
			<td>Listado de Copias</td>
			<td><a href="copias.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Directores</td>
			<td><a href="directores.php">Ver</a></td>			
		</tr>
		
		<tr>
			<td>Listado de Directores por Pelicula</td>
			<td><a href="directorporpelicula.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Distribuidores</td>
			<td><a href="distribuidores.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Distribuidores por Pelicula</td>
			<td><a href="distribuidoresporpelicula.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Formatos de Audio</td>
			<td><a href="formatoaudio.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Formato por Pelicula</td>
			<td><a href="formatoporpelicula.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Formatods de videos</td>
			<td><a href="formatovideo.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Generos por Peliculas</td>
			<td><a href="generoporpeliculas.php">Ver</a></td>				
		</tr>
		
		<tr>
			<td>Listado de Generos de Peliculas</td>
			<td><a href="generosdepeliculas.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Horas y Fechas</td>
			<td><a href="horafecha.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Peliculas</td>
			<td><a href="pelicula-lista.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Productoras</td>
			<td><a href="productora.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Productoras por Peliculas</td>
			<td><a href="productoraporpelicula.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Proyecciones</td>
			<td><a href="proyecciones.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Reservas de Asientos</td>
			<td><a href="reservaasientos.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Salas</td>
			<td><a href="salas.php">Ver</a></td>	
		</tr>
		
		<tr>
			<td>Listado de Usuarios</td>
			<td><a href="usuario.php">Ver</a></td>	
		</tr>	
		
	</table>
	<br>
	
	

	
</body>
</html>
