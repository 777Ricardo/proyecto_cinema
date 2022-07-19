<?php
 if (!isset($_SESSION)){
	 session_start();
 }

?>
<?php
 
$hostname_conexioncine = "localhost";
$database_conexioncine = "cine";
$username_conexioncine = "root";
$password_conexioncine = "";
$conexioncine = mysqli_connect($hostname_conexioncine,$username_conexioncine,
							   $password_conexioncine,$database_conexioncine);
if (is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else
{
	include("../includes/funciones.php");
}
?>
