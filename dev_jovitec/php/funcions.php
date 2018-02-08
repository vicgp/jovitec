<?php
// pàgina per posar les funcions d'us comú en tot el lloc

////////////////////////////////////////////////////////////////////////////////
// capçalera del lloc, $titol de la pàgina.
////////////////////////////////////////////////////////////////////////////////
function capsalera ($titol){
  echo "
  <!DOCTYPE html>
  <html>
    <head>
      <meta name='author' content='Xavier Morera'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
      <link rel='stylesheet' type='text/css' href='../css/jovitec.css'>
      <link rel='stylesheet' type='text/css' href='../css/boton.css'>
	  <link rel='stylesheet' type='text/css' href='../css/style.css'>
    <link rel='stylesheet' type='text/css' href='../css/navbar.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
      <script src='../js/funcions.js'></script>
        <title>".$titol."</title>
    </head>
    <body>
    ";
  
  //Si la variable de sessió està buida vol dir que no ens hem autenticat i ens
  // redirigeix a la pàgina de login
  if (!isset($_SESSION['usuari']))
  {
  // eliminem la sessió per si en teniem alguna d'activa
    session_destroy();
     /* ens en anem a la pàgina de login*/
    header("location:../index.html");
  }
////////////////////////////////////////////////////////////////////////////////
// si estem autoritzats endavant, ara però hem de veure els rols
////////////////////////////////////////////////////////////////////////////////

//distribuim els botons comuns al lloc a la part superior
  
      //afegir botó de gestió d'usuaris si el rol és inferior a 5
  if ($_SESSION['rol'] < '5'){
      echo '
<nav class="navbar navbar-default navbar-fixed-top" style="margin-left:2px;">
  <div >
    <div class="navbar-header">
      <a class="navbar-brand" href="" style="width:600px;"><img src="../img/jv.png" style=" width: 7%; margin-top: -5px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="background-color:#333;">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../front/main.php">Ordres de treball</a></li>
        <li><a href="../front/comunicacions.php">Info producte</a></li>
        <li><a href="../front/usuaris.php">Usuaris</a></li>
        <li><a href="../front/comunicacions.php">Comunicacions</a></li>
        <li><a href="../front/usuari.php">'.$_SESSION["usuari"].'</a></li>
        </li>
        <li style="margin-right:11px"><a href="../back/logout.php"><span class="glyphicon glyphicon-log-out"  ></span></a></li>
      </ul>
    </div>
  </div>
</nav>
        ';
      }
      if ($_SESSION['rol'] == '5'){
        echo'<nav class="navbar navbar-default navbar-fixed-top" style="margin-left:2px;">
  <div >
    <div class="navbar-header">
      <a class="navbar-brand" href="" style="width:600px;"><img src="../img/jv.png" style=" width: 7%; margin-top: -5px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="background-color:#333;">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../front/comunicacions.php">Info producte</a></li>
        <li><a href="../front/usuari.php">'.$_SESSION["usuari"].'</a></li>
        </li>
        <li style="margin-right:11px"><a href="../back/logout.php"><span class="glyphicon glyphicon-log-out"  ></span></a></li>
      </ul>
    </div>
  </div>
</nav>';
};
  
      echo'

    
    

    <div id=logoJoviatFPI>
      <img src="../img/JOVIAT_FPi_sota.svg" alt="JOVIAT FPi"/>
    </div>
    <div id=logoJovitec>
      <img src="../img/jovitec.png" alt="Jovitec" class="jovitec"/>
    </div>

<!-- inici del cos de la pàgina -->

  <div id="cos">
  ';

} //fi_capsalera


////////////////////////////////////////////////////////////////////////////////
//peu de pàgina del lloc
////////////////////////////////////////////////////////////////////////////////
function peu ($msg){
  echo "
    </div><!--/cos-->
    <footer>
      <hr />
      Jovitec.0.5.1
      ".$msg."
    </footer>
  </body>
</html>
";
}//fi_peu


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
