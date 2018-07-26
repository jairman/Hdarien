/*
Este es el archivo js para registrar los procesos por oarte del user
 */

$(document).on('ready',function(){
	dialogoAlert();
  dialogoAlertM();
  $('#agregarFila').on('click', AgregarFilaProcesos);
  $('#agregarFilaColor').on('click', AgregarFilaColor);
	$('#agregarColor').on('click',mostrarFormColor);
  $('#procesos_enviar').on('submit',enviarProcesos);
  $('#modificar_proceso').on('submit',modificarProcesos);
  $('#enviar_colors').on('submit',guardarColor);
});

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
   $("#"+id_tabla).printThis({
         debug: false,          
         importCSS: true,           
         printContainer: true,                           
         loadCSS: "../../css/style-print.css",
         pageTitle: "",             
         removeInline: false,
         removebuttons:true, 
         encabezadoAganda:true, 

     });
} 

//moatraR BUSCAR PROCESOS
function mostrar(url){
   //console.log(url);
   var w = window.open(url,'','width=800,height=400')
   window.win=w;
   overlay.show();
   //checkChildWindow(w, function() {  } );
   w.moveTo(0,0);
    w.resizeTo(800,400);      
}

function checkChildWindow(win, onclose) {
    var w = win;
    var cb = onclose;
    var t = setTimeout(function() { checkChildWindow(w, cb); }, 500);
    var closing = false;
    try {
        if (win.closed || win.top == null) //happens when window is closed in FF/Chrome/Safari
        closing = true;        
    } catch (e) { //happens when window is closed in IE        
        closing = true;
    }
    if (closing) {
    
      window.location.reload()
    
        clearTimeout(t);
   // overlay.hide();
    }
  }
function editarPr(url){
   //console.log(url);
   var w = window.open(url,'','width=400,height=400')
   window.win=w;
   //overlay.show();
   checkChildWindow(w, function() {  } );
   w.moveTo(0,0);
   w.resizeTo(800,400);          
}

/*
 Ventana de mensajes
 */

function dialogoAlert(){
   $(function() {
      var dialogwidth=400
      $( "#dialog" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {},         
      });
   });
}

function dialogoAlertM(){
   $(function() {
      var dialogwidth=400
      $( "#error" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {},         
      });
   });
}

function alertaAccion(data){
         $("#error").html('&nbsp;&nbsp;&nbsp;'+data).css('text-align','center');
         $("#error").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/> ');
         $("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
         $("#error").dialog("open");     
         setTimeout(function () {
            $("#error").dialog("close");
           // window.parent.Shadowbox.close();
         }, 2000);   
}

function alertaAccionError(data){
         $("#error").html('&nbsp;&nbsp;&nbsp;'+data).css('text-align','center');
         $("#error").prepend('<img id="theImg2" src="../../img/erase.png" width="40" height="40"/> ');
         $("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
         $("#error").dialog("open");     
         setTimeout(function () {
            $("#error").dialog("close");
           // window.parent.Shadowbox.close();
         }, 5000);   
}
/*

 */

function mostrarFormColor(){
    $("span.ui-dialog-title").text('Agregar Color').css("text-align", "center");
    $("#dialog").dialog("open");	
}  

/*
Agregar Filas para mas procesos
 */

//eliminar filas
function removerChild(elem){
 // elem = document.getElementById(id);
  elem = elem.parentNode;
  padreb = elem.parentNode;
  padre = padreb.parentNode;
  padre.removeChild(padreb);
}

function AgregarFilaProcesos(){
  var filas = '<tr class="row">';
      filas += '<td class="cont" align="center" width="20%" class="creado">';
      filas += '         <input type="text" id="codigo" name="codigo[]" class="codigo" onkeyup="codigoRepedito(this)" required>';
     // filas += '         <input type="text" id="codigo" name="codigo[]" class="codigo" required>';
      filas += '         </td>';
      filas += '         <td class="cont" align="center" width="20%" class="creado">';
      filas += '           <input type="text" id="nombre" name="nombre[]" required class="creado">';
      filas += '         </td>';              
      filas += '         <td class="cont" align="center" width="50%" class="creado">';
      filas += '           <input  type="text" name="descripcion[]" id="descripcion" style="width: 90%;">';
      filas += '         </td>'; 
      filas += '         <td>';
      filas += '           <img src="../../img/erase.png" height="22" width="22" alt="Quitar" title="Quitar" onclick="removerChild(this)">';
      filas += '         </td></tr>';

  $('#agragar_proceso').append(filas);
}

function codigoRepedito(data){
  controles = document.getElementsByTagName('input');
  data.className="";
  for ( i=0; i<controles.length; i++){
   if(controles[i].className=='codigo'){
    if (controles[i].value==data.value && controles[i].value!=""){
      console.log('data:'+data.value);
         alertaAccion('Este código ya existe en el formulario');              
         data.value="";
         controles[i].className="codigo";
         //return false;
      } 
    }

  }
  data.className="codigo";
}

function validarCodPro(data){
  codigoRepedito(data)
  //if (codigoRepedito(data)){
    //console.log('entro a buscar aqui')
      data = data.value;
      $.get('../controllers/controlador.php?existePro&dato='+data,llegadaValidarCodPro);
//  }
}


function llegadaValidarCodPro(data){
  //console.log(data);
  var datos = "";
   var json = eval("(" + data + ")");
   for(i=0; i<json.length; i++){
    if(json[i]!=null){
      //console.log(json[i]);
      datos = json[i]+' '+datos;
    }
   }
   if (datos == ""){
    data = $('#procesos_enviar').serialize();
    $.get('../controllers/controlador.php?guardarPro&'+data,llegadaEnviarProcesos);
    //console.log('mandar');
   }
   else{
    alertaAccionError('Estos codigos existen asociados a otros procesos: '+datos);
   }
      // if(data=='Existe'){
      //    alertaAccion('Este código ya existe registrado');              
      // }  
  }

function enviarProcesos(){
  data = $('#procesos_enviar').serialize();
  $.get('../controllers/controlador.php?existePro&'+data,llegadaValidarCodPro);  
//   $('#field').keyup(function(e) {
//   if(e.keyCode==13){

//   }
// });
//  data = $('#procesos_enviar').serialize();
  //if(validarCodPro){
  //  llegadaValidarCodPro(data)
  //}
  //else{
    //$.get('../controllers/controlador.php?guardarPro&'+data,llegadaEnviarProcesos);
  //}
  return false;
}

function llegadaEnviarProcesos(data){
  //console.log(data);
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         alertaAccion('Registro Exitoso'); 
         $("#procesos_enviar input[type=text]").val("");
      }
}

function modificarProcesos(){
  data = $('#modificar_proceso').serialize();
  $.get('../controllers/controlador.php?modificarPro&'+data,llegadaModificarProcesos);
  return false;
}

function llegadaModificarProcesos (data) {
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         alertaAccion('Registro Exitoso'); 
      }
}

