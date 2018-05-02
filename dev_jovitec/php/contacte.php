<?php
	session_start();

	$nom = $_POST['name'];
	$email = $_POST['email'];
	$missatge = $_POST['comments'];

	if(isset($email)) {

		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = "aleeiix_1997@hotmail.com";
		$asunto = "Contacte des del lloc web";


		// Aquí se deberían validar los datos ingresados por el usuario
		if(!isset($nom) || !isset($email) || !isset($missatge)) {

			echo("<script type='text/javascript'> alert('S'ha produït un error i el formulari no ha estat enviat. Si us plau, torneu enrere i verifiqui la informació ingressada'); </script>");
			

			header("Location:../index.php");

			die();
		}

		$email_message = "Detalls del formulari de contactes:\n\n";
		$email_message .= "Nom: " . $nom . "\n";
		$email_message .= "E-mail: " . $email . "\n";
		$email_message .= "Missatge: " . $missatge . "\n\n";


		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'From: '.$email."\r\n".
		'Reply-To: '.$email."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $asunto, $email_message, $headers);

		echo("<script type='text/javascript'> alert(S'ha enviat correctament!); </script>");
		//header("Location:../index.php");
	}
?>