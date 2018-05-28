$(document).ready(function(){
  $("td.user").each(function(){
    $(this).click(function(){
      $.post("../back/modificarUsuari.php",{
        id_usuari: $(this).children($(".id_usuari")).val()
      },
        function(result){
          $("#modificarUsuari").html(result);
      });
      $("#modalModificarUsuari").show();
    })
  })
})
