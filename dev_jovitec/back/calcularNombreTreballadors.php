<?php
session_start();
include("../php/funcions.php");

?>

<?php

$quiAvaluem=$_POST['QuiAvaluem'];
$idot=$_POST['id_ot'];
if($quiAvaluem==1){
  $num="SELECT COUNT(*) a FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$idot;
  $alumnes="SELECT username_usuari,usuaris.id_usuari FROM usuaris INNER JOIN tecnics ON usuaris.id_usuari=tecnics.id_usuari WHERE tecnics.id_ot=".$idot;
}
else {
  $num="SELECT COUNT(*) a FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE administratius.id_ot=".$idot;
  $alumnes="SELECT username_usuari,usuaris.id_usuari FROM usuaris INNER JOIN administratius ON usuaris.id_usuari=administratius.id_usuari WHERE administratius.id_ot=".$idot;
}
$numid=0;
$res=consulta($num);
$fila_ot_res=$res->fetch_assoc();
$numFinal=12/$fila_ot_res['a'];

// $nom=$fila_ot_res['username_usuari'];
// $idUser=$fila_ot_res['id_usuari'];
  if($fila_ot_res['a']>1){
    ?>
    <html lang="es">
      <head>
    <?php
    capsalera('Avaluació');
    chat();
    ?>

        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link rel="stylesheet" type="text/css" href="../css/avaluacio.css">
        <script type="text/javascript" src="../js/avaluar.js"></script>


        <!--<link rel="stylesheet" href="css/estilos.css" rel="stylesheet">-->

        <!-- Latest compiled and minified CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
        <!-- Optional theme
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
        <script type="text/javascript" src="../js/redireccioAvaluar.js"></script>



      </head>

      <body>
    <div class='panel panel-default' style='height:40%;width:65%;position:relative;top:30%;left:20%;'>
      <input type="hidden" id='quiAvaluem' value=<?php echo $quiAvaluem ?>>
      <input type="hidden" id='idot' value=<?php echo $idot ?>>
      <div class='panel-heading' style='text-align:center'>Tria Alumne a avaluar</div>
      <div class='panel-body'>
        <div class="row">
          <?php
          $res1=consulta($alumnes);
          while($fila_ot_res1=$res1->fetch_assoc()){
          echo '<div class="col-sm-'.$numFinal.'" id="'.$numid.'" >'
          ?>
            <div class='panel-heading' ><?php echo $fila_ot_res1['username_usuari'] ?></div>
            <div class='panel-body' disabled='disabled'>
              <input type="hidden" id='usuari' value=<?php echo $fila_ot_res1['id_usuari'] ?>>
              <i class="material-icons" style='font-size: 8em;text-align:center' disabled>account_box </i>
            </div>
        </div>
        <?php
        $numid+=1;
      } ?>

        </div>

      </div>
    </div>

  </body>
</html>


<?php

  peu("");
}
else{
  header('Location:../front/avaluacio.php?id_ot='.$idot.'&quiAvaluem='.$quiAvaluem);
}
?>
