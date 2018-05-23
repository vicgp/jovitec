<?php
session_start();
include("../../php/funcions.php");
$idot=$_POST['idOt'];
$idSupervisor=$_POST['supervisor'];
$sql="DELETE FROM tecnics WHERE id_ot=".$idot." AND id_usuari=".$idSupervisor;
$res=consulta($sql);
 ?>
