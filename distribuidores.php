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
		
$query_DatosDistribuidores = "SELECT * FROM distribuidores";
$DatosDistribuidores = mysqli_query($conexioncine, $query_DatosDistribuidores) or die (mysqli_error($conexioncine));
$row_DatosDistribuidores = mysqli_fetch_assoc($DatosDistribuidores);
$totalRows_DatosDistribuidores = mysqli_num_rows($DatosDistribuidores);
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' a href="css/estilos.css" type="text/css">
<meta charset="utf-8">
<title> Lista de Distribuidores </title>
</head>

<body>
	<br>
<h1 align="center">LISTADO DE DISTRIBUIDORES</h1>
   <table border ="2" align="center" width="70%" >
		<tr align="center" class="fondotitulo">
			<td> Id Distribuidores</td>
			<td> Nombres </td>
			<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
			<td> Acciones</td>
			<?php } ?>
		</tr>
<?php do {?>
<?php  $valorestiloactual=tablero();?>
  <tr class="<?php echo $valorestiloactual; ?>" onmouseover="this.className='trBrillo'"                  onmouseout="this.className='<?php echo $valorestiloactual; ?>'">	
<td><?php echo $row_DatosDistribuidores['idDistribuidores']; ?></td>
 <td><?php echo utf8_encode($row_DatosDistribuidores['nombres']); ?></td>
  </td>
      
	<?php if ($_SESSION["cine-lunes_Cargo"]==1){?>
	  <td><a href="distribuidores-editar.php?distribuidores=<?php echo $row_DatosDistribuidores['idDistribuidores']; ?>">Editar</a>-<a href="distribuidores-eliminar.php?distribuidores=<?php echo $row_DatosDistribuidores['idDistribuidores']; ?>">Eliminar</a><?php } ?>
	  
<?php } while ($row_DatosDistribuidores = mysqli_fetch_assoc($DatosDistribuidores))?>
				</tr>
	   
        
	</table>		
	<p align="center"><a href="inicio.php">Regresar</a> - <a href="distribuidores-agregar.php">Agregar</a></p>
</body>	
</html>
<?php mysqli_free_result($DatosDistribuidores) // optimizar el rendimiento(borra variables temporales)?> 
