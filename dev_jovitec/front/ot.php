<?php
session_start();
include("../php/funcions.php");
capsalera("modificar OT");
chat();

echo "
  <h1>Veure / Modificar Ordre de treball</h1>
";

  /*mostrar les ordres de treball obertes, en funció del rol, és a dir
  * en el cas d'un usuari es mostrarà la informació associada a la seva reparació
  * accions, data prevista de finalització.*/
  // fem la consulta a la base de dades per mostrar les ordres de treball (de moment totes)

  $query_ot_generic="SELECT id_ot, curs_escolar.curs, usuaris.cognoms_usuari, usuaris.nom_usuari, usuaris.email_usuari, data_entrada, prioritat, data_finalitzacio, data_lliurament FROM ordre_treball INNER JOIN curs_escolar ON ordre_treball.id_curs=curs_escolar.id_curs INNER JOIN usuaris ON usuaris.id_usuari=ordre_treball.id_usuari WHERE id_ot='".$_POST['id_ot']."'";
  //fem la consulta de les ordres de treball
  $resultat_ot_generic=consulta($query_ot_generic);
  // echo "ordres de treball:";
  while ($fila_ot_generic=$resultat_ot_generic->fetch_assoc()){
echo "
  <table id=taula> <!-- taula dades genèriques -->
    <tr>
      <th colspan=2>
        nº ordre:
      </th>
      <th>
        data entrada:
      </th>
      <th>
        usuari:
      </th>
      <th>
        prioritat
      </th>
      <th>
        <form method=POST action=modificar_ot.php>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          <input type=hidden name=taula value=supervisors />
          <input type=hidden name=rol_usuari value=2 />
          <button>supervisors:</button>
        </form>
      </th>
      <th>
        <form method=POST action=modificar_ot.php>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          <input type=hidden name=taula value=tecnics />
          <input type=hidden name=rol_usuari value=3 />
          <button>tècnics:</button>
        </form>
      </th>
      <th>
        <form method=POST action=modificar_ot.php>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          <input type=hidden name=taula value=administratius />
          <input type=hidden name=rol_usuari value=4 />
          <button>administratius:</button>
        </form>
      </th>
      <th>
        data de finalització:
      </th>
      <th>
        data de lliurament:
      </th>
    </tr>
    <tr>
      <td>
        ".$fila_ot_generic['id_ot']."
      </td>
      <td>
        ".$fila_ot_generic['curs']."
      </td>
      <td>
        ".$fila_ot_generic['data_entrada']."
      </td>
      <td>
        ".$fila_ot_generic['cognoms_usuari'].", ".$fila_ot_generic['nom_usuari']."<br />
        ".$fila_ot_generic['email_usuari']."
      </td>
      <td class=prioritat_".$fila_ot_generic['prioritat'].">
        <form id=f_prioritat method=post action=../back/modificar_prioritat.php>
";
          $query_prioritat="SELECT * FROM prioritat WHERE id_prioritat=".$fila_ot_generic['prioritat'];
          $resultat_prioritat=consulta($query_prioritat);
          $prioritat=$resultat_prioritat->fetch_assoc();
echo"
          <select name=id_prioritat onchange=document.getElementById('f_prioritat').submit(); >
            <option value=".$prioritat['id_prioritat'].">".$prioritat['prioritat']."</option>
";
            $query_prioritats="SELECT * FROM prioritat ORDER BY id_prioritat DESC ";
            $resultat_prioritats=consulta($query_prioritats);
            while ($prioritats=$resultat_prioritats->fetch_assoc()){
echo "
              <option value=".$prioritats['id_prioritat'].">
                ".$prioritats['prioritat']."
              </option>
";
            }
echo"
          </select>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
        </form>
      </td>
      <td>
";
          $query_ot_supervisors="SELECT username_usuari FROM usuaris INNER JOIN supervisors ON usuaris.id_usuari=supervisors.id_usuari WHERE supervisors.id_ot=".$fila_ot_generic['id_ot'];
          $resultat_ot_supervisors=consulta($query_ot_supervisors);
          while ($fila_ot_supervisors=$resultat_ot_supervisors->fetch_assoc()){
echo "

              ".$fila_ot_supervisors['username_usuari']."<br />

";
          }
echo "
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
        $resultat_ot_tecnics->close();
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
        $resultat_ot_administratius->close();
echo "

      </td>
      <td>
";
        if($fila_ot_generic['data_finalitzacio']){
          echo $fila_ot_generic['data_finalitzacio'];
        }
        else{
  echo "
          <form id='finalitzacio' method=post action=../back/afegir_data.php>
            <input type=hidden name=data_de value=finalitzacio />
            <input type=hidden name=id_ot value=".$_POST['id_ot']." />
            <input type=hidden name=prioritat value='True' /> <!-- per resetejar la prioritat de l'ordre de treball -->
            <input type=date name=data onchange=document.getElementById('finalitzacio').submit(); />
          </form>
";
        }
echo "
      </td>
      <td>
";
        if($fila_ot_generic['data_lliurament']){
          echo $fila_ot_generic['data_lliurament'];
        }
        else{
echo "
            <form id='lliurament' method=post action=../back/afegir_data.php>
              <input type=hidden name=data_de value=lliurament />
              <input type=hidden name=id_ot value=".$_POST['id_ot']." />
              <input type=date name=data onchange=document.getElementById('lliurament').submit();  />
      <!--        <button>afegir</button> -->
            </form>
";
        }
echo "
      </td>
    </tr>
  </table> <!-- fi de la taula general de la OT -->
";
  }
/////////////////fins aqui la capçalera de l'ordre de treball///////////////////

////////////////////////////////////////////////////////////////////////////////
////////////////////////////taula observacions//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$query_observacions="SELECT * FROM observacions_ot WHERE id_ot ='".$_POST['id_ot']."'";
$resultat_observacions=consulta($query_observacions);

echo "
  <table id=taula> <!-- taula observacions -->
    <tr>
      <th colspan='3'>
        Observacions
      </th>
";
    while ($fila_observacions=$resultat_observacions->fetch_assoc()){
echo "
        <tr>
         <td style='width:95%;'>
          ".$fila_observacions['item_observacions']."
        </td>
        <td>
          <form method=POST action=../back/eliminar_item.php>
            <button>eliminar</button>
            <input type=hidden name=eliminar value=item_observacions />
            <input type=hidden name=torna_a value=ot  />
            <input type=hidden name=item_observacions value='".$fila_observacions['id_observacions']."'  />
            <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          </form>
        </td>
      </tr>
";
      }
echo "
    <tr>
      <form method=POST action=../back/afegir_item.php >
        <td style='width:95%;' >
          <input style='width:99%;' type=text name=item_observacions required/>
        </td>
        <td>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          <input type=hidden name=torna_a value=ot />
          <input type=hidden name=afegir value=item_observacions />
          <button>afegir</button>
        </td>
      </form>
    </tr>
  </table>
";
////////////////////////fins aqui la taula observacions/////////////////////////
echo "
  <hr />
";
////////////////////////////////////////////////////////////////////////////////
////////////////////////////taula inventari client//////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$query_items="SELECT * FROM inventari_client WHERE id_ot ='".$_POST['id_ot']."'";
$resultat_items=consulta($query_items);

echo "
  <table id=taula> <!-- taula inventari -->
    <tr>
      <th colspan='3'>
        Inventari del client
      </th>
";
    while ($fila_item=$resultat_items->fetch_assoc()){
echo "
        <tr>
         <td style='width:95%;' >
          ".$fila_item['descripcio']."
        </td>
        <td>
          <form method=POST action=../back/eliminar_item.php>
            <button>eliminar</button>
            <input type=hidden name=eliminar value=item_client />
            <input type=hidden name=torna_a value=ot  />
            <input type=hidden name=item value='".$fila_item['id_inventari_client']."'  />
            <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          </form>
        </td>
      </tr>
";
      }
echo "
    <tr>
      <form method=POST action=../back/afegir_item.php >
        <td style='width:95%;'>
          <input style='width:99%;' type=text name=descripcio required />
        </td>
        <td>
";
          echo "<input type=hidden name=id_ot value=".$_POST['id_ot']." />";
          echo "<input type=hidden name=torna_a value=ot />";
          echo "<input type=hidden name=afegir value=item_client />";
echo "
          <button>afegir</button>
        </td>
      </form>
    </tr>
  </table>
";
///////////////////fins aqui la taula d'inventari de client//////////////////
echo "
  <hr />
";
////////////////////////////////////////////////////////////////////////////////
///////////////////////////////taula anomalies//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$query_anomalies="SELECT * FROM anomalies WHERE id_ot = '".$_POST['id_ot']."'";
$resultat_anomalies=consulta($query_anomalies);

