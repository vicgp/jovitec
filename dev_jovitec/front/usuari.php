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
          echo "<ul class='ch-grid'>
          <li>
            <div class='ch-item ch-img-1'>
              <div class='ch-info'>
                <input type='file' name='file-1[]' id='file-1' class='inputfile inputfile-1' data-multiple-caption='{count} files selected' multiple />
                <label for='file-1' style='margin-top: 90px;''><svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'/></svg> <span>Editar</span></label>
                
              </div>
            </div>
          </li>
          </ul>";
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
