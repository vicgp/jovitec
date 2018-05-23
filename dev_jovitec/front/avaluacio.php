<?php
session_start();
include("../php/funcions.php");
capsalera('Avaluació');
chat();
?>
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
<?php

$quiAvaluem=$_GET['quiAvaluem'];
$idot=$_GET['id_ot'];

if(isset($_GET['idUser'])){
  $idUser=$_GET['idUser'];
  $sql="SELECT username_usuari FROM usuaris WHERE id_usuari=".$idUser;
  $resNomUser=consulta($sql);
  $fila_ot_res=$resNomUser->fetch_assoc();
  $nom=$fila_ot_res['username_usuari'];

}
else{
  if($quiAvaluem==1){
      $sql="SELECT username_usuari,usuaris.id_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$idot;
  }
  else{
    $sql="SELECT username_usuari,usuaris.id_usuari FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE administratius.id_ot=".$idot;
  }
  $res=consulta($sql);
  $fila_ot_res=$res->fetch_assoc();
  $nom=$fila_ot_res['username_usuari'];
  $idUser=$fila_ot_res['id_usuari'];
}

?>




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
