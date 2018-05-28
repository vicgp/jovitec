

$(document).ready(function(){

  $("#login")[0].addEventListener("click",function(){
    var array={"usuari":$("#uname").val(),
    "password":SHA256("39384114H"),
    "tipus_usuari":121,
    "remitent":"Pol-Victor",
    "signatura":SHA256("login"+$("#uname").val()+password+121+"Pol-Victor"+"Don't be evil")};
    console.log(array);
    // event.preventDefault();


    $.post("https://app.joviat.com/api/api.php",{
        param: JSON.stringify(array)
      },
        function(result){
          retorn=JSON.parse(result);
          console.log(retorn.estat);
        // event.preventDefault();
    })

})

});
