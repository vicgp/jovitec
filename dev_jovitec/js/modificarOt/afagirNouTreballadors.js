$("#afagirAdministratiu").hide();
$("#afagirTecnic").hide();
$("#afagirSupervisor").hide();

$(document).ready(function(){
  $("#closeModificarOt")[0].addEventListener("click",function(){
    console.log("h");
      $("#modificarOtTot").hide();
  })
  //-------------------------------------------------------------------------------------
//afagir Supervisor/Tecnic/Administratiu
  //-------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------



  //-------------------------------------------------------------------------------------
  //afagir supervisor
  //-------------------------------------------------------------------------------------
  $("#supervisor").click(function(){
    $.post("../back/modificarOt/creacioSelectModal.php",
       {
           idOt: $("#idOt").val(),
         funcio:1,
          rol: 2
       },
       function(result){
         $("#addSupervisor").html(result);
       });
       $("#removeSup").hide();
       $("#afagirSup").show();
      $("#afagirSupervisor").show();
  })

  $("#Sup").click(function(){
    console.log("j");
    console.log($("#addSupervisor").val());
    if($("#addSupervisor").val()!=""){
      $.post("../back/modificarOt/afagirSupervisor.php",
         {
            idOt: $("#idOt").val(),
             supervisor: $("#addSupervisor").val()
         },
         function(result){
           console.log(result);
           $("#afagirSupervisor").hide();
         });
     }
     else{
       alert("has de seleccionar un supervisor");

     }

  });
  $(".close-modal").click(function(){
    $("#afagirTecnic").hide();
    $("#afagirAdministratiu").hide();

  });
  //-------------------------------------------------------------------------------------
    //afagir administratiu
    //-------------------------------------------------------------------------------------
    $("#administratius").click(function(){
      $.post("../back/modificarOt/creacioSelectModal.php",
         {
             idOt: $("#idOt").val(),
           funcio:1,
            rol: 4

         },
         function(result){
           $("#addAdministratiu").html(result);
         });
         $("#removeAd").hide();
         $("#afagirAd").show();
        $("#afagirAdministratiu").show();
    });
    $("#Ad").click(function(){
      if($("#addAdministratiu").val()!=""){
        $.post("../back/modificarOt/afagirAdministratiu.php",
           {
              idOt: $("#idOt").val(),
               administratiu: $("#addAdministratiu").val()
           },
           function(result){
             $("#afagirAdministratiu").hide();
           });
       }
       else{
         alert("has de seleccionar un administratiu");

       }
    });
    //-------------------------------------------------------------------------------------
    //afagir tecnic
    //-------------------------------------------------------------------------------------
    $("#tecnic").click(function(){
      $.post("../back/modificarOt/creacioSelectModal.php",
         {
           idOt: $("#idOt").val(),
           funcio:1,
            rol: 3
         },
         function(result){
           $("#addTecnic").html(result);
         });
         $("#removeTec").hide();
         $("#afagirTec").show();
        $("#afagirTecnic").show();
    })
    $("#Tec").click(function(){
      if($("#addTecnic").val()!=""){
        $.post("../back/modificarOt/afagirTecnic.php",
           {
              idOt: $("#idOt").val(),
               tecnic: $("#addTecnic").val()
           },
           function(result){
             $("#afagirTecnic").hide();
           });
       }
       else{
          alert("has de seleccionar un tecnic");
       }
    });
    $(".close-modal").click(function(){
      $("#afagirTecnic").hide();
      $("#afagirAdministratiu").hide();
      $("#afagirSupervisor").hide();

    })


    //-------------------------------------------------------------------------------------
  //eliminar Supervisor/Tecnic/Administratiu
    //-------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------
    //----------eliminar supervisor---------------------------------------------------------------------------
    $("#supervisorRemove").click(function(){
      $.post("../back/modificarOt/creacioSelectModal.php",
         {
          idOt: $("#idOt").val(),
           funcio:2,
            rol: 2
         },
         function(result){
           $("#addSupervisor").html(result);
         });
         $("#Sup").hide();
         $("#removeSup").show();
        $("#afagirSupervisor").show();
    })

    $("#removeSup").click(function(){
      if($("#addSupervisor option").size()>1){
        $.post("../back/modificarOt/eliminarSupervisor.php",
           {
              idOt: $("#idOt").val(),
               supervisor: $("#addSupervisor").val()
           },
           function(result){
             $("#afagirSupervisor").hide();
           });
       }
       else{
         alert("No deixar la ordre de treball sense supervisor");
       }

    });
    $(".close-modal").click(function(){
      $("#afagirTecnic").hide();
      $("#afagirAdministratiu").hide();

    });
    //-------------------------------------------------------------------------------------
      //eliminar administratiu
      //-------------------------------------------------------------------------------------
      $("#administratiusRemove").click(function(){
        $.post("../back/modificarOt/creacioSelectModal.php",
           {
               idOt: $("#idOt").val(),
             funcio:2,
              rol: 4

           },
           function(result){
             $("#addAdministratiu").html(result);
           });
           $("#Ad").hide();
           $("#removeAd").show();
          $("#afagirAdministratiu").show();
      });
      $("#removeAd").click(function(){
        if($("#addAdministratiu option").size()>1){
          $.post("../back/modificarOt/eliminarAdministratiu.php",
             {
                idOt: $("#idOt").val(),
                 administratiu: $("#addAdministratiu").val()
             },
             function(result){
               $("#afagirAdministratiu").hide();
             });
         }
         else{
           alert("No deixar la ordre de treball sense administratiu");

         }
      });
      //-------------------------------------------------------------------------------------
      //eliminar tecnic
      //-------------------------------------------------------------------------------------
      $("#tecnicRemove").click(function(){
        $.post("../back/modificarOt/creacioSelectModal.php",
           {
              idOt: $("#idOt").val(),
             funcio:2,
              rol: 3
           },
           function(result){
             $("#addTecnic").html(result);
           });
           $("#Tec").hide();
           $("#removeTec").show();
          $("#afagirTecnic").show();
      })
      $("#afagirTec").click(function(){
        if($("#addTecnic option").size()>1){
          $.post("../back/modificarOt/eliminarTecnic.php",
             {
                idOt: $("#idOt").val(),
                 tecnic: $("#addTecnic").val()
             },
             function(result){
               $("#afagirTecnic").hide();
             });
         }
         else{
           alert("No deixar la ordre de treball sense tecnic");

         }
      });
      $(".close-modal").click(function(){
        $("#afagirTecnic").hide();
        $("#afagirAdministratiu").hide();
        $("#afagirSupervisor").hide();

      })
});
