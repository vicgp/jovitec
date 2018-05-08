<?php

///////////////////////////////////////////////////////////////////////////
// capçalera del lloc, $titol de la pàgina.
////////////////////////////////////////////////////////////////////////////////
function capsalera ($titol){
  echo "

      <meta name='author' content='Xavier Morera'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <!--bootstrap -->

      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
      <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Allerta+Stencil'>
      <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css' integrity='sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd' crossorigin='anonymous'>
      <!--icons fontawesome -->
      <script src='https://use.fontawesome.com/210d3549a1.js'></script>

    <!--CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='../css/UserProfile.css'>
      <link href='../css/statproduct.css' rel='stylesheet' type='text/css'>
      <link rel='stylesheet' type='text/css' href='../css/jovitec.css'>
      <link rel='stylesheet' type='text/css' href='../css/boton.css'>
	  <link rel='stylesheet' type='text/css' href='../css/style.css'>
    <link rel='stylesheet' type='text/css' href='../css/navbar.css'>
    <link rel='stylesheet' type='text/css' href='../css/chat.css'>
    <link rel='stylesheet' type='text/css' href='../css/sidebar.css'>
    <link rel='stylesheet' type='text/css' href='../css/modal.css'>

<!--Perfil-->
<link rel='stylesheet' type='text/css' href='../css/perfil/normalize.css' />
    <link rel='stylesheet' type='text/css' href='../css/perfil/component.css' />
    <link rel='stylesheet' type='text/css' href='../css/perfil/common.css' />
    <link rel='stylesheet' type='text/css' href='../css/perfil/perfil.css' />
<script src='../js/perfil/custom-file-input.js'></script>
<script src='../js/perfil/jquery-v1.min.js'></script>
<script src='../js/perfil/jquery.custom-file-input.js'></script>


<!---->
    <!--JS -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>

    <script type='text/javascript' src='../js/modernizr.custom.79639.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <script src='../js/func_alta_user.js'></script>
    <script src='../js/func_alta_ot.js'></script>
    <script src='../js/sidebar.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script  src='../js/UserProfile.js'></script>




      <title>".$titol."</title>
    </head>
    <body>
    <!--<script>
    $(document).ready(function(){
          $(window).on('beforeunload', function(){
            alert('prova');
            $.ajax({url: '../back/Disconnect.php', success: function(result){
            }});
            return 'Are you sure you qant to quit';

          });
    });
    </script>-->
    ";


  //Si la variable de sessió està buida vol dir que no ens hem autenticat i ens
  // redirigeix a la pàgina de login
  if (!isset($_SESSION['usuari']))
  {
  // eliminem la sessió per si en teniem alguna d'activa
    session_destroy();
     /* ens en anem a la pàgina de login*/
    header("location: ../index.html");
  }
////////////////////////////////////////////////////////////////////////////////
// si estem autoritzats endavant, ara però hem de veure els rols
////////////////////////////////////////////////////////////////////////////////

//distribuim els botons comuns al lloc a la part superior

      //afegir botó de gestió d'usuaris si el rol és inferior a 5


  if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    echo '<nav class="navbar navbar-default navbar-fixed-top" style="margin-left:2px;">
      <div >

        <div class="navbar-header">
          <a class="navbar-brand" href="" style="width:70px;"><img src="../img/jv.png" style=" width: 140%; margin-left:-20%; margin-top: -20%;"></a>
          <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open('.$_SESSION['url'].')" style="display: inline-block;margin-top: -6%;padding-top: 11px;padding-bottom: 8px;">&#9776</button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar" >







          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="
    margin-left: -50%;
    margin-top: -13.8%;

    padding-top: 37%;
    padding-bottom: 10%;
    padding-right: 12%;



">
              <span id="notificacio" class="material-icons" style=" margin-bottom:  6%; padding-top: 20%; padding-bottom: 8%;font-s;font-size: 2em;">notifications</span>
            </a>
              <ul class="dropdown-menu" id="missatgeNous">

                <!-- crear tants <li><a href="#">Page 1-1</a></li> com missatges nous -->
              </ul>
          </li>
            <li><a href="../front/main.php" style="margin-bottom:  6%;padding-top: 9%;padding-bottom: 8%;margin-top: 6%;margin-left: -19%;">Ordres de treball</a></li>
            <li><a href="../front/usuaris.php" style="margin-bottom:  20%;padding-top: 17%;padding-bottom: 15%;margin-top: 11%;margin-left: -21%;">Usuaris</a></li>
            <li><a class="Img" style="margin-bottom:  20%;padding-top: 18%;padding-bottom: 19%;margin-top: 21%;margin-left: -20%;"></span></a></li>
            </li>
          </ul>
        </div>
      </div>
    </nav>';

  }
  if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 4){
    echo'<nav class="navbar navbar-default navbar-fixed-top" style="margin-left:2px;">
      <div >
        <div class="navbar-header">
          <a class="navbar-brand" href="" style="width:70px;"><img src="../img/jv.png" style=" width: 140%; margin-left:-5px; margin-top: -10px;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar" >

          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <span id="notificacio" class="glyphicon glyphicon-envelope" style="margin-bottom:  6%; padding-top: 6%; padding-bottom: 8%;color:#d5d5d5;">New Message</span>
            </a>
              <ul class="dropdown-menu" id="missatgeNous">

                <!-- crear tants <li><a href="#">Page 1-1</a></li> com missatges nous -->
              </ul>
          </li>

            <li><a href="../front/main.php" style="margin-bottom:  6%;padding-top: 9%;padding-bottom: 8%;margin-left: -13%;margin-top: 6%;">Ordres de treball</a></li>
            <li><a class="Img" style="margin-bottom:  20%;padding-top: 18%;padding-bottom: 19%;margin-top: 21%;margin-left: -20%;"></span></a></li>
          </ul>
        </div>
      </div>
    </nav>';
  };

    if ($_SESSION['rol'] == 5){
    echo'<nav class="navbar navbar-default navbar-fixed-top" style="margin-left:2px;">
      <div >
        <div class="navbar-header">
          <a class="navbar-brand" href="" style="width:70px;"><img src="../img/jv.png" style=" width: 140%; margin-left:-5px; margin-top: -10px;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar" >
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <span id="notificacio" class="glyphicon glyphicon-envelope" style="margin-bottom:  6%; padding-top: 6%; padding-bottom: 8%;color:#d5d5d5;">New Message</span>
            </a>
              <ul class="dropdown-menu" id="missatgeNous">

                <!-- crear tants <li><a href="#">Page 1-1</a></li> com missatges nous -->
              </ul>
          </li>
             <li><a href="../front/historial_comandes.php" style="margin-bottom: 6%; padding-top: 9%; padding-bottom: 15.825; margin-top: 3%; padding-bottom: 15px;">Historial de Comandes</a></li>
            <li><a href="../front/usuari.php" style="margin-bottom: 20%;padding-top: 18%; padding-bottom: 19.712; margin-top: 14%;padding-bottom: 13px;">'.$_SESSION["usuari"].'</a></li>
            </li>
            <li style="margin-right:11px"><a href="../back/logout.php" style="margin-bottom: 8.2;padding-top: 14.813;padding-bottom: 14.275;margin-top: 5px%;top: 27%;padding-bottom: 15.5;padding-bottom: 15.3;padding-bottom: 14px;padding-top: 35%;margin-top: -17%;"><span class="glyphicon glyphicon-log-out"></span></a></li>

          </ul>
        </div>
      </div>
    </nav>';


  };
   if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
  echo'<div class="ACon">
