<?php
session_start();
include("../php/funcions.php");

  echo "<div id='formOT' class='modal'>
          <div class='modal-content animate'>
            <span onclick='cancelar()' class='close' title='Close Modal'>&times;</span>
              <div class='container'>
              <div class='row'>
              <div class='col-sm-4'>
                <label><b>Curs:</b></label>
                  <select id='curs' >";
                  $query_select_curs="SELECT * FROM curs_escolar";
                  $resultat_curs = consulta($query_select_curs);
                  while ($row_curs=$resultat_curs->fetch_assoc()){
                    echo "<option value=".$row_curs['id_curs'].">".$row_curs['curs']."</option>";
                  }

                  echo "</select>
                  </div>



                  <div class='col-sm-4'>
                  <label><b>Usuaris:</b></label>
                  <select id='usuari'>
                  <option value=''>Escull Usuari</option>";
                  $query_ot_usuaris="SELECT DISTINCT id_usuari,username_usuari FROM usuaris WHERE usuaris.rol_usuari=5";
                  $resultat_ot_usuaris=consulta($query_ot_usuaris);
                  while ($fila_ot_usuari=$resultat_ot_usuaris->fetch_assoc()){
                      echo "<option value=".$fila_ot_usuari['id_usuari'].">".$fila_ot_usuari['username_usuari']."</option>";
                  }

                  echo "</select>
                  </div>

                  <div class='col-sm-4'>
                  <label><b>Prioritat:</b></label>
                  <select id='prioritat' >";

                    $query_prioritats="SELECT * FROM prioritat ORDER BY id_prioritat DESC ";
                    $resultat_prioritats=consulta($query_prioritats);
                    while ($prioritats=$resultat_prioritats->fetch_assoc()){
                  echo "
                      <option value=".$prioritats['id_prioritat'].">".$prioritats['prioritat']."</option>
                  ";
                    }
                  echo"
                  </select>
                  </div>
                  </div>

                  <div class='row'>
                  <div class='col-sm-4'>
                  <label><b>Supervisors:</b></label>
                  <select id='supervisors'>
                  <option value=''>Escull Administratius</option>";
                  $query_ot_supervisors="SELECT DISTINCT usuaris.id_usuari,username_usuari FROM usuaris INNER JOIN supervisors ON usuaris.id_usuari=supervisors.id_usuari WHERE usuaris.rol_usuari=2";
                  $resultat_ot_supervisors=consulta($query_ot_supervisors);
                  while ($fila_ot_supervisors=$resultat_ot_supervisors->fetch_assoc()){
                      echo "<option value=".$fila_ot_supervisors['id_usuari'].">".$fila_ot_supervisors['username_usuari']."</option>";
                  }

                  echo "</select>
                  </div>
                  <div class='col-sm-4'>
                  <label><b>Tecnics:</b></label>
                  <select id='tecnics'>
                  <option value=''>Escull Tecnic</option>";


                  $query_ot_tecnics="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE usuaris.rol_usuari=3";
                  $resultat_ot_tecnics=consulta($query_ot_tecnics);
                  while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){

                    echo "<option value=".$fila_ot_tecnics['id_usuari'].">".$fila_ot_tecnics['username_usuari']."</option>";
                  }

                  echo "</select>
                  </div>

                  <div class='col-sm-4'>
                  <label><b>Administratius:</b></label>
                  <select id='administratius'>
                    <option value=''>Escull Administratius</option>";
                  $query_ot_administratius="SELECT DISTINCT usuaris.id_usuari,username_usuari FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE usuaris.rol_usuari=4";
                  $resultat_ot_administratius=consulta($query_ot_administratius);
                  while ($fila_ot_administratius=$resultat_ot_administratius->fetch_assoc()){
                    echo "<option value=".$fila_ot_administratius['id_usuari'].">".$fila_ot_administratius['username_usuari']."</option>";
                  }

                  echo "</select>

                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-sm-4'>
                  <label><b>Data d'Entrada:</b></label>
                  <input type='date' placeholder='Entra Data'id='dataE' name='dataE' value='2018-01-25' readonly>
                  </div>
                  <!--<div class='col-sm-4'>
                  <label><b>Data de Finalitzacio:</b></label>
                  <input type='date' placeholder='Entra Data' id='dataF' name='dataF' readonly>
                  </div>-->
                  <div class='col-sm-4'>
                  <label><b>Data de Lliuramnet:</b></label>
                  <input type='date' placeholder='Entra Data' id='dataLL' name='dataLL' readonly>
                  </div>
                  </div>
                  <button type='submit'  id='boto1' onclick='alta()'>Acceptar</button>
              <button type='button' onclick='cancelar()' class='cancelbtn'>Cancel</button>
    </div>
  </div>
</div>";
