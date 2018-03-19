
<?php
session_start();
include("../php/funcions.php");
capsalera("modificar usuari");
chat();?>


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
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<div class="jquery-script-clear"></div>
</div>

<div class="container">
<h1>Informació del teu Dispositiu</h1>
<div id="myGoal"></div>
<!-- <div id="user" style="display: none;"> --> <!-- en procés para los roles-->
<span class="btn btn-primary" id="get-current-value-btn" style="float: left;margin-top: 3.36%;" onclick="desc2()">Recollit</span><br>
        <span class="btn btn-primary" id="set-current-value-btn" style="float: left;margin-left: 31%; margin-top: 1.3%;"onclick="desc()" >En Procés</span><br>
        <span class="btn btn-primary" id="find-step-btn" style="float: left;margin-left: 69%;margin-top: -4.4%;" onclick="intro()">Pendent d'entrega</span><br>
        <span class="btn btn-primary" id="remove-step-btn" style="float: left;margin-left: 92%;margin-top: -4.3%;" onclick="desc3()">Entregat</span>
        </div>

<script src="http://code.jquery.com/jquery-1.12.2.min.js"></script>
<script src="../js/statproduct.js"></script>
<script>
$('#myGoal').stepProgressBar({
  currentValue: 10,
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
  function intro() {

  document.getElementById("foto").style.display="block";

 }
 function desc(){
  document.getElementById("foto").style.display="none";
 }
 function desc2(){
  document.getElementById("foto").style.display="none";
 }
 function desc3(){
  document.getElementById("foto").style.display="none";
 }
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<div id="foto" style="display: none;"><img src="../img/dis.png" style="margin-left: 15%; float: left;" />
  <p class="w3-xlarge">El teu dispositiu ja està arreglat!</p>
  <p class="w3-xlarge">Rebràs un Email confirmant que ja està apunt per recollir.</p>
</div>

<?php

peu("");?>