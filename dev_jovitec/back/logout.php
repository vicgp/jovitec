<?php
session_start();
include("../php/funcions.php");

$Disconnected="UPDATE usuaris SET Conectat=0 WHERE id_usuari=".$_SESSION['id_user'];
$res=consulta($Disconnected);
session_destroy();
header("location:../index.html");
 ?>
