<?php
session_start();
include("../php/funcions.php");
$idUsuari=$_POST['id_usuari'];
$sql="DELETE FROM usuaris WHERE id_usuari=".$idUsuari;
$res=consulta($sql);
$sql="DELETE FROM ordre_treball WHERE id_usuari=".$idUsuari;
$res=consulta($sql);
$sql="DELETE FROM administratius WHERE id_usuari=".$idUsuari;
$res=consulta($sql);
$sql="DELETE FROM supervisors WHERE id_usuari=".$idUsuari;
$res=consulta($sql);
$sql="DELETE FROM tecnics WHERE id_usuari=".$idUsuari;
$res=consulta($sql);
$sql="DELETE FROM chat WHERE id_emisor=".$idUsuari." OR id_receptor=".$idUsuari;
$res=consulta($sql);
echo $res;
?>
