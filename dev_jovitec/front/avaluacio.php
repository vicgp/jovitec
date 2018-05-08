<?php
session_start();
include("../php/funcions.php");
capsalera('Avaluació');
chat();

//
// $host = 'localhost';
// $basededatos = 'dev_jovitec';
// $usuario = 'root';
// $contraseña = '';



// $conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
// if ($conexion -> connect_errno) {
// die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno()
// . ") " . $conexion -> mysqli_connect_error());
// }
  ///////////////////CONSULTA DE LOS ALUMNOS///////////////////////

$quiAvaluem=$_POST['QuiAvaluem'];
$idot=$_POST['id_ot'];
if($quiAvaluem==1){
  $numTecnics="SELECT COUNT(*) a,username_usuari,usuaris.id_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$idot;

}
else {
  $numTecnics="SELECT COUNT(*) a,username_usuari,usuaris.id_usuari FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE administratius.id_ot=".$idot;
}
  $res=consulta($numTecnics);
?>

<div id='id01' class='w3-modal' style='display:none;'>
  <div class='w3-modal-content'>
    <div class='w3-container'>
      <span onclick='document.getElementById('id01').style.display='none'' class='w3-button w3-display-topright'>&times;</span>
      <p>Some text. Some text. Some text.</p>
      <p>Some text. Some text. Some text.</p>
    </div>
  </div>
</div>

<html lang="es">

  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" type="text/css" href="../css/avaluacio.css">

    <!--<link rel="stylesheet" href="css/estilos.css" rel="stylesheet">-->

    <!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <!-- Optional theme
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
    <script type="text/javascript" src="../js/avaluar.js"></script>



  </head>

  <body>
    <div class="w3-container" >
      <h2>Competencies Avaluades</h2>
      <ul class="w3-ul w3-card-4" id="llistaCompetencies">
      </ul>
    </div>
    <div id="tota_avaluacio">
      <h3 id="titol" class="bg-primary text-center pad-basic no-btm">Agregar Nova Nota </h3>
      <div class="table bg-info" id="tabla">
        <div class="fila-fija">

          <input type="hidden" id="id_usuari" name="id_usuari" value="1"/>
          <input required name="nombre" id="Nombre" value=<?php echo $nom ?> disabled/>
          <input required name="ot" id="OrdreT" value=<?php echo $idot ?> disabled/>
          <input type='hidden'  name='id' value=<?php echo $idUser ?> />

          <?php

          echo "<select id='competencia' required name='competencia[]'' placeholder='Competencia'>";

            $competencia = "SELECT * FROM competencia";
            $resultat_competencia=consulta($competencia);
              // echo "ordres de treball:";

          while ($competencies=$resultat_competencia->fetch_assoc()){
                echo "<option value='".$competencies['id_competencia']."/".$competencies['competencia']."'>".$competencies['competencia']."</option>";
          }
          echo "</select>";

            $nota = "SELECT id, nota FROM valoracio";
            $resultat_nota=consulta($nota);
              // echo "ordres de treball:";

          echo"<select required name='nota[]' id='nota' placeholder='Nota'>";
          while ($notas=$resultat_nota->fetch_assoc()){
                echo "<option value='".$notas['id']."/".$notas['nota']."'>".$notas['nota']."</option>";
          }
          echo "</select>";
            ?>
        </div>
      </div>
      <div id="botones" class="btn-der">
        <button id="insertar" name="insertar" type="submit" class="btn btn-info"> Insertar Nota </button>
        <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Més + </button>
        <a href="main.php"><button id="cancelar" name="cancelar" class="btn btn-delete"> Cancel·lar </button></a>
      </div>
    </div>


    <footer>
    </footer>
  </body>
</html>


<?php
  peu("");
?>
