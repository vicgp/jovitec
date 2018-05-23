<?php
session_start();
include("../../php/funcions.php");
$idot=$_POST['idOt'];
$idSupervisor=$_POST['supervisor'];
$sql="INSERT INTO supervisors VALUES(NULL,".$idSupervisor.",".$idot.",null)";
$res=consulta($sql);
 ?>
