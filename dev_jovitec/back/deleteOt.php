<?php

session_start();
include("../php/funcions.php");
$idot=$_POST['id_ot'];
$sql="DELETE FROM ordre_treball WHERE id_ot=".$idot;
$res=consulta($sql);
$sql="DELETE FROM tecnics WHERE id_ot=".$idot;
$res=consulta($sql);
$sql="DELETE FROM administratius WHERE id_ot=".$idot;
$res=consulta($sql);
$sql="DELETE FROM supervisors WHERE id_ot=".$idot;
$res=consulta($sql);
echo $res;
?>
