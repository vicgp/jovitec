<?php
session_start();
include("../php/funcions.php");
capsalera("nova OT");


echo<<<END
    <form id='alta_ot' method=POST action=../back/alta_ot.php>
      <table>
        <tr>
          <td>
            curs:
          </td>
          <td>
            <select name=id_curs required>
              <option value='1'>17/18</option>
END;
                $query_select_curs="SELECT * FROM curs_escolar";
                $resultat_curs = consulta($query_select_curs);
                while ($row_curs=$resultat_curs->fetch_assoc()){
                  echo "<option value=".$row_curs['id_curs'].">".$row_curs['curs']."</option>";
                }
                // $resultat_curs->close();
echo<<<END
            </select>
          </td>
        </tr>
        <tr>
          <td>
            data d'entrada:
          </td>
          <td>
            <input id='data_entrada' type=date name=data_entrada required/>
          </td>
        </tr>
        <tr>
          <td>
            usuari:
          </td>
          <td>
            <select name=id_usuari onchange="nova_ot()" required>
              <option value="">tria un usuari...</option>
END;
              $query_select_usuari="SELECT id_usuari, nom_usuari, cognoms_usuari FROM usuaris WHERE rol_usuari='5'";
              $resultat_usuari = consulta($query_select_usuari);
              while ($row_usuari=$resultat_usuari->fetch_assoc()){
                echo "<option value=".$row_usuari['id_usuari'].">".$row_usuari['cognoms_usuari'].", ".$row_usuari['nom_usuari']."</option>";
              }
echo<<<END
              <option value="nou_usuari">nou usuari</option>
          </select>
          <input type=hidden name=torna_a value='nova_ot.php' />
          </td>
        </tr>
      </table>
<!--      <button>nova OT</button> -->
    </form>

    <img id=novaot src="../img/TopOfTheRock.jpg" alt="TopOfTheRock, nova ordre de treball">
END;

peu("");
