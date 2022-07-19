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
		
$query_DatosPeliculas = "SELECT * FROM peliculas";
$DatosPeliculas = mysqli_query($conexioncine, $query_DatosPeliculas) or die (mysqli_error($conexioncine));
$row_DatosPeliculas = mysqli_fetch_assoc($DatosPeliculas);
$totalRows_DatosPeliculas = mysqli_num_rows($DatosPeliculas);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title>RAPIDOFRUVER.COM </title>
</head>
<style>
body{
	background-color: #06FBBC;
	}
	</style>
	<script src="js/jquery-3.2.1.min.js"></script>
	<br>
<h1 align="center">RapidoFruver.com</h1>
   <table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Id producto</td>
			<td> imagenes </td>
			<td> Cantidad del producto</td>
			<td> Nombre del producto</td>
			<td> Clasificacion del producto</td>
			<td>Acciones</td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	
<td><?php echo $row_DatosPeliculas['idpelicula']; ?></td>
 <td><?php echo utf8_encode($row_DatosPeliculas['nombre']) ?></td>
  <td><?php echo $row_DatosPeliculas['duracion']; ?></td>	
 
    <td><?php echo ObtenerClasificacion($row_DatosPeliculas['idclasificasion']);?></td>
	 <td align="center"> <img src="images/peliculas-imagenes/<?php echo           ($row_DatosPeliculas['imagenes']) ;?>" width="170" height="170"></td>	
      
	 <?php if ($_SESSION["cine-lunes_Cargo"]==1){?> 
	  <td><a href="peliculas-editar.php?peliculas=<?php echo $row_DatosPeliculas['idpelicula']; ?>">Editar</a>-<a href="peliculas-eliminar.php?peliculas=<?php echo $row_DatosPeliculas['idpelicula']; ?>">Eliminar</a> <?php } ?>
	  
<?php } while ($row_DatosPeliculas = mysqli_fetch_assoc($DatosPeliculas))?>
				</tr>
	   
        
	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="peliculas-agregar.php">Agregar</a></p>
</body>	
</html>
<?php mysqli_free_result($DatosPeliculas) // optimizar el rendimiento(borra variables temporales)?> 
