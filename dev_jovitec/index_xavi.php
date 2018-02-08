<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #0050ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}


.imgcontainer {
    text-align: center;
    margin: 1px 0 12px 0;
}

img.avatar {
    width: 35%;

}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<head>
  <title>Jovitec</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
  require("php/funcions.php");

?>
</head>
<body>

<h2>Benvinguts a Jovitec <h2>

<form method='POST' action="back/authorize.php">
  <div class="imgcontainer">

    <img src="img/logo_jovitec.svg" alt="Jovitec" class="avatar">
  </div>

  <div class="container">
    <label><b>Usuari</b></label>
    <input type="text" placeholder="Introduir Usuari" name="uname" required>

    <label><b>Contrasenya</b></label>
    <input type="password" placeholder="Introduir Contrassenya" name="psswd" required>

    <label><b>Curs Escolar</b></label>
    <select name=curs_actual>
<?php
    $query_curs_escolar="SELECT * FROM curs_escolar";
    $resultat_curs_escolar=consulta($query_curs_escolar);
    while($curs_escolar=$resultat_curs_escolar->fetch_assoc()){
      echo "<option value=".$curs_escolar['id_curs'].">".$curs_escolar['curs']."</option>";
    }
?>
    </select>

    <button type="submit">Accedir</button>
  </div>
</form>
</body>
</html>
