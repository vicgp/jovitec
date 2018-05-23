<?php
session_start();
include("../../php/funcions.php");
$idot=$_POST['idOt'];
$idTecnic=$_POST['tecnic'];
$sql="DELETE FROM tecnics WHERE id_ot=".$idot." AND id_usuari=".$idTecnic;
$res=consulta($sql);
 ?>
