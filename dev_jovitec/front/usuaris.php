<html>
  <head>
    <script src='../js/func_alta_user.js'></script>
    <script src='../js/sidebar.js'></script>



<?php
session_start();
include("../php/funcions.php");
$_SESSION['url']=2;
capsalera('usuaris');
chat();
if($_SESSION['rol']>2){
  header('Location: usuari.php');
}


  //mostrar els usuaris
   $qwery="SELECT id_usuari, nom_usuari, cognoms_usuari, email_usuari, rol_usuari, telef_usuari, observacions, rols.rol FROM usuaris INNER JOIN rols ON usuaris.rol_usuari=rols.id_rol ORDER BY usuaris.id_usuari DESC";
   $resultat= consulta($qwery);


echo '
    <script src="../js/modificarUsuari/modificarUsuari.js"></script>
<div class="w3-sidebar w3-bar-block w3-border-right" style="display: none; position:absolute; z-index:9999; width: 25%; background-color: rgba(50, 54, 60, 0.83); color:black; margin-top:-3.5%;" id="mySidebar">
  <button onclick="w3_close('.$_SESSION['url'].')" class="w3-bar-item w3-large" style="background-color:#f30808d4;">Close &times;</button>
          <!--CheckBoxes -->
          <div style="display:block;">
            <label id="checks"> Tots els usuaris </label>
            <input type="radio" id="totsCheck" name="all" value="0" onclick="OnCheck()">
            <label id="checks"> Tots els Tecnics </label>
            <input type="radio" id="tecnicCheck" name="all" value="0" onclick="OnCheck()">
            <label id="checks"> Tots els Administratius </label>
            <input type="radio" id="administratiusCheck" name="all" value="0" onclick="OnCheck()">
            <label id="checks"> Tots els Clients </label>
            <input type="radio" id="CLientCheck" name="all" value="0" onclick="OnCheck()">
          </div>


          <!--drop tecnics -->
          <select id="tecnicsCheck" onchange="carregarTecnicsUsuaris()">
            <option value="">Tria Tecnic</option>';
              $query_ot_tecnics="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=3";
              $resultat_ot_tecnics=consulta($query_ot_tecnics);
              while ($fila_ot_tecnics=$resultat_ot_tecnics->fetch_assoc()){

                echo "<option value=".$fila_ot_tecnics['id_usuari'].">".$fila_ot_tecnics['username_usuari']."</option>";
              }

          echo '
            </select>
            <!--drop administratius -->
            <select id="adminisCheck" onchange="carregarAdminisUsuaris()">
              <option value="">Tria Administratius</option>';
                $query_ot_Adminis="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=4";
                $resultat_ot_adminis=consulta($query_ot_Adminis);
                while ($fila_ot_adminis=$resultat_ot_adminis->fetch_assoc()){

                  echo "<option value=".$fila_ot_adminis['id_usuari'].">".$fila_ot_adminis['username_usuari']."</option>";
                }

          echo '
          </select>
            <!--drop Clients -->
            <select id="ClientFiltre" onchange="carregarClient()">
              <option value="">Tria Client</option>';

              $query_ot_Client="SELECT DISTINCT usuaris.id_usuari ,username_usuari FROM usuaris  WHERE usuaris.rol_usuari=5";
                $resultat_Clients=consulta($query_ot_Client);
                while ($Clients=$resultat_Clients->fetch_assoc()){
                    echo "
                        <option value=".$Clients['usuaris.id_usuari'].">".$Clients['username_usuari']."</option>
                    ";
                }


              echo "
                  </select>
                </div>
                <div id='usuarisList' style='padding-right: 4%; margin-left: 4%;'>
                <h1 style='text-align:center;'>Usuaris</h1>

                <button class='btn btn-success' onclick='user()' style= width:100%; margin-left: -1px !important;>Nova Usuari</button>
                <div id='newUser'>
                </div>

                <div id='usuarisUpdate' style='margin-left: 0.7%; margin-right: -0.9%;'>

                <div class='w3-modal' id='modalModificarUsuari'>
                  <div class='w3-modal-content animate'>
                      <div class='w3-container' id='modificarUsuari'>
                      </div>
                  </div>
                </div>
                <div id='usuarisUpdate'>
                    <form id='formulario'>
                        <table id='taula'>
                          <tr>
                            <th>
                              nom
                            ";fletxes('nom_usuari','usuaris');echo "
                            </th>
                            <th>
                              cognoms
                            </th>
                            <th>
                              email
                            </th>
                            <th>
                              telèfon
                            </th>
                            <th>
                              rol
                            </th>
                            <th>
                              observacions
                            </th>
                            <th>
                              Editar Usuari
                            </th>
                            <th>
                              Eliminar Usuari
                            </th>

                          </tr>";

                       while ($fila=$resultat->fetch_assoc()) {

                         //mostrar els usuaris en funció del rol que tinguis
                        if (($_SESSION['rol'] == '3' || $_SESSION['rol'] == '4') && $fila['rol_usuari']<'5' ){
                          continue;
                        }
                        if ($_SESSION['rol'] == '2' && $fila['rol_usuari']<='2'){
                          continue;
                        }
                         echo "
                              <tr title='doble click per modificar usuari'>
                                  <input type='hidden' name='altauser' value='False' />
                                <td>". $fila['nom_usuari'] . "</td>
                                <td>" . $fila['cognoms_usuari'] . "</td>
                                <td>" . $fila['email_usuari'] . "</td>
                                <td>" . $fila['telef_usuari'] . "</td>
                                <td>" . $fila['rol'] . "</td>
                                <td>" . $fila['observacions'] . "</td>
                                <td  class='user'>
                                    <input type='hidden' class='id_usuari' value='".$fila['id_usuari']."'>
                                    <i class='material-icons'>edit</i>
                                </td>
                                <td class='delete' >
                                      <input type='hidden' class='id_usuari' value='".$fila['id_usuari']."' />
                                      <i class='material-icons' style='font-size: 2em;color:black'>delete</i>
                                </td>
                              </tr>
                            ";
                       }
                         echo "</table>
                         </form>
                   </div>
                 </div>
                 <script src='../js/modificarUsuari/deleteUsuari.js'></script>
";



///////////////////// fi de la taula d'usuaris /////////////////////////////
peu("");
