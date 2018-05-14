<?php
session_start();
include("../php/funcions.php");
$query_ot_generic="";

if($_SESSION['rol']<=2){
  $query_ot_generic="SELECT ordre_treball.AvaluadaAdministratiu,ordre_treball.AvaluadaTecnic, ordre_treball.id_estat,ordre_treball.id_ot, curs_escolar.curs, usuaris.cognoms_usuari, usuaris.nom_usuari, usuaris.email_usuari, data_entrada, prioritat, data_finalitzacio, data_lliurament
  FROM ordre_treball INNER JOIN curs_escolar ON ordre_treball.id_curs=curs_escolar.id_curs
  INNER JOIN usuaris ON usuaris.id_usuari=ordre_treball.id_usuari
  ORDER BY id_ot DESC";
}
else if($_SESSION['rol']==3 ){
  $query_ot_generic="SELECT ordre_treball.AvaluadaAdministratiu,ordre_treball.AvaluadaTecnic, ordre_treball.id_estat,ordre_treball.id_ot, curs_escolar.curs, usuaris.cognoms_usuari, usuaris.nom_usuari, usuaris.email_usuari, data_entrada, prioritat, data_finalitzacio, data_lliurament
   FROM ordre_treball INNER JOIN curs_escolar ON ordre_treball.id_curs=curs_escolar.id_curs
   INNER JOIN usuaris ON usuaris.id_usuari=ordre_treball.id_usuari INNER JOIN tecnics ON tecnics.id_ot=ordre_treball.id_ot
   WHERE tecnics.id_usuari=".$_SESSION['id_user']." ORDER BY id_ot DESC";
}
else if($_SESSION['rol']==4 ){
    $query_ot_generic="SELECT ordre_treball.AvaluadaAdministratiu,ordre_treball.AvaluadaTecnic,  ordre_treball.id_estat,ordre_treball.id_ot, curs_escolar.curs, usuaris.cognoms_usuari, usuaris.nom_usuari, usuaris.email_usuari, data_entrada, prioritat, data_finalitzacio, data_lliurament
    FROM ordre_treball INNER JOIN curs_escolar ON ordre_treball.id_curs=curs_escolar.id_curs
    INNER JOIN usuaris ON usuaris.id_usuari=ordre_treball.id_usuari INNER JOIN administratius ON administratius.id_ot=ordre_treball.id_ot
    WHERE administratius.id_usuari=".$_SESSION['id_user']." ORDER BY id_ot DESC";

}

$resultat_ot_generic=consulta($query_ot_generic);
  while ($fila_ot_generic=$resultat_ot_generic->fetch_assoc()){
echo "
  <tr ondblclick=document.getElementById('modificar_ot".$fila_ot_generic['id_ot']."').submit(); title='doble click per veure/modificar'>
    <form id='modificar_ot".$fila_ot_generic['id_ot']."' method='POST' action='ot.php'>
      <input type='hidden' name='id_ot' value='".$fila_ot_generic['id_ot']."' />
    </form>
    <td align='right'>
      ".$fila_ot_generic['id_ot']."
    </td>
    <td>
      ".$fila_ot_generic['curs']."
    </td>
    <td align='center'>
      ".$fila_ot_generic['data_entrada']."
    </td>
    <td>
      ".$fila_ot_generic['cognoms_usuari'].", ".$fila_ot_generic['nom_usuari']."
    </td>
    <td class=prioritat_".$fila_ot_generic['prioritat'].">
";
    $query_prioritat="SELECT * FROM prioritat WHERE id_prioritat=".$fila_ot_generic['prioritat'];
    $resultat_prioritat=consulta($query_prioritat);
    $prioritat=$resultat_prioritat->fetch_assoc();
echo"
      ".$prioritat['prioritat']."
    </td>
    <td>

";
        $query_ot_tecnics="SELECT username_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$fila_ot_generic['id_ot'];
        $resultat_ot_tecnics=consulta($query_ot_tecnics);
        while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){
echo "

            ".$fila_ot_tecnics['username_usuari']."<br />

";
        }
echo "

    </td>
    <td>
";
        $query_ot_administratius="SELECT username_usuari FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE administratius.id_ot=".$fila_ot_generic['id_ot'];
        $resultat_ot_administratius=consulta($query_ot_administratius);
        while ($fila_ot_administratius=$resultat_ot_administratius->fetch_assoc()){
echo "
            ".$fila_ot_administratius['username_usuari']."<br />

";
        }
echo "
    </td>
    <td>
      ".$fila_ot_generic['data_finalitzacio']."
    </td>
    <td>
      ".$fila_ot_generic['data_lliurament']."
    </td>
    <td onclick=$('#editarComanda".$fila_ot_generic['id_ot']."').submit(); title='click per veure lestat de lordre'>
        <form id='editarComanda".$fila_ot_generic['id_ot']."' method='POST' action='comandes.php'>
          <input type='hidden' name='id_ot' value='".$fila_ot_generic['id_ot']."' />
          <i class='material-icons' style='font-size: 2em;color:";if($fila_ot_generic['id_estat']==1){
                                                                      echo "red;";
                                                                  }
                                                                  else if($fila_ot_generic['id_estat']==2 || $fila_ot_generic['id_estat']==3){
                                                                    echo "orange;";
                                                                  }
                                                                  else{
                                                                    echo "green;";
                                                                  }
             echo "'>linear_scale</i>
        </form>
    </td>";
    if($_SESSION['rol']==2){


      echo "<td onclick=$('#avaluarTecnic".$fila_ot_generic['id_ot']."').submit(); title='click per avaluar el tecnic de lordre'>
          <form id='avaluarTecnic".$fila_ot_generic['id_ot']."' method='POST' action='../back/calcularNombreTecnics.php'>
            <input type='hidden' name='id_ot' value='".$fila_ot_generic['id_ot']."' />
            <input type='hidden' name='QuiAvaluem' value='1' />";

          echo "
            <i class='material-icons' style='font-size: 2em;color:";if($fila_ot_generic['AvaluadaTecnic']==1){
                                                                        echo "green;";
                                                                    }

                                                                    else{
                                                                      echo "red;";
                                                                    }
            echo "'>spellcheck</i>
          </form>
      </td>";
      echo "<td onclick=$('#avaluarAdministratiu".$fila_ot_generic['id_ot']."').submit(); title='click per avaluar el administratius de lordre'>
          <form id='avaluarAdministratiu".$fila_ot_generic['id_ot']."' method='POST' action='../back/calcularNombreTecnics.php'>
            <input type='hidden' name='id_ot' value='".$fila_ot_generic['id_ot']."' />
            <input type='hidden' name='QuiAvaluem' value='2' />";
          echo "
            <i class='material-icons' style='font-size: 2em;color:";if($fila_ot_generic['AvaluadaAdministratiu']==1){
                                                                        echo "green;";
                                                                    }

                                                                    else{
                                                                      echo "red;";
                                                                    }
            echo "'>spellcheck</i>
          </form>
      </td>
  </tr> <!-- fi de la línia de dades de la OT -->

";
  }
}

?>
