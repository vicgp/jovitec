<?php

session_start();
include("../php/funcions.php");
require_once '../php/config.php';

$connection=new mysqli($db_hostname,$db_username,$db_password,$db_database);
$connection->set_charset("utf8"); //per triar el joc de caràcters amb accents
if (!$connection) {
    die("Error de connexió: " . mysqli_connect_error());
}

$curs=$_GET['curs'];
$dataE=$_GET['dataE'];
$prioritat=$_GET['prioritat'];
// $dataF=$_GET['dataF'];
$dataLL=$_GET['dataLL'];
$usuari=$_GET['usuari'];
$supervisors=$_GET['supervisors'];
$tecnics=$_GET['tecnics'];
$administratius=$_GET['administratius'];


$ot="INSERT INTO ordre_treball VALUES (null,".$curs.",".$dataE.",".$prioritat.",".$dataF.",".$dataLL.",".$usuari.")";
mysqli_query($connection, $ot);
$id_ot=mysqli_insert_id($connection);

$supervisors="INSERT INTO supervisors VALUES (null,".$supervisors.",".$id_ot.", null)";
$resultat_super=consulta($supervisors);
echo "1";

$tecnics="INSERT INTO tecnics VALUES (null,".$tecnics.",".$id_ot.", null)";
$resultat_tec=consulta($tecnics);
echo "1";

$administratius="INSERT INTO administratius VALUES (null,".$administratius.",".$id_ot.")";
$resultat_admin=consulta($administratius);
echo "1";

?>
