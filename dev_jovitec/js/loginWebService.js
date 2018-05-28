

$(document).ready(function(){
//   $.ajaxSetup({
//     url: "/xmlhttp/",
//   global: false,
//   type: "POST",
//   dataType: 'jsonp',
//   Accept: 'application/json'
// })
  $("#login")[0].addEventListener("click",function(){
    hashPass=SHA256($("#psswd").val());
    var array={"usuari":$("#uname").val(),
    "password":hashPass,
    "tipus_usuari":122,
    "remitent":"Pol-Victor",
    "signatura":SHA256("login"+$("#uname").val()+hashPass+122+"Pol-Victor"+"Don't be evil")};
    console.log(array);
     event.preventDefault();
     console.log($("#psswd").val());

      $.ajax({
       type: "POST",
       url : 'https://app.joviat.com/api/api.php?f=login&v=1',
       data: { param : JSON.stringify(array) },
       contentType: 'application/json; charset=UTF-8',
       dataType: 'json',
       xhrFields: {
         withCredentials: true
       },

    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(result) {
      console.log(result);
      alert(result);

}})
})


});
