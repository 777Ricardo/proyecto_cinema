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
		
$query_DatosHoraFecha = "SELECT * FROM horafecha";
$DatosHoraFecha = mysqli_query($conexioncine, $query_DatosHoraFecha) or die (mysqli_error($conexioncine));
$row_DatosHoraFecha = mysqli_fetch_assoc($DatosHoraFecha);
$totalRows_DatosHoraFecha = mysqli_num_rows($DatosHoraFecha);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title> Lista de horas y fechas </title>
</head>

<body>
	<br>
<h1 align="center">LISTADO DE HORAS Y FECHAS</h1>
   <table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Horas</td>
			<td> Fecha </td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			<td> Acciones</td>
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	
<td><?php echo $row_DatosHoraFecha['hora']; ?></td>
 
  <td><?php echo $row_DatosHoraFecha['fecha']; ?></td>	
    
        <?php if ($_SESSION["cine-lunes_Cargo"]==1){?>              	
	  <td><a href="horafecha-editar.php?horafecha=<?php echo $row_DatosHoraFecha['hora']; ?>">Editar</a>-<a href="horafecha-eliminar.php?horafecha=<?php echo $row_DatosHoraFecha['hora']; ?>">Eliminar</a> <?php } ?>
	  
<?php } while ($row_DatosHoraFecha = mysqli_fetch_assoc($DatosHoraFecha))?>
				</tr>
	   
        
	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="horafecha-agregar.php">Agregar</a></p>
</body>	
</html>
<?php mysqli_free_result($DatosHoraFecha) // optimizar el rendimiento(borra variables temporales)?> 
