<?php
session_start();
include("../php/funcions.php");

require_once '../php/config.php';
$connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
$connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
if (!$connection) {
    die("Error de connexió: " . mysqli_connect_error());
}

    //variables POST a variables per la query
    $id_usuari = $_POST['id_usuari'];
    $nom = mysqli_real_escape_string($connection, $_POST['nom']);
    $cognoms = mysqli_real_escape_string($connection, $_POST['cognoms']);
    $usuari = mysqli_real_escape_string($connection, $_POST['user']);
    $contrasenya = mysqli_real_escape_string($connection, $_POST['passwd']);
    $email = mysqli_real_escape_string($connection, $_POST['email']) ;
    $telef = mysqli_real_escape_string($connection, $_POST['telef']);
    $rol = $_POST['rol'];
    $observacions = mysqli_real_escape_string($connection, $_POST['observacions']);




    // alta de l'usuari a la base de dades

    $query_usuari="SELECT * FROM usuaris WHERE id_usuari = '$id_usuari'";
    $resultat_usuari=$connection->query($query_usuari);

     $fila_usuari=$resultat_usuari->fetch_assoc();

//anem comprobant els camps que han canviat i els actualitzem a la base de dades
    if ($fila_usuari['nom_usuari'] != $nom){
      $query_intro_usuari="UPDATE usuaris SET nom_usuari='$nom' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['cognoms_usuari'] != $cognoms){
      $query_intro_usuari="UPDATE usuaris SET cognoms_usuari='$cognoms' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['username_usuari'] != $usuari){
      $query_intro_usuari="UPDATE usuaris SET username_usuari='$usuari' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['password_usuari'] != $contrasenya){
      $query_intro_usuari="UPDATE usuaris SET password_usuari='$contrasenya' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['email_usuari'] != $email){
      $query_intro_usuari="UPDATE usuaris SET email_usuari='$email' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['telef_usuari'] != $telef){
      $query_intro_usuari="UPDATE usuaris SET telef_usuari='$telef' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['rol_usuari'] != $rol){
      $query_intro_usuari="UPDATE usuaris SET rol_usuari='$rol' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    }
    if ($fila_usuari['observacions'] != $observacions){
      $query_intro_usuari="UPDATE usuaris SET observacions='$observacions' WHERE id_usuari = '$id_usuari'";
      $resultat_insert=$connection->query($query_intro_usuari);
    } 


        header("location:../front/usuaris.php");


?>
