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
$anomalies=$_GET['anomalia'];
$ob=$_GET['ob'];
$inventari=$_GET['inventari'];



$ot="INSERT INTO ordre_treball VALUES (null,".$curs.",".$dataE.",".$prioritat.",null,".$dataLL.",".$usuari.")";
mysqli_query($connection, $ot);
$id_ot=mysqli_insert_id($connection);

$anomalia="INSERT INTO anomalies VALUES (null,'".$anomalies."',".$id_ot.")";
$resultat_anomalia=consulta($anomalia);
echo "1";
$obsevacio="INSERT INTO observacions_ot VALUES (null,'".$ob."',".$id_ot.")";
$resultat_ob=consulta($obsevacio);
echo "1";
$inventaris="INSERT INTO inventari_client VALUES (null,'".$inventari."',".$id_ot.")";
$resultat_inve=consulta($inventaris);
echo "1";


$supervisor="INSERT INTO supervisors VALUES (null,".$supervisors.",".$id_ot.", null)";
$resultat_super=consulta($supervisor);
echo "1";

$tecnic="INSERT INTO tecnics VALUES (null,".$tecnics.",".$id_ot.", null)";
$resultat_tec=consulta($tecnic);
echo "1";

$administratiu="INSERT INTO administratius VALUES (null,".$administratius.",".$id_ot.")";
$resultat_admin=consulta($administratiu);
echo "1";

?>
