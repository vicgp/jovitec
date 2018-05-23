<?php 
	session_start();
	include("../php/funcions.php");

	capsalera('Avaluació');
	chat();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Qualificacions</title>
</head>
<style type="text/css">
	h1{
		text-align: center;
		margin-top: 70px;
	}
	button{
		height: 5%;
		width: 25%;
		margin-top: 1%;
		margin-left: 38%;
	}
	.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 45%;
    height: 50%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

</style>
<body>
	<h1>Ordres de Treball qualificades</h1>

	<?php 

		$query_ot_generic = "SELECT ordre_treball.AvaluadaAdministratiu,ordre_treball.AvaluadaTecnic, ordre_treball.id_estat,ordre_treball.id_ot, curs_escolar.curs, usuaris.cognoms_usuari, usuaris.nom_usuari, usuaris.email_usuari, data_entrada, prioritat, data_finalitzacio, data_lliurament
	     FROM ordre_treball INNER JOIN curs_escolar ON ordre_treball.id_curs=curs_escolar.id_curs
	     INNER JOIN usuaris ON usuaris.id_usuari=ordre_treball.id_usuari INNER JOIN tecnics ON tecnics.id_ot=ordre_treball.id_ot
	     WHERE  ordre_treball.id_estat = 1 AND tecnics.id_usuari=".$_SESSION['id_user']." ORDER BY id_ot ASC";

	     $res=consulta($query_ot_generic);
	     while ($fila_ot_generic = $res->fetch_assoc()){

    ?>
	<button id="boton"><?php echo $fila_ot_generic['id_ot'] ?></button>
	<div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
  	    	<span class="close">&times;</span> 
        </div>
	</div>


</body>
  <script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("boton");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
   
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</html>

<?php
	};
  peu("");
?>