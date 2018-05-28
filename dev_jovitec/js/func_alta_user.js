
var xhttp = new XMLHttpRequest();
function user(){
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("newUser").innerHTML = this.responseText;
     document.getElementById('formUser').style.display="block";

    }
  };
  xhttp.open("GET", "../back/alta_user.php", true);
  xhttp.send();
}
function alta_user(){

  $.post("../back/alta_user_final.php",{
    username: $('#username').val(),
    password: $('#password').val(),
    nom: $('#nom').val(),
    cognom: $('#cognom').val(),
    email: $('#email').val(),
    rol:$('#rol').val(),
    tel:$('#telefon').val()
  },
    function(result){
      $('#formUser').hide();
      location.reload();
        });

}

function cancelarUser(){
  document.getElementById('formUser').style.display='none';
}
