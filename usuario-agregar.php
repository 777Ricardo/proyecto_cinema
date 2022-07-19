s<?php require_once('Connections/conexioncine.php'); ?>
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





?>
<!doctype html>
<html>
<head>
	
	<meta charset="utf-8">
	<title>Registro</title>
	<link rel="stylesheet" href="css/estilos.css">
	</head>

<body>
	<script src="js/jquery-3.2.1.min.js"></script>	
	<script>
  function valEmail(valor){ 
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(valor))    {
        return false;
    }else{
        return true;
    }
}
  function validateformregistro()
{
	//avisos
	
    valid = true;
	$("#aviso1").hide("slow");
	$("#aviso2").hide("slow");
	$("#aviso3").hide("slow");
	$("#aviso4").hide("slow");
	$("#aviso5").hide("slow");
	$("#aviso6").hide("slow");
	$("#aviso7").hide("slow");
	$("#aviso8").hide("slow");
	$("#aviso9").hide("slow");
	$("#aviso10").hide("slow");
	
	document.formregistro.NombreUsuario.style.border="1px solid #CCC";
	document.formregistro.CedulaUsuario.style.border="1px solid #CCC";
	document.formregistro.EmailUsuario.style.border="1px solid #CCC";
	document.formregistro.RepetirEmail.style.border="1px solid #00FF00";
	document.formregistro.password.style.border="1px solid #CCC";
	document.formregistro.Repetircontraseña.style="1px solid #CCC";
	document.formregistro.idcargo.style="1px solid #CCC";
	document.formregistro.Estado.style="1px solid #CCC";
	//colores
	if ( document.formregistro.NombreUsuario.value == ""){
		$("#aviso1").show("slow");
		document.formregistro.NombreUsuario.style.border='1px solid red';
		valid = false;
	}

	if ( document.formregistro.CedulaUsuario.value == ""){
		$("#aviso2").show("slow");
		document.formregistro.CedulaUsuario.style.border='1px solid red';
		valid = false;
	}
	if ( document.formregistro.EmailUsuario.value == ""){
		$("#aviso3").show("slow");
		document.formregistro.EmailUsuario.style.border='1px solid red';
		valid = false;
		
	}
	if (document.formregistro.RepetirEmail.value == ""){
		$("#aviso4").show("slow");
	document.formregistro.RepetirEmail.style.border="1px solid red";
		valid = false;
		}
	   
	if (document.formregistro.password.value == ""){
		$("#aviso5").show("slow");
		document.formregistro.password.style.border="1px solid red";
		valid = false;
	}
	if (document.formregistro.Repetircontraseña.value == ""){
		$("#aviso6").show("slow");
		document.formregistro.Repetircontraseña.style.border="1px solid red";
		valid = false;
		}
	if (document.formregistro.idcargo.value == ""){
		$("#aviso7").show("slow");
		document.formregistro.idcargo.style.border="1px solid red";
		valid = false;
		}
	if (document.formregistro.Estado.value == ""){
		$("#aviso8").show("slow");
		document.formregistro.Estado.style.border="1px solid red";
		valid = false;
		}
	
		//FIN DE LOS ERRORES DE LOS CAMPOS VACIOS
//comprobacion de que de sean iguales los emails
	if (!valEmail(document.formregistro.EmailUsuario.value)){
		$("#aviso3").show("slow");
		document.formregistro.EmailUsuario.style.border='1px solid red';
		valid = false;
	}

	if (!valEmail(document.formregistro.RepetirEmail.value)){
		$("#aviso4").show("slow");
		document.formregistro.RepetirEmail.style.border='1px solid red';
		valid = false;
	}
	
	
//FIN DE LOS ERRORES DE EMAIL
	//comprobacion de que sean iguales los emails
	if ( document.formregistro.EmailUsuario.value != document.formregistro.RepetirEmail.value){
		$("#aviso9").show("slow");
		document.formregistro.EmailUsuario.style.border='1px solid red';
		valid = false;
	}
	//comprobacion de que sean igules las contraseñas
	if ( document.formregistro.password.value != document.formregistro.Repetircontraseña.value){
		$("#aviso10").show("slow");
		document.formregistro.password.style.border='1px solid red';
		valid = false;
	}
	
	
	return valid;
	}
