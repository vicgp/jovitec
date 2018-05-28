<?php
session_start();
include("../php/funcions.php");

  /*mostrar les ordres de treball obertes, en funció del rol, és a dir
  * en el cas d'un usuari es mostrarà la informació associada a la seva reparació
  * accions, data prevista de finalització.*/
  // fem la consulta a la base de dades per mostrar les ordres de treball (de moment totes)

  $query_ot_generic="SELECT * FROM usuaris ,rols WHERE usuaris.rol_usuari=rols.id_rol AND id_usuari=".$_POST['id_usuari'];
  //fem la consulta de les ordres de treball
  $resultat_ot_generic=consulta($query_ot_generic);
  // echo "ordres de treball:";
  $fila_ot_generic=$resultat_ot_generic->fetch_assoc();


  echo "    <script src='../js/modificarUsuari/modificarUsuarisInfo.js'></script>
  <span  id='closeModificarUsuari' class='w3-button w3-display-topright'>&times;</span>
    <div class='w3-row'>
      <!--1 part d'informacio -->
      <div class='w3-col l12'>
          <div class='w3-row'>
            <div class='w3-col l6'>
            <input type='hidden' id='idUsuari' value='".$_POST['id_usuari']."'>
              <label>Nom d'Usuari</label>
              <input class='w3-input' id='username' type='text' value='".$fila_ot_generic['username_usuari']."' readonly>
            </div>
            <div class='w3-col l6'>
              <label>Password</label>
              <input class='w3-input' type='text' value='".$fila_ot_generic['password_usuari']."' readonly>
            </div>
          </div>
          <div class='w3-row'>
            <div class='w3-col l6'>
              <label>Nom</label>
              <input class='w3-input' id='nomUsuari' type='text' value='".$fila_ot_generic['nom_usuari']."' >
            </div>
            <div class='w3-col l6'>
              <label>Cognoms
              </label>
              <input class='w3-input' id='cognomUsuari' type='text' value='".$fila_ot_generic['cognoms_usuari']."' >
              </div>
          </div>
          <div class='w3-row'>
            <div class='w3-col l6'>
              <label>Email
              </label>
              <input class='w3-input' id='emailUsuari' type='text' value='".$fila_ot_generic['email_usuari']."' >
            </div>
            <div class='w3-col l6'>
              <label>Telefon
              </label>
              <input class='w3-input' id='telefonUsuari' type='text' value='".$fila_ot_generic['telef_usuari']."' >
            </div>
          </div>
          <div class='w3-row'>
            <div class='w3-col l6'>
              <label>Rol d'Usuari</label>
              <select id='rol' style='padding-top: 0px;'>
                <option value=".$fila_ot_generic['rol_usuari'].">".$fila_ot_generic['rol']."</option>";
              $sqlRol="SELECT * FROM rols";
              $rols=consulta($sqlRol);
              while ($rol=$rols->fetch_assoc()){
                echo "  <option value=".$rol['id_rol'].">".$rol['rol']."</option>";
            }
      echo "</select>
            </div>
            <div class='w3-col l6'>
              <label>Observacio</label>
              <input class='w3-input' id='observacioUsuari' type='text' value='".$fila_ot_generic['observacions']."' >
            </div>
          </div>
    </div>
  </div>"
  ?>
