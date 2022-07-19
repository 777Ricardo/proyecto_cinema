<?php require_once('../Connections/conexioncine.php'); ?>
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

if ($_POST["formid"]==1)
	{
	
	$query_Datosusuarios = "SELECT idUsuario FROM usuarios WHERE EmailUsuario = '".utf8_decode($_POST['EmailUsuario '])."'";
	$Datosusuarios = mysqli_query($conexioncine,$query_Datosusuarios) or die(mysqli_error($conexioncine));
	$row_Datosusuarios = mysqli_fetch_assoc($Datosusuarios);
	$totalRows_Datosusuarios = mysqli_num_rows($Datosusuarios);
	
	if ($totalRows_Datosusuarios>0) echo "0"; 
	else echo "1";
	}

if ($_POST["formid"]==2)
{
  $insertSQL = sprintf("INSERT INTO usuarios (NombreUsuario, CedulaUsuario, EmailUsuario, password, repetircontraseña, idcargo, Estado ) VALUES (%s, %s, %s,%s, %s, %s, %s)",
                      GetSQLValueString(utf8_decode($_POST['NombreUsuario']), "text"),
					  GetSQLValueString(utf8_decode($_POST['CedulaUsuario']), "text"),
					  GetSQLValueString(utf8_decode($_POST['EmailUsuario']), "text"),
                      GetSQLValueString(utf8_decode($_POST['password']), "text"),
					  GetSQLValueString(utf8_decode($_POST['Repetircontraseña']), "text"),
					  GetSQLValueString(utf8_decode($_POST['idcargo:']), "text"),
	                  GetSQLValueString(utf8_decode($_POST['Estado:']), "text"));
  $Result1 = mysqli_query($conexioncine,$insertSQL) or die(mysqli_error($conexioncine));
  
  echo "1";
  }