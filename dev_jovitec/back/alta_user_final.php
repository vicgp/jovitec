<?php

session_start();
include("../php/funcions.php");


$username=$_GET['username'];
$password=$_GET['password'];
$nom=$_GET['nom'];
$cognom=$_GET['cognom'];
$email=$_GET['email'];
$telefon=$_GET['tel'];
$rol=$_GET['rol'];

echo "1";
$user="INSERT INTO usuaris VALUES (null,'".$username."','".$password."','".$nom."','".$cognom."','".$email."','".$telefon."',".$rol.",'prova')";
$id_user=consulta($user);
echo "1";


?>
