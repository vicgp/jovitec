
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
  var rol=$('#rol')[0].value;
  var username=$('#username')[0].value;
  var password=$('#password')[0].value;
  var nom=$('#nom')[0].value;
  var cognom=$('#cognom')[0].value;
  var email=$('#email')[0].value;
  var tel=$('#telefon')[0].value;

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('formUser').style.display="none";
      // carregaTaula();
    }
  };
  console.log("rol="+rol+"&username="+username+"&password="+password+"&nom="+nom+"&cognom="+cognom+"&email="+email+"&tel="+tel);
  xhttp.open("GET", "../back/alta_user_final.php?rol="+rol+"&username="+username+"&password="+password+"&nom="+nom+"&cognom="+cognom+"&email="+email+"&tel="+tel, true);
  xhttp.send();
}

function cancelarUser(){
  document.getElementById('formUser').style.display='none';
}

function carregaTaula(){
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log('ok');
      document.getElementById('ot').value=this.responseText;
      document.getElementById('ot').style.display="block";
    }
  };
  xhttp.open("GET", "../back/carregaMain.php", true);
  xhttp.send();
}
