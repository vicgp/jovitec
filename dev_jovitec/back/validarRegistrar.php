<?php

session_start();
include("../php/funcions.php");
$tipusInfo=$_GET['infoPassar'];
$cerca="";
if($tipusInfo=='1'){
  $cerca="SELECT COUNT(*) FROM usuaris WHERE username_usuari='".$_GET['username']."'";

}
else if($tipusInfo=='2'){
  $cerca="SELECT COUNT(*) FROM usuaris WHERE email_usuari='".$_GET['email']."'";
}
$result=consulta($cerca);
$error=$result->fetch_array();


if($error[0]==1){
  echo "0";
}
else{
  echo "1";
}


?>
