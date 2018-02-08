<?php
session_start();
include("../php/funcions.php");

  $query_prioritat="UPDATE ordre_treball SET prioritat='".$_POST['id_prioritat']."' WHERE id_ot=".$_POST['id_ot']."";
  $resultat=consulta($query_prioritat);
  
echo "
      <form name=torna_a action=../front/ot.php method=post>
        <input type=hidden name=id_ot value=".$_POST['id_ot']." />
      <script language=javascript>document.torna_a.submit();</script>
    </form>
";
?>
