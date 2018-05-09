<?php
session_start();
include("../php/funcions.php");

  echo "<div id='formUser' class='modal'>
          <div class='modal-content animate'>
            <span onclick='cancelarUser()' class='close' title='Close Modal'>&times;</span>
              <div class='container' style='margin-top: 0px; margin-bottom: 0px;'>
                <div class='row'>
                  <div class='col-sm-12'>
                    <label><b>rol:</b></label>
                    <select id='rol' >";
                    $query_select_curs="SELECT * FROM rols";
                    $resultat_curs = consulta($query_select_curs);
                    while ($row_curs=$resultat_curs->fetch_assoc()){
                      echo "<option value=".$row_curs['id_rol'].">".$row_curs['rol']."</option>";
                    }

                    echo "</select>
                </div>
                <div class='row'>
                  <div class='col-sm-6'>
                    <label><b>Username:</b></label>
                    <input type='text' id='username' placeholder='Escriu el nom de usuari desitgat' required></input>
                  </div>
                  <div class='col-sm-6'>
                    <label><b>Pasword:</b></label><br>
                    <input type='password' id='password' placeholder='Escriu la Password' required></input>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-sm-6'>
                    <label><b>Nom usuari:</b></label>
                    <input type='text' id='nom' placeholder='Escriu el nom ' required></input>
                  </div>
                  <div class='col-sm-6'>
                    <label><b>Cognoms Usuari:</b></label>
                    <input type='text' id='cognom' placeholder='Escriu els cognoms' required></input>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-sm-6'>
                    <label><b>e-mail:</b></label>
                    <input type='text' id='email' placeholder='Escriu el email' required></input>
                  </div>
                  <div class='col-sm-6'>
                    <label><b>Telefon:</b></label>
                    <input type='text' id='telefon' placeholder='Escriu el telefon' required></input>
                  </div>

                </div>
              <button type='submit'  id='boto1' onclick='alta_user()'>Acceptar</button>
              <button type='button' onclick='cancelarUser()' class='cancelbtn'>Cancel</button>
    </div>
  </div>
</div>";
