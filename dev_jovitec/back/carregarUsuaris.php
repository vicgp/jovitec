<?php
session_start();
include("../php/funcions.php");

$qwery="SELECT id_usuari, nom_usuari, cognoms_usuari, email_usuari, rol_usuari, telef_usuari, observacions, rols.rol FROM usuaris INNER JOIN rols ON usuaris.rol_usuari=rols.id_rol ORDER BY usuaris.id_usuari DESC";
$resultat= consulta($qwery);
echo "
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
        <th>
          Editar Usuari
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
     <tr title='doble click per modificar usuari'>
         <input type='hidden' name='altauser' value='False' />
       <td>". $fila['nom_usuari'] . "</td>
       <td>" . $fila['cognoms_usuari'] . "</td>
       <td>" . $fila['email_usuari'] . "</td>
       <td>" . $fila['telef_usuari'] . "</td>
       <td>" . $fila['rol'] . "</td>
       <td>" . $fila['observacions'] . "</td>
       <td  class='user'>
           <input type='hidden' class='id_usuari' value='".$fila['id_usuari']."'>
           <i class='material-icons'>edit</i>
       </td>
     </tr>
        ";
   }
     echo "</table>
     </form>";
