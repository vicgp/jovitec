<html>
<head>
</head>
<body>

<h2>Omplir Informacio d'Usuari</h2>
<div class="container">
 <form action="/action_page.php">
   <div class="row">
     <div class="col-25">
       <label for="fname">Nom</label>
     </div>
     <div class="col-75">
       <input type="text" id="Nom" name="Nom" placeholder="Your name..">
     </div>
   </div>
   <div class="row">
     <div class="col-25">
       <label for="lname">Cognoms</label>
     </div>
     <div class="col-75">
       <input type="text" id="Cognoms" name="Cognoms" placeholder="Your last name..">
     </div>
   </div>
   <div class="row">
     <div class="col-25">
       <label for="country">email</label>
     </div>
     <div class="col-75">
       <input type="text" id="email" name="email" placeholder="Your last name..">

     </div>
   </div>
   <div class="row">
     <div class="col-25">
       <label for="subject">Telefon</label>
     </div>
     <div class="col-75">
       <input type="text" id="Telefon" name="Telefon" placeholder="Your last name..">
     </div>
   </div>
   <div class="row">
     <div class="col-25">
       <label for="subject">Rol</label>
     </div>
     <div class="col-75">
      <select id='Rol'>
          <option value='2'>Supervisor</option>
          <option value='3'>Tecnic</option>
          <option value='4'>Administratiu</option>
      </select>
     </div>
   </div>
   <div class="row">
     <input type="submit" value="Submit">
   </div>
 </form>
</div>

</body>
</html>
