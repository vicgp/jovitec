$(document).ready(function(){
var canvi=false;
$("#closeModificarUsuari")[0].addEventListener("click",function(){
    $("#modalModificarUsuari").hide();
    if(canvi!=false){
      location.reload();

    }

  })
  $("#nomUsuari").blur(function(){
    canvi=true;
    $.post("../back/modificarUsuariFinal.php",{
      id_usuari:$("#idUsuari").val(),
      info:$("#nomUsuari").val(),
      infoCanvi:1
    },
      function(result){
        console.log(result);
    });
  })
  $("#cognomUsuari").blur(function(){
    canvi=true;
    $.post("../back/modificarUsuariFinal.php",{
      id_usuari:$("#idUsuari").val(),
      info:$("#cognomUsuari").val(),
      infoCanvi:2
    },
      function(result){

    });
  })
  $("#emailUsuari").blur(function(){
    canvi=true;

    $.post("../back/modificarUsuariFinal.php",{
      id_usuari:$("#idUsuari").val(),
      info:$("#emailUsuari").val(),
      infoCanvi:3
    },
      function(result){

    });
  })
  $("#telefonUsuari").blur(function(){
    canvi=true;

    $.post("../back/modificarUsuariFinal.php",{
      id_usuari:$("#idUsuari").val(),
      info:$("#telefonUsuari").val(),
      infoCanvi:4
    },
      function(result){
    });
  })
  $("#rol").blur(function(){
    canvi=true;

    $.post("../back/modificarUsuariFinal.php",{
      id_usuari:$("#idUsuari").val(),
      info:$("#rol").val(),
      infoCanvi:5
    },
      function(result){

    });
  })
  $("#observacioUsuari").blur(function(){
    canvi=true;

    $.post("../back/modificarOt.php",{
      id_usuari:$("#idUsuari").val(),
      info:$("#observacioUsuari").val(),
      infoCanvi:6
    },
      function(result){

    });
  })
})
