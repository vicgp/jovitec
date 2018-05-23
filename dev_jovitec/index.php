<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require("php/funcions.php");

?>

  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Jovitec</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <script type="text/javascript" src="js/passwd.js"></script>
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link href="css/style2.css" rel="stylesheet" type="text/css">
  <link href="css/login.css" rel="stylesheet" type="text/css">
  <link href="css/stgall.css" rel="stylesheet" type="text/css">
<script src="js/script.js"></script>


</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href=""><img src="img/jv.png" style="width: 7%; margin-top: -10px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myPage">INICI</a></li>
        <li><a href="#band">EQUIP</a></li>
        <li><a href="#tour">GALERIA</a></li>
        <li><a href="#contact">CONTACTE</a></li>
        </li>
        <li><a href="#" onclick="document.getElementById('id01').style.display='block'"><span class="glyphicon glyphicon-log-in" ></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<script type="text/javascript">
  function login(){

    document.getElementById('login-form').style.display='block';
    document.getElementById('pepe').style.display='none';


  }
  function register(){
    document.getElementById('pepe').style.display='block';
    document.getElementById('login-form').style.display='none';
    document.getElementById('carousel').style.display='none';
  }
  function validar(){
    var p1 = document.getElementById("pwd").value;

    var p2 = document.getElementById("pwd2").value;
    var espacios = false;
    var cont = 0;

while (!espacios && (cont < p1.length)) {
  if (p1.charAt(cont) == " ")
    espacios = true;
  cont++;

}

if (espacios) {
  alert ("La contraseña no puede contener espacios en blanco");
  return false;
}
if (p1.length == 0 || p2.length == 0) {
  alert("Los campos de la password no pueden quedar vacios");
  return false;
}
if (p1 != p2) {
  alert("Las passwords deben de coincidir");
  return false;
} else {
  alert("Todo esta correcto");
  return true;
}
  }
</script>
<div id="id01" class="modal">
  <form class="modal-content animate" method="POST" action="back/authorize.php" style="margin-top: -2px;padding-right: 7px;border-left-width: 1px;padding-left: 7px;">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" >&times;</span>
      <img src="img/logo.png"  alt="Avatar" class="avatar" style="width: 25%;">
    </div>
    <style type="text/css">





    </style>

    <div class="btn-group btn-group-justified" role="group"  >

  <div class="btn-group" role="group" >
    <button id="b1" type="button" class="btn btn-default" href="#login-form" onclick="login()"> Login <span class="glyphicon glyphicon-user"></span></button>
  </div>

  <div class="btn-group" role="group">
    <button id="b2" type="button" class="btn btn-default" href="#pepe" onclick="register()"> Register<span class="glyphicon glyphicon-pencil"></span>
    </button>
  </div>
</div>

      <div class="tab-content" style="margin-top: 12px;">

      <div class="tab-pane fade active in" id="login-form">

      <label><b>Nom d'usuari</b></label><br>
      <input type="text" placeholder="Enter Username" name="uname" id="uname" required><br><br>

      <label><b>Contrasenya</b></label><br>
      <input type="password" placeholder="Enter Password" name="psswd" id="psswd" required><br>
      <label><b>Curs</b></label><br>

        <select name=curs_actual>
<?php
    $query_curs_escolar="SELECT * FROM curs_escolar";
    $resultat_curs_escolar=consulta($query_curs_escolar);
    while($curs_escolar=$resultat_curs_escolar->fetch_assoc()){
      echo "<option value=".$curs_escolar['id_curs'].">".$curs_escolar['curs']."</option>";
    }
?>
    </select>
    <button type="submit">Login</button>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>


      <!-- <label>
        <input type="checkbox" checked="checked"> Remember me
      </label> -->
      <!-- <div id="registration-form" class="tab-pane fade">
         <form action="/">
                         <div class="form-group">
                                <label for="name">Your Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                         </div>
                         <div class="form-group">
                                <label for="newemail">Email:</label>
                                <input type="email" class="form-control" id="newemail" placeholder="Enter new email" name="newemail">
                        </div>
                         <div class="form-group">
                               <label for="newpwd">Password:</label>
                               <input type="password" class="form-control" id="newpwd" placeholder="New password" name="newpwd">
                        </div>
                    <button type="submit" class="btn btn-default">Register</button>
          </form>
    </div> -->

