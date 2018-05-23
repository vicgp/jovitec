<?php
session_start();
include("../../php/funcions.php");
if($_POST['funcio']==1){
    if($_POST['rol']==2){
      //supervisor
      echo '<option value="">Tria Supervisor</option>';
      $query_ot="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=2";
    }
    else if($_POST['rol']==3){
      //$fila_ot_tecnics
      echo '<option value="">Tria Tecnic</option>';
      $query_ot="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=3";

    }
    else{
      //administratiu
      echo '<option value="">Tria Administratiu</option>';
      $query_ot="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=4";
    }
}
else{
  if($_POST['rol']==2){
    //supervisor
    $query_ot="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris , supervisors WHERE usuaris.id_usuari=supervisors.id_usuari AND supervisors.id_ot=".$_POST['idOt'];
  }
  else if($_POST['rol']==3){
    //$fila_ot_tecnics
    $query_ot="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris , tecnics WHERE usuaris.id_usuari=tecnics.id_usuari AND tecnics.id_ot=".$_POST['idOt'];

  }
  else{
    //administratiu
    $query_ot="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  , administratius WHERE usuaris.id_usuari=administratius.id_usuari AND administratius.id_ot=".$_POST['idOt'];
  }
}
$resultat_ot=consulta($query_ot);
while ($fila_ot=$resultat_ot->fetch_assoc()){
  echo "<option value=".$fila_ot['id_usuari'].">".$fila_ot['username_usuari']."</option>";
}
 ?>
