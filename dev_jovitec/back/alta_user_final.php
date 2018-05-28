<?php

session_start();
include("../php/funcions.php");


$username=$_POST['username'];
$password=$_POST['password'];
$nom=$_POST['nom'];
$cognom=$_POST['cognom'];
$email=$_POST['email'];
$telefon=$_POST['tel'];
$rol=$_POST['rol'];

$user="INSERT INTO usuaris VALUES (null,'".$username."','".$password."','".$nom."','".$cognom."','".$email."','".$telefon."',".$rol.",'prova',0,null)";
$id_user=consulta($user);
echo $id_user;


?>
