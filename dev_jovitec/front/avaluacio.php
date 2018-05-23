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
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal, .modalOt {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content, .modal-content-ot {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 45%;
    height: 50%;
}

/* The Close Button */
.close, .closeOt {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus,
.close:hover,
.close:focus{
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

#crear_competencia{
  height: 10%;
  width: 50%;
  margin-left: 25%;
  margin-top: 5%;
}

#insertar_modal{
  margin-left: 35%;
  margin-top: 10%;
}


</style>


  </head>

  <body>
    <?php

    $quiAvaluem=$_GET['quiAvaluem'];
    $idot=$_GET['id_ot'];
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
          <input required name="ot" id="OrdreT" value="<?php echo $idot ?>">

          <div id="myModalOt" class="modalOt">
            <!-- Modal content -->
            <div class="modal-content-ot">
              <span class="closeOt">&times;</span>
            </div>
          </div>
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
        <button id="afegir" name="afegir" type="submit" class="btn btn-info"> Afegir Competencia</button>
        <!-- The Modal -->
        <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Crear les competencies per poder avaluar</h1>
              <input type="text"  id="crear_competencia" name="crear_competencias">
              <br>
            <button id="insertar_modal" name="insertar_modal" type="submit" class="btn btn-info"> Afegir Competencia
          </button>
          </div>

        </div>
        <button id="insertar" name="insertar" type="submit" class="btn btn-info"> Insertar Nota </button>
        <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Més + </button>
        <a href="main.php"><button id="cancelar" name="cancelar" class="btn btn-delete"> Cancel·lar </button></a>
      </div>
    </div>
    <script type="text/javascript" src="../js/afegircompetencia.js"></script>
    <script>
    // Get the modal
    var modal = document.getElementById('myModal');
    var modalOt = document.getElementById('myModalOt');

    // Get the button that opens the modal
    var btn = document.getElementById("afegir");
    var btnOt = document.getElementById("OrdreT");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var spanOt = document.getElementsByClassName("closeOt")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }
    btnOt.onclick = function() {
        modalOt.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    spanOt.onclick = function() {
        modalOt.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    window.onclick = function(event) {
        if (event.target == modalOt) {
            modalOt.style.display = "none";
        }
    }
    </script>
  </body>
</html>


<?php
  peu("");
?>
