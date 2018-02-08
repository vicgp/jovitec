<?php
session_start();
include("../php/funcions.php");

capsalera("Modificar OT");

// echo "taula a modificar: ". $_POST['taula']." (".$_POST['rol_usuari'].") de l'ordre de treball: ".$_POST['id_ot'];
$query_usuaris="SELECT usuaris.id_usuari, usuaris.cognoms_usuari, usuaris.nom_usuari FROM ".$_POST['taula']." INNER JOIN usuaris ON usuaris.id_usuari=".$_POST['taula'].".id_usuari WHERE ".$_POST['taula'].".id_ot='".$_POST['id_ot']."'";
$resultat_usuaris=consulta($query_usuaris);
echo "<table border='1'>";
while ($fila=$resultat_usuaris->fetch_assoc()){
  echo "<tr>";
    echo "<td>";
      echo $fila['cognoms_usuari'].", ".$fila['nom_usuari'];
echo<<<END
        </td>
        <td>
END;
          echo "<form method=POST action=../back/eliminar_usuari_ot.php>";
            echo "<input type=hidden name=taula value=".$_POST['taula']." />";
            echo "<input type=hidden name=id_ot value=".$_POST['id_ot']." />";
            echo "<input type=hidden name=id_usuari value=".$fila['id_usuari']." />";
            echo "<input type='hidden' name='rol_usuari' value='".$_POST['rol_usuari']."' />";
echo<<<END
            <button>Elimina</button>
          </form>
        </td>
      </tr>
END;
}

echo "</table>";

echo<<<END
  <table border='1'>
  <form id='afegeix' method=POST action=../back/afegir_usuari_ot.php>
    <tr>
      <td>
        <select name=id_usuari onchange=document.getElementById('afegeix').submit(); >
          <option value="">afegir un usuari...</option>
END;
//mostrar els usuaris que tinguin aquest rol i que no estiguin assignats a aquesta ordre de treball
$query_possibles="SELECT * FROM `usuaris` WHERE rol_usuari='".$_POST['rol_usuari']."'";
$resultat_possibles=consulta($query_possibles);
    while($fila_possibles=$resultat_possibles->fetch_assoc()){ //seleccionar i mostrar els usuaris que tinguin el rol donat i que no hagin sortit al query anterior
    // si l'usuari ja esta assignat a l'ordre de treball no mostrar-lo

            echo "<option value=".$fila_possibles['id_usuari'].">".$fila_possibles['cognoms_usuari'].", ".$fila_possibles['nom_usuari']." </option>";
          }
echo<<<END
        </select>
      </td>
      <td>
END;
          echo "<input type=hidden name=taula value=".$_POST['taula']." />";
          echo "<input type=hidden name=id_ot value=".$_POST['id_ot']." />";
          echo "<input type=hidden name=rol_usuari value=".$_POST['rol_usuari']." />";
echo<<<END
    <!--      <button>Afegir</button> -->
      </td>
    </tr>
    </form>
  </table>
END;
//taula amb els registres actuals amb botons d'eliminar i afegir











///////// botó tornar a OT
echo "  <br /><form method=POST action=ot.php>";
echo "    <input type=hidden name=id_ot value=".$_POST['id_ot']." />";
echo<<<END
          <button>tornar OT</button>
        </form>
END;


peu("");
