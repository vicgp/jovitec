<?php
session_start();
include("../php/funcions.php");
capsalera('Nou Usuari');
chat();


if ($_POST['altauser'] == 'True'){
////////////////////////////////////////////////////////////////////////////////
///////////////// formulari per l'alta de nous usuaris /////////////////////////
////////////////////////////////////////////////////////////////////////////////

echo<<< END
  <br />
  <form method=POST action=../back/alta_usuari.php>
  <div id='table'>
    <div id='tr'>
      <div id='td'>
        nom*:
      </div>
      <div id='td'>
        <input type="text" name="nom" required/>
      </div>
    </div>
    <div id='tr'>
      <div id='td'>
        cognoms*:
      </div>
      <div id='td'>
        <input type="text" name="cognoms" required/>
      </div>
    </div>
    <div id='tr'>
      <div id='td'>
        usuari*:
      </div>
      <div id='td'>
        <input type="text" name="user" required/>
      </div>
    </div>
    <div id='tr'>
      <div id='td'>
        contrasenya*:
      </div>
      <div id='td'>
        <input type="text" name="passwd" required/>
      </div>
    </div>
    <div id='tr'>
      <div id='td'>
        email*:
      </div>
      <div id='td'>
        <input type="email" name="email" required/>
      </div>
    </div>
    <div id='tr'>
      <div id='td'>
        telef:
      </div>
      <div id='td'>
        <input type="tel" name="telef" pattern="[0-9]{9}"/>
      </div>
    </div>
    <div id='tr'>
END;
    //si l'usuari és administrador pot assignar qualsevol rol
    if ($_SESSION['rol'] == '1'){
echo<<<END
      <div id='td'>
        rol*:
      </div>
      <div id='td'>
        <select name="rol" required>
          <option value="">   tria un rol...   </option>
END;
          //query pel combo de rols
          $query_rols="SELECT * FROM rols";
          $resultat_rols= consulta($query_rols);
          while ($row=$resultat_rols->fetch_assoc()){
            echo"<option value=".$row['id_rol'].">".$row['rol']."</option>";
        }
        echo"</select>";//rol
      echo "</div>"; //td del rol
    }
    //si l'usuari és supervissor pot assignar rols de tècnic, administratiu o client
    elseif ($_SESSION['rol'] == '2'){
echo<<<END
      <div id='td'>
        rol*:
      </div>
      <div id='td'>
      <select name="rol" required>
        <option value="">   tria un rol...   </option>
END;
        //query pel combo de rols
        $query_rols2="SELECT * FROM rols WHERE id_rol > '2' ";
        $resultat_rols2= consulta($query_rols2);
        while ($row2=$resultat_rols2->fetch_assoc()){
          echo"<option value=".$row2['id_rol'].">".$row2['rol']."</option>";
      }
        echo"</select>";//rol
echo<<<END
      </div> <!-- rol -->
END;
    }
    //si l'usuari és tècnic o administratiu només pot donar d'alta clients
    elseif ($_SESSION['rol'] == '3' || $_SESSION['rol'] == '4'){
      echo'<input type="hidden" name="rol" value="5">';
    }
echo<<< END
    </div>
    <div id='tr'>
      <div id='td'> observacions: </div><div id='td'> <input type="text" name="observacions" /> </div>
    </div>
  </div>
END;
//si venim de una nova ot hem de re-enviar les dades per poder tornar a la nova ot
if ($_POST['alta_ot'] == 'True'){
echo "
  <input type=hidden name='id_curs' value='".$_POST['id_curs']."'  />
  <input type=hidden name='data_entrada' value='".$_POST['data_entrada']."'  />
  <input type=hidden name='alta_ot' value='True'  />
";
}
if ($_POST['alta_comunicacio'] == 'nou_remitent'){
echo "
    <input type=hidden name=alta_comunicacio value=remitent />
";
}
if ($_POST['alta_comunicacio'] == 'nou_destinatari'){
echo "
  <input type=hidden name=remitent value=".$_POST['remitent']." />
  <input type=hidden name=alta_comunicacio value=destinatari />
";
}
echo<<<END
    <button class=esquerra type="submit">alta usuari</button>
  </form>
END;
///////////// fi del formulari d'alta d'usuaris
} // fi de l'alta d'usuaris