<div class="Profile" >
    <div class="overlay">

    </div>
</div>

<div class="clickPopUp">
<h4><a class="username" href="" style="margin-left: 10px;">'.$_SESSION["usuari"].'</a></h4>
<h5 class="buttons"><a class="username" href="../front/usuari.php">Perfil</a></h5>
<h5 class="buttons"><a class="username" href="">Activity</a></h5>
<h5 class="buttons"><a class="username" href="">Portfolio</a></h5>
<h5 class="buttons b"><a class="username" href="">Favorites</a></h5>
<div class="Social">
<a href="../back/logout.php" style="margin-left: 29%; padding:1px;">logout <span class="glyphicon glyphicon-log-out"  ></span></a>

</div>

</div>
</div>';
};
if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 4){
  echo'<div class="ACon">
<div class="Profile" >
    <div class="overlay">

    </div>
</div>

<div class="clickPopUp">
<h4><a class="username" href="" style="margin-left: 10px;">'.$_SESSION["usuari"].'</a></h4>
<h5 class="buttons"><a class="username" href="../front/usuari.php">Perfil</a></h5>
<h5 class="buttons"><a class="username" href="">Activity</a></h5>
<h5 class="buttons"><a class="username" href="">Portfolio</a></h5>
<h5 class="buttons b"><a class="username" href="">Favorites</a></h5>
<div class="Social">
<a href="../back/logout.php" style="margin-left: 29%; padding:1px;">logout <span class="glyphicon glyphicon-log-out"  ></span></a>

</div>

</div>
</div>';
};
if ($_SESSION['rol'] == 5){
  echo'<div class="ACon">
<div class="Profile" >
    <div class="overlay">

    </div>
</div>

<div class="clickPopUp">
<h4><a class="username" href="" style="margin-left: 10px;">'.$_SESSION["usuari"].'</a></h4>
<h5 class="buttons"><a class="username" href="../front/usuari.php">Perfil</a></h5>
<h5 class="buttons"><a class="username" href="">Dispositius</a></h5>
<h5 class="buttons"><a class="username" href="../front/historial_comandes.php">La teva Historia</a></h5>
<h5 class="buttons b"><a class="username" href="">DEMO</a></h5>
<div class="Social">
<a href="../back/logout.php" style="margin-left: 29%; padding:1px;">logout <span class="glyphicon glyphicon-log-out"  ></span></a>

</div>

</div>
</div>';
};


