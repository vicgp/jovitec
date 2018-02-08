<?php
session_start();
include("../php/funcions.php");

if($_POST['data'] != NULL){

  $query_temps="UPDATE ordre_treball SET data_".$_POST['data_de']."='".$_POST['data']."' WHERE id_ot=".$_POST['id_ot']."";
  $resultat=consulta($query_temps);

  if ($_POST['prioritat'] == 'True'){
    echo "<form name=torna_a action=modificar_prioritat.php method=post>
          <input type=hidden name=id_prioritat value='1' />";
  }
  else{
    echo"
        <form name=torna_a action=../front/ot.php method=post>
  ";
  }

  echo"<input type=hidden name=id_ot value=".$_POST['id_ot']." />
      <script language=javascript>document.torna_a.submit();</script>
      </form>
  ";
}
?>
