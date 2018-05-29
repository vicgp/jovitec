<html>
  <head>
    <script src='../js/sidebar.js'></script>

<?php
session_start();
include("../php/funcions.php");
$_SESSION['url']=1;
capsalera("jovitec");
chat();


  /*mostrar les ordres de treball obertes, en funció del rol, és a dir
  * en el cas d'un usuari es mostrarà la informació associada a la seva reparació
  * accions, data prevista de finalització.*/
  // fem la consulta a la base de dades per mostrar les ordres de treball ordenades segons les variables POST donades si n'hi ha
  // $columna='id_ot';
  // $ordre='DESC';
  // if ($_POST['columna']){
  //   $columna=$_POST['columna'];
  //   $ordre=$_POST['ordre'];
  // }
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

  //fem la consulta de les ordres de treball
  $resultat_ot_generic=consulta($query_ot_generic);

  echo '<div class="w3-sidebar w3-bar-block w3-border-right" style="display: none; position:absolute; z-index:9999; width: 25%; background-color: rgba(50, 54, 60, 0.83); color:black; margin-top:-3.5%;" id="mySidebar">
  <button onclick="w3_close('.$_SESSION['url'].')" class="w3-bar-item w3-large" style="background-color:#f30808d4;">Close &times;</button>
            <!--drop tecnics -->
            <label id="checks"> Tots els Tecnics </label>
            <input type="checkbox" id="tecnicCheck" name="all" value="0" onclick="TecnicsOnCheck()">
            <select id="tecnicsDisCheck" class="form-control" onchange="carregarTecnics()">
              <option value="">Tria Tecnic</option>';
                $query_ot_tecnics="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=3";
                $resultat_ot_tecnics=consulta($query_ot_tecnics);
                while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){

                  echo "<option value=".$fila_ot_tecnics['id_usuari'].">".$fila_ot_tecnics['username_usuari']."</option>";
                }

            echo '
              </select>
              <select id="tecnicsCheck" class="form-control" style="display:none; onchange="carregarTecnics()">
                <option value="">Tria Tecnic</option>';

                  $query_ot_tecnics="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris";
                  $resultat_ot_tecnics=consulta($query_ot_tecnics);
                  while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){

                    echo "<option value=".$fila_ot_tecnics['id_usuari'].">".$fila_ot_tecnics['username_usuari']."</option>";
                  }

              echo '
              </select>
              <!--drop administratius -->
              <label id="checks"> Tots els Administratius </label>
              <input type="checkbox"  id="adminCheck" name="some" value="1" onclick="AdminisOnCheck()">
              <select id="adminisDisCheck" class="form-control" onchange="carregarAdminis()">
                <option value="">Tria Administratius</option>';
                  $query_ot_Adminis="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=4";
                  $resultat_ot_adminis=consulta($query_ot_Adminis);
                  while ($fila_ot_adminis=$resultat_ot_adminis->fetch_assoc()){

                    echo "<option value=".$fila_ot_adminis['id_usuari'].">".$fila_ot_adminis['username_usuari']."</option>";
                  }

            echo '
            </select>
            <select id="adminisCheck" class="form-control" style="display:none;" onchange="carregarAdminis()">
              <option value="">Tria Administratius</option>';
                $query_ot_Adminis="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris";
                $resultat_ot_adminis=consulta($query_ot_Adminis);
                while ($fila_ot_adminis=$resultat_ot_adminis->fetch_assoc()){

                  echo "<option value=".$fila_ot_adminis['id_usuari'].">".$fila_ot_adminis['username_usuari']."</option>";
                }


              echo '
              </select>
              <!--drop prioritat -->
              <label id="checks">Prioritat</label>
              <select id="prioritatFiltre" class="form-control" onchange="carregarPrioritat()">
                <option value="">Tria Prioritat</option>';

                  $query_prioritats="SELECT * FROM prioritat";
                  $resultat_prioritats=consulta($query_prioritats);
                  while ($prioritats=$resultat_prioritats->fetch_assoc()){
                      echo "
                          <option value=".$prioritats['id_prioritat'].">".$prioritats['prioritat']."</option>
                      ";
                  }


                echo "
                </select>
          </div>

          <div id='ordres' style='margin-left: 4%; padding-right: 4%;'>
          <h1 style='text-align: center;'>Ordres de Treball</h1>

          <button id='ot'  onclick='ot_alta()' style= width:100%; >Nova OT</button>
          <div id='newOT'>
          </div>
          <div class='w3-modal' id='modificarOtTot'>
            <div class='w3-modal-content animate'>
                <div class='w3-container' id='modificarOt'>
                </div>
            </div>
          </div>
          <!-- taula amb els botons d'ordenar les ordres de treball -->
          <div id='otTotal'>
          <form method=POST action=nova_ot.php id='formulario'>
          <table id='taula' class='table-fill'>
          <thead>
            <tr>
              <th colspan='2' >
                  nº ordre
                    <span class='fletxes' title='ordena AZ' onclick=document.getElementById('ordre_up').submit();>&uarr;</span>
                    <span class='fletxes' title='ordena ZA' onclick=document.getElementById('ordre_down').submit();>&darr;</span>
                  <form id='ordre_up' method=POST action=main.php>
                   <input type=hidden name=columna value=id_ot />
                    <input type=hidden name=ordre value=ASC />
                  </form>
                  <form id='ordre_down' method=POST action=main.php>
                    <input type=hidden name=columna value=id_ot />
                    <input type=hidden name=ordre value=DESC />
                  </form>
              </th>
              <th>
                data entrada
                  <span class='fletxes' title='ordena AZ' onclick=document.getElementById('entrada_up').submit();>&uarr;</span>
                  <span class='fletxes' title='ordena ZA' onclick=document.getElementById('entrada_down').submit();>&darr;</span>
                <form id='entrada_up' method=POST action=main.php>
                  <input type=hidden name=columna value=data_entrada />
                  <input type=hidden name=ordre value=ASC />
                </form>
                <form id='entrada_down' method=POST action=main.php>
                  <input type=hidden name=columna value=data_entrada />
                  <input type=hidden name=ordre value=DESC />
                </form>
              </th>
              <th class='text-left'>
                usuari
                  <span class='fletxes' title='ordena AZ' onclick=document.getElementById('usuari_up').submit();>&uarr;</span>
                  <span class='fletxes' title='ordena ZA' onclick=document.getElementById('usuari_down').submit();>&darr;</span>
                <form id='usuari_up' method=POST action=main.php>
                  <input type=hidden name=columna value=cognoms_usuari />
                  <input type=hidden name=ordre value=ASC />
                </form>
                <form id='usuari_down' method=POST action=main.php>
                  <input type=hidden name=columna value=cognoms_usuari />
                  <input type=hidden name=ordre value=DESC />
                </form>
              </th>
              <th>
                prioritat
                <span class='fletxes' title='ordena AZ' onclick=document.getElementById('prioritat_up').submit();>&uarr;</span>
                <span class='fletxes' title='ordena ZA' onclick=document.getElementById('prioritat_down').submit();>&darr;</span>
                <form id='prioritat_up' method=POST action=main.php>
                  <input type=hidden name=columna value=prioritat />
                  <input type=hidden name=ordre value=DESC />
                </form>
                <form id='prioritat_down' method=POST action=main.php>
                  <input type=hidden name=columna value=prioritat />
                  <input type=hidden name=ordre value=ASC />
                </form>
              </th>
              <th>
                tècnics
              </th>
              <th>
                administratius
              </th>
              <th>
                data finalització
                  <span class='fletxes' title='ordena AZ' onclick=document.getElementById('fi_up').submit();>&uarr;</span>
                  <span class='fletxes' title='ordena ZA' onclick=document.getElementById('fi_down').submit();>&darr;</span>
                <form id='fi_up' method=POST action=main.php>
                  <input type=hidden name=columna value=data_finalitzacio />
                  <input type=hidden name=ordre value=ASC />
                </form>
                <form id='fi_down' method=POST action=main.php>
                  <input type=hidden name=columna value=data_finalitzacio />
                  <input type=hidden name=ordre value=DESC />
                </form>
              </th>
              <th>
                data lliurament
                  <span class='fletxes' title='ordena AZ' onclick=document.getElementById('lliurament_up').submit();>&uarr;</span>
                  <span class='fletxes' title='ordena ZA' onclick=document.getElementById('lliurament_down').submit();>&darr;</span>
                <form id='lliurament_up' method=POST action=main.php>
                  <input type=hidden name=columna value=data_lliurament />
                  <input type=hidden name=ordre value=ASC />
                </form>
                <form id='lliurament_down' method=POST action=main.php>
                  <input type=hidden name=columna value=data_lliurament />
                  <input type=hidden name=ordre value=DESC />
                </form>
              </th>
              <th>
                Editar Ordre
              </th>";
              if($_SESSION['rol']!=4 || $_SESSION['rol']==1){
                echo "<th>Estat Ordre</th>";
              }


              if($_SESSION['rol']==2 || $_SESSION['rol']==3 || $_SESSION['rol']==1){
                echo "<th>Eliminar Ordre</th>";
              }
              if($_SESSION['rol']==4 || $_SESSION['rol']==1){
                echo "<th>Factura</th>";

              }
              if($_SESSION['rol']==2 || $_SESSION['rol']==1){
                echo "<th>Avaluar Tecnic</th>";
                echo "<th>Avaluar Administratius</th>";
              }
              echo "
            </tr> <!-- fi de la primera fila de títols i botons -->
            </thead>
            <tbody id='tbody'>
        ";
            while ($fila_ot_generic=$resultat_ot_generic->fetch_assoc()){
        echo "
            <tr title='doble click per veure/modificar'>

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
              <td class='ordre'>
                  <input type='hidden' id='id_ot' value='".$fila_ot_generic['id_ot']."' />
                  <i class='material-icons'>edit</i>
              </td>";

              if($_SESSION['rol']!=4 || $_SESSION['rol']==1){
              echo "<td onclick=$('#editarComanda".$fila_ot_generic['id_ot']."').submit(); title='click per veure lestat de lordre'>
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
            }
            if($_SESSION['rol']==2 || $_SESSION['rol']==3 || $_SESSION['rol']==1){


              echo "<td class='delete'  title='click per avaluar el tecnic de lordre'>
                    <input type='hidden' class='id_ot' value='".$fila_ot_generic['id_ot']."' />
                    <i class='material-icons' style='font-size: 2em;color:black'>delete</i>
              </td>";
            }
              if($_SESSION['rol']==4 || $_SESSION['rol']==1){


                echo "<td onclick=$('#factura".$fila_ot_generic['id_ot']."').submit(); title='click per avaluar el tecnic de lordre'>
                    <form id='factura".$fila_ot_generic['id_ot']."' method='POST' action='../front/facturaOt.php'>
                      <input type='hidden' name='id_ot' value='".$fila_ot_generic['id_ot']."' />
                      <input type='hidden' name='QuiAvaluem' value='1' />";

                    echo "
                      <i class='material-icons' style='font-size: 2em;color:";if($fila_ot_generic['id_estat']==3){
                                                                                  echo "green;";
                                                                              }

                                                                              else{
                                                                                echo "red;";
                                                                              }
                      echo "'>euro_symbol</i>
                    </form>
                </td>";
              }
              if($_SESSION['rol']==2 || $_SESSION['rol']==1){


                echo "<td onclick=$('#avaluarTecnic".$fila_ot_generic['id_ot']."').submit(); title='click per avaluar el tecnic de lordre'>
                    <form id='avaluarTecnic".$fila_ot_generic['id_ot']."' method='POST' action='../back/calcularNombreTreballadors.php'>
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
                    <form id='avaluarAdministratiu".$fila_ot_generic['id_ot']."' method='POST' action='../back/calcularNombreTreballadors.php'>
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
                </td>";

              }

              echo "
            </tr>

            <!-- fi de la línia de dades de la OT -->

        ";
            }
        echo "
        </tbody>
          </table>
          </div>
          </div>
          <script src='../js/modificarOt/deleteOt.js'></script>

          <script src='../js/func_alta_ot.js'></script>

        ";

peu("");
?>
