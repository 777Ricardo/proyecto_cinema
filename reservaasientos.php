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
		
$query_DatosReservaAsientos = "SELECT * FROM reservaasientos";
$DatosReservaAsientos = mysqli_query($conexioncine, $query_DatosReservaAsientos) or die (mysqli_error($conexioncine));
$row_DatosReservaAsientos = mysqli_fetch_assoc($DatosReservaAsientos);
$totalRows_DatosReservaAsientos = mysqli_num_rows($DatosReservaAsientos);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title> Lista de Reservas de asientos </title>
</head>

<body>
	<br>
<h1 align="center">LISTADO DE RESERVAS DE ASIENTOS</h1>
   <table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Usuario</td>
			<td> Id Asiento </td>
			<td> Estado</td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			<td> Acciones</td>
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	
<td><?php echo $row_DatosReservaAsientos['usuario']; ?></td>
 <td><?php echo $row_DatosReservaAsientos['idAsiento']; ?></td>
  <td><?php echo $row_DatosReservaAsientos['estado']; ?></td>	
         
	   <?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
	  <td><a href="reservaasientos-editar.php?reservaasientos=<?php echo $row_DatosReservaAsientos['usuario']; ?>">Editar</a>-<a href="reservaasientos-eliminar.php?reservaasientos=<?php echo $row_DatosReservaAsientos['usuario']; ?>">Eliminar</a> <?php } ?>
	  
<?php } while ($row_DatosReservaAsientos = mysqli_fetch_assoc($DatosReservaAsientos))?>
				</tr>
	   
        
	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="reservaasientos-agregar.php">Agregar</a></p>
</body>	
</html>
<?php mysqli_free_result($DatosReservaAsientos) // optimizar el rendimiento(borra variables temporales)?> 
