
<?php
session_start();
include("../php/funcions.php");
$sql="SELECT nom_usuari FROM usuaris WHERE id_usuari=".$_GET['emisor'];
$ejecutar=consulta($sql);
while($fila=$ejecutar->fetch_array()){
  $nombre=$fila;
}

$mensaje=$_GET['mensaje'];
$emisor=$_GET['emisor'];
$receptor=$_GET['receptor'];


$sql = "INSERT INTO chat VALUES (null,".$emisor.",".$receptor.",'".$nombre."','".$mensaje."',null)";
  $ejecutar = consulta($sql);
  ?>
