<?php
session_start();
include("../php/funcions.php");
capsalera('usuaris');
chat();

$columna='id_usuari';
$ordre='ASC';
if ($_POST['columna']){
  $columna=$_POST['columna'];
  $ordre=$_POST['ordre'];
}

  //mostrar els usuaris
   $qwery="SELECT id_usuari, nom_usuari, cognoms_usuari, email_usuari, rol_usuari, telef_usuari, observacions, rols.rol FROM usuaris INNER JOIN rols ON usuaris.rol_usuari=rols.id_rol ORDER BY $columna $ordre";
   $resultat= consulta($qwery);

echo "
  <h1>Usuaris</h1>
  
  <button id='user' onclick='user()' style= width:100%; >Nova Usuari</button>
  <div id='newUser'>
  </div>


  <form method=POST action=nou_usuari.php>
    <input type=hidden name=altauser value='True' />
  </form>

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
      </tr>";

   while ($fila=$resultat->fetch_assoc()) {

     //mostrar els usuaris en funció del rol que tinguis
    if (($_SESSION['rol'] == '3' || $_SESSION['rol'] == '4') && $fila['rol_usuari']<'5'){
      continue;
    }
    if ($_SESSION['rol'] == '2' && $fila['rol_usuari']<='2'){
      continue;
    }
     echo "
          <tr ondblclick=document.getElementById('modifica_usuari".$fila['id_usuari']."').submit(); title='doble click per modificar usuari'>
            <form id='modifica_usuari".$fila['id_usuari']."' method='POST' action='nou_usuari.php'>
              <input type='hidden' name='id_usuari' value='".$fila['id_usuari']."'>
              <input type='hidden' name='altauser' value='False' />
            </form>
            <td>". $fila['nom_usuari'] . "</td><td>" . $fila['cognoms_usuari'] . "</td><td>" . $fila['email_usuari'] . "</td><td>" . $fila['telef_usuari'] . "</td><td>" . $fila['rol'] . "</td><td>" . $fila['observacions'] . "</td>
          </tr>
        ";
   }
     echo "</table></form>";


///////////////////// fi de la taula d'usuaris /////////////////////////////
peu("");
