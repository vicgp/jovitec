$(document).ready(function(){
  $(".delete").each(function(){
    console.log($(this).children($(".id_usuari")).val())

    $(this).click(function(){
      console.log($(this).children($(".id_usuari")).val())
      $.post("../back/deleteUsuari.php",
         {
             id_usuari: $(this).children($(".id_usuari")).val()

         },
         function(result){
           location.reload();
         });
    })
  })
})
