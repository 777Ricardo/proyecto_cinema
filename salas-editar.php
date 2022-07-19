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
$varsalas_DatosActualizar = "0";
if (isset($_GET["salas"])) {
  $varsalas_DatosActualizar = $_GET["salas"];
}

$query_DatosActualizar = sprintf("SELECT * FROM salas WHERE salas.idSala = %s", GetSQLValueString($varsalas_DatosActualizar, "int"));
$DatosActualizar = mysqli_query($conexioncine,$query_DatosActualizar) or die(mysqli_error($conexioncine));
$row_DatosActualizar = mysqli_fetch_assoc($DatosActualizar);
$totalRows_DatosActualizar = mysqli_num_rows($DatosActualizar);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE salas SET cantFilas=%s, cantColumnas=%s, imagen=%s WHERE idSala=%s",
                       GetSQLValueString($_POST['cantFilas'], "int"),
					   GetSQLValueString($_POST['cantColumnas'], "int"),
					   GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['idSala'], "int"));

  
  $Result1 = mysqli_query($conexioncine,$updateSQL) or die(mysqli_error($conexioncine));

  $updateGoTo = "salas.php";
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
<title>Actualizar Información de las Salas</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>
</head>
<body>
<br><br><br>
<h1 align="center">ACTUALIZAR INFORMACION DE LAS SALAS</h1>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      
		
     
		<tr valign="baseline">  
        <td nowrap="nowrap" align="right">Cantidad de Filas:</td>
        <td><input type="text" name="cantFilas" class="campo" value=" <?php echo $row_DatosActualizar['cantFilas']; ?>" size="32" /></td>
      </tr>
       
       <tr valign="baseline">
        <td nowrap="nowrap" align="right">Cantidad de Columnas:</td>
        <td><input type="text" name="cantColumnas" class="campo" value=" <?php echo $row_DatosActualizar['cantColumnas']; ?>" size="32" /></td>
      </tr>
		
		<tr valign="baseline">
        <td nowrap="nowrap" align="right">Imagen:</td>
        <td><input type="text" name="imagen" class="campo" value=" <?php echo $row_DatosActualizar['imagen']; ?>" size="32" /></td>
      </tr>
       
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Actualizar registro" class="boton" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idSala" value="<?php echo $row_DatosActualizar['idSala']; 
												  ?>"/>
</form>
</body>
</html>