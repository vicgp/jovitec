<?php
session_start();
include("../php/funcions.php");
capsalera("comunicacions");
chat();

/**
*   @brief Pàgina per documentar les comunicacions
*   s'anoten totes les comunicacions que es generen en el funcionament
*   de jovitec, relacionat-les amb les ordres de treball si s'escau
*   es mostren totes les comunicacions i es poden ordenar per columnes
*   @param string.columna per ordenar
*   @param string.odre per l'ordenació de la columna
*   @param bool.nova_comunicacio per mostrar els camps per generar una nova comunicació:
*     True per mostrar els camps d'entrada per una nova comunicació
*     False per mostrar el botó per crear una nova notificació
*   crida a la pròpia pàgina per ordenar columnes
*   @return string.columna
*   @return string.ordre
*   crida a la pròpia pàgina per crear una nova comunicació
*   @return string.nova_comunicacio=True
*   @author xavier morera
*   @date desembre 2017
*/

  $columna='data_comunicacio';
  $ordre='DESC';
  if ($_POST['columna']){
    $columna=$_POST['columna'];
    $ordre=$_POST['ordre'];
  }
  if (!$_POST['nova_comunicacio']){
    $nova_comunicacio='False';
  }
  else{
    $nova_comunicacio=$_POST['nova_comunicacio'];
  }

  $query_com_generic="SELECT
  id_comunicacio,
  curs_escolar.curs,
  id_ot,
  data_comunicacio,
  remitent.cognoms_usuari as cognoms_remitent,
  remitent.nom_usuari as nom_remitent,
  destinatari.cognoms_usuari as cognoms_destinatari,
  destinatari.nom_usuari as nom_destinatari,
  comunicacions_via.via,
  resum
  FROM comunicacions
  INNER JOIN
  usuaris as remitent on remitent.id_usuari=comunicacions.id_remitent
  INNER JOIN
  usuaris as destinatari on destinatari.id_usuari=comunicacions.id_destinatari
  INNER JOIN
  curs_escolar on curs_escolar.id_curs=comunicacions.id_curs
  INNER JOIN
  comunicacions_via on comunicacions_via.id_via=comunicacions.id_via
  ORDER BY $columna $ordre";
  //fem la consulta de les ordres de treball
  $resultat_com_generic=consulta($query_com_generic);

  echo "
  <h1>Comunicacions:</h1>
  ";