</div>
<style></style>
</form>
<div id="pepe" style="display: none;" >
      <form action="back/registrar.php" method="POST">
                        <br><div id="NameForm" class="form-group  has-feedback">

                                <label class="control-label" for="nom">Nom:</label>
                                <input type="text" class="form-control" id="nom" placeholder="Enter your name" name="Names" required>
                                <i id="NameIcon" class="material-icons form-control-feedback"  aria-hidden="true">done</i>
                                <!-- <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span> -->
                                <!-- <span id="inputSuccess2Status" class="sr-only">(success)</span> -->
                         </div>


                         <div id="emailForm" class="form-group has-feedback">
                                <label  class="control-label" for="newemail">Email:</label>
                                <div class="input-group">
                                  <span class="input-group-addon">@</span>
                                  <input type="email" class="form-control" id="newemail" placeholder="Enter new email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                              </div>
                                <i id="emailIcon" class="material-icons form-control-feedback">highlight_off</i>
                        </div>

                         <div id="usernameForm" class="form-group  has-feedback">
                                <label class="control-label" for="username">Nom d'usuari:</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter your username" name="usname" required>
                                <i id="usernameIcon" class="material-icons form-control-feedback"  aria-hidden="true">done</i>

                         </div>

                         <div class="form-group  has-feedback">
                               <label class="control-label" for="newpwd">Password:</label>
                               <input type="password" class="form-control" id="password" placeholder="New password" name="pwd" required>
                                <div class="pwstrength_viewport_progress"></div>
                                <i class="material-icons form-control-feedback"  aria-hidden="true">done</i>

                        </div>
                        <input type="hidden" id="hidenValue" value="">
                        <div class="form-group">
                        <button id="botoRegistrar" type="submit"  style="background-color:#2196F3;">Registrar-se</button>

          </form>
        </div>

     <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>

   </div>

</div>
</div>
</div>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators" id="carousel">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/pd.png" alt="New York" width="1200" height="700">
        <div class="carousel-caption">
          <h3 style="color:white;">Hardware</h3>
          <p>Ajudem a buscar el component que necessitis</p>
        </div>
      </div>

      <div class="item">
        <img src="img/xat.jpg" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Servei Tècnic</h3>
          <p>La millor manera de contactar amb el soport Tènic a través del xat!</p>
        </div>
      </div>

      <div class="item">
        <img src="img/ss.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3 id="co">Tècnics</h3>
          <p style="color:black;">Confia amb els tècnics de l'escola Joviat!</p>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The Band Section) -->
<div id="band" class="container text-center">
  <h3 style="color: black;">Taller de manteniment informàtic Jovitec</h3>
  <p><em>(projecte de simulació)</em></p>
  <p>L’objectiu de Taller Joviat (Jovitec) és proporcionar un marca on els alumnes assoleixin de forma significativa els resultats d’aprenentatge marcats al mòduls Aula-Empresa de segon curs del cicle MGADM i M12 dels alumnes de MSMIX-2 .. Per tal d’aconseguir aquest objectiu, es pretén envoltar a l’alumne d’un entorn professionalitzador, similar al que es pot trobar en el món laboral, la qual cosa inclou tant les activitats a realitzar, l’actitud a adoptar i la forma d’avaluar.</p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>Xavier Morera</strong></p><br>
      <a href="#demo" data-toggle="collapse">
       <img src="img/sx.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo" class="collapse">
        <p>Guitarist and Lead Vocalist</p>
        <p>Loves long walks on the beach</p>
        <p>Member since 1988</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Sergi Sercós</strong></p><br>
      <a href="#demo2" data-toggle="collapse">
        <img src="img/sx.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo2" class="collapse">
        <p>Drummer</p>
        <p>Loves drummin'</p>
        <p>Member since 1988</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Josep Farreny</strong></p><br>
      <a href="#demo3" data-toggle="collapse">
        <img src="img/sx.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo3" class="collapse">
        <p>Bass player</p>
        <p>Loves math</p>
        <p>Member since 2005</p>
      </div>
    </div>
  </div>
</div>

<!-- Container (TOUR Section) -->
<div id="tour" class="bg-1">
  <div class="container">
    <h3 class="text-center">Galeria</h3>
    <div class="gallery cf">
  <div>
    <img src="img/xavi.jpg" />
  </div>
  <div>
    <img src="img/as.jpg" />
  </div>
  <div>
   <img src="img/2014s.jpg" />
  </div>
  <div>
    <img src="img/ed.jpg"/>
  </div>
  <div>
    <img src="img/we.jpg" />
  </div>
  <div>
    <img src="img/sa.jpg" />
  </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Tickets</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Tickets, $23 per person</label>
              <input type="number" class="form-control" id="psw" placeholder="How many?">
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Send To</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
              <button type="submit" class="btn btn-block">Pay
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container">
  <h3 class="text-center" style="color: black;">Contacta</h3>

  <div class="row">
    <div class="col-md-4">
      <p>Contacta'ns</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Joviat</p>
      <p><span class="glyphicon glyphicon-phone"></span>938 75 41 78</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: xmorera@joviat.com</p>
    </div>
    <form action="php/contacte.php" method="POST">
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Nom" type="text" required>
        </div>
        <div class="col-sm-6 form-group" style="    margin-top: 8px;">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Missatge" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="button3" type="submit" >Enviar</button>
        </div>
      </div>
    </div>
  </form>
  </div>

</div>

<!-- Add Google Maps -->
<div id="googleMap" >
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1770.6972418506787!2d1.8156190111128176!3d41.72168566558437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4586c1ea567d9%3A0xe83a8c8885eb82dc!2sEscola+Joviat!5e0!3m2!1ses!2ses!4v1517235070235" width="1519" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script></div>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Jovitec by<a href="https://www.joviat.com" data-toggle="tooltip" title="jovia.com"> www.joviat.cat</a></p>
</footer>
<!-- <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script> -->
<script src="js/registrar.js"></script>

</body>
</html>
