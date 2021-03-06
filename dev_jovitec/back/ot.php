<?php
session_start();
include("../php/funcions.php");

  /*mostrar les ordres de treball obertes, en funció del rol, és a dir
  * en el cas d'un usuari es mostrarà la informació associada a la seva reparació
  * accions, data prevista de finalització.*/
  // fem la consulta a la base de dades per mostrar les ordres de treball (de moment totes)

  $query_ot_generic="SELECT ordre_treball.id_ot, curs_escolar.curs, usuaris.cognoms_usuari, usuaris.nom_usuari, usuaris.email_usuari,
   data_entrada, prioritat.prioritat, data_finalitzacio, data_lliurament ,supervisors.id_usuari,tecnics.id_usuari,
   administratius.id_usuari,anomalies.anomalia,observacions_ot.item_observacions
   FROM ordre_treball ,usuaris ,curs_escolar,supervisors,tecnics,administratius, prioritat,anomalies,observacions_ot
   WHERE ordre_treball.id_usuari=usuaris.id_usuari AND ordre_treball.id_curs=curs_escolar.id_curs
   AND supervisors.id_ot=ordre_treball.id_ot AND ordre_treball.id_ot=tecnics.id_ot AND ordre_treball.id_ot=administratius.id_ot
   AND prioritat.id_prioritat=ordre_treball.prioritat AND ordre_treball.id_ot=anomalies.id_ot
   AND observacions_ot.id_ot=ordre_treball.id_ot AND ordre_treball.id_ot=".$_POST['id_ot'];
  //fem la consulta de les ordres de treball
  $resultat_ot_generic=consulta($query_ot_generic);
  // echo "ordres de treball:";
  while ($fila_ot_generic=$resultat_ot_generic->fetch_assoc()){
echo "
    <span  id='closeModificarOt' class='w3-button w3-display-topright'>&times;</span>
      <div class='w3-row'>
        <!--1 part d'informacio -->
        <div class='w3-col l6'>
        <input class='w3-input' type='hidden' id='idOt' value='".$fila_ot_generic['id_ot']."' readonly>
            <div class='w3-row'>
              <div class='w3-col l12'>
                <label>Curs</label>
                <input class='w3-input' type='text' value='".$fila_ot_generic['curs']."' readonly>
              </div>
            </div>
            <div class='w3-row'>
              <div class='w3-col l6'>
                <label>Prioritat</label>
                <input class='w3-input' type='text' value='".$fila_ot_generic['prioritat']."' readonly>
              </div>
              <div class='w3-col l6'>
                <label>Supervisors
                  <i class='material-icons' id='supervisor'>add_circle</i>
                  <i class='material-icons' id='supervisorRemove'>remove_circle</i>
                </label>";
                $query_ot_supervisors="SELECT username_usuari FROM usuaris INNER JOIN supervisors ON usuaris.id_usuari=supervisors.id_usuari WHERE supervisors.id_ot=".$fila_ot_generic['id_ot'];
                $resultat_ot_supervisors=consulta($query_ot_supervisors);
                while ($fila_ot_supervisors=$resultat_ot_supervisors->fetch_assoc()){
                      echo   "<input class='w3-input' type='text' value='".$fila_ot_supervisors['username_usuari']."' readonly>";

                    }

              echo "</div>
            </div>
            <div class='w3-row'>
              <div class='w3-col l6'>
                <label>Tecnics
                  <i class='material-icons' id='tecnic'>add_circle</i>
                  <i class='material-icons' id='tecnicRemove'>remove_circle</i>
                </label>";
                $query_ot_tecnics="SELECT username_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$fila_ot_generic['id_ot'];
                $resultat_ot_tecnics=consulta($query_ot_tecnics);
                while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){
                echo "<input class='w3-input' type='text' value='".$fila_ot_tecnics['username_usuari']."' readonly>";
              }
      echo "</div>
              <div class='w3-col l6'>
                <label>Administratius
                  <i class='material-icons' id='administratius'>add_circle</i>
                  <i class='material-icons' id='administratiusRemove'>remove_circle</i>
                </label>";
                $query_ot_administratius="SELECT username_usuari FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE administratius.id_ot=".$fila_ot_generic['id_ot'];
                $resultat_ot_administratius=consulta($query_ot_administratius);
                while ($fila_ot_administratius=$resultat_ot_administratius->fetch_assoc()){
                  echo    "<input class='w3-input' type='text' value='".$fila_ot_administratius['username_usuari']."' readonly>";
              }
      echo "</div>
            </div>
            <div class='w3-row'>
              <div class='w3-col l6'>
                <label>Data Finalitzacio</label>
                <input class='w3-input' id='dataF' type='date' value='".$fila_ot_generic['data_finalitzacio']."'>
              </div>
              <div class='w3-col l6'>
                <label>Data LLuirament</label>
                <input class='w3-input' id='dataLl' type='date' value='".$fila_ot_generic['data_lliurament']."'>
              </div>
            </div>
            <!-- 2 part d'informacio -->
      </div>
      <div class='w3-col l6'>
            <div class='w3-row'>
              <div class='w3-col l12'>
                <label>Observacio</label>
                <textarea rows='4' cols='10' id='observacio'>".$fila_ot_generic['item_observacions']."</textarea>
              </div>
            </div>
            <div class='w3-row'>
              <div class='w3-col l12'>
                <label>Anomalia</label>
                <textarea rows='4' cols='10' id='anomalies'>".$fila_ot_generic['anomalia']."</textarea>
              </div>
            </div>
            <div class='w3-row'>
            <div class='w3-col l12'>
                <label>Actuacio
                </label>
              <input class='w3-input' id='actuacio' type='text'  placeholder='Explicacio de les accions efectuades'>
              </input>
            </div>
            </div>
            <div class='w3-row'>
              <div class='w3-row'>
              <div class='w3-col l5'>
                  <label>Hores de Treballades</label>
                <input class='w3-input' id='horesTreballades' type='number' value='0' placeholder='Minuts Treballades'>
              </div>
                <div class='w3-col l5'>
                    <label>Minuts de Treballades</label>
                  <input class='w3-input' id='minutsTreballades' type='number' value='0' placeholder='Minuts Treballades'>
                </div>
                <div class='w3-col l2'>
                    <label>Afagir</label>
                    <br>
                  <button id='afagirActuacio'><i class='material-icons' style='font-size:2em;'>add_circle_outline</i></button>

                </div>
              </div>


            </div>
      </div>
    </div>


    ";
  }
  echo '
  <input type="hidden" id="idOt" value='.$_POST['id_ot'].'>
  <input type="hidden" id="remove" value=0>
  <div id="afagirTecnic" class="w3-modal" >
      <div class="w3-modal-content" style="width:20%">
        <div class="w3-container" >
          <span  class="w3-button w3-display-topright close-modal">&times;</span>
          <select id="addTecnic">';



          echo '</select>
          <button id="Tec">Afagir Tecnic</button>
          <button id="removeTec">Eliminar Tecnic</button>

        </div>
      </div>
    </div>

    <div id="afagirAdministratiu" class="w3-modal" >
        <div class="w3-modal-content" style="width:20%">
          <div class="w3-container" >
            <span  class="w3-button w3-display-topright close-modal">&times;</span>
            <select id="addAdministratiu">
            ';


            echo '</select>
            <button id="Ad">Afagir Administratiu</button>
            <button id="removeAd">Eliminar Tecnic</button>

          </div>
        </div>
    </div>
    <div id="afagirSupervisor" class="w3-modal" >
        <div class="w3-modal-content" style="width:20%">
          <div class="w3-container" >
            <span  class="w3-button w3-display-topright close-modal">&times;</span>
            <select id="addSupervisor">';


            echo '</select>
            <button id="Sup">Afagir Supervisor</button>
            <button id="removeSup">Eliminar Supervisor</button>

          </div>
        </div>
    </div>


<script type="text/javascript" src="../js/modificarOt/modificarObserAnomalia.js"> </script>
<script type="text/javascript" src="../js/modificarOt/afagirNouTreballadors.js"> </script>';
////////////////////////////fins aqui taula actuacions//////////////////////////