echo "
  <table id=taula> <!-- taula anomalies -->
    <tr>
      <th colspan='3'>
        Anomalies
      </th>
    </tr>
";
    while ($fila_anomalia=$resultat_anomalies->fetch_assoc()){
echo "
        <tr>
         <td style='width:95%;' >
          ".$fila_anomalia['anomalia']."
          </td>
          <td>
            <form method=POST action=../back/eliminar_item.php>
              <button>eliminar</button>
              <input type=hidden name=eliminar value=anomalia />
              <input type=hidden name=torna_a value=ot  />
              <input type=hidden name=anomalia value='".$fila_anomalia['id_anomalia']."'  />
              <input type=hidden name=id_ot value=".$_POST['id_ot']." />
            </form>
          </td>
        </tr>
";
    }
echo "
    <tr>
      <form method=POST action=../back/afegir_item.php >
        <td style='width:95%;'>
          <input style='width:99%;' type=text name=anomalia required/>
        </td>
        <td>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          <input type=hidden name=torna_a value=ot />
          <input type=hidden name=afegir value=anomalia />
          <button>afegir</button>
        </td>
      </form>
    </tr>
  </table>
";
  ///////////////////fins aqui la taula anomalies//////////////////
echo "
  <hr />
";
////////////////////////////////////////////////////////////////////////////////
///////////////////////////////taula actuacions/////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$query_actuacions="SELECT * FROM actuacions WHERE id_ot='".$_POST['id_ot']."'";
$resultat_actuacions=consulta($query_actuacions);

echo "
  <table id=taula> <!-- taula actuacions -->
    <tr>
      <th colspan='3'>
        Actuacions realitzades:
      </th>
    </tr>
";
      while ($fila_actuacions=$resultat_actuacions->fetch_assoc()){
echo "
      <tr>
        <td style='width:80%' >
          ".$fila_actuacions['actuacio']."
        </td>
        <td>
          ".conversor_segons_a_hores_minuts($fila_actuacions['segons'])."
        </td>
        <td>
          <form method=POST action=../back/eliminar_item.php>
            <button>eliminar</button>
            <input type=hidden name=eliminar value=actuacio />
            <input type=hidden name=torna_a value=ot  />
            <input type=hidden name=actuacio value='".$fila_actuacions['id_actuacio']."' />
            <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          </form>
        </td>
      </tr>
";
    }
echo "
    <tr>
      <form method=POST action=../back/afegir_item.php >
        <td style='width:80%;'>
          <input style='width:99%;' type=text name=actuacio required/>
        </td>
        <td>
          <input class='temps' type=text name=hores pattern='[0-9]{1,2}' title='1 o 2 dígits' required/>h:
          <input class='temps' type=text name=minuts pattern='[0-9]{1,2}' title='1 o 2 dígits' required/>m
";
echo "
        </td>
        <td>
          <input type=hidden name=id_ot value=".$_POST['id_ot']." />
          <input type=hidden name=torna_a value=ot />
          <input type=hidden name=afegir value=actuacio />
          <button>afegir</button>
        </td>
      </form>
    </tr>
    <tr>
      <th>
        <span class='dreta'>temps total:</span>
      </th>
      <td colspan=2 >
";
    $query_temps_total=" SELECT SUM(segons) FROM actuacions WHERE id_ot='".$_POST['id_ot']."'";
    $resultat_temps=consulta($query_temps_total);
    $temps_total=$resultat_temps->fetch_assoc();
echo "
        <span style='position:relative;left:35%;'>".conversor_segons_a_hores_minuts($temps_total['SUM(segons)'])."</span>
      </td>
    </tr>
  </table>";


 $query_ot_tecnics="SELECT username_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$_POST['id_ot'];
  $resultat_ot_tecnics=consulta($query_ot_tecnics);
  // echo "ordres de treball:";
  while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){


echo "
<form action=avaluacio.php method='POST'>
  <input type='hidden' name='nom' value='".$fila_ot_tecnics['username_usuari']."'/>
  <input type='hidden' name='ot' value='".$_POST['id_ot']."' />
  <button class=avaluacio class=esquerra type='submit'>Avaluar ".$fila_ot_tecnics['username_usuari']."</button>
</form>";

}
////////////////////////////fins aqui taula actuacions//////////////////////////

peu("");
