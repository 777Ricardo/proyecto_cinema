<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subir Imagen</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
	$nombre_archivo = $_FILES['userfile']['name']; 
	move_uploaded_file($_FILES['userfile']['tmp_name'], "images/peliculas-imagenes/".$nombre_archivo);
	?>
    <script>
		opener.document.form1.imagen.value="<?php echo $nombre_archivo; ?>";
		self.close();
	</script>
    <?php
}
else
{?>
<form action="gestionimagen.php" method="POST" enctype="multipart/form-data" id="form1">

  <p>&nbsp;  </p>
  <table width="100%" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td><input name="userfile" type="file" class="campo" /></td>
    </tr>
    <tr>
      <td align="left"><input name="button" type="submit" class="boton" id="button" value="Subir Imagen" /></td>
    </tr>
  </table>
  <input type="hidden" name="enviado" value="form1" />
</form>
<?php }?>
</body>
</html>