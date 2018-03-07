var productes_client=[];
function nova_ot(){
  if(document.getElementById('data_entrada').value == ""){

    alert("introdueix una data, \nsi us plau");
    location.reload();
  }
  else{

  document.getElementById('alta_ot').submit();
  }
}

function envia(boto){
  document.getElementById('boto').submit();
}

// Funció per comprovar els camps de la pàgina de comunicacions i enviar si s'escau
function comunicacio_nova(){
  if(document.getElementById('data_comunicacio').value == ''){
    alert ('introdueix la data de la comunicació \nsi us plau');
    document.getElementById('data_comunicacio').focus();
  }
  else if(document.getElementById('resum_comunicacio').value== ''){
    alert ('introdueix un resum de la comunicació \nsi us plau');
    document.getElementById('resum_comunicacio').focus();
  }
  else{
    document.getElementById('alta_comunicacio').submit();
  }
}

var xhttp = new XMLHttpRequest();
function ot_alta(){
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("newOT").innerHTML = this.responseText;
     document.getElementById('dataE').value=new Date().toISOString().split("T")[0];
     document.getElementById('formOT').style.display="block";

    }
  };
  xhttp.open("GET", "../back/alta_ot.php", true);
  xhttp.send();
}
function alta(){
  var curs=document.getElementById('curs').value;
  var dataE=new Date().toISOString().split("T")[0];;
  var usuari=document.getElementById('usuari').value;
  var prioritat=document.getElementById('prioritat').value;
  var supervisors=document.getElementById('supervisors').value;
  var tecnics=document.getElementById('tecnics').value;
  var administratius=document.getElementById('administratius').value;
  var anomalies=document.getElementById('anomalies').value;
  var ob=document.getElementById('ob').value;
  var inventari=document.getElementById('inventari').value;


  //var dataF=document.getElementById('dataF').value;
  var dataLL=document.getElementById('dataLL').value;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('formOT').style.display="none";
      productes_client=[];
      //carregaTaula();
    }
  };
  xhttp.open("GET", "../back/alta_ot_final.php?curs="+curs+"&dataE="+dataE+"&usuari="+usuari+"&prioritat="+prioritat+"&supervisors="+supervisors+"&tecnics="+tecnics+"&administratius="+administratius+"&dataLL="+dataLL+"&anomalia="+anomalies+"&ob="+ob+"&inventari="+inventari, true);
  xhttp.send();
}

function cancelar(){
  document.getElementById('formOT').style.display='none';
}

function carregaTaula(){
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('ot').value=this.responseText;
      document.getElementById('ot').style.display="block";
    }
  };
  xhttp.open("GET", "../back/carregaMain.php", true);
  xhttp.send();
}
 function mostrarInventari(){
   $("#objectes")[0].style.display="block";
}
function loadDrop(){
  var drop="";
  for(var i=0;i<productes_client.length;i++){
    drop+="<option value=''>"+productes_client[i]+"</option>"

  }
  $("#inventari")[0].innerHTML=drop;
}
function addInventari(a){
  if(a==1){
      productes_client.push("Portatil");
  }
  else if(a==2){
    productes_client.push("Movil");
  }
  else if(a==3){
    productes_client.push("Tablet");
  }
  else if(a==4){
    productes_client.push("Torre");
  }
  loadDrop();
}
function eliminarObjecte(){
  var name=$("#inventari option:selected").html();
  console.log(name);
  var pos=productes_client.indexOf(name);
  productes_client.splice(pos,1)
  loadDrop();
}
