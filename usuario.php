<?php require_once('Connections/conexioncine.php')
?><?php	
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  global $conexioncine;
$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexioncine, $theValue) : mysqli_escape_string($conexioncine,$theValue);


  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}	
		
$query_DatosUsuarios = "SELECT * FROM usuarios";
$DatosUsuarios = mysqli_query($conexioncine, $query_DatosUsuarios) or die (mysqli_error($conexioncine));
$row_DatosUsuarios = mysqli_fetch_assoc($DatosUsuarios);
$totalRows_DatosUsuarios = mysqli_num_rows($DatosUsuarios);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title> Lista de Usuarios </title>
</head>

<body>
	<br>
<h1 align="center">LISTADO DE USUARIOS</h1>
   <table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Id Usuario</td>
			<td> Nombre Usuario</td>
			<td> Cedula Usuario</td>
			<td> Email Usuario</td>
			
			<td> Id cargo</td>
			<td> Estado</td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			<td> Acciones</td>
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	

<td><?php echo $row_DatosUsuarios['idUsuario']; ?></td>
 <td><?php echo $row_DatosUsuarios['NombreUsuario']; ?></td>
  <td><?php echo $row_DatosUsuarios['CedulaUsuario']; ?></td>	
    <td><?php echo $row_DatosUsuarios['EmailUsuario']; ?></td>	 
	  <td><?php echo $row_DatosUsuarios['idcargo']; ?></td>
	   <td><?php echo $row_DatosUsuarios['Estado']; ?></td>
	   
       <?php if ($_SESSION["cine-lunes_Cargo"]==1){?>                 	
	  <td><a href="usuario-editar.php?usuarios=<?php echo $row_DatosUsuarios['idUsuario']; ?>">Editar</a>-<a href="usuario-eliminar.php?usuarios=<?php echo $row_DatosUsuarios['idUsuario']; ?>">Eliminar</a><?php } ?>
	  
<?php } while ($row_DatosUsuarios = mysqli_fetch_assoc($DatosUsuarios))?>
				</tr>
	   
        
	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="usuario-agregar.php">Agregar</a></p>
</body>	
</html>
<?php mysqli_free_result($DatosUsuarios) // optimizar el rendimiento(borra variables temporales)?> 
