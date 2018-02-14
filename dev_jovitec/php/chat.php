<?php
include("../php/funcions.php");
$emisor=$_GET['emisor'];
// $user="SELECT * FROM usuari WHERE id_usuari=".$emisor;
// $execute_user = $conexion->query($user);
// $fila2 = $ejecutar->fetch_array();


$receptor=$_GET['receptor'];
	$sql = "SELECT * FROM chat WHERE (id_emisor=".$emisor." AND id_receptor=".$receptor.") OR (id_emisor=".$receptor." AND id_receptor=".$emisor.") ORDER BY fecha";
	$ejecutar = consulta($sql);
	if(!$ejecutar){
		return $conexion->error;
	}
		else{


	while($fila = $ejecutar->fetch_array()){
?>
	<div id="datos-chat">
		<span style="color: #1c62c4;"><?php echo $fila['nombre']; ?>:</span>
		<span style="color: #848484;"><?php echo $fila['mensaje']; ?></span>
		<div id="hora">
			<span id="hora"><?php echo formatearFecha($fila['fecha']); ?></span>
		</div>
	</div>


<?php }}
?>
