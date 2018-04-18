function AdminisOnCheck() {
    var checkBox = document.getElementById("adminCheck");
    if (checkBox.checked == true){
      document.getElementById("adminisDisCheck").style.display="none";
        document.getElementById("adminisCheck").style.display = "block";
    } else {
        document.getElementById("adminisCheck").style.display = "none";
        document.getElementById("adminisDisCheck").style.display="block";

    }
}
function TecnicsOnCheck() {
    var checkBox = document.getElementById("tecnicCheck");
    if (checkBox.checked == true){
      document.getElementById("tecnicsDisCheck").style.display="none";
        document.getElementById("tecnicsCheck").style.display = "block";
    } else {
        document.getElementById("tecnicsCheck").style.display = "none";
        document.getElementById("tecnicsDisCheck").style.display="block";

    }
}
var xhttp = new XMLHttpRequest();
function carregarTecnics(){
  var checkBox = document.getElementById("tecnicCheck");
  if (checkBox.checked == true){
    var id_tecnic=document.getElementById("tecnicsCheck").value;
  }
  else{
    var id_tecnic=document.getElementById("tecnicsDisCheck").value;
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("otTotal").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "../back/carregarMainFiltre.php?id="+id_tecnic, true);
  xhttp.send();
}
function carregarAdminis(){
  var checkBox = document.getElementById("adminCheck");
  if (checkBox.checked == true){
    var id_adminis=document.getElementById("adminisCheck").value;
  }
  else{
    var id_adminis=document.getElementById("adminisDisCheck").value;
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("otTotal").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "../back/carregarMainFiltre.php?id="+id_adminis, true);
  xhttp.send();
}

function carregarPrioritat(){

  var id_prioritat=document.getElementById("prioritatFiltre").value;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("otTotal").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "../back/carregarMainFiltrePrioritat.php?id="+id_prioritat, true);
  xhttp.send();
}


//############################################################################
//-------------------Usuaris Filtre-------------------------------------------
//############################################################################
function carregarClient(){
    var id_client=document.getElementById("ClientFiltre").value;
console.log(id_client);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("usuarisUpdate").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "../back/carregarUsuarisFiltre.php?id="+id_client, true);
  xhttp.send();
}
function carregarTecnicsUsuaris(){
    var id_tecnic=document.getElementById("tecnicsCheck").value;

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("usuarisUpdate").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "../back/carregarUsuarisFiltre.php?id="+id_tecnic, true);
  xhttp.send();
}
function carregarAdminisUsuaris(){
    var id_adminis=document.getElementById("adminisCheck").value;

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("usuarisUpdate").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "../back/carregarUsuarisFiltre.php?id="+id_adminis, true);
  xhttp.send();
}
function OnCheck() {
    var checkBox1 = document.getElementById("tecnicCheck");
    var checkBox2 = document.getElementById("administratiusCheck");
    var checkBox3 = document.getElementById("CLientCheck");
    var checkBox4 = document.getElementById("totsCheck");
    var rol=1;
    if (checkBox1.checked == true){
      rol=3;
    }
    else if(checkBox2.checked == true) {
      rol=4;
    }
    else if(checkBox3.checked == true) {
      rol=5;
    }
    else if(checkBox4.checked == true) {
      rol=1;
    }
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       document.getElementById("usuarisUpdate").innerHTML = this.responseText;


      }
    };
    xhttp.open("GET", "../back/carregarUsuarisChecks.php?id="+rol, true);
    xhttp.send();
}
function w3_open(sitio) {
    console.log(sitio);

  if(sitio==1){
   //  $.ajax({url: "../js/sidebar/moveOrdre.js?a=1", success: function(result){
   //      $("#div1").html(result);
   // }});
      document.getElementById("ordres").style.marginLeft = "25%";


  }
  else if(sitio==2){
   //  $.ajax({url: "../js/sidebar/moveUsuaris.js?a=1", success: function(result){
   //      $("#div1").html(result);
   // }});
    document.getElementById("usuarisList").style.marginLeft = "25%";



     }
    document.getElementById("openNav").style.display = 'none';
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close(sitio) {
  console.log(sitio);
    if(sitio==1){
   //      $.ajax({url: "../js/sidebar/moveOrdre.js?a=2", success: function(result){
   // }});   
   
              document.getElementById("ordres").style.marginLeft = "7%";


    }
    else if(sitio==2){
      // $.ajax({url: "../js/sidebar/moveUsuaris.js?a=2", success: function(result){
      // }});
            document.getElementById("usuarisList").style.marginLeft = "7%";

   }    
    
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
}


