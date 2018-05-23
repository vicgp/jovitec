.Img{

	<?php
  session_start();
  $imgquery = "SELECT  imatge FROM usuaris WHERE id_usuari= '".$_SESSION['id_user']."'";
  $resultatImg= consulta($imgquery);
  $row=$resultatImg->fetch_assoc();
   ?>
   background:url(data:image/gif;base64,<?php base64_encode($row['imatge']) ?>);
	  background-size:contain;

	  	  /*z-index: 9999;*/
	  position: relative;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
	-webkit-transition:cubic-bezier(.34,.43,0,1.02) 0.2s;
	-moz-transition:cubic-bezier(.34,.43,0,1.02) 0.2s;
	transition:cubic-bezier(.34,.43,0,1.02) 0.2s;
  box-shadow: 0px 0px 0px 2pt transparent;
	border: 0px solid #FFF;
	margin: auto;
  cursor: pointer;
	width:50px;
	height:50px;

	}
