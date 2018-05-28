<?php
session_start();
include("../php/funcions.php");
$idOt=$_POST['id_ot'];
$info=$_POST['info'];
$infoCanvi=$_POST['infoCanvi'];
$actuacio="";
$hores=0;
if(isset($_POST['actuacio'])){
  $actuacio=$_POST['actuacio'];
}
if(isset($_POST['hores'])){
  $hores=$_POST['hores'];
}
if($infoCanvi==1){
  $sql="UPDATE observacions_ot SET item_observacions='".$info."' WHERE id_ot=".$idOt;
}
elseif ($infoCanvi==2) {
  $sql="UPDATE anomalies SET anomalia='".$info."' WHERE id_ot=".$idOt;
}
elseif ($infoCanvi==3) {
  $sql="UPDATE ordre_treball SET data_lliurament='".$info."' WHERE id_ot=".$idOt;

}
elseif ($infoCanvi==4) {
  $sql="UPDATE ordre_treball SET data_finalitzacio='".$info."' WHERE id_ot=".$idOt;
}
else{
  $temps=hores_minuts_to_segons($hores,$info);
  $sql="INSERT INTO actuacions VALUES(null,'".$actuacio."',".$temps.",".$idOt.")";
}
$res=consulta($sql);
echo $res;
 ?>