//       echo'

//     <div id=logoJovitec>
//       <img src="../img/jovitec.png" alt="Jovitec" class="jovitec"/>
//     </div>

// <!-- inici del cos de la pàgina -->

//   <div id="cos">

//   ';


} //fi_capsalera

// pàgina per posar les funcions d'us comú en tot el lloc
function chat(){
  echo "
  <div class='btnUsuario'>
		<button id='btnUser'><p style='margin: -10px 0 10px;'>ABRIR USUARIOS</p></button>
	</div>
  <div id='alertUser' style='display:none;width:30%;margin:auto;' class='alert alert-warning'>
    <strong>Warning!</strong> El client ja esta obert en el chat.
  </div>

	<div id='contenedor-usuaris'>
		<div id='minimizarInici'>
				<button id='buttonMinimitzar' onclick='minimizarInici()'></button>
		</div>
		<div id='users' class='w3-container'>
			<ul class='ul'>";
      if($_SESSION['rol']==3 || $_SESSION['rol']==4){
        	$user="SELECT * FROM usuaris WHERE id_usuari in(SELECT o.id_usuari FROM usuaris u , ordre_treball o, tecnics t WHERE t.id_ot=o.id_ot AND t.id_usuari=u.id_usuari AND u.id_usuari=".$_SESSION['id_user'].")";
      }
      else if($_SESSION['rol']==5){
        $user="SELECT * FROM usuaris WHERE id_usuari in(SELECT o.id_usuari FROM usuaris u , ordre_treball o, tecnics t WHERE t.id_ot=o.id_ot AND t.id_usuari=u.id_usuari AND u.id_usuari=4)";

      }
      else{
			     $user="SELECT * FROM usuaris WHERE id_usuari!=".$_SESSION['id_user'];
      }
      $ejecutar = consulta($user);
      $conentat="";
			while($fila = $ejecutar->fetch_array()){
        if($fila['Conectat']==1){
                $conentat="green";
               }
                else{
                  $conentat="white";
                }
				echo "<li><button class='li' onclick='abrir(".$_SESSION['id_user'].",".$fila['id_usuari'].")'>".$fila['nom_usuari']."
        <div style='margin-left: 92%;margin-top: -15%;'><span class='glyphicon glyphicon-user'style='margin-left:20%; color:".$conentat.";'></span><div>
        </button></li><br>";
			}

      echo "
		  </ul>
		</div>
	</div>

	<!--CHAT -->
  <!--chat 1 -->

	<div id='btnChat'>
		<img id='icon' src='../css/exit.ico'>
	</div>

			<div id='contenedor'>
				<div id='minimizar'>
					<input type='hidden' id='id_user1' value=''>
				</div>
				<span onclick='cerrar(2)' id='cerrar'><img id='icon' src='../css/exit.ico'></span>
				<div id='caja-chat'>
					<div id='chat1'></div>
				</div>
					<!--<input type='text' name='nombre' placeholder='Ingresa el nombre'>-->
					<textarea name='mensaje1'  id='textarea1' placeholder='Ingresa tu mensaje'></textarea>
					<button id='buttonEnviar' onclick='enviar(1,".$_SESSION['id_user'].")'>Enviar</button>
			</div>

  <!--chat 2 -->

	   <div id='btnChat1'>
				<img id='icon' src='../css/exit.ico'>
			</div>

					<div id='contenedor1'>
						<div id='minimizar1'>
							<input type='hidden' id='id_user2' value=''>

						</div>
						<span onclick='cerrar(3)' id='cerrar'><img id='icon' src='../css/exit.ico'></span>
						<div id='caja-chat'>
							<div id='chat2'></div>
						</div>
						<textarea name='mensaje2'  id='textarea2' placeholder='Ingresa tu mensaje'></textarea>
						<button id='buttonEnviar1' onclick='enviar(2,".$_SESSION['id_user'].")'>Enviar</button>
					</div>
<!--chat 3 -->
	        <div id='btnChat2'>
						<img id='icon' src='../css/exit.ico'>
					</div>

							<div id='contenedor2'>
								<div id='minimizar2'>
									<input type='hidden' id='id_user3' value=''>

								</div>
								<span onclick='cerrar(4)' id='cerrar'><img id='icon' src='../css/exit.ico'></span>
								<div id='caja-chat'>
									<div id='chat3'></div>
								</div>
								<textarea name='mensaje3'  id='textarea3' placeholder='Ingresa tu mensaje'></textarea>
								<button id='buttonEnviar2' onclick='enviar(3,".$_SESSION['id_user'].")'>Enviar</button>
							</div>
              <script src='../js/chat.js'></script>";

}
/////
////////////////////////////////////////////////////////////////////////////////
//peu de pàgina del lloc
////////////////////////////////////////////////////////////////////////////////
function peu ($msg){
  echo "
    </div><!--/cos-->

    <footer style='z-index:-999;'>
      <hr />
      Jovitec.0.5.1
      ".$msg."
    </footer>
  </body>
</html>
";
}//fi_peu

