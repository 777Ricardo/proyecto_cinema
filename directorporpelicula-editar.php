<?php require_once('Connections/conexioncine.php'); ?>
<?php
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
?>
<?php
$vardirectorporpelicula_DatosActualizar = "0";
if (isset($_GET["directorporpelicula"])) {
  $vardirectorporpelicula_DatosActualizar = $_GET["directorporpelicula"];
}

$query_DatosActualizar = sprintf("SELECT * FROM directorporpelicula WHERE directorporpelicula.idDirector = %s", GetSQLValueString($vardirectorporpelicula_DatosActualizar, "int"));
$DatosActualizar = mysqli_query($conexioncine,$query_DatosActualizar) or die(mysqli_error($conexioncine));
$row_DatosActualizar = mysqli_fetch_assoc($DatosActualizar);
$totalRows_DatosActualizar = mysqli_num_rows($DatosActualizar);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE directorporpelicula SET idPelicula=%s WHERE idDirector=%s",
                       GetSQLValueString($_POST['idPelicula'], "int"),
					   GetSQLValueString($_POST['idDirector'], "int"));
					  
                       
  $Result1 = mysqli_query($conexioncine,$updateSQL) or die(mysqli_error($conexioncine));

  $updateGoTo = "directorporpelicula.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Actualizar Información de Director por Pelicula</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>
</head>
<body>
<br><br><br>
<h1 align="center">ACTUALIZAR LA INFOMACION DE DIRECTOR POR PELICULA</h1>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      
		
		<tr valign="baseline">  
        <td nowrap="nowrap" align="right">Id Pelicula:</td>
        <td><input type="text" name="idPelicula" class="campo" value=" <?php echo $row_DatosActualizar['idPelicula']; ?>" size="32" /></td>
      </tr>
       
            
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Actualizar registro" class="boton" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idDirector" value="<?php echo $row_DatosActualizar['idDirector']; 
												  ?>"/>
</form>
</body>
</html>