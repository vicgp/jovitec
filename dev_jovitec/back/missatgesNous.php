<?php
session_start();
include("../php/funcions.php");
$sql="SELECT u.username_usuari,u.id_usuari,COUNT(*) a FROM chat c,usuaris u WHERE c.id_emisor=u.id_usuari AND id_receptor=".$_SESSION['id_user']." AND estat=0 GROUP BY u.username_usuari";
$resultat=consulta($sql);
$numMi=0;
while ($fila=$resultat->fetch_assoc()){
  echo "<a id='".$numMi."NewMessage' class='w3-bar-item w3-button' onclick='abrir(".$_SESSION['id_user'].",".$fila['id_usuari'].")'>".$fila['username_usuari']."/".$fila['a']."</a>";
  $numMi++;
}
  ?>