//comprovem si s'ha de fer una nova comunicació
  if($_POST['nova_comunicacio'] == 'True'){

////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////creació nova comunicació///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

// si no hi ha un remitent seleccionat
    if (!$_POST['remitent']){
      $query_remitent="SELECT id_usuari, cognoms_usuari, nom_usuari FROM usuaris ORDER BY cognoms_usuari ASC";
      $resultat_remitent=consulta($query_remitent);
      //fem un formulari per enviar elremitent o crear-ne un de nou
      echo "
      <form id=remitent action=comunicacions.php method=post>
        <input type=hidden name=nova_comunicacio value=True />
        <table id=taula>
          <tr>
            <th>
              remitent:
            </th>
          </tr>
          <tr>
            <td>
              <select name=remitent required onchange=document.getElementById('remitent').submit(); style=width:100%;>
                <option value=''>remitent...</option>
                  ";
                  while ($fila_remitent=$resultat_remitent->fetch_assoc()){
                    echo "
                    <option value=".$fila_remitent['id_usuari'].">".$fila_remitent['cognoms_usuari'].", ".$fila_remitent['nom_usuari']."</option>
                    ";
                  }
                echo "
                <option value='nou_remitent'>nou usuari</option>
              </select>
            </td>
          </tr>
        </table>
      </form>
      ";
    }
    else{ //si que tenim remitent o l'opció de crear-lo
      //hem de crear un nou usuari?
      if ($_POST['remitent'] == 'nou_remitent'){
      echo "
        <form id=nou_usuari_remitent method=POST action=nou_usuari.php>
          <input type=hidden name=alta_comunicacio value=".$_POST['remitent']." />
          <input type=hidden name=nova_comunicacio value='True' />
          <input type=hdden name=altauser value='True' />
        </form>
        <script >document.getElementById('nou_usuari_remitent').submit();</script>
        ";
      }
    //tenim un usuari remitent seleccionat, el mostrem i demanem el destinatari
    echo "
    <table id=taula>
      <tr>
        <th>
          remitent:
        </th>
        <th>
          destinatari:
        </th>
        ";
        if($_POST['destinatari']){
        echo "
        <th>
          data:
        </th>
        <th>
          OT:
        </th>
        <th>
          via:
        </th>
        <th>
          resum:
        </th>
        ";
        }
        echo "
      </tr>
      <tr>
        <th>
          ";
          $query_remitent_seleccionat="SELECT cognoms_usuari, nom_usuari FROM usuaris WHERE id_usuari =".$_POST['remitent'];
          $remitent_seleccionat=consulta($query_remitent_seleccionat)->fetch_assoc();
          echo "
          ".$remitent_seleccionat['cognoms_usuari'].", ".$remitent_seleccionat['nom_usuari']."
        </th>
        ";
        if (!$_POST['destinatari']){
          echo "
          <td>
            <form id=destinatari action=comunicacions.php method=POST>
              <input type=hidden name=nova_comunicacio value=True />
              ";
              $query_destinatari="SELECT id_usuari, cognoms_usuari, nom_usuari FROM usuaris WHERE id_usuari !=".$_POST['remitent']." ORDER BY cognoms_usuari";
              $resultat_destinatari=consulta($query_destinatari);
              echo "
              <select name=destinatari required onchange=document.getElementById('destinatari').submit(); style=width:100%;>
                <option value=''>destinatari...</option>
                ";
                while ($fila_destinatari=$resultat_destinatari->fetch_assoc()){
                  echo "
                  <option value=".$fila_destinatari['id_usuari'].">".$fila_destinatari['cognoms_usuari'].", ".$fila_destinatari['nom_usuari']."</option>
                  ";
                }
                echo "
                <option value='nou_destinatari'>nou usuari</option>
              </select>
              <input type=hidden name=remitent value=".$_POST['remitent']." />
            </form>
          </td>
          ";
        }
        //un cop seleccionat el destinatari mirem si hem de crear un usuari nou
        else {
          if($_POST['destinatari'] == 'nou_destinatari'){
            echo "
            <form id=nou_usuari_destinatari method=POST action=nou_usuari.php>
              <input type=hidden name=remitent value=".$_POST['remitent']." />
              <input type=hidden name=alta_comunicacio value=".$_POST['destinatari']." />
              <input type=hidden name=nova_comunicacio value='True' />
              <input type=hdden name=altauser value='True' />
            </form>
            <script >document.getElementById('nou_usuari_destinatari').submit();</script>
            ";
          }
          //tenim destinatari, per tant l'afegim i acabem de muntar el formulari i la taula
          $query_destinatari_seleccionat="SELECT cognoms_usuari, nom_usuari FROM usuaris WHERE id_usuari = ".$_POST['destinatari'];
          $resultat_destinatari_seleccionat=consulta($query_destinatari_seleccionat)->fetch_assoc();
          echo "
          <th>
            ".$resultat_destinatari_seleccionat['cognoms_usuari'].", ".$resultat_destinatari_seleccionat['nom_usuari']."
          </th>
          ";
          //iniciem el formulari per crear una nova comunicació
          echo "
          <form id=alta_comunicacio method=POST action=../back/alta_comunicacio.php>
            <th>
              <input id=data_comunicacio type=date name=data_comunicacio required />
            </th>
            <th>
            ";
            //seleccionar ot relacionades amb el remitent o destinatari si ni ha
            $query_ot_comunicacions="SELECT id_ot FROM ordre_treball WHERE id_usuari = ".$_POST['remitent']." OR id_usuari =".$_POST['destinatari']." ORDER BY id_ot DESC";
            $resultat_ot_comunicacions=consulta($query_ot_comunicacions);
            if(mysqli_num_rows($resultat_ot_comunicacions) == 0){
              echo "---";
            }
            else{
              echo "<select name=id_ot required>";
              while($ot_comunicacions=$resultat_ot_comunicacions->fetch_assoc()){
                echo "
                <option value=".$ot_comunicacions['id_ot'].">".$ot_comunicacions['id_ot']."</option>
                ";
              }
              echo "</select>";
            }
              echo "
            </th>
            <th>
            ";
            //selecció de les vies de comunicació
            echo "
              <select name=id_via required>
              ";
              $resultat_vies=consulta("SELECT * FROM comunicacions_via");
              while ($vies_de_comunicacio=$resultat_vies->fetch_assoc()){
              echo "
                <option value=".$vies_de_comunicacio['id_via'].">".$vies_de_comunicacio['via']."</option>
                ";
              }
              echo "
              </select>
            </th>
            <th>
              <input id=resum_comunicacio type=text required name=resum style=width:95%; />
            </th>
            <input type=hidden name=id_remitent value=".$_POST['remitent']." />
            <input type=hidden name=id_destinatari value=".$_POST['destinatari']." />
          </form>
          ";
        }
        //tanquem la taula
        echo "
        </tr>
      </table> ";
      if ($_POST['destinatari']){
        echo "
        <button onclick='comunicacio_nova()' id=boto_enviar_comunicacio class=esquerra style=width:85%; >Acceptar</button>
        ";
      }
    }

  /////////////////////////////// botó cancel·lar ////////////////////////////////
  echo "
        <form method=POST action=comunicacions.php>
          <input type=hidden name=nova_comunicacio value='False' />
          <button class=cancel class=esquerra style='width:15%;'>Cancel·lar</button>
        </form>
  ";

/////////////////////////////fi de la nova comunicacio//////////////////////////////

  }
