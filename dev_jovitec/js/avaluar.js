var ListCompetencies=[];
var idList=0;
$(document).ready(function(){
  // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
  $("#adicional").on('click', function(){
    ListCompetencies.push([idList,$("#id_usuari").val(),$("#Nombre").val(),$("#OrdreT").val(),$("#competencia").val().split("/")[0],$("#nota").val().split("/")[0]]);
    $("#llistaCompetencies").append("<li  class='w3-display-container' value='"+idList+"'>"+$("#competencia").val().split("/")[1]+"/"+$("#nota").val().split("/")[1]+
    " <span onclick='eliminar(this.parentElement.value),this.parentElement.remove()' class='w3-button  w3-display-right'>&times;</span></li>")
    idList++;
  });

  $("#insertar").on("click",function(){
        for(i=0;i<ListCompetencies.length;i++){
          $.post("../back/avaluar.php",{
            id_usuari: ListCompetencies[i][1],
            nombre: ListCompetencies[i][2],
            ot:ListCompetencies[i][3],
            competencia:ListCompetencies[i][4],
            nota:ListCompetencies[i][5]
          },
            function(result){
                });
        }
        $("#llistaCompetencies").children().remove();
    });

});
function eliminar(item){
  for(var x=0;x<ListCompetencies.length;x++){
    if(ListCompetencies[x].indexOf(item)){
        ListCompetencies.splice(x-1,1);

    }
  }
}