function noAccion(){
   $("#dialog").dialog("close");
   $("#dialogNotas").dialog("close");
}


function eliminarProceso(id){
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Proceso?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #si").attr("onclick","siEliminarA("+id+")");
   $("#dialog #no").attr("onclick","noAccion()");
}

function siEliminarA (id) {
  $('#'+id).fadeOut();
  $.get('../controllers/controlador.php?eliminarPro&id='+id,llegadaSiEliminarA);
}

function llegadaSiEliminarA(data){
  //console.log(data);
  $("#dialog").dialog("close");
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         alertaAccion('Registro Exitoso');
      }  
}

//Color
//
function AgregarFilaColor(){
  var filas = '<tr class="row">';
      filas += '        <td class="cont" align="center" width="40%">';
      filas += '         <input type="text" id="nombre" name="nombre[]" class="codigo" required>';
      filas += '        </td>';
      filas += '        <td class="cont" align="center" width="40%">';
      filas += '          <input type="color" required id="codigo" name="codigo[]" value="#f3f3f3" min="1" max="10">';
      filas += '        </td>'; 
      filas += '         <td>';
      filas += '           <img src="../../img/erase.png" height="22" width="22" alt="Quitar" title="Quitar" onclick="removerChild(this)">';
      filas += '         </td></tr>';

  $('#agragar_color').append(filas);
}

// registrar Color

function guardarColor(){
  $('.modalLoad').fadeIn();
  data = $('#enviar_colors').serialize();
  $.get('../controllers/controlador.php?guardarColor&'+data,llegadaGuardarColor); 
  return false; 
}

function llegadaGuardarColor(data){
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         setTimeout(function () {
            $("#dialog").dialog("close");
           // window.parent.Shadowbox.close();
         }, 2000);        
         alertaAccion('Registro Exitoso');            
         $("#enviar_colors input[type=text]").val("");
         $("#enviar_colors input[type=color]").val("");
      }
  $('.modalLoad').fadeOut();
}

function eliminarColor(id){
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Color?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #si").attr("onclick","siEliminarC("+id+")");
   $("#dialog #no").attr("onclick","noAccion()");
}

function siEliminarC (id) {
  $('#'+id).fadeOut();
  $.get('../controllers/controlador.php?eliminarcol&id='+id,llegadaSiEliminarA);
}

function llegadaSiEliminarC(data){
  //console.log(data);
  $("#dialog").dialog("close");
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         alertaAccion('Registro Exitoso');
      }  
}