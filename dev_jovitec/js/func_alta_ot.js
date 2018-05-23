var productes_client=[];
$(document).ready(function(){
  $(".ordre").each(function(){
      $(this).click(function(){
        $.post("../back/ot.php",{
          id_ot:$(this).children("input").val()
        },
          function(result){
            $("#modificarOt").html(result);
            $("#modificarOtTot").show();
        });
      })
  });

});

//----------------------------------------------------------------
//----------funcio per afagir el modal de ordres noves------------
//-------------------------------------------------------------


var xhttp = new XMLHttpRequest();
function ot_alta(){
  $.ajax({url: "../back/alta_ot.php", success: function(result){
    $("#newOT").html(result);
    $('#dataE').val(new Date().toISOString().split("T")[0]);
      $('#formOT').show();
}})
}

//----------------------------------------------------
//----------funcio per afagir ordres noves------------
//----------------------------------------------------
function alta(){
  //agafem tots el valors del modal
  var curs=$('#curs').val();
  var dataE=new Date().toISOString().split("T")[0];;
  var usuari=$('#usuari').val();
  var prioritat=$('#prioritat').val();
  var supervisors=$('#supervisors').val();
  var tecnics=$('#tecnics').val();
  var administratius=$('#administratius').val();
  var anomalies=$('#anomalies').val();
  var ob=$('#ob').val();
  var dataLL=$('#dataLL').val();

$.ajax({url: "../back/alta_ot_final.php?curs="+curs+"&dataE="+dataE+"&usuari="+usuari+"&prioritat="+prioritat+"&supervisors="+supervisors+"&tecnics="+tecnics+"&administratius="+administratius+"&dataLL="+dataLL+"&anomalia="+anomalies+"&ob="+ob
      ,success: function(result){
        carregaTaula();
      for(i=0;i<productes_client.length;i++){
        $("#formOT").hide();

        $.post("../back/alta_ot_inventari.php",{
          producte:productes_client[i][0],
          descripcio:productes_client[i][1],
          idot: result

        },
          function(result){
              });
      }
      productes_client=[];
    }
    });

}
//------funcio per sortir del modal---------
function cancelar(){
  $('#formOT').hide();
}
//----funcio per tornar a carregar la taula----
function carregaTaula(){
  	$.ajax({url: "../back/carregarMain.php", success: function(result){
      console.log(result)
      $("#tbody").html(result);
    }});

}
//-----carregar el dropdown de l'invetnari----------
function loadDrop(){
  var drop="";
  for(var i=0;i<productes_client.length;i++){
    var marca=productes_client[i][1].split(",");
    drop+="<option value='"+productes_client[i][0]+"'>"+productes_client[i][0]+" -- "+marca[0]+"</option>"
  }
  $("#inventari")[0].innerHTML=drop;
}
//----funcio per obrir el modal per afagir objectes al inventari---------
function addInventari(a){
  if(productes_client.length<=3){
    $('#modalProduct').show();

    if(a==1){
      $('#tipusProduct').val("portatil");
    }
    else if(a==2){
      $('#tipusProduct').val("movil");
    }
    else if(a==3){
      $('#tipusProduct').val("tablet");
    }
    else if(a==4){
      $('#tipusProduct').val("PC Torre");
    }
  }
  else{
    $("#MaximProduct").show();
	  setTimeout(clearAlertProduct,4000);
  }
}
//---funcio per netejar el alert de productes maxim-----
function clearAlertProduct(){
	$("#MaximProduct").hide();
  $("#productAfagit").hide();


}
//---- funcio per treure el modal de producte------
function cancelarProduct(){
  $('#modalProduct').hide();

}
//--- funcio per afagir un objecte al desplegable del inventari
function addInventariFinal(){
  var product=$('#tipusProduct').val();
  var desc=$('#descProduct').val();
  productes_client.push([product,desc]);
  $('#modalProduct').hide();
  $("#productAfagit").hide();
  setTimeout(clearAlertProduct,4000);
  loadDrop();
  $('#descProduct').val("");
}
function eliminarObjecte(){
  var name=$("#inventari").val();
  for(var i=0;i<productes_client.length;i++){
    if(productes_client[i][0].includes(name)){
      productes_client.splice(i,1)
    }

  }

  loadDrop();
}
