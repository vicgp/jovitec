
$(document).ready(function(){
  var x= 200;
  var y=200;
  $("#imatge")[0].addEventListener("change",function(){
    // $.ajax({url:"../back/perfil/imagenUpdate.php",  success:function(result){
    //     console.log(result);
    // }});

    document.getElementById("but").click(); // Click on the checkbox
    $("img2").css('width', '100px');
  })
});
