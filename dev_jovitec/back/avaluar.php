<?php
  //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
  include("../php/funcions.php");


    $id_usuari = ($_POST['id_usuari']);
    $nombre = ($_POST['nombre']);
    $ot = ($_POST['ot']);
    $competencia = ($_POST['competencia']);
    $nota = ($_POST['nota']);

        ////// ASIGNARLOS A VARIABLES ///////////////////

        //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
        $valores='(null,'.$id_usuari.',"'.$nombre.'","'.$ot.'","'.$competencia.'","'.$nota.'")';

        ///////// QUERY DE INSERCIÓN ////////////////////////////
        $sql = "INSERT INTO avaluacio (id_avaluacio, id_usuari, nom, numero_ot, id_competencia, id_nota)
      VALUES $valores";
      $resultat=consulta($sql);
      $sql2 = "UPDATE usuaris SET Avaluat=1 WHERE id_usuari".$id_usuari;
    $resultat=consulta($sql2);





  ?>
