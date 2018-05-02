<?php
session_start();
include("../php/funcions.php");
capsalera("modificar usuari");
chat();

      //mostrar l'usuari
      $qwery="SELECT * FROM usuaris WHERE username_usuari = '".$_SESSION['usuari']."'";
      $resultat= consulta($qwery);
      $fila_usuari=$resultat->fetch_assoc();

      // mostrar la taula de camps d'usuari omplerta amb els valors actuals
      echo<<< END
      <br />
      <br>
      <div class="w3-container w3-card-4 w3-light-grey w3-text-blue" style='margin:auto; width:50%;'>
      <h2 class="w3-container w3-red" style='text-align:center;'>El meu Perfil</h2>
      <ul class='ch-grid'>
          <li>
            <div class='ch-item ch-img-1'>
              <div class='ch-info'>
                <input type='file' name='file-1[]' id='file-1' class='inputfile inputfile-1' data-multiple-caption='{count} files selected' multiple />
                <label for='file-1' style='margin-top: 90px;''><svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'/></svg> <span>Editar</span></label>
                
              </div>
            </div>
          </li>
          </ul>

      <form method=POST action=../back/modificar_usuari.php style="padding-right: 22px;">
      
      
      
            
        
END;

          
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
