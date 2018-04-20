chats=[];
usuarisOberts=[];
chatsMin=[];
numChats=chats.length+1;
receptor = 0;
numMissatge=0;
var req = new XMLHttpRequest();
read=false;
setInterval(actualizarChat,1000);
setInterval(newMessage,1000);
$("#caja-chat").animate({ scrollTop: $('#caja-chat').prop("scrollHeight")}, 0);

function newMessage(){
	$.ajax({url: "../back/nombreMissatge.php", success: function(result){
			if(parseInt(result)>numMissatge && read==false){
				$("#notificacio").css("color","red");
				$.ajax({url: "../back/missatgesNous.php", success: function(result){
						$("#missatgeNous").html(result);
					}});
			}
			else{
				$("#notificacio").css("color","#d5d5d5");
			}
			numMissatge=parseInt(result);

	 }});
}
$("#notificacio")[0].addEventListener("click", function(){
		read=true;
});

function actualizarChat(){
	for(var i=0;i<usuarisOberts.length;i++){
		carregarChat(usuarisOberts[i][2],usuarisOberts[i][1],usuarisOberts[i][0]);
	}
}

function openChat(emisor,receptor){
			
			req.onreadystatechange = function(){
				if(req.readyState == 4 && req.status == 200){
					if(!chats.includes('2')){
						chats.push('2');
						document.getElementById('chat1').innerHTML = req.responseText;
						document.getElementById('id_user1').value =receptor;
					}
					else if(!chats.includes('3')){
						chats.push('3');
						document.getElementById('chat2').innerHTML = req.responseText;
						document.getElementById('id_user2').value =receptor;
					}
					else if(!chats.includes('4')){
						chats.push('4');
						document.getElementById('chat3').innerHTML = req.responseText;
						document.getElementById('id_user3').value =receptor;
					}
				}
			}
			req.open('GET', '../php/chat.php?emisor='+emisor+'&receptor='+receptor, true);
			req.send();

	}
function carregarChat(emisor,receptor,chat){
					req.onreadystatechange = function(){
						if(req.readyState == 4 && req.status == 200){

				          if(chat==1){

				            document.getElementById('chat1').innerHTML = req.responseText;
				          }
				          else if(chat==2){
				            document.getElementById('chat2').innerHTML = req.responseText;


				          }
				          else if(chat==3){
				            document.getElementById('chat3').innerHTML = req.responseText;

				          }
							}
						}

					req.open('GET', '../php/chat.php?emisor='+emisor+'&receptor='+receptor, true);
					req.send();
				}

		//Linea hace que se refresque la página cada segundo
		 //setInterval(function(){ajax();}, 1000);
function enviar(chat,id_user){
receptor=usuarisOberts[chat-1][1];
if(chat==1){
	var mensaje=document.getElementById('textarea1').value;

}
else if(chat==2){
	var mensaje=document.getElementById('textarea2').value;

}
else if(chat==3){
	var mensaje=document.getElementById('textarea3').value;

}
	req.onreadystatechange = function(){
		if(req.readyState == 4 && req.status == 200){
			carregarChat(id_user,receptor,chat);
			if(chat==1){
				document.getElementById('textarea1').value='';
				document.getElementById('textarea1').placeholder='Escriu el teu missatge';

			}
			else if(chat==2){
				document.getElementById('textarea2').value='';
				document.getElementById('textarea2').placeholder='Escriu el teu missatge';

			}
			else if(chat==3){
				document.getElementById('textarea3').value='';
				document.getElementById('textarea3').placeholder='Escriu el teu missatge';

			}

		}
	}
	req.open('GET', '../php/enviar.php?emisor='+id_user+'&receptor='+receptor+'&mensaje='+mensaje, true);
	req.send();



}
function clearAlert(){
	$("#alertUser")[0].style.display="none";

}

function abrir(emisor,receptor){
	var trobat=false;
	for(var i=0;i<usuarisOberts.length && trobat!=true;i++){
		if(receptor==usuarisOberts[i][1]){
			trobat=true;
		}
	}
	if(trobat==true){
		$("#alertUser")[0].style.display="block";
	  setTimeout(clearAlert,2000);

	}

	else{
  var dreta=245*numChats;
    if(numChats>=1 && numChats<4){
      numChats++;
      if(!chats.includes('2')){
				usuarisOberts.push([1,receptor,emisor]);
				if(chats.includes('4') && chats.includes('3')){
					$("#contenedor2").animate({right: '960px'});
					$("#contenedor1").animate({right: '615px'});
				}
				else if(chats.includes('4')){
					$("#contenedor2").animate({right: '615px'});
				}
				else if(chats.includes('3')){
					$("#contenedor1").animate({right: '615px'});
				}
        $('#contenedor').show();
        $('#btnChat').hide();
        $("#contenedor").animate({
            height: '350px',
            width: '20%',
            right: '250px'
        });
				// $('#contenedor').scrollTop=$('#contenedor').scrollHeight;

      }
      else if(!chats.includes('3')){
				usuarisOberts.push([2,receptor,emisor]);

				if(chats.includes('4') && chats.includes('2')){
					$("#contenedor2").animate({right: '960px'});
					$("#contenedor").animate({right: '270px'});
				}
				else if(chats.includes('4')){
					$("#contenedor2").animate({right: '900px'});
				}

        $('#contenedor1').show();
        $('#btnChat1').hide();
        $("#contenedor1").animate({
            height: '350px',
            width: '20%',
            right: '537px'
        });

      }
      else if(!chats.includes('4')){
				usuarisOberts.push([3,receptor,emisor]);

        $('#contenedor2').show();
        $('#btnChat2').hide();
        $("#contenedor2").animate({
            height: '350px',
            width: '20%',
            right: ''+(dreta+90)+'px'
        });


      }

    }
    else{
      alert('Ja tens el nombre maxim de chats');
    }
    openChat(emisor,receptor);
}}

