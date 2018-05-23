<?php
session_start();
include("../php/funcions.php");
capsalera("modificar usuari");
chat();
echo '<script src="../js/perfil/imagen.js"></script>';
      //mostrar l'usuari
      $qwery="SELECT * FROM usuaris WHERE username_usuari = '".$_SESSION['usuari']."'";
      $resultat= consulta($qwery);
      $fila_usuari=$resultat->fetch_assoc();

      $imgquery = "SELECT  imatge FROM usuaris WHERE id_usuari= '".$_SESSION['id_user']."'";
      $resultatImg= consulta($imgquery);
      $row=$resultatImg->fetch_assoc();


      // mostrar la taula de camps d'usuari omplerta amb els valors actuals
      echo '
      <br />
      <br>
      <div class="w3-container w3-card-4 w3-light-grey w3-text-blue" style="margin:auto; width:50%;">
      <h2 class="w3-container w3-red" style="text-align:center;"">El meu Perfil</h2>
      <ul class="ch-grid">
          <li>
            <div id="img2" class="ch-item ch-img-1" style="
            background-position: right top;
            background-repeat: no-repeat;
            background-position-x: 0% 0% !important;
            background-position-y:  0% 0% !important;
            background-attachment: scroll!important;
            background-origin: padding-box!important;
            background-clip: border-box!important;

            background:url(data:image/jpg;base64,'.base64_encode($row['imatge']).'" >
              <div class="ch-info">
              <form  action="../back/perfil/imagenUpdate.php" method="POST" enctype="multipart/form-data" name="myForm">


                <label  class="fileContainer"  style="margin-left: 36%;
    margin-top: 37%;">
                  <img src="../img/add.png" >

                <input type="file" class="shiny-button"  name="imatge" id="imatge" style=" margin-top: -10x; margin-top: 93px; width: 124px; margin-left:  50px;" >



                </label>
                <input type="submit" id="but" style="display:none;" />
                </form>
              </div>
            </div>
          </li>
          </ul>

      <form method=POST action=../back/modificar_usuari.php style="padding-right: 22px;">
';


          echo"<div class='w3-row w3-section'>
          <div class='w3-col' style='width:50px'><i class='material-icons' style='font-size:45px; margin-top: 18px;'>account_circle</i></div>
          <div class='w3-rest'>
              <p>Nom<input class='w3-input w3-border' type='text' name='nom' required value='".$fila_usuari['nom_usuari']."' /></p></div>
          </div>";

          echo "<div class='w3-row w3-section'>
          <div class='w3-col' style='width:50px'><i class='material-icons' style='font-size:45px; margin-top: 15px;'>person</i></div>
          <div class='w3-rest'>
          cognoms:<input class='w3-input w3-border' type='text' name='cognoms' required value='".$fila_usuari['cognoms_usuari']."' /></div></div>";
          echo "<div class='w3-row w3-section'>
          <div class='w3-col' style='width:50px'><i class='material-icons' style='font-size:45px;margin-top: 18px;'>vpn_key</i></div>
          <div class='w3-rest'>
          <p>contrasenya:<input class='w3-input w3-border' type='password' name='passwd' required value='".$fila_usuari['password_usuari']."'";
          echo"</p</div></div>
          </div>";
          echo "<div class='w3-row w3-section'>
                  <div class='w3-col' style='width:50px'><i class='material-icons' style='font-size:45px; margin-top: -2;'>email</i></div>
                  <div class='w3-rest'>
                 <input type='text' class='w3-input w3-border' name='email' required value='".$fila_usuari['email_usuari']."' aria-describedby='sizing-addon1' />
              </div></div>";

          echo "<div class='w3-row w3-section'>
          <div class='w3-col' style='width:50px'><i class='material-icons' style='font-size:45px; margin-top: 17px;'>phone_iphone</i></div>
          <div class='w3-rest'>
          telef:<input type='tel' class='w3-input w3-border' name='telef' pattern='[0-9]{9}' value='".$fila_usuari['telef_usuari']."'></div>
          </div>";

        // echo "<input type='hidden' name='id_usuari' value='".$fila_usuari['id_usuari']."' />";
        // echo "<input type='hidden' name='user' required value='".$fila_usuari['username_usuari']."' />";
        // echo "<input type='hidden' name='rol' required value='".$fila_usuari['rol_usuari']."' />";
        // echo "<input type='hidden' name='observacions' required value='".$fila_usuari['observacions']."' />";

        echo "<input type='hidden' name='torna_usuari' value='True' />";
echo'<div class="row">';
          echo "<div class='col-sm-6'><button class='w3-button w3-block w3-section w3-green w3-ripple w3-padding' type='submit' style='margin-left:20%; margin-top:10px; width:60%;' >modificar usuari</button></div>";





        echo "</form>";
      ///////////// fi del formulari de modificació d'usuaris
        echo<<<END
        <div class="col-sm-6">
        <form action=main.php method='POST' >
        <input type="hidden" name="altauser" value=True />
        <input type='hidden' name='torna_usuari' value='False' />

        <button class="w3-button w3-block w3-section w3-red w3-ripple w3-padding" style='margin-left:20%; margin-top:10px; width:60%;' type='submit' >cancel·lar
        </button>
      </form>
      </div>
      </div>
      <br />
END;
   ///////////// fi del formulari de modificació d'usuaris



///////////////////// fi de la taula d'usuaris /////////////////////////////

peu("");
