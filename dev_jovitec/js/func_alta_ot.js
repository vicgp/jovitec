var productes_client=[];
//
// function nova_ot(){
//   if(document.getElementById('data_entrada').value == ""){
//
//     alert("introdueix una data, \nsi us plau");
//     location.reload();
//   }
//   else{
//
//   document.getElementById('alta_ot').submit();
//   }
// }
//
// function envia(boto){
//   document.getElementById('boto').submit();
// }
//
// // Funció per comprovar els camps de la pàgina de comunicacions i enviar si s'escau
// function comunicacio_nova(){
//   if(document.getElementById('data_comunicacio').value == ''){
//     alert ('introdueix la data de la comunicació \nsi us plau');
//     document.getElementById('data_comunicacio').focus();
//   }
//   else if(document.getElementById('resum_comunicacio').value== ''){
//     alert ('introdueix un resum de la comunicació \nsi us plau');
//     document.getElementById('resum_comunicacio').focus();
//   }
//   else{
//     document.getElementById('alta_comunicacio').submit();
//   }
// }

//----------------------------------------------------------------
//----------funcio per afagir el modal de ordres noves------------
//----------------------------------------------------------------

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
//----------------------------------------------------
//----------funcio per afagir ordres noves------------
//----------------------------------------------------
function alta(){
  //agafem tots el valors del modal
  var curs=document.getElementById('curs').value;
  var dataE=new Date().toISOString().split("T")[0];;
  var usuari=document.getElementById('usuari').value;
  var prioritat=document.getElementById('prioritat').value;
  var supervisors=document.getElementById('supervisors').value;
  var tecnics=document.getElementById('tecnics').value;
  var administratius=document.getElementById('administratius').value;
  var anomalies=document.getElementById('anomalies').value;
  var ob=document.getElementById('ob').value;
  var dataLL=document.getElementById('dataLL').value;

  console.log(productes_client);
 var inventari=JSON.stringify(productes_client);
 console.log(inventari);
 var parametres="curs="+curs+"&dataE="+dataE+"&usuari="+usuari+"&prioritat="+prioritat+"&supervisors="+supervisors+"&tecnics="+tecnics+"&administratius="+administratius+"&dataLL="+dataLL+"&anomalia="+anomalies+"&ob="+ob+"&inventari="+inventari;
  //var dataF=document.getElementById('dataF').value;
  console.log(parametres);

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('formOT').style.display="none";
      productes_client=[];
      carregaTaula();
    }
  };

  xhttp.open("POST", "../back/alta_ot_final.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(parametres);
}
//------funcio per sortir del modal---------
function cancelar(){
  document.getElementById('formOT').style.display='none';
}
//----funcio per tornar a carregar la taula----
function carregaTaula(){
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('otTotal').value=this.responseText;
    }
  };
  xhttp.open("GET", "../back/carregaMain.php", true);
  xhttp.send();
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
  if(productes_client.length<=1){
    document.getElementById('modalProduct').style.display='block';

    if(a==1){
      document.getElementById('tipusProduct').value="portatil";
    }
    else if(a==2){
      document.getElementById('tipusProduct').value="movil";
    }
    else if(a==3){
      document.getElementById('tipusProduct').value="tablet";
    }
    else if(a==4){
    document.getElementById('tipusProduct').value="PC Torre";
    }
  }
  else{
    $("#MaximProduct")[0].style.display="block";
	  setTimeout(clearAlertProduct,4000);
  }
}
//---funcio per netejar el alert de productes maxim-----
function clearAlertProduct(){
	$("#MaximProduct")[0].style.display="none";
  $("#productAfagit")[0].style.display="none";


}
//---- funcio per treure el modal de producte------
function cancelarProduct(){
  document.getElementById('modalProduct').style.display='none';

}
//--- funcio per afagir un objecte al desplegable del inventari
function addInventariFinal(){
  var product=document.getElementById('tipusProduct').value;
  var desc=document.getElementById('descProduct').value;
  productes_client.push([product,desc]);
  document.getElementById('modalProduct').style.display='none';
  $("#productAfagit")[0].style.display="block";
  setTimeout(clearAlertProduct,4000);
  loadDrop();
  document.getElementById('descProduct').value="";
}
function eliminarObjecte(){
  var name=document.getElementById("inventari").value;
  for(var i=0;i<productes_client.length;i++){
    if(productes_client[i][0].includes(name)){
      productes_client.splice(i,1)
    }

  }

  loadDrop();
}
