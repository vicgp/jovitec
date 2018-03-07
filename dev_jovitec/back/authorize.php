<?php
include("../php/funcions.php");

// cercar l'usuari i comprovar la contrasenya
$uname = $_POST['uname'];
$query_usuari="SELECT password_usuari FROM usuaris WHERE username_usuari = '$uname'";
$resultat=consulta($query_usuari);
// if(!$resultat){echo "no hi ha resultat";}

if ($resultat->fetch_assoc()['password_usuari'] != $_POST['psswd']){
<<<<<<< HEAD
	$mensaje = "Error a la autentificació";
	echo "<script type='text/javascript'>alert('$mensaje'); location.href = '../index.php'</script>";
  //echo" <br />ho sento, no estàs autoritzat!<br />";
  //echo" <br />introduir usuari i contrasenya correctes<br />";
  //echo '<meta http-equiv="refresh" content="4; url=../index.html" />';
=======
  echo" <br />ho sento, no estàs autoritzat!<br />";
  echo" <br />introduir usuari i contrasenya correctes<br />";
  echo '<meta http-equiv="refresh" content="4; url=../index.html" />';

>>>>>>> master
}
else {
  // fem una consulta per saber el rol de l'usuari
  $query_rol="SELECT rol_usuari,id_usuari FROM usuaris WHERE username_usuari = '$uname'";
  $resultat_rol=consulta($query_rol);
// es defineixen les variables de sessió
  session_start();
  $_SESSION['usuari']=$uname;
  $_SESSION['id_user']=($resultat_rol->fetch_assoc()['id_usuari']);
  $_SESSION['rol']=($resultat_rol->fetch_assoc()['rol_usuari']);
  $_SESSION['curs_actual']=$_POST['curs_actual'];

  //redirigim a la pàgina principal del lloc
 header("location:../front/main.php");
}
?>
