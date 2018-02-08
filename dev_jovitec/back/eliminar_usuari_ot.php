<?php
session_start();
include("../php/funcions.php");


  $query_elimina_usuari="UPDATE ".$_POST['taula']." SET id_ot=0 WHERE id_usuari=".$_POST['id_usuari']." AND id_ot=".$_POST['id_ot']."";

  $resultat_delete_usuari=consulta($query_elimina_usuari);

  //tornar a la pàgina de l'OT mitjançant un formulari (per enviar variable POST) que s'activa automàticament amb javascript

    if($_POST['id_ot']){
      echo "<form name=torna_a action='../front/modificar_ot.php' method='post'>";
      echo "<input type='text' name='id_ot' value='".$_POST['id_ot']."' />";
      echo "<input type='text' name='taula' value='".$_POST['taula']."' />";
      echo "<input type='text' name='rol_usuari' value='".$_POST['rol_usuari']."' />";
        echo "</form>";
      echo "<script language='javascript'>document.torna_a.submit();</script>";
    }

?>
