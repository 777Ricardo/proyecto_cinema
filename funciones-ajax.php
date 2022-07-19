<?php require_once('../Connections/conexionlaboratorio.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  global $conexionlaboratorio;
$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexionlaboratorio, $theValue) : mysqli_escape_string($conexionlaboratorio,$theValue);


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

if ($_POST["formid"]==1)
	{
	
	$query_DatosFrecuentes = "SELECT idUsuario FROM tblusuario WHERE strEmail = '".utf8_decode($_POST['strEmail'])."'";
	$DatosFrecuentes = mysqli_query($conexionlaboratorio,$query_DatosFrecuentes) or die(mysqli_error($conexionlaboratorio));
	$row_DatosFrecuentes = mysqli_fetch_assoc($DatosFrecuentes);
	$totalRows_DatosFrecuentes = mysqli_num_rows($DatosFrecuentes);
	
	if ($totalRows_DatosFrecuentes>0) echo "0"; 
	else echo "1";
	}

if ($_POST["formid"]==2)
{
  $insertSQL = sprintf("INSERT INTO tblelementos (strNombre, strDescripcion, intCantidad) VALUES (%s, %s, %s)",
                      GetSQLValueString(utf8_decode($_POST['strNombre']), "text"),
					  GetSQLValueString(utf8_decode($_POST['strDescripcion']), "text"),
					  GetSQLValueString(utf8_decode($_POST['intCantidad']), "int"));

  
  $Result1 = mysqli_query($conexionlaboratorio,$insertSQL) or die(mysqli_error($conexionlaboratorio));
  
  echo "1";
  }