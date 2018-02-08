<?php
session_start();
include("../php/funcions.php");

require_once '../php/config.php';
$connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
$connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
if (!$connection) {
    die("Error de connexió: " . mysqli_connect_error());
}


    //variables POST a variables escapades per la query
    $nom = mysqli_real_escape_string($connection, $_POST['nom']);
    $cognoms = mysqli_real_escape_string($connection, $_POST['cognoms']);
    $usuari = mysqli_real_escape_string($connection, $_POST['user']);
    $contrasenya = mysqli_real_escape_string($connection, $_POST['passwd']);
    $email = mysqli_real_escape_string($connection, $_POST['email']) ;
    $telef = mysqli_real_escape_string($connection, $_POST['telef']);
    $rol = $_POST['rol'];
    $observacions = mysqli_real_escape_string($connection, $_POST['observacions']);

    // alta de l'usuari a la base de dades

    $query_intro_usuari="INSERT INTO usuaris (nom_usuari, cognoms_usuari, username_usuari,
      password_usuari, email_usuari, telef_usuari, rol_usuari, observacions)
      VALUES ('$nom', '$cognoms', '$usuari', '$contrasenya', '$email', '$telef', '$rol', '$observacions')";

      $result=$connection->query($query_intro_usuari);
      if (!$result){
          die("Error en la consulta: ".$connection->error);
      }
      //ara recollim l'id de l'usuari acabat de crear
        $id_usuari=$connection->insert_id;
      $connection->close();
// si l'usuari s'ha creat de nou des de una nova ordre de treball...
if($_POST['alta_ot'] == 'True'){
  echo "alta ot";
echo "
  <form id='alta_ot' action='alta_ot.php' method='post' >
    <input type=hidden name='id_curs' value='".$_POST['id_curs']."'  />
    <input type=hidden name='data_entrada' value='".$_POST['data_entrada']."'  />
    <input type='hidden' name='id_usuari' value='".$id_usuari."' />
  </form>
  <script>
    document.getElementById('alta_ot').submit();
  </script>
  ";
}
//si l'usuari s'ha creat des d'una comunicació
elseif ($_POST['alta_comunicacio'] == 'remitent'){
echo "
  <form id='torna_a_remitent' action='../front/comunicacions.php' method='post'>
    <input type=hidden name=nova_comunicacio value='True' />
    <input type=hidden name=remitent value=".$id_usuari." />
  </form>
  <script>
    document.getElementById('torna_a_remitent').submit();
  </script>
";
}
elseif ($_POST['alta_comunicacio'] == 'destinatari'){
echo "
<form id='torna_a_destinatari' action='../front/comunicacions.php' method='post'>
  <input type=hidden name='remitent' value=".$_POST['remitent']." />
  <input type=hidden name='destinatari' value=".$id_usuari." />
  <input type=hidden name=nova_comunicacio value='True' />
</form>
<script>
  document.getElementById('torna_a_destinatari').submit();
</script>
";
}

else{
  header("location:../front/usuaris.php");
}

?>
