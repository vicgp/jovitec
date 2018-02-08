<?php
session_start();
include("../php/funcions.php");

require_once '../php/config.php';
$connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
$connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
if (!$connection) {
    die("Error de connexió: " . mysqli_connect_error());
}

    // alta d'un ítem a la base de dades
    ///////////////////////////////////////////////////////////////
    if($_POST['afegir'] == "item_observacions" ){
      //escapem els caracters que poden ser conflictius per l'SQL
      $item_observacions=mysqli_real_escape_string($connection, $_POST['item_observacions']);
      $query_intro_item='INSERT INTO `jovitec`.`observacions_ot` (`id_observacions`, `item_observacions`, `id_ot`) VALUES (NULL, "'.$item_observacions.'", "'.$_POST["id_ot"].'")';
    }

    if($_POST['afegir'] == "item_client" ){
      $descripcio=mysqli_real_escape_string($connection, $_POST["descripcio"]);
      $query_intro_item='INSERT INTO `jovitec`.`inventari_client` (`id_inventari_client`, `descripcio`, `id_ot`) VALUES (NULL, "'.$descripcio.'", "'.$_POST["id_ot"].'")';
    }

    if($_POST['afegir'] == "anomalia" ){
      $anomalia=mysqli_real_escape_string($connection, $_POST["anomalia"]);
      $query_intro_item='INSERT INTO `jovitec`.`anomalies` (`id_anomalia`, `anomalia`, `id_ot`) VALUES (NULL, "'.$anomalia.'", "'.$_POST["id_ot"].'")';
    }

    if($_POST['afegir'] == "actuacio" ){
      $actuacio=mysqli_real_escape_string($connection, $_POST["actuacio"]);
      $temps_en_segons=$_POST['hores']*3600+$_POST['minuts']*60;
      $query_intro_item='INSERT INTO `jovitec`.`actuacions` (`id_actuacio`, `actuacio`, `segons`, `id_ot`) VALUES (NULL, "'.$actuacio.'", "'.$temps_en_segons.'", "'.$_POST["id_ot"].'")';
    }

//////////////////////////////////////////////////////////////////
    // $resultat_insert=consulta($query_intro_item);
    $result=$connection->query($query_intro_item);
    if (!$result){
        die("Error en la consulta: ".$connection->error);
    }
    $connection->close();

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
    else{
      header('Location: main.php');
    }
    // header("location:../front/usuaris.php");

?>
