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
