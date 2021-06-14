let idProducto=[];
let precio=[];
let totalApagar=[];



function send(campo){

   var data = $("#tours").serialize();
    data =data+"&save=ok";
    var tabla = $('#tabla_hoteles');
    tabla.empty();

   //realizar la peticion ajax con backend
   $.ajax({
     type:"POST",
     url:"datos/hoteles.php",
     data:data

   }).done(function(res){
    var res =JSON.parse(res);

    res.forEach(element => {

        html = '<tr>';
        html += '<td >'+ element.name+'</td>';
        html += '<td>'+ element.destino +'</td>';
        html += '<td>'+ element.precio +'</td>';
        html += '<td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="reservar('+element.id+')">Reservar</button></td>';
        html += '</tr>';
        tabla.append(html);
    });

   }).fail(function(a,b,c){
     alert(c);
   });

}




function reservar(id){
  $('#diaSP').val("1")
  precio=[];
  totalApagar=[];
  idProducto=[];
  var detalle = $('#detalle');
  detalle.empty();

  var total = $('#total');
  total.empty();

 $.ajax({
   type:"POST",
   url:"datos/calcular.php",
   data:{'id': id}

 }).done(function(res){
  var res =JSON.parse(res);
  res.forEach(element => {

    precio.push(element.precio)
    totalApagar.push(element.precio)
    idProducto.push(element.id)

    html = '<li class="list-group-item">Hotel: '+ element.name+'</li>';
    html += '<li id="precioDolar" class="list-group-item">'+ element.precio+'  USD</li>';
    detalle.append(html);

    html = '<div class="list-group-item"> Total: '+element.precio+' USD</div>';
    total.append(html);

  });

 }).fail(function(a,b,c){
   alert(c);
 });


}



function sumaDSP(){

  var total = $('#total');
  total.empty();
  var num_persona = parseInt(document.getElementById("diaSP").value);
  let suma = num_persona +1;

  if(suma>=100){
    document.getElementById("diaSP").value = 100;
  }
  else{
    document.getElementById("diaSP").value = suma;
  }

  let totalSuma =suma*precio;


  totalApagar=[];
  totalApagar.push(totalSuma)
 
  
  html = '<div class="list-group-item"> Total: '+totalSuma+' USD</div>';
  total.append(html);
  
 
  
  
  
};

function restaDSP(){

  var total = $('#total'); 
  total.empty();
  
  
  

  

    var num_persona  = parseInt(document.getElementById("diaSP").value);
    let suma=num_persona-1;
    if(suma<=1){
      document.getElementById("diaSP").value = 1;
    }
    else{
      document.getElementById("diaSP").value = suma;
    }


    let totalSuma =suma*precio;
 
    
    if (totalSuma===0) {

      totalApagar=[];
      totalApagar.push(precio)
      
    }else{
      totalApagar=[];
      totalApagar.push(totalSuma)
    }
    
    


 
    if (totalSuma==0) {
      html = '<div class="list-group-item"> Total: '+precio+' USD</div>';
      total.append(html);
    }else{

    html = '<div class="list-group-item"> Total: '+totalSuma+' USD</div>';
    total.append(html);
    
    }


};





function saveForm(){

 

  var data = $("#saveForm").serialize();
  data=data+"&id="+idProducto;
  data=data+"&total="+totalApagar;
  data =data+"&save=ok";
  
  
  $.ajax({
    type:"POST",
    url:"datos/saveDatos.php",
    data:data

  }).done(function(res){
    var res =JSON.parse(res);
console.log(res);

  }).fail(function(a,b,c){
    alert(c);
  });

}
