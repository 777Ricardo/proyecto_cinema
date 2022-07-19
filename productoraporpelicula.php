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
		
$query_DatosProductoraPorPelicula = "SELECT * FROM productoraporpelicula";
$DatosProductoraPorPelicula = mysqli_query($conexioncine, $query_DatosProductoraPorPelicula) or die (mysqli_error($conexioncine));
$row_DatosProductoraPorPelicula = mysqli_fetch_assoc($DatosProductoraPorPelicula);
$totalRows_DatosProductoraPorPelicula = mysqli_num_rows($DatosProductoraPorPelicula);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title> Lista de Productoras por Peliculas </title>
</head>

<body>
	<br>
<h1 align="center">LISTADO DE PRODUCTORAS POR PELICULAS</h1>
	<table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Id Productora</td>
			<td> Id Pelicula </td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			<td> Acciones</td>
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	
<td><?php echo $row_DatosProductoraPorPelicula['idProductora']; ?></td>
 <td><?php echo utf8_encode($row_DatosProductoraPorPelicula['idpelicula']); ?></td>
         
	   <?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
	<td><a href="productoraporpelicula-editar.php?productoraporpelicula=<?php echo 				$row_DatosProductoraPorPelicula['idProductora']; ?>">Editar</a>-<a 					href="productoraporpelicula-eliminar.php?productoraporpelicula=<?php echo $row_DatosProductoraPorPelicula['idProductora']; ?>">Eliminar</a><?php } ?>
	  
		<?php } while ($row_DatosProductoraPorPelicula = mysqli_fetch_assoc($DatosProductoraPorPelicula))?>
	</tr>

	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="productoraporpelicula-agregar.php">Agregar</a></p>
</body>	
</html>
<?php mysqli_free_result($DatosProductoraPorPelicula) // optimizar el rendimiento(borra variables temporales)?> 
