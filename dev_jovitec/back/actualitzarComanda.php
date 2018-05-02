<?php
session_start();
include("../php/funcions.php");
$sql="UPDATE ordre_treball SET id_estat=".$_POST['estat']." WHERE id_ot=".$_POST['id_ot'];
consulta($sql);
?>
