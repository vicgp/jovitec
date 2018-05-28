$(document).ready(function(){
  $(".delete").each(function(){
    $(this).click(function(){
      $.post("../back/deleteOt.php",
         {
             id_ot: $(this).children($(".id_ot")).val()

         },
         function(result){
           location.reload();
         });
    })
  })
})
