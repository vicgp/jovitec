$(document).ready(function(){

$("i").each(function(){
  console.log($(this));
  $(this)[0].addEventListener("click",function(){
      window.location.assign("../front/avaluacio.php?id_ot='.$idot");
  });
});
});
