<?php
session_start();
include("../php/funcions.php");
capsalera('Avaluació');
chat();


$host = 'localhost';
$basededatos = 'dev_jovitec';
$usuario = 'root';
$contraseña = '';



$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno() 
. ") " . $conexion -> mysqli_connect_error());
}
  ///////////////////CONSULTA DE LOS ALUMNOS///////////////////////

$alumnos="SELECT * FROM avaluacio";
$queryAlumnos= $conexion->query($alumnos);


?>

<html lang="es">

  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" type="text/css" href="css/avaluacio.css">

    <!--<link rel="stylesheet" href="css/estilos.css" rel="stylesheet">-->
    
    <!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <!-- Optional theme 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

    <script>
        $(function(){
        // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
        $("#adicional").on('click', function(){
          $("#tabla:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
        });
       
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar",function(){
          var parent = $(this).parents().get(0);
          $(parent).remove();
        });
      });

    /*  function loadDrop(){
      var drop="";
      for(var i=0;i<productes_client.length;i++){
        var marca=productes_client[i][1].split(",");
        drop+="<option value='"+productes_client[i][0]+"'>"+productes_client[i][0]+" -- "+marca[0]+"</option>"
      }
      $("#inventari")[0].innerHTML=drop;
    }
    function addInventari(a){
      if(productes_client.length<=1){
        document.getElementById('modalProduct').style.display='block';

        if(a==1){
          document.getElementById('tipusProduct').value="portatil";
        }
        else if(a==2){
          document.getElementById('tipusProduct').value="movil";
        }
        else if(a==3){
          document.getElementById('tipusProduct').value="tablet";
        }
        else if(a==4){
        document.getElementById('tipusProduct').value="PC Torre";
        }
      }
      else{
        $("#MaximProduct")[0].style.display="block";
        setTimeout(clearAlertProduct,4000);
      }
    }*/
    </script>
  </head>
  <style type="text/css">
    #tota_avaluacio{
      margin-top: 50px;
    }
    #tabla, #titol{
      background-color: rgba(0,0,0,0) !important;
      margin-bottom: 10px;
    }

    #botones, #menos {
      margin-bottom: 20px;
    }
    select, input, #botones {
      width: 30%;
      margin-left: 35%;
      color: black;
    }
  </style>
  <body>
    <div id="tota_avaluacio">
      <h3 id="titol" class="bg-primary text-center pad-basic no-btm">Agregar Nova Nota </h3>
      <div class="table bg-info" id="tabla">
        <div class="fila-fija">
          
          <input type="hidden" name="id_usuari[]" value="1"/>
          <input required name="nombre[]" id="Nombre" value=<?php echo $_POST['nom'] ?> disabled/>
          <input required name="ot[]" id="OrdreT" value=<?php echo $_POST['ot'] ?> disabled/>
          <?php

          echo "<select required name='competencia[]'' placeholder='Competencia'>";
            $competencia = "SELECT * FROM competencia";
            $resultat_competencia=consulta($competencia);
              // echo "ordres de treball:";
                      
          while ($competencies=$resultat_competencia->fetch_assoc()){
                echo "<option>".$competencies['competencia']."</option>";
          }
          echo "</select>";
          
            $nota = "SELECT id, nota FROM valoracio";
            $resultat_nota=consulta($nota);
              // echo "ordres de treball:";
                      
          echo"<select required name='nota[]' placeholder='Nota'>";
          while ($notas=$resultat_nota->fetch_assoc()){
                echo "<option>".$notas['nota']."</option>";
          }
          echo "</select>";
            ?>
         <input type="button" id="menos" class="eliminar" value="Menys -"/></td>
        </div>
      </div>
      <div id="botones" class="btn-der">
        <button id="insertar" name="insertar" type="submit" class="btn btn-info"> Insertar Nota </button>
        <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Més + </button>
        <a href="ot.php"><button id="cancelar" name="cancelar" class="btn btn-delete"> Cancel·lar </button></a>
      </div>
    </div>
    <?php
      //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
      if(isset($_POST['insertar'])){

        $items1 = ($_POST['id_usuari']);
        $items2 = ($_POST['nombre']);
        $items3 = ($_POST['ot']);
        $items4 = ($_POST['competencia']);
        $items5 = ($_POST['nota']);
         
        ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);
            $item5 = current($items5);
            
            ////// ASIGNARLOS A VARIABLES ///////////////////
            $id_usuari = $item1;
            $nombre = $item2;
            $ot = $item3;
            $competencia = $item4;
            $nota = $item5;

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='(null,'.$id_usuari.',"'.$nombre.'","'.$ot.'","'.$competencia.'","'.$nota.'")';
            
            ///////// QUERY DE INSERCIÓN ////////////////////////////
            $sql = "INSERT INTO avaluacio (id_avaluacio, id_usuari, nom, numero_ot, id_competencia, id_nota) 
          VALUES $valores";

          
          $sqlRes=$conexion->query($sql) or mysql_error();

            
            // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );
            $item5 = next( $items5 );
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false) break;
    
        }
    
        }

      ?>
    </section>

    <footer>
    </footer>
  </body>
</html>


<?php
  peu("");
?>