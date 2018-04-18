<?php
session_start();
include("../php/funcions.php");
print_r($_SESSION);
$Disconnected="UPDATE usuaris SET Conectat=0 WHERE id_usuari=".$_SESSION['id_user'];
$res=consulta($Disconnected);
session_destroy();

?>
