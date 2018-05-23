<?php
session_start();
include("../../php/funcions.php");
$idot=$_POST['idOt'];
$idAdministratiu=$_POST['administratiu'];
$sql="INSERT INTO administratius VALUES(NULL,".$idAdministratiu.",".$idot.")";
$res=consulta($sql);
 ?>
