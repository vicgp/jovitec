<?php
session_start();
include("../../php/funcions.php");
$idot=$_POST['idOt'];
$idAdministratiu=$_POST['administratiu'];
$sql="DELETE FROM tecnics WHERE id_ot=".$idot." AND id_usuari=".$idAdministratiu;
$res=consulta($sql);
 ?>