function formatearFecha($fecha){
  return date('g:i a', strtotime($fecha));

}
////////////////////////////////////////////////////////////////////////////////
//funció per connectar a la base de  dades, $query es paràmetre d'entrada
////////////////////////////////////////////////////////////////////////////////
function consulta($query){
  require 'config.php';
  $connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
  $connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
//   if ($connection->connect_error) die ($connection->error);
//
//   $resultat=$connection->query($query);
//   if(!$resultat) die ($connection->error);
//   $connection->close();
//    return $resultat;
// }
// Check connection
  if (!$connection) {
      die("Error de connexió: " . mysqli_connect_error());
  }
  $result=$connection->query($query);
  if (!$result){
      die("Error en la consulta: ".$connection->error);
  }
  else{
    return($result);
  }
}

////////////////////////////////////////
// funció de control
//////////////////////////////////////
function test(){
  echo "hi world!";
}

function conversor_segons_a_hores_minuts($temps_en_segons) {
    $hores = floor($temps_en_segons / 3600);
    $minuts = floor(($temps_en_segons - ($hores * 3600)) / 60);


    return $hores.'h:' .$minuts.'m';
}

function fletxes($columna, $pagina){
  echo "
  <span class='fletxes' title='ordena AZ' onclick=document.getElementById('ordre_up').submit();>&uarr;</span>
  <span class='fletxes' title='ordena ZA' onclick=document.getElementById('ordre_down').submit();>&darr;</span>
<form id='ordre_up' method=POST action=".$pagina.".php>
 <input type=hidden name=columna value=".$columna." />
  <input type=hidden name=ordre value=ASC />
</form>
<form id='ordre_down' method=POST action=".$pagina.".php>
  <input type=hidden name=columna value=".$columna." />
  <input type=hidden name=ordre value=DESC />
</form>
";

}