/// si no s'ha de crear una nova comunicació, mostrar botó !
  else {
  echo"
  <form method=POST action=comunicacions.php>
    <input type=hidden name=nova_comunicacio value='True' />
    <button style= width:100%;>Nova Comunicació</button>
  </form>
  ";
  }

////////////////////////////////////////////////////////////////////////////////
////////////////////////////mostrar comunicacions///////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo"
  <table id=taula2>
    <tr>
      <th colspan=2>
          id comunicació
            <span class='fletxes' title='ordena AZ' onclick=document.getElementById('ordre_up').submit();>&uarr;</span>
            <span class='fletxes' title='ordena ZA' onclick=document.getElementById('ordre_down').submit();>&darr;</span>
          <form id='ordre_up' method=POST action=comunicacions.php>
           <input type=hidden name=columna value=id_comunicacio />
            <input type=hidden name=ordre value=ASC />
          </form>
          <form id='ordre_down' method=POST action=comunicacions.php>
            <input type=hidden name=columna value=id_comunicacio />
            <input type=hidden name=ordre value=DESC />
          </form>
      </th>
      <th>
        OT
          <span class='fletxes' title='ordena AZ' onclick=document.getElementById('fi_up').submit();>&uarr;</span>
          <span class='fletxes' title='ordena ZA' onclick=document.getElementById('fi_down').submit();>&darr;</span>
        <form id='fi_up' method=POST action=comunicacions.php>
          <input type=hidden name=columna value=id_ot />
          <input type=hidden name=ordre value=ASC />
        </form>
        <form id='fi_down' method=POST action=comunicacions.php>
          <input type=hidden name=columna value=id_ot />
          <input type=hidden name=ordre value=DESC />
        </form>
      </th>
      <th>
        data
          <span class='fletxes' title='ordena AZ' onclick=document.getElementById('entrada_up').submit();>&uarr;</span>
          <span class='fletxes' title='ordena ZA' onclick=document.getElementById('entrada_down').submit();>&darr;</span>
        <form id='entrada_up' method=POST action=comunicacions.php>
          <input type=hidden name=columna value=data_comunicacio />
          <input type=hidden name=ordre value=ASC />
        </form>
        <form id='entrada_down' method=POST action=comunicacions.php>
          <input type=hidden name=columna value=data_comunicacio />
          <input type=hidden name=ordre value=DESC />
        </form>
      </th>
      <th>
        remitent
          <span class='fletxes' title='ordena AZ' onclick=document.getElementById('remitent_up').submit();>&uarr;</span>
          <span class='fletxes' title='ordena ZA' onclick=document.getElementById('remitent_down').submit();>&darr;</span>
        <form id='remitent_up' method=POST action=comunicacions.php>
          <input type=hidden name=columna value=cognoms_remitent />
          <input type=hidden name=ordre value=ASC />
        </form>
        <form id='remitent_down' method=POST action=comunicacions.php>
          <input type=hidden name=columna value=cognoms_remitent />
          <input type=hidden name=ordre value=DESC />
        </form>
      </th>
      <th>
        destinatari
        <span class='fletxes' title='ordena AZ' onclick=document.getElementById('destinatari_up').submit();>&uarr;</span>
        <span class='fletxes' title='ordena ZA' onclick=document.getElementById('destinatari_down').submit();>&darr;</span>
      <form id='destinatari_up' method=POST action=comunicacions.php>
        <input type=hidden name=columna value=cognoms_destinatari />
        <input type=hidden name=ordre value=ASC />
      </form>
      <form id='destinatari_down' method=POST action=comunicacions.php>
        <input type=hidden name=columna value=cognoms_destinatari />
        <input type=hidden name=ordre value=DESC />
      </form>
      </th>
      <th>
        via
      </th>
      <th>
        resum
      </th>
    </tr>
";
    while ($fila_com_generic=$resultat_com_generic->fetch_assoc()){
echo "
    <tr>
      <td align='right'>
        ".$fila_com_generic['id_comunicacio']."
      </td>
      <td>
        ".$fila_com_generic['curs']."
      </td>
      <td align='center'>
        ".$fila_com_generic['id_ot']."
      </td>
      <td align='center'>
        ".$fila_com_generic['data_comunicacio']."
      </td>
      <td>
        ".$fila_com_generic['cognoms_remitent'].", ".$fila_com_generic['nom_remitent']."
      </td>
      <td>
          ".$fila_com_generic['cognoms_destinatari'].", ".$fila_com_generic['nom_destinatari']."
      </td>
      <td>
        ".$fila_com_generic['via']."
      </td>
      <td>
        ".$fila_com_generic['resum']."
      </td>
    </tr>
";
    }
echo "
  </table>
";

peu("");
