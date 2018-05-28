<?php
session_start();
include("../php/funcions.php");
$idUsuari=$_POST['id_usuari'];
$info=$_POST['info'];
$infoCanvi=$_POST['infoCanvi'];
if($infoCanvi==1){
  $sql="UPDATE usuaris SET nom_usuari='".$info."' WHERE id_usuari=".$idUsuari;
}
elseif ($infoCanvi==2) {
  $sql="UPDATE usuaris SET cognoms_usuari='".$info."' WHERE id_usuari=".$idUsuari;
}
elseif ($infoCanvi==3) {
  $sql="UPDATE usuaris SET email_usuari='".$info."' WHERE id_usuari=".$idUsuari;
}
elseif ($infoCanvi==4) {
  $sql="UPDATE usuaris SET telef_usuari='".$info."' WHERE id_usuari=".$idUsuari;
}
elseif ($infoCanvi==5) {
  $sql="UPDATE usuaris SET rol_usuari=".$info." WHERE id_usuari=".$idUsuari;
}
else{
    $sql="UPDATE usuaris SET observacions='".$info."' WHERE id_usuari=".$idUsuari;

}

$res=consulta($sql);
echo $res;
 ?>
