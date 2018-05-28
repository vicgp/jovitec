 <?php
 if(isset($_POST['correu'])) {

 // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
 $email_to = "jajabron@gmail.com";
 $email_subject = "Contacto desde el sitio web";


 // Aquí se deberían validar los datos ingresados por el usuario
 if(!isset($_POST['nom']) ||
 !isset($_POST['correu']) ||
 !isset($_POST['missatge'])) {

 echo "<b>S'ha produït un error i el formulari no ha estat enviat. </b><br />";
 echo "Si us plau, torneu enrere i verifiqui la informació ingressada<br />";
 die();
 }

 $email_message = "Detalls del formulari de contactes:\n\n";
 $email_message .= "Nom: " . $_POST['nom'] . "\n";
 $email_message .= "E-mail: " . $_POST['correu'] . "\n";
 $email_message .= "Missatge: " . $_POST['missatge'] . "\n\n";


 // Ahora se envía el e-mail usando la función mail() de PHP
 $headers = 'From: '.$_POST['correu']."\r\n".
 'Reply-To: '.$_POST['correu']."\r\n" .
 'X-Mailer: PHP/' . phpversion();
 @mail($email_to, $email_subject, $email_message, $headers);

 echo "¡El formulari s'ha enviat correctament!";
 }
 ?>
