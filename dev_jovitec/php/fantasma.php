<?php
	session_start();
	include("../php/funcions.php");

	$Comp = $_POST['name'];
	$sql = "INSERT INTO competencia (id_competencia, competencia) VALUES (NULL, '".$Comp."')";

	$fila = consulta($sql);
?>