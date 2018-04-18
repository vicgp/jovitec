
<?php
session_start();
include("../php/funcions.php");

$sql="SELECT nom_usuari FROM usuaris WHERE id_usuari=".$_GET['emisor'];
$ejecutar=consulta($sql);
while($fila=$ejecutar->fetch_array()){
  $nombre=$fila[0];
}

$mensaje=$_GET['mensaje'];
$emisor=$_GET['emisor'];
$receptor=$_GET['receptor'];

$sql="SELECT Conectat FROM usuaris WHERE id_usuari=".$receptor;
$ejecutar=consulta($sql);
while($fila=$ejecutar->fetch_array()){
  $conectat=$fila[0];

}

$sql = "INSERT INTO chat VALUES (null,".$emisor.",".$receptor.",'".$nombre."','".$mensaje."',null,".$conectat.")";
  $ejecutar = consulta($sql);

  ?>
