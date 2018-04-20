<html>
  <head>
    <link  rel='stylesheet' type='text/css' href='src/css/jquerysctipttop.css'>
      <link  rel='stylesheet' type='text/css' href='../css/statproduct.css'>
<?php
session_start();
include("../php/funcions.php");
capsalera("modificar usuari");
chat();
$sql="SELECT id_ot,id_estat FROM ordre_treball WHERE id_usuari=".$_SESSION['id_user']." AND id_estat!=4  LIMIT 1";
$result=consulta($sql);
$comanda=$result->fetch_assoc();

if($comanda['id_estat']==2){
   $percentatge=500;
}
else if($comanda['id_estat']==3){
   $percentatge=800;
}
else{
  $percentatge=1200;
}

?>


<div id="jquery-script-menu">
<div class="jquery-script-center">
<div class="jquery-script-ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
</div>
</script></div>
<div class="jquery-script-clear"></div>
</div>

<div class="container" style="margin-top: 100px;">
<h2>Informació del teu Dispositiu</h2>
<div id="myGoal"></div>
<!-- <div id="user" style="dis'play: none;"> --> <!-- en procés para los roles-->
<?php if($_SESSION['rol']<=3){?>
    <span class="btn btn-primary" id="get-current-value-btn" style="float: left;margin-top: 3.36%;" onclick="bot1()">Recollit</span><br>
        <span class="btn btn-primary" id="set-current-value-btn" style="float: left;margin-left: 31%; margin-top: 1.3%;"onclick="bot2()" >En Procés</span><br>
        <span class="btn btn-primary" id="find-step-btn" style="float: left;margin-left: 69%;margin-top: -4.4%;" onclick="bot3()">Pendent d'entrega</span><br>
        <span class="btn btn-primary" id="remove-step-btn" style="float: left;margin-left: 92%;margin-top: -4.3%;" onclick="bot4()">Entregat</span>
        </div>
<?php }

?>

<script src="../js/statproduct.js"></script>
<script>

$('#myGoal').stepProgressBar({
  currentValue: <?php echo $percentatge ?>,
  steps: [
    { value: 100,
    topLabel: 'Recollit',
    bottomLabel: '<i class="material-icons">transfer_within_a_station</i>' },

    {
      topLabel: 'Procés',
      value: 500,
      bottomLabel: '<i class="material-icons">build</i>'
    },
    {
      topLabel: 'Pendent Entregat',
      value: 800,
      bottomLabel: '<i class="material-icons">notifications_active</i>'

    },

    {
      topLabel: 'Entregat',
      value: 1000,
      bottomLabel: '<i class="material-icons">done</i>',
      mouseOver: function() { alert('mouseOver'); },
      click: function() { alert('click'); }
    }
  ],
  unit: '$'
});


        $('#get-current-value-btn').click(function() {
          $('#myGoal').stepProgressBar('setCurrentValue', 100);
        });
        $('#set-current-value-btn').click(function() {
          $('#myGoal').stepProgressBar('setCurrentValue', 500);
        });
        $('#find-step-btn').click(function() {
          $('#myGoal').stepProgressBar('setCurrentValue', 800);
        });
        $('#remove-step-btn').click(function() {
          $('#myGoal').stepProgressBar('setCurrentValue', 1000);
          alert("Finalitzat");
        });
</script>
<script type="text/javascript">

  function bot1() {
  document.getElementById("foto").style.display="none";
  $sql="UPDATE ordre_treball SET id_estat=1 WHERE id_ot=".$comanda['id_ot'];
  consulta($sql);
 }
 function bot2(){
  document.getElementById("foto").style.display="none";
  $sql="UPDATE ordre_treball SET id_estat=2 WHERE id_ot=".$comanda['id_ot'];
  consulta($sql);

 }
 function bot3() {
 document.getElementById("foto").style.display="block";
 $sql="UPDATE ordre_treball SET id_estat=3 WHERE id_ot=".$comanda['id_ot'];
 consulta($sql);

}
function bot4() {
document.getElementById("foto").style.display="none";
$sql="UPDATE ordre_treball SET id_estat=4 WHERE id_ot=".$comanda['id_ot'];
consulta($sql);

}

</script>

<?php if($_SESSION['rol']==5 && $percentatge==800){?>
  <div id="foto1" style="display: block;"><img src="../img/dis.png" style="margin-left: 15%; float: left;" />
    <p class="w3-xlarge">El teu dispositiu ja està arreglat!</p>
    <p class="w3-xlarge">Rebràs un Email confirmant que ja està apunt per recollir.</p>
  </div>
<?php }
else{?>
<div id="foto" style="display: none;"><img src="../img/dis.png" style="margin-left: 15%; float: left;" />
  <p class="w3-xlarge">El teu dispositiu ja està arreglat!</p>
  <p class="w3-xlarge">Rebràs un Email confirmant que ja està apunt per recollir.</p>
</div>
<?php }?>


</div>




<?php

peu("");?>
