<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>under construction</title>
  </head>
  <body>
    <?php
    //Si la variable de sessió està buida
    if (!isset($_SESSION['usuari']))
    {
    // eliminem la sessió per si en teniem alguna d'activa
      // session_destroy();
       /* ens en anem a la pàgina de login*/
       echo" <br />ho sento, no estàs autoritzat!<br />";
       echo" introdueix usuari i contrasenya correctes...";
       echo '<meta http-equiv="refresh" content="4; url=index.html" />';
    }
    else{
      echo "usuari: ".$_SESSION['usuari']." rol: ".$_SESSION['rol'];
echo<<< END
      <form action=usuari.php>
        <button type="submit">les meves dades</button>
      </form>
      <form action=main.php>
        <button type="submit">inici</button>
      </form>
END;
    //afegir botó de gestió d'usuaris si el rol és inferior a 5
    if ($_SESSION['rol'] < '5'){
echo<<< END
      <form method="POST" action=front/usuaris.php>
        <input type="hidden" name="altauser" value=True />
        <button type="submit">usuaris</button>
      </form>
END;
    }
echo<<< END
    <form action=logout.php>
      <button type="submit">sortir</button>
    </form>
    <br />

    <h1>Pàgina en construcció</h1>
    <img src="img/TopOfTheRock.jpg" alt="TopOfTheRock, pàgina en construcció">
END;

    }
     ?>
  </body>
</html>
