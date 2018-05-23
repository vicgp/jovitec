$(document).ready(function(){
var num=0;
$("i").each(function(){
  iduser=$("#"+num+" #usuari").val();
  $(this)[0].addEventListener("click",function(){
    
      window.location.assign("../front/avaluacio.php?id_ot="+$("#idot").val()+"&quiAvaluem="+$("#quiAvaluem").val()+"&idUser="+iduser);
  });
  num++;
});
});
