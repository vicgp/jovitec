<?php
session_start();
include("../php/funcions.php");
$sql="SELECT COUNT(*) a FROM chat WHERE id_receptor=".$_SESSION['id_user']." AND estat=0";
$resultat=consulta($sql);
while ($fila=$resultat->fetch_assoc()){
  echo $fila['a'];
}
  ?>
