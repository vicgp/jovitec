<?php
session_start();
include("../php/funcions.php");



    if($_POST['eliminar'] == "item_observacions" ){
      $query_elimina_item="DELETE FROM observacions_ot WHERE id_observacions=".$_POST['item_observacions']."";
    }

    if($_POST['eliminar'] == "item_client" ){
      $query_elimina_item="DELETE FROM inventari_client WHERE id_inventari_client=".$_POST['item']."";
    }

    if($_POST['eliminar'] == "anomalia" ){
      $query_elimina_item="DELETE FROM anomalies WHERE id_anomalia=".$_POST['anomalia']."";
    }

    if($_POST['eliminar'] == "actuacio" ){
      $query_elimina_item="DELETE FROM actuacions WHERE id_actuacio=".$_POST['actuacio']."";
    }

//////////////////////////////////////////////////////////////////
    $resultat_delete=consulta($query_elimina_item);

////// si venim de modificació de les pròpies dades haurem de tornar a l'inici
////// per tant hem de rebre una variable que ens ho indiqui
////// i fer un if per seleccionar la tornada
////// s'ha de modificar igualment la variable 'altauser'

    //tornar a la pàgina de l'OT mitjançant un formulari (per enviar variable POST) que s'activa automàticament amb javascript
    if($_POST['torna_a']== 'ot'){
      echo "<form name=torna_a action='../front/ot.php' method='post'>";
        echo "<input type='text' name='id_ot' value='".$_POST['id_ot']."'>";
        echo "</form>";
      echo "<script language='javascript'>document.torna_a.submit();</script>";
    }


    // header("location:../front/usuaris.php");

?>
