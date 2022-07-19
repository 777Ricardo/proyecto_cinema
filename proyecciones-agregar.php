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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formregistro")) {
  $insertSQL = sprintf("INSERT INTO proyecciones (IdProyecciones, idSala, hora, idCopia) VALUES (%s, %s, %s, %s)",
					   
					   GetSQLValueString($_POST['IdProyecciones'], "int"),
                       GetSQLValueString($_POST['idSala'], "int"),
					   GetSQLValueString($_POST['hora'], "long"),
					   GetSQLValueString($_POST['idCopia'], "int"));
	

  
  $Result1 = mysqli_query($conexioncine,$insertSQL) or die(mysqli_error($conexioncine));

  $insertGoTo = "proyecciones.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



?>
<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Jura:400,300' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-type" content="text/html charset=utf-8" />

<title>Ingresar Nueva Proyeccion</title>
<link rel="stylesheet" href="css/estilos.css"  type="text/css" />
</head>
<body>
<br><br><br><br>
<h1 align="center">INGRESAR NUEVA PROYECCION</h1>
  
  <form action="<?php echo $editFormAction; ?>" method="post" name="formregistro" id="formregistro" onsubmit="return validateformregistro();">
    <table align="center">
		
		<tr valign="baseline">
        <td nowrap="nowrap" align="right">Id Proyeccion:</td>
        <td><input type="text" name="IdProyecciones" value="" size="32" class="campo" /></td>
      </tr>
		
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Id Sala:</td>
        <td><input type="text" name="idSala" value="" size="32" class="campo" /></td>
      </tr>
		
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Hora:</td>
        <td><input type="text" name="hora" value="" size="32" class="campo"/></td>
		</tr>
		
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Id Copia:</td>
        <td><input type="text" name="idCopia" value="" size="32" class="campo"/></td>
		</tr>
      
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Ingresar" id="botonalta" class="boton"/></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="formregistro"/>
</form>
</body>
</html>