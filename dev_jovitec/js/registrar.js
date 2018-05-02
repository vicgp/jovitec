$(".form-control-feedback").hide();
$("#nom")[0].addEventListener("focusout",function(){
      if($("#nom").val()==""){
        $("#NameForm").removeClass("has-success");
        $("#NameForm").addClass("has-error");
        $("#NameIcon").html("highlight_off");
        $("#hidenValue").val("0");
      }
      else{
        $("#NameForm").removeClass("has-error");
        $("#NameForm").addClass("has-success");
        $("#NameIcon").html("done");
        $("#hidenValue").val("1");
      }
      $("#NameIcon").show();

});
$("#newemail")[0].addEventListener("focusout",function(){
  if($("#newemail").val().split()!=""){
      $.ajax({url: "back/validarRegistrar.php?infoPassar=2&email="+$("#newemail").val(), success: function(result){
        if(result!="1"){
          $("#emailForm").removeClass("has-success");
          $("#emailForm").addClass("has-error");
          $("#emailIcon").html("highlight_off");
          $("#hidenValue").val("0");

        }
        else{
          $("#emailForm").removeClass("has-error");
          $("#emailForm").addClass("has-success");
          $("#emailIcon").html("done");
          $("#hidenValue").val("1");

        }
        $("#emailIcon").show();

    }});
  }
  else{
    $("#emailForm").removeClass("has-success");
    $("#emailForm").addClass("has-error");
    $("#emailIcon").html("highlight_off");
    $("#hidenValue").val("0");
  }
});
$("#username")[0].addEventListener("focusout",function(){
  if($("#username").val()!=""){
      $.ajax({url: "back/validarRegistrar.php?infoPassar=1&username="+$("#username").val(), success: function(result){
        if(result!="1"){
          $("#usernameForm").removeClass("has-success");
          $("#usernameForm").addClass("has-error");
          $("#usernameIcon").html("highlight_off");
          $("#hidenValue").val("0");
        }
        else{
          $("#usernameForm").removeClass("has-error");
          $("#usernameForm").addClass("has-success");
          $("#usernameIcon").html("done");
          $("#hidenValue").val("1");

        }
        $("#usernameIcon").show();

    }});
  }
  else{
    $("#usernameForm").removeClass("has-success");
    $("#usernameForm").addClass("has-error");
    $("#usernameIcon").html("highlight_off");
    $("#hidenValue").val("0");
  }
});

$("#botoRegistrar")[0].addEventListener("click",function(){
  if($("#hidenValue").val()=="0"){
    event.preventDefault();
  }
});
