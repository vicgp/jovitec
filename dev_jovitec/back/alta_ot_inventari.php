<?php

session_start();
include("../php/funcions.php");
$idot=$_POST['idot'];
$producte=$_POST['producte'];
$descripcio=$_POST['descripcio'];
$sql="INSERT INTO inventari_client VALUES (NULL,'".$producte."','".$descripcio."',".$idot.")";
$res=consulta($sql);
?>
