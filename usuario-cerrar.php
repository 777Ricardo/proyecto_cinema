<?php require_once('Connections/conexioncine.php'); ?>
<?php    
    $_SESSION['MM_Username'] = "";
    $_SESSION['MM_UserGroup'] = "";
    $_SESSION['cine-lunes_UserId'] = "";
    $_SESSION['cine-lunes'] = "";
    $_SESSION['cine-lunes'] = "";
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['cine-lunes']);
	unset($_SESSION['cine-lunes']);
    unset($_SESSION['cine-lunes']);

    $updateGoTo = "index.php";
	header(sprintf("Location: %s", $updateGoTo));
	?>