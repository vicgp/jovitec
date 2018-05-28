<?php
  require("../php/funcions.php");


  if (!empty($_POST['email']) && !empty($_POST['Names']) && !empty($_POST['usname']) && !empty($_POST['pwd']) ) {


    // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
    $email_to = $_POST['email'];
    $email_subject = "Registrat jovitec";


    // Aquí se deberían validar los datos ingresados por el usuario


    $email_message = "Credencials d'usuari jovitec:\n\n";
    $email_message .= "Nom: " . $_POST['Names'] . "\n\n";
    $email_message .= "Username: " . $_POST['usname'] . "\n";
    $email_message .= "Password: " . $_POST['pwd'] . "\n";



    // Ahora se envía el e-mail usando la función mail() de PHP
    $headers = 'From: '.$_POST['email']."\r\n".
    'Reply-To: '.$_POST['email']."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    echo "¡El formulari s'ha enviat correctament!";


    $sql= "INSERT INTO usuaris (id_usuari,username_usuari,password_usuari,nom_usuari,email_usuari,rol_usuari) VALUES (null,'".$_POST['usname']."','".$_POST['pwd']."','".$_POST['Names']."','".$_POST['email']."',5)";

consulta($sql);
  }

   header('Location: ../index.php');

?>
