<?php
  require("../php/funcions.php");

  if (!empty($_POST['email'])) {

        $sql= "SELECT password_usuari FROM usuaris WHERE email_usuari='".$_POST['email']."'";

    $res=consulta($sql);
    $fila=$res->fetch_assoc();
    // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
    if(empty($res)){
    $email_to = $_POST['email'];
    $email_subject = "Registrat jovitec";


    // Aquí se deberían validar los datos ingresados por el usuario


    $email_message = "Credencials d'usuari jovitec:\n\n";
    $email_message .= "Password: " . $fila['password_usuari'] . "\n";



    // Ahora se envía el e-mail usando la función mail() de PHP
    $headers = 'From: '.$_POST['crreu']."\r\n".
    'Reply-To: '.$_POST['email']."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    echo "¡El formulari s'ha enviat correctament!";
}
else{
  echo"No correspon a cap usuari aquest correu.";
}

  }

   header('Location: ../index.php');

?>
