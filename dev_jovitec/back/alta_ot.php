<?php
session_start();
include("../php/funcions.php");
// echo "<br />curs escolar: ".$_POST['id_curs'];
// echo "<br />data: ".$_POST['data_entrada'];
// echo "<br />usuari: ".$_POST['id_usuari'];

if($_POST['id_usuari'] == 'nou_usuari'){
  //donar d'alta l'usuari i tornar per cumplimentar la nova ordre_treball
  //faig un formulari per enviar les dades al formulari d'alta d'usuari i que torni aquí
echo "
    <form id='nou_usuari' method='post' action='../front/nou_usuari.php'>
      <input type=hidden name='id_curs' value='".$_POST['id_curs']."'  />
      <input type=hidden name='data_entrada' value='".$_POST['data_entrada']."'  />
      <input type=hidden name='alta_ot' value='True'  />
      <input type=hidden name='altauser' value='True' />
    </form>
    <script>document.getElementById('nou_usuari').submit();</script>
";
}
else{

// en primer lloc mirem si s'ha de crear un usuari nou i anem a la pàgina d'usuaris
// if($_POST['id_usuari'] == "nou_usuari"){
//   header("location:../front/usuaris.php");
// }
// entrar a la base de dades i consultar l'últim id per redirigir a la ot acabada de crear

//entrar la nova ordre
$query_nova_ot="INSERT INTO ordre_treball (id_ot, id_curs, id_usuari, data_entrada, prioritat, data_finalitzacio, data_lliurament) VALUES (NULL, ".$_POST['id_curs'].", ".$_POST['id_usuari'].", '".$_POST['data_entrada']."', 1, NULL, NULL)";

//en aquesta ocasió no utilitzo la funció conecta() per tal de obtenir l'últim id, ja que he de consultar l'objecte de la connexió
require '../php/config.php';
$connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
$connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
if (!$connection) {
    die("Error de connexió: " . mysqli_connect_error());
}
$result=$connection->query($query_nova_ot);
if (!$result){
    die("Error en la consulta: ".$connection->error);
}
else{
  //consultar id de la OT creada
  $id_ot=$connection->insert_id;
  $connection->close();
}



echo "última id_ot: ".$id_ot;

echo<<<END
    <form name=torna_a method=POST action=../front/ot.php>
END;
    echo "<input type=hidden name=id_ot value=".$id_ot." />";
echo<<<END
      <script language=javascript>document.torna_a.submit();</script>
    </form>
END;
}
?>
