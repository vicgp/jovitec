<?php
include("../php/funcions.php");

// cercar l'usuari i comprovar la contrasenya
$uname = $_POST['uname'];
$query_usuari="SELECT password_usuari FROM usuaris WHERE username_usuari = '$uname'";
$resultat=consulta($query_usuari);
// if(!$resultat){echo "no hi ha resultat";}

if ($resultat->fetch_assoc()['password_usuari'] != $_POST['psswd']){
  echo "<script language='javascript'>
                alert('Contrasenya incorrecte!');
                window.location= '../index.php'
    </script>";
}
else {
  // fem una consulta per saber el rol de l'usuari
  $conented="UPDATE usuaris SET Conectat=1 WHERE id_usuari=";
  $query_id="SELECT id_usuari FROM usuaris WHERE username_usuari = '$uname'";
  $resultat_id=consulta($query_id);
// es defineixen les variables de sessió
  session_start();
  $_SESSION['usuari']=$uname;
  $_SESSION['id_user']=($resultat_id->fetch_assoc()['id_usuari']);
  $connected="UPDATE usuaris SET Conectat=1 WHERE id_usuari=".$_SESSION['id_user'];
  $res=consulta($connected);

  $query_rol="SELECT rol_usuari FROM usuaris WHERE username_usuari = '$uname'";
  $resultat_rol=consulta($query_rol);
  $_SESSION['rol']=($resultat_rol->fetch_assoc()['rol_usuari']);

  $_SESSION['curs_actual']=$_POST['curs_actual'];

if($_SESSION['rol']<5){
  header("location:../front/main.php");

}
else{
  header("location:../front/historial_comandes.php");

}
  //redirigim a la pàgina principal del lloc
}
?>
