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
$varpeliculas_DatosActualizar = "0";
if (isset($_GET["peliculas"])) {
  $varpeliculas_DatosActualizar = $_GET["peliculas"];
}

$query_DatosActualizar = sprintf("SELECT * FROM peliculas WHERE peliculas.idpelicula = %s", GetSQLValueString($varpeliculas_DatosActualizar, "int"));
$DatosActualizar = mysqli_query($conexioncine,$query_DatosActualizar) or die(mysqli_error($conexioncine));
$row_DatosActualizar = mysqli_fetch_assoc($DatosActualizar);
$totalRows_DatosActualizar = mysqli_num_rows($DatosActualizar);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE peliculas SET nombre=%s, duracion=%s,  idclasificasion=%s, estreno=%s  imagen=%s WHERE idpelicula=%s",
					   
					   
                       GetSQLValueString(utf8_decode($_POST['nombre']), "text"),
					   GetSQLValueString($_POST['duracion'], "text"),
					   GetSQLValueString($_POST['idclasificasion'], "int"),
					   GetSQLValueString($_POST['estreno'], "text"),
                       GetSQLValueString($_POST['imagenes'], "text"),
					   GetSQLValueString($_POST['idpelicula'], "int"));
                       

  
  $Result1 = mysqli_query($conexioncine,$updateSQL) or die(mysqli_error($conexioncine));

  $updateGoTo = "pelicula-lista.php";
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
<title>Información de Productos</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>
</head>
<body>
	<script>
function subirimagen()
{
	self.name = 'opener';
	remote = open('gestionimagen.php', 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}
	</script>	
	
	<br>
	<br>
	<br>
<h1 align="center">Actualizar información de Productos</h1>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      
		
		
		<tr valign="baseline">
         <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre:</td>
        <td><input type="text" name="nombre" class="campo" value="<?php echo utf8_encode($row_DatosActualizar['nombre']); ?>" size="32" /></td>
      </tr>
     
		<tr valign="baseline">  
        <td nowrap="nowrap" align="right">Duración:</td>
        <td><input type="text" name="duracion" class="campo" value=" <?php echo $row_DatosActualizar['duracion']; ?>" size="32" /></td>
      </tr>
       
      <tr valign="baseline">  
        <td nowrap="nowrap" align="right">estreno:</td>
        <td><input type="text" name="estreno" class="campo" value=" <?php echo $row_DatosActualizar['duracion']; ?>" size="32" /></td>
      </tr>
       <tr valign="baseline">
        <td nowrap="nowrap" align="right">Clasificación:</td>
        <td><input type="text" name="idclasificasion" class="campo" value="<?php echo $row_DatosActualizar['idclasificasion']; ?>" size="32" /></td>
	   </tr>
		
	   <tr valign="baseline">
		<td nowrap="nowrap" align="right">Imagen</td>
		<td ><input name="imagenes" type="text" class="campo" value="<?php echo $row_DatosActualizar['imagenes']; ?>"><input name="button" type="button" class="boton" id="button" onclick="javascript:subirimagen();" value="Subir Imagen"/></td>
	   </tr>
      
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Actualizar producto" class="boton" /></td>
      </tr>
		
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idpelicula" value="<?php echo $row_DatosActualizar['idpelicula']; 
												  ?>"/>
</form>
</body>
</html>