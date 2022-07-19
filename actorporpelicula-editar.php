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
$varactorporpelicula_DatosActualizar = "0";
if (isset($_GET["actorporpelicula"])) {
  $varactorporpelicula_DatosActualizar = $_GET["actorporpelicula"];
}
$query_DatosActualizar = sprintf("SELECT * FROM actorporpelicula WHERE actorporpelicula.idActorPorPelicula = %s", GetSQLValueString($varactorporpelicula_DatosActualizar, "int"));
$DatosActualizar = mysqli_query($conexioncine,$query_DatosActualizar) or die(mysqli_error($conexioncine));
$row_DatosActualizar = mysqli_fetch_assoc($DatosActualizar);
$totalRows_DatosActualizar = mysqli_num_rows($DatosActualizar);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE actorporpelicula SET idActor=%s, idPelicula=%s, rol=%s WHERE idActorPorPelicula=%s",
                       GetSQLValueString($_POST['idActor'], "int"),
					   GetSQLValueString($_POST['idPelicula'], "int"),
					   GetSQLValueString($_POST['rol'], "text"),
                       GetSQLValueString($_POST['idActorPorPelicula'], "int"));

  
  $Result1 = mysqli_query($conexioncine,$updateSQL) or die(mysqli_error($conexioncine));

  $updateGoTo = "actorporpelicula.php";
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
<title>Actualizar Información de Actores por pelicula</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>
</head>
<body>
<br><br><br>
<h1 align="center">ACTUALIZAR INFORMACION DE ACTORES POR PELICULA</h1>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      
		<tr valign="baseline">
         <tr valign="baseline">
        <td nowrap="nowrap" align="right">Id Actor:</td>
        <td><input type="text" name="idActor" class="campo" value="<?php echo $row_DatosActualizar['idActor']; ?>" size="32" /></td>
      </tr>
     
		<tr valign="baseline">  
        <td nowrap="nowrap" align="right">Id Pelicula:</td>
        <td><input type="text" name="idPelicula" class="campo" value=" <?php echo $row_DatosActualizar['idPelicula']; ?>" size="32" /></td>
      </tr>
       
             
       <tr valign="baseline">
        <td nowrap="nowrap" align="right">Rol:</td>
        <td><input type="text" name="rol" class="campo" value=" <?php echo $row_DatosActualizar['rol']; ?>" size="32" /></td>
      </tr>
      
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Actualizar registro" class="boton" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idActorPelicula" value="<?php echo $row_DatosActualizar['idActorPorPelicula']; 
												  ?>"/>
</form>
</body>
</html>