</script>
	
	
	<h1 align="center">Registrese en el sistema</h1>
  
  <form action="<?php echo $editFormAction; ?>" method="post" name="formregistro" id="formregistro" onsubmit="return validateformregistro();">
    <table align="center">
		
					
		<tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre y apellidos del Usuario:</td>
        <td><input type="text" name="NombreUsuario" value="" size="32" class="campo" />
			 <div class="capaerrores" id="aviso1">Debes escribir un Nombre</div></td>
			
      </tr>
		
     


      <tr valign="baseline">
	   <td nowrap="nowrap" align="right">CedulaUsuario:</td>
		<td><input type="text" name="CedulaUsuario" value="" size="32" class="campo" />
			<div class="capaerrores" id="aviso2">Debes escribir la cedula</div></td>
			  
				   
				   
	 </td>
		  
	 
     

		<tr valign="baseline">
    <td nowrap="nowrap" align="right">EmailUsuario:</td>
	<td><input name="EmailUsuario" type="text" class="campo" value="" size="32" onblur="javascript:controlaremailunico();"/>	 
	<div class="capaerrores" id="aviso3">Debes escribir un email</div>
	<div class="capaerrores" id="aviso11">Atención, el usuario ya está siendo utilizado. Escoge otro email o recupera tu contraseña.</div></td>
	  </tr>

	  
	  
	  
      <tr valign="baseline">
      <td nowrap="nowrap" align="right">Repetir Email:</td>
		  <td><input type="text" name="RepetirEmail" value="" size="32" class="campo"/>
		  <div class="capaerrores"id="aviso4">Escribir un email</div>
		  <div class="capaerrores"id="aviso9">Los Emails no coinciden</div></td>

</tr>
     
	 

	<tr valign="baseline">
<td nowrap="nowrap" align="right">password:</td>
<td><input type="password" name="password" value="" size="32" class="campo"/>
<div class="capaerrores"id="aviso5">Escribir contraseña</div>
   <div class="capaerrores" id="aviso5">Debes escribir una contraseña válida</div></td>  
</tr>

	  <tr valign="baseline">
       <td nowrap="nowrap" align="right">Repetir contraseña:</td>
		 <td><input type="password" name="Repetircontraseña" value="" size="32" class="campo" /> 
      <div class="capaerrores"id="aviso6">Repetir contraseña</div>
		   <div class="capaerrores"id="aviso10">las contraseñas no coninciden</div>

</tr>
   

     
	  <tr valign="baseline">
 <td nowrap="nowrap" align="right">idcargo:</td>
<td><input type="text" name="idcargo" value="" size="32" class="campo"/td>
	<div class="capaerrores"id="aviso7">Escribir cargo</div></td>		 
</tr>
      <tr valign="baseline">
       <td nowrap="nowrap" align="right">Estado:</td>
	<td><input type="text" name="Estado" value="" size="32" class="campo"/td>	
		<div class="capaerrores"id="aviso8">El Estado no es valido</div></td>
		  
</tr>
     <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td align="right"><input type="submit" value="Registrarse" id="botonalta" class="boton"/></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="formregistro"/>
</form>
<script src="js/jquery-3.2.1.min.js"></script>	
<script type="text/javascript">

function controlaremailunico()
{
	var emailinsertado = document.formregistro.EmailUsuario.value;
	$.ajax({
		type: "POST",
		url:"includes/funciones-ajax.php",
		data: 'EmailUsuario='+emailinsertado+'&formid=1',
		success: function(resp)
		{  
			//El email no se encuentra en la BD, el alta se puede dar.
			if (resp==1)
			{
 				 $("#aviso11").hide("fast");
				 $("#exito1").show("slow");
				 document.formregistro.botonalta.disabled=false;
			}
			//El email se ecncuentra en la BD, no podemos dejar que se de de alta.
			if (resp==0)
			{
				 $("#exito1").hide("fast");
				 $("#aviso11").show("slow");
				 document.formregistro.botonalta.disabled=true;
			}
		}
		});

}

</script>
	
	</body>
</html>