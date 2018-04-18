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
                  <option value=''>Tria Usuari</option>";
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
                  <option value=''>Tria Administratius</option>";
                  $query_ot_supervisors="SELECT DISTINCT usuaris.id_usuari,username_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE usuaris.rol_usuari=2";
                  $resultat_ot_supervisors=consulta($query_ot_supervisors);
                  while ($fila_ot_supervisors=$resultat_ot_supervisors->fetch_assoc()){
                      echo "<option value=".$fila_ot_supervisors['id_usuari'].">".$fila_ot_supervisors['username_usuari']."</option>";
                  }

                  echo "</select>
                </div>
                <div class='col-sm-4'>
                  <label><b>Tecnics:</b></label>
                  <select id='tecnics'>
                  <option value=''>Tria Tecnic</option>";


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
                    <option value=''>Tria Administratius</option>";
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
                  <input type='date' placeholder='Entra Data' id='dataLL' name='dataLL' >
               </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='panel panel-default'>
                    <div class='panel-heading'>Entrar Anomalia</div>
                    <div class='panel-body'>
                      <textarea placeholder='Entrar Anomalia 'id='anomalies' name='ANOMALIA'  ></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='panel panel-default'>
                    <div class='panel-heading'>Entrar Observacio</div>
                    <div class='panel-body'>
                      <textarea placeholder='Entrar Obsevacio 'id='ob' name='observacio'    ></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='panel panel-default'>
                    <div class='panel-heading'>Inventari Client</div>
                      <div class='panel-body'>
                      <select id='inventari'>
                        <option value=''>Productes Client</option>
                      </select>
                      <button type='button' class='btn btn-default btn-sm' onclick='eliminarObjecte()'>
                        <span class='glyphicon glyphicon-remove'></span> Remove
                      </button>
                      </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12' >
                  <div class='col-md-3'>
                    <div class='thumbnail'>
                      <img src='../img/portatil.png' alt='Lights' style='width:100%;height:100px;'>
                          <div class='caption'>
                            <button class=' btn btn-default btn-sm' onclick='addInventari(1)'>
                                <span class='glyphicon glyphicon-plus' ></span> ADD
                              </button>
                          </div>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='thumbnail'>
                        <img src='../img/movil.png' alt='Nature' style='width:100%;height:100px;'>
                        <div class='caption'>
                          <button class=' btn btn-default btn-sm' onclick='addInventari(2)'>
                              <span class='glyphicon glyphicon-plus' ></span> ADD
                          </button>
                        </div>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='thumbnail'>
                        <img src='../img/tablet.png' alt='Fjords' style='width:100%;height:100px;'>
                        <div class='caption'>
                              <button class=' btn btn-default btn-sm' onclick='addInventari(3)'>
                                <span class='glyphicon glyphicon-plus' ></span> ADD
                              </button>
                        </div>
                    </div>
                  </div>
                  <div class='col-md-3'>
                        <div class='thumbnail'>
                            <img src='../img/torre.jpg' alt='Fjords' style='width:100%;height:100px;'>
                            <div class='caption'>
                              <button class=' btn btn-default btn-sm' onclick='addInventari(4)'>
                                <span class='glyphicon glyphicon-plus' ></span> ADD
                              </button>
                            </div>
                        </div>
                  </div>
              </div>
            </div>
            <div class='row'>
                  <div class='alert alert-danger' id='MaximProduct' style='display:none;z-index:9999;'>
                    <strong>Danger!</strong> No pots ficar mes de 10 productes.
                  </div>
                  <div class='alert alert-success' id='productAfagit' style='display:none;z-index:9999;'>
                    <strong>Success!</strong> El producte s'ha afagit correctament.
                  </div>
              <div id='modalProduct' class='w3-modal' style='display:none;'>
                <div class='w3-modal-content' style='width:500px;'>
                  <div class='w3-container' >
                    <span onclick='cancelarProduct()' class='w3-button w3-display-topright'>&times;</span>
                      <input type='text' id='tipusProduct' name='tipusProduct' style='height:50px;margin-top:8px;'  readonly>
                      <input type='text' placeholder='Entrar Marca,Model,Caracteristiques' id='descProduct' name='descProduct' style='height:50px;font-size:20px'  >
                      <button type='submit'  id='boto1' onclick='addInventariFinal()' >Acceptar</button>
                      <button type='button' onclick='cancelarProduct()' class='cancelbtn' style='margin-bottom:8px;'>Cancel</button>
                  </div>
                </div>
              </div>

              <button type='submit'  id='boto1' onclick='alta()'>Acceptar</button>
              <button type='button' onclick='cancelar()' class='cancelbtn'>Cancel</button>
    </div>
  </div>
</div>";
