<?php
session_start();
include("../../php/funcions.php");
$idot=$_POST['idOt'];
$idTecnic=$_POST['tecnic'];
$sql="INSERT INTO tecnics VALUES(NULL,".$idTecnic.",".$idot.",NULL)";
$res=consulta($sql);
 ?>