//------------------------------------------------------------
//-----------------boto "enter" eniva missatge----------------
//------------------------------------------------------------
var input1 = document.getElementById("textarea1");
input1.addEventListener("keyup", function(event) {
if (event.keyCode === 13) {
		document.getElementById("buttonEnviar").click();
}
});

var input2 = document.getElementById("textarea2");
input2.addEventListener("keyup", function(event) {
if (event.keyCode === 13) {
		document.getElementById("buttonEnviar1").click();
}
});

var input3 = document.getElementById("textarea3");
input3.addEventListener("keyup", function(event) {
if (event.keyCode === 13) {
		document.getElementById("buttonEnviar2").click();
}
});

//------------------------------------------------------------
//-----------------event obrir chats----------------
//------------------------------------------------------------
$("#btnChat2")[0].addEventListener("click",function(){
	$("#contenedor2").animate({
			height: '350px'});
			$("#contenedor2").show();
		$('#btnChat2').hide();
});
$("#btnChat1")[0].addEventListener("click",function(){
	$("#contenedor1").animate({
			height: '350px'});
			$("#contenedor1").show();
		$('#btnChat1').hide();
});
$("#btnChat")[0].addEventListener("click",function(){
	$("#contenedor").animate({
			height: '350px'});
			$("#contenedor").show();
		$('#btnChat').hide();
});

//------------------------------------------------------------
//-----------------event minimitzar chats----------------
//------------------------------------------------------------
$("#minimizar")[0].addEventListener("click",function(){
		$("#contenedor").animate({height: "0px"});
			$('#btnChat').show();
			$('#btnChat').animate({
				right: '250px'
			});
			$('#btnChatUser2').show();
			$('#btnChatUser2').animate({
				right: '250px'
			});
			$('#contenedor').hide();
});
$("#minimizar1")[0].addEventListener("click",function(){
	$("#contenedor1").animate({height: "0px"});
	$('#btnChat1').show();
	$('#btnChat1').animate({
		right: '540px'
	});
	$('#btnChatUser3').show();
	$('#btnChatUser3').animate({
		right: '540px'
	});
	$('#contenedor1').hide();

});
$("#minimizar2")[0].addEventListener("click",function(){
	$("#contenedor2").animate({height: "0px"});
	$('#btnChat2').show();
	$('#btnChat2').animate({
		right: '830px'
	});
	$('#btnChatUser4').show();
	$('#btnChatUser4').animate({
		right: '830px'
	});
	$('#contenedor2').hide();

});



function minimizarInici(){
    $("#contenedor-usuaris").animate({height: "0px"});
    $('#btnUser').show();
    $('#contenedor-usuaris').hide();
}

function cerrar(id) {

    if(2==id){
      $("#contenedor").animate({height: "0px"});
			if(chats.includes('3')){
				$("#contenedor1").animate({right: "270px"});
				$("#contenedor2").animate({right: "615px"});			}
			else{
				$("#contenedor2").animate({right: "270px"});

			}

      $('#contenedor').hide();
      $('#btn').show();
      numChats--;
			var posU=buscarUsuari(receptor);
			usuarisOberts.splice(posU,1);
			var pos=buscar('2');
			chats.splice(pos,1);


    }
    else if(3==id){
      $("#contenedor1").animate({height: "0px"});
			if(chats.includes('2')){
				$("#contenedor2").animate({right: "615px"});
			}
			else{
				$("#contenedor2").animate({right: "270px"});

			}
      $('#contenedor1').hide();
      $('#btn').show();
      numChats--;
			var posU=buscarUsuari(receptor);
			usuarisOberts.splice(posU,1);
			var pos=buscar('3');
			chats.splice(pos,1)

    }
    else if(4==id){
      $("#contenedor2").animate({height: "0px"});
      $('#contenedor2').hide();
      $('#btn').show();
      numChats--;
			var posU=buscarUsuari(receptor);
			usuarisOberts.splice(posU,1);
			var pos=buscar('4');
			chats.splice(pos,1)

    }
}


function buscar(valor){
	for(var i=0;i<chats.length;i++){
		if(chats[i]==valor){
			return i;
		}

	}
}
function buscarUsuari(id){
	pos=0;
	var trobat=false;
	for(var i=0;i<usuarisOberts.length && trobat!=true;i++){
		if(id==usuarisOberts[i][1]){
			trobat=true;
			pos=i;
		}
		if(trobat==true){
			return pos;
		}
	}
}

$(document).ready(function(){
    $("#cerrar").click(function(){
    cerrar();
    });
});



$(document).ready(function(){
    $("#minimizarInici").click(function(){
    minimizarInici();
    });
});

$(document).ready(function(){
	$("#btnUser").click(function(){
	   $('#contenedor-usuaris').show();
	   $('#btnUser').hide();
    	$("#contenedor-usuaris").animate({height: "350px"});
	});
});
$(document).ready(function(){
	$("#cerrarUser").click(function(){
   		$("#contenedor-usuaris").animate({height: "0px"});
  		$('#btnUser').show();
		$('#contenedor-usuaris').hide();
	});
});
