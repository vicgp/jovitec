<?php
  require("../php/funcions.php");

  if (!empty($_POST['email']) && !empty($_POST['Names']) && !empty($_POST['usname']) && !empty($_POST['pwd']) ) {

    $sql= "INSERT INTO usuaris (id_usuari,username_usuari,password_usuari,nom_usuari,email_usuari,rol_usuari) VALUES (null,'".$_POST['usname']."','".$_POST['pwd']."','".$_POST['Names']."','".$_POST['email']."',5)";
  
consulta($sql);
  }

   header('Location: ../index.php');

?>