<?php
require_once('Connections/conexioncine.php')
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
		
$query_DatosActorporpelicula = "SELECT * FROM actorporpelicula";
$DatosActorporpelicula = mysqli_query($conexioncine, $query_DatosActorporpelicula) or die (mysqli_error($conexioncine));
$row_DatosActorporpelicula = mysqli_fetch_assoc($DatosActorporpelicula);
$totalRows_DatosActorporpelicula = mysqli_num_rows($DatosActorporpelicula);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title> Lista de actores por pelicula </title>
</head>

<body>
	<br><h1 align="center">LISTADO DE ACTORES POR PELICULA</h1>
   <table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Id Actor</td>
			<td> Id Pelicula </td>
			<td> Id Actor por Pelicula</td>
			<td> Rol</td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			<td> Acciones</td>
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	
<td><?php echo $row_DatosActorporpelicula['idActor']; ?></td>
 <td><?php echo $row_DatosActorporpelicula['idPelicula']; ?></td>
  <td><?php echo $row_DatosActorporpelicula['idActorPorPelicula']; ?></td>	
    <td><?php echo $row_DatosActorporpelicula['rol']; ?></td>
      
       <?php if ($_SESSION["cine-lunes_Cargo"]==1){?>             	
	  <td><a href="actorporpelicula-editar.php?actorporpelicula=<?php echo $row_DatosActorporpelicula['idActorPorPelicula']; ?>">Editar</a>-<a href="actorporpelicula-eliminar.php?actorporpelicula=<?php echo $row_DatosActorporpelicula['idActorPorPelicula']; ?>">Eliminar</a> <?php } ?>
	  
<?php } while ($row_DatosActorporpelicula = mysqli_fetch_assoc($DatosActorporpelicula))?>
				</tr>
   
	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="actorporpelicula-agregar.php">Agregar</a></p>
	
</body>	
</html>
<?php mysqli_free_result($DatosActorporpelicula) // optimizar el rendimiento(borra variables temporales)?> 
