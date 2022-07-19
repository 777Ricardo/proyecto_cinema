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
$varreservaasientos_DatosActualizar = "0";
if (isset($_GET["reservaasientos"])) {
  $varreservaasientos_DatosActualizar = $_GET["reservaasientos"];
}

$query_DatosActualizar = sprintf("SELECT * FROM reservaasientos WHERE reservaasientos.usuario= %s", GetSQLValueString($varreservaasientos_DatosActualizar, "int"));
$DatosActualizar = mysqli_query($conexioncine,$query_DatosActualizar) or die(mysqli_error($conexioncine));
$row_DatosActualizar = mysqli_fetch_assoc($DatosActualizar);
$totalRows_DatosActualizar = mysqli_num_rows($DatosActualizar);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE reservaasientos SET idAsiento=%s, estado=%s WHERE usuario=%s",
                       GetSQLValueString($_POST['idAsiento'], "int"),
					   GetSQLValueString($_POST['estado'], "int"),
					   GetSQLValueString($_POST['usuario'], "int"));

  
  $Result1 = mysqli_query($conexioncine,$updateSQL) or die(mysqli_error($conexioncine));

  $updateGoTo = "reservaasientos.php";
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
<title>Actualizar Información de Reservas de Asientos</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>
</head>
<body>
<br><br><br>
<h1 align="center">ACTUALIZAR INFORMACION DE RESERVAS DE ASIENTOS</h1>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      
		    
		<tr valign="baseline">  
        <td nowrap="nowrap" align="right">Id Asiento:</td>
        <td><input type="text" name="idAsiento" class="campo" value=" <?php echo $row_DatosActualizar['idAsiento']; ?>" size="32" /></td>
      </tr>
       
       <tr valign="baseline">
        <td nowrap="nowrap" align="right">Estado:</td>
        <td><input type="text" name="estado" class="campo" value=" <?php echo $row_DatosActualizar['estado']; ?>" size="32" /></td>
      </tr>
       
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Actualizar registro" class="boton" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="usuario" value="<?php echo $row_DatosActualizar['usuario']; 
												  ?>"/>
</form>
</body>
</html>