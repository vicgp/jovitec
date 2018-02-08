<?php
session_start();
include("../php/funcions.php");

if($_POST['id_ot']){
  $id_ot=$_POST['id_ot'];
}
else{
  $id_ot="0";
}

require_once '../php/config.php';
$connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
$connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
if (!$connection) {
    die("Error de connexió: " . mysqli_connect_error());
}
$resum=mysqli_real_escape_string($connection, $_POST['resum']);

$query_comunicacio_nova=
"INSERT INTO comunicacions (id_comunicacio,	id_curs, id_ot, id_remitent, id_destinatari,	data_comunicacio,	id_via, resum )
VALUES (NULL, ".$_SESSION['curs_actual'].", $id_ot, ".$_POST['id_remitent'].", ".$_POST['id_destinatari'].", '".$_POST['data_comunicacio']."', ".$_POST['id_via'].", '".$resum."' )";

$inserir_comunicacio=consulta($query_comunicacio_nova);

echo "
<form id=torna_a action=../front/comunicacions.php method=post>
  <input type=hidden name=nova_comunicacio value='False' />
</form>
<script>document.getElementById('torna_a').submit();</script>
";

?>
