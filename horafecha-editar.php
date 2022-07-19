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
$varhorafecha_DatosActualizar = "0";
if (isset($_GET["horafecha"])) {
  $varhorafecha_DatosActualizar = $_GET["horafecha"];
}

$query_DatosActualizar = sprintf("SELECT * FROM horafecha WHERE horafecha.hora = %s", GetSQLValueString($varhorafecha_DatosActualizar, "int"));
$DatosActualizar = mysqli_query($conexioncine,$query_DatosActualizar) or die(mysqli_error($conexioncine));
$row_DatosActualizar = mysqli_fetch_assoc($DatosActualizar);
$totalRows_DatosActualizar = mysqli_num_rows($DatosActualizar);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE horafecha SET fecha=%s WHERE hora=%s",
                       GetSQLValueString($_POST['fecha'], "long"),
					   GetSQLValueString($_POST['hora'], "double"));

  
  $Result1 = mysqli_query($conexioncine,$updateSQL) or die(mysqli_error($conexioncine));

  $updateGoTo = "horafecha.php";
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
<title>Actualizar Información de Fecha y Hora</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>
</head>
<body>
<br><br><br>
<h1 align="center">ACTUALIZAR INFOMACION DE LA FECHA Y HORA</h1>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      
		<tr valign="baseline">
         <tr valign="baseline">
        <td nowrap="nowrap" align="right">Hora:</td>
        <td><input type="text" name="hora" class="campo" value="<?php echo utf8_encode($row_DatosActualizar['hora']); ?>" size="32" /></td>
      </tr>
     
		<tr valign="baseline">  
        <td nowrap="nowrap" align="right">Fecha:</td>
        <td><input type="text" name="fecha" class="campo" value=" <?php echo $row_DatosActualizar['fecha']; ?>" size="32" /></td>
      </tr>
       
            
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Actualizar registro" class="boton" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="hora" value="<?php echo $row_DatosActualizar['hora']; 
												  ?>"/>
</form>
</body>
</html>