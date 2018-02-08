<?php
session_start();
include("../php/funcions.php");

    // alta d'un usuari qualificat a una OT

/////////////////////////////////////////////////////////////
    if($_POST['taula'] == "supervisors" ){
      $query_intro_item="INSERT INTO jovitec.supervisors (id_supervisor, id_usuari, id_ot, id_inventari_jovitec) VALUES (NULL, '".$_POST['id_usuari']."', '".$_POST['id_ot']."', NULL)";
    }

    if($_POST['taula'] == "tecnics" ){
      $query_intro_item="INSERT INTO jovitec.tecnics (id_tecnic, id_usuari, id_ot, id_inventari_jovitec) VALUES (NULL, '".$_POST['id_usuari']."', '".$_POST['id_ot']."', NULL)";
    }

    if($_POST['taula'] == "administratius" ){
      $query_intro_item="INSERT INTO jovitec.administratius (id_administratiu, id_usuari, id_ot) VALUES (NULL, '".$_POST['id_usuari']."', '".$_POST['id_ot']."')";
    }
////////////////////////////////////////////////////////////////
    $resultat_insert=consulta($query_intro_item);


////// si venim de modificació de les pròpies dades haurem de tornar a l'inici
////// per tant hem de rebre una variable que ens ho indiqui
////// i fer un if per seleccionar la tornada
////// s'ha de modificar igualment la variable 'altauser'

    //tornar a la pàgina de l'OT mitjançant un formulari (per enviar variable POST) que s'activa automàticament amb javascript

      echo "<form name=torna_a action='../front/modificar_ot.php' method='post'>";
        echo "<input type='text' name='id_ot' value='".$_POST['id_ot']."' />";
        echo "<input type='text' name='taula' value='".$_POST['taula']."' />";
        echo "<input type='text' name='rol_usuari' value='".$_POST['rol_usuari']."' />";
        echo "</form>";
      echo "<script language='javascript'>document.torna_a.submit();</script>";

    // header("location:../front/usuaris.php");

?>
