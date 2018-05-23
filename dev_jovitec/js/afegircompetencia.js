$(document).ready(function(){
    $("#insertar_modal").click(function(){
        $.post("../php/fantasma.php",
        {
          name: $("#crear_competencia").val()
        },
        function(name){
            $("#myModal").hide();
            location.reload();
        });
    });
});