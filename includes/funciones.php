<?php 
function ObtenerClasificacion($identificador)
{

	global $conexioncine, $database_conexioncine;
	mysqli_select_db($conexioncine, $database_conexioncine);
	$query_ConsultaFuncion = sprintf("SELECT Detalles FROM clasificacionpelicula WHERE idClasificacion=%s", $identificador);
	$ConsultaFuncion = mysqli_query($conexioncine, $query_ConsultaFuncion) or die(mysqli_error($conexioncine));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return utf8_encode($row_ConsultaFuncion['Detalles']); 
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerNombreUsuario($identificador)
{

	global $conexioncine, $database_conexioncine;
	mysqli_select_db($conexioncine, $database_conexioncine);
	$query_ConsultaFuncion = sprintf("SELECT NombreUsuario FROM usuarios WHERE idUsuario=%s", $identificador);
	$ConsultaFuncion = mysqli_query($conexioncine, $query_ConsultaFuncion) or die(mysqli_error($conexioncine));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return utf8_encode($row_ConsultaFuncion['NombreUsuario']); 
	mysqli_free_result($ConsultaFuncion);
}

$tablerow_count=0;

function tablero() {
	global $tablerow_count;
	$tablerow_count++;
	if ($tablerow_count % 2) {
	return "trFila1";
	}
	else {
	return "trFila2";
	}
}

function ObtenerCargoUsuario($cargo){
	switch ($cargo){
			
		case 1: 
		return("Administrador");
		break;
		
		case 2: 
			return("Vendedor"); 
		break;
	}
}
	
?>










