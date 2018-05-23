<?php
session_start();
include("../../php/funcions.php");
$imatge=addslashes(file_get_contents($_FILES['imatge']['tmp_name']));
$sql="UPDATE usuaris SET imatge='$imatge' WHERE id_usuari=".$_SESSION['id_user'] ;
$res=consulta($sql);

header('Location: ../../front/usuari.php');

  ?>
