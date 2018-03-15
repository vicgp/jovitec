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
      <div id="ft">
      <form method=POST action=../back/modificar_usuari.php>
        <div id="perfi">
END;
          echo "<div id=titulo><h2>Les meves dades </h2></div>";
          echo"
          <p>Nom<input type='text' name='nom' required value='".$fila_usuari['nom_usuari']."' /></p><br>";
          echo "cognoms:<input type='text' name='cognoms' required value='".$fila_usuari['cognoms_usuari']."' /> <br>";
          echo "contrasenya:<input type='password' name='passwd' required value='".$fila_usuari['password_usuari']."'";
          echo"<br>";
          echo "<div class='input-group'>
                  <span class='input-group-addon' id='basic-addon1'>@</span>
                 <input type='text' class='form-control' name='email' required value='".$fila_usuari['email_usuari']."' aria-describedby='sizing-addon1' />
              </div><br>";
          echo "telef:<input type='tel' name='telef' pattern='[0-9]{9}' value='".$fila_usuari['telef_usuari']."'><br>";

        echo "<input type='hidden' name='id_usuari' value='".$fila_usuari['id_usuari']."' />";
        echo "<input type='hidden' name='user' required value='".$fila_usuari['username_usuari']."' />";
        echo "<input type='hidden' name='rol' required value='".$fila_usuari['rol_usuari']."' />";
        echo "<input type='hidden' name='observacions' required value='".$fila_usuari['observacions']."' />";

        echo "<input type='hidden' name='torna_usuari' value='True' />";
          echo "<button class=esquerra type='submit' style='margin-left:200px; margin-top:10px; width:72%;' >modificar usuari</button>";


          echo "<button class=esquerra type='submit' id='edit' >modificar usuari</button>";
        
        echo "</form>";
      ///////////// fi del formulari de modificació d'usuaris
        echo<<<END
        <form action=main.php method='POST'>
        <input type="hidden" name="altauser" value=True />
        <input type='hidden' name='torna_usuari' value='False' />
        <button class=cancel class=esquerra type='submit' id='cancel'>cancel·lar</button>

        </div>
      </form>

      <br />
END;
   ///////////// fi del formulari de modificació d'usuaris



///////////////////// fi de la taula d'usuaris /////////////////////////////

peu("");