////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


  elseif ($_POST['altauser'] == 'False'){
    ////////////////////////////////////////////////////////////////////////////
    // formulari per la modificació d'un usuari
    ////////////////////////////////////////////////////////////////////////////

    $query_rols="SELECT * FROM rols";
    $resultat_rols= consulta($query_rols);

    //query per dades usuari per modificar
    $query_usuari="SELECT * FROM usuaris WHERE id_usuari =". $_POST['id_usuari'];
    $resultat_usuari=consulta($query_usuari);

    $fila_usuari=$resultat_usuari->fetch_assoc();

// mostrar la taula de camps d'usuari omplerta amb els valors actuals
echo "<br />
   <form method=POST action=../back/modificar_usuari.php>
    <table>
      <tr>
        <td>
          nom:
        </td>
        <td>
          <input type='text' name='nom' required value='".$fila_usuari['nom_usuari']."' />
        </td>
      </tr>
      <tr>
        <td>
          cognoms:
        </td>
        <td>
          <input type='text' name='cognoms' required value='".$fila_usuari['cognoms_usuari']."' />
        </td>
      </tr>
      <tr>";
// nomes els administradors i el propi usuari poden modificar contrasenyes
    if ($_SESSION['rol']=='1' || $fila_usuari['nom_usuari'] == $_SESSION['usuari']){
echo  " <td>
          usuari:
        </td>
        <td>
          <input type='text' name='user' required value='".$fila_usuari['username_usuari']."' />
        </td>
      </tr>
      <tr>
        <td>
          contrasenya:
        </td>
        <td>
          <input type='password' name='passwd' required value='".$fila_usuari['password_usuari']."' />
        </td>
      </tr>";
   }
echo "<tr>
        <td>
          email:
        </td>
        <td>
          <input type='text' name='email' required value='".$fila_usuari['email_usuari']."' />
        </td>
      </tr>
      <tr>
        <td>
          telef:
        </td>
        <td>
          <input type='tel' name='telef' pattern='[0-9]{9}' value='".$fila_usuari['telef_usuari']."' >
        </td>
      </tr>
      <tr>";

//si l'usuari és administrador canviar el rol de l'usuari
     if ($_SESSION['rol'] == '1'){
echo  ' <td>
          rol*:
        </td>
        <td>
          <select name="rol" required>
            <option value="">   tria un rol...   </option>';
         while ($row=$resultat_rols->fetch_assoc()){
echo       "<option value=".$row['id_rol'].">".$row['rol']."</option>";
         }
echo     "</select></td>";
     }
     // la resta d'usuaris no poden canviar el rol d'un usuari
     elseif ($_SESSION['rol'] >= '2'){
echo    '<input type="hidden" name="rol" value="'.$fila_usuari["rol_usuari"].'">';
     }
echo"
    </tr>
    <tr>
      <td>
        observacions:
      </td>
      <td>
        <input type='text' name='observacions' value='".$fila_usuari['observacions']."' >
      </td>
    </tr>
  </table>
  <input type='hidden' name='id_usuaris' value=".$fila_usuari['id_usuari']." />
  <button class=esquerra type='submit'>modificar usuari</button>
</form>";
///////////// fi del formulari de modificació d'usuaris
   } //else de modificació de l'usuari
   //Fiquem un boto d'avaluacio per el alumne i un altre de cancelar.
echo<<<END


     <form action=usuaris.php method='POST'>
       <input type="hidden" name="altauser" value=True />
       <button class=cancel class=esquerra type='submit'>Cancel·lar</button>
     </form>
     <br />
END;

peu("");
