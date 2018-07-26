/*
contiene las funciones generales del modulo
desing by  Fredis Vergara
*/
var idq;
var id22 = new Array();
var nombre2 = new Array();
var idP = new Array();
var nombreP = new Array();
$(document).on('ready',function(){
  autocompletarProveedor2();
  //autocompletarProveedor();
  buscarOrden();//consecutibo numeor de ficha tecnica
  buscarOrdenProduccion();//consecutibo numeor de ficha tecnica
  //ventanas modales inicializacion
  mensaje();
  ventanaCostos();
  dialogoAlert();//dalogo de confirmacion al eliminar
  //evebntos enviar
	$('#procesos_enviar').on('submit',function(){

    if($('#CostoFinal').val()==0){
        $('.fontaVnetana').fadeIn();
        alertaAccion('Agregue Un Proceso');
         setTimeout(function () {
          $('.fontaVnetana').fadeOut();
         }, 2000);        
    }
    else{
      $.get('../controllers/controlador.php?validarRefFicha&id='+$('#referencia').val(),llegadavalidarREF);  
    }     

    //$('.fontaVnetana').fadeOut();
    return false;
  });
  $('#enviarTodo').on('submit',enviarProduccion);
  $('#modificarFicha').on('submit',preguntaModificar);
  cargarCategoria();
  cargarUnidad();

	nobackbutton();//funcion no regresar atras

  //campos fecha
  $.datepicker.setDefaults({ 
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd",
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    monthNames: ['Enero de', 'Febrero de', 'Marzo de', 'Abril de', 'Mayo de', 'Junio de', 
            'Julio de', 'Agosto de', 'Septiembre de', 'Octubre de', 
            'Noviembre de', 'Diciembre de'],
    nextText: 'Siguiente',
    prevText: 'Anterior'
  });
  $( ".calinput" ).datepicker(); 
});

function cargarCategoria(){
  $.get('../controllers/controlador.php?cargarCategoria', LLegadacategoria)  ;
}
function LLegadacategoria (data) {
   $('#tf_cat').html('<option value=""></option>');
  var json = eval("(" + data + ")");
  for(i=0; i<json.length; i++){
    $('#tf_cat').append('<option value="'+json[i].nombre+'">'+json[i].nombre+'</option>');
   }
}

function cargarUnidad(){
  $.get('../controllers/controlador.php?cargarUnidad', LLegadaunudad)  ;
}
function LLegadaunudad (data) {
  //console.log(data);
   $('#tf_und').html('<option value=""></option>');
  var json = eval("(" + data + ")");
  for(i=0; i<json.length; i++){
    $('#tf_und').append('<option value="'+json[i].und+'">'+json[i].und+'</option>');
   }
}

//mostrar una pagina
//se crea la variable con el estilo css overlay
//overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
//
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


      window.location.reload();
    
        clearTimeout(t);
   // overlay.hide();
    }
  }

function mostrar(url){
   //console.log(url);
   var w = window.open(url,'','width=800,height=400')
   window.win=w;
   //overlay.show();
   checkChildWindow(w, function() {  } );
   w.moveTo(0,0);
   w.resizeTo(screen.width,screen.height);      
}

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

function noAccion(){
   $("#dialog").dialog("close");
   $("#dialogNotas").dialog("close");
   $("#solicitud").dialog("close");
   $("#ventanaCostos").dialog("close");
   $('.fontaVnetana').fadeOut();
}

//funcion solo numeros
function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
}

//numero decimales
 function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 8) return true
    if (key > 47 && key < 58) {
      if (field.value == "") return true
      regexp = /.[0-9]{5}$/
      return !(regexp.test(field.value))
    }
    if (key == 46) {
      if (field.value == "") return false
      regexp = /^[0-9]+$/
      return regexp.test(field.value)
    }
    return false
  }

//eliminar
function removerCosto(elem){
  padre = elem.parentNode;
  padre = padre.parentNode;
  padre = padre.parentNode;
  hijo = padre.childNodes[0];
  padre.removeChild(hijo);
  sumar();
  sumarOtrosCostosModifica();
  Costos();
}

//eliminar filas
function removerChild(id,tipo,insumo){
	elem = document.getElementById(id);
  //alert(elem);
	padre = elem.parentNode;
	padre.removeChild(elem);
  costoTotalProximado(tipo);
  costoTotalProximadoP();
  costoTotalProximadoInsumos();
  quitarCategoria(id,tipo);
  $('#i'+insumo).fadeIn();

}

//si no tiene nada borrar
function quitarCategoria(id,tipo){
  controles = document.getElementsByClassName('caja'+tipo);
  if(controles.length==0){
    $('#'+tipo).remove();
    $('#costaL'+tipo).remove();
  }

}

//eliminar insumo ficha
function eliminarInsumo(id,tipo,insumo){
  $("#dialog #si").attr("onclick",'removerChildInsumo(\''+id+'\',\''+tipo+'\', '+insumo+')');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Insumo de Ficha Técnica?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");
}

function removerChildInsumo(id,tipo,insumo){
  $('.modalLoad').fadeIn();
  removerChild(id,tipo,insumo);
  $("#dialog").dialog("close");
  sumarOtrosCostosModifica($('#otrosCostos').val());
  $('#modificarFicha').append('<input type="hidden" name="Ieliminar[]" value="'+insumo+'">');
  $('.modalLoad').fadeOut();
 // $.get('../controllers/controlador.php?eliminarInsumoFicha&id='+insumo,llegadaEliminarInsumo);
 }


function llegadaEliminarInsumo(data){
  //console.log(data);
  $('.modalLoad').fadeOut();
    if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
    }   
    else{
        alertaAccion('Registro Exitoso');
    }
}

//eliminar procesos modificar
function eliminarproceso(id,proceso,pro){
  $("#dialog #si").attr("onclick",'removerChildProceso(\''+id+'\',\''+proceso+'\',\''+pro+'\')');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Proceso de Ficha Técnica?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");
}

function removerChildProceso(id,proceso,pro){
  $('.modalLoad').fadeIn();
  $('#pr'+proceso).fadeIn();
  elem = document.getElementById(id);
  padre = elem.parentNode;
  padre.removeChild(elem);
  $("#dialog").dialog("close");
  costoTotalProximadoPModificar();
  $('#modificarFicha').append('<input type="hidden" name="Peliminar[]" value="'+pro+'">');
  $('.modalLoad').fadeOut();
}
//

function removerChildP(id,proceso,pro){
  $('#pr'+proceso).fadeIn();
  elem = document.getElementById(id);
  padre = elem.parentNode;
  padre.removeChild(elem);
  costoTotalProximado(tipo);
  costoTotalProximadoP();
  costoTotalProximadoInsumos();
}


//funcion no regresar atras
function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
}

//alerta eliminar
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
        close: function() {
          $('.fontaVnetana').fadeOut();
          $('.modalLoad').fadeOut();
        },         
      });
   });
}

////inicializar ventana de mensajes
function mensaje(){
   $(function() {
      var dialogwidth=400
      $( "#error" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {
          $('.fontaVnetana').fadeOut();
          $('.modalLoad').fadeOut();         
        },         
      });
   });    	
}

//inilizar ventana de costos
////inicializar ventana de mensajes
function ventanaCostos(){
   $(function() {
      var dialogwidth=500
      $( "#ventanaCostos" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: true, 
        close: function() {
          $('.fontaVnetana').fadeOut();
          $('.modalLoad').fadeOut();
        },         
      });
   });      
}

//mostrar mensaje de alerta o registo
function alertaAccion(data){
  //$('.fontaVnetana').fadeIn();
         $("#error").html('&nbsp;&nbsp;&nbsp;'+data).css('text-align','center');
         $("#error").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/> ');
         $("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
         $("#error").dialog("open");     
         setTimeout(function () {
          //$('.fontaVnetana').fadeOut();
            $("#error").dialog("close");
           // window.parent.Shadowbox.close();
         }, 2000);   
}

function alertaAcc(data){
         $("#error").html('&nbsp;&nbsp;&nbsp;'+data).css('text-align','center');
         $("#error").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/> ');
         $("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
         $("#error").dialog("open");     
         setTimeout(function () {
            $("#error").dialog("close");
            $('.fontaVnetana').fadeOut();
           // window.parent.Shadowbox.close();
         }, 2000);   
}

//buscar numero de orden a mostrar en el formulario
//buscar orden
function buscarOrden(){
	$.get('../controllers/controlador.php?buscarOrden',llegadaBuscarOrden);
}

function llegadaBuscarOrden(data){
	var json = eval("(" + data + ")");
	for(i=0; i<json.length; i++){
		if (json[i].orden==null){
				$('#orden').val('10001');
				$('#norden').html('10001');
		}
		else{
		$('#orden').val(parseInt(json[i].orden)+1);	
		$('#norden').html(parseInt(json[i].orden)+1);
		}
	}
}

function enviarTodoFicha(){
  data1 = $('#procesos_enviar').serialize();
  data2 = $('#enviarTodo').serialize();
  $('.modalLoad').fadeIn();
  //alert(data1);
  $.get('../controllers/controlador.php?enviarProduccion="enviar"&'+data1+'&'+data2,llegadaenviarProduccion);
  //return false;  
}

// funcion envia produccion a la bd procesos y produccion
function enviarProduccion(){
  $("#ventanaCostos").dialog("close");
  data1 = $('#procesos_enviar').serialize();
  //alert(data1);
  data2 = $('#enviarTodo').serialize();
  $.get('../controllers/controlador.php?enviarProduccion="enviar"&'+data1+'&'+data2,llegadaenviarProduccion);
	return false;
}

function llegadaenviarProduccion(data){
	//console.log(data);
    if(data=='error en la consulta'){
         alertaAcc('Error al realizar el registro');              
    }  	
    else{
		buscarOrden();
    alertaAcc('Registro Exitoso');
   $('.ventanaCostos').fadeOut();
   $('.modalLoad').fadeOut();
   $('.fontaVnetana').fadeOut();
    window.setTimeout('location.href="../views/listafichaTecnica.php"', 3000); 
    }
}

//buscar porveedor
//
function autocompletarProveedor(){
  $.get('../controllers/controlador.php?buscarProve', LLegadaAutocompletarProveedor)
}

function LLegadaAutocompletarProveedor(data){
  //console.log(data);
  $('.selectProveedor').html('<option value=""></option>');
  var json = eval("(" + data + ")");
  for(i=0; i<json.length; i++){
   $('.selectProveedor').append('<option value="'+json[i].id+'">'+json[i].nombre+'</option>');
   // idP[i]=json[i].id;
    //nombreP[i] = json[i].nombre;
   }
}

function autocompletarProveedor2(){
  $.get('../controllers/controlador.php?buscarProve', LLegadaAutocompletarProveedor2)
}

function LLegadaAutocompletarProveedor2(data){
   //$('.nuevoslelectp').html('<option value=""></option>');
  var json = eval("(" + data + ")");
  for(i=0; i<json.length; i++){
    //$('.nuevoslelectp').append('<option value="'+json[i].id+'">'+json[i].nombre+'</option>');
    id22[i]=json[i].id;
    nombre2[i] = json[i].nombre;
   }
}

function llenarnuevoslelectp(){
   $('.nuevoslelectp').html('<option value=""></option>');
  for(i=0; i<id22.length; i++){
    $('.nuevoslelectp').append('<option value="'+id22[i]+'">'+ nombre2[i]+'</option>');
   }
}

function llenarnuevoslelectproveedor(){
   $('.selectProveedor').html('<option value=""></option>');
  for(i=0; i<idP.length; i++){
    $('.selectProveedor').append('<option value="'+idP[i]+'">'+ nombreP[i]+'</option>');
   }
}


//formatear numero
function formato_numero(numero, decimales, separador_decimal, separador_miles){ // v2007-08-06
    numero=parseFloat(numero);
    if(isNaN(numero)){
        return "";
    }

    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

    if(separador_miles){
        // Añadimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}

//calcular Costos 
function Costos(){
  $('.fontaVnetana').fadeIn();
  $('#CoPredefinidos').html("");
  var filas = "<table width='100%'>";
  controles = document.getElementsByTagName('input');
  TotalCostoApx = 0;
  for ( i=0; i<controles.length; i++){
   if(controles[i].className=='costaLC'){
    if (controles[i].value==""){
      numero = 0;
    }
    else{
      numero = controles[i].value;
    }
    filas += "<tr class='row-m'>"; 
    filas += "<td width='70%'>Costo "+controles[i+1].value+" $ </td>";       
    filas += "<td class='bold' align='center' width='80%'>"+formato_numero(controles[i].value,2,'.','.')+"</td>";  
    filas += "</tr>";    
    TotalCostoApx= parseFloat(numero)+parseFloat(TotalCostoApx);
   }
  } 
  filas += "</table>"; 
  controles = document.getElementsByTagName('input');
  TotalCostoApx = 0;
  for ( i=0; i<controles.length; i++){
   if(controles[i].className=='ostrosC'){
    if (controles[i].value==""){
      numero = 0;
    }
    else{
      numero = controles[i].value;
    }    
    TotalCostoApx= parseFloat(numero)+parseFloat(TotalCostoApx);
    //sumarOtrosCostos(TotalCostoApx);
   }
  }  
  $("#otrosCostos").val('0');
  costoref = parseFloat($('#costotoli').val())+parseFloat($('#totalProceso').val())
  $('#totalref').val(costoref);
  $('#subtotal').html(formato_numero(costoref,2,'.','.'));
  $('#CoPredefinidos').append(filas);
  $('#CostoFinal').val(costoref);
  $('#total').html(formato_numero(costoref,2,'.','.'));
         /*$("#ventanaCostos").append($('#CoPredefinidos').append(filas)).css('text-align','center');
         $("#ventanaCostos").prepend('');*/
         $("span.ui-dialog-title").text('Resumen de Costos').css("text-align", "center");
         $("#ventanaCostos").dialog("open");   

  return false;
}

//sumar otros costos
function sumarOtrosCostos(data){
  controles = document.getElementsByTagName('input');
  TotalCostoApx = 0;
  for ( i=0; i<controles.length; i++){
   if(controles[i].className=='ostrosC'){
    if (controles[i].value==""){
      numero = 0;
    }
    else{
      numero = controles[i].value;
    }    
    TotalCostoApx= parseFloat(numero)+parseFloat(TotalCostoApx);
    //sumarOtrosCostos(TotalCostoApx);
   }
  }  
  if (data == ""){
    data = 0;
    $('#totalref').val(parseFloat($('#costotoli').val())+parseFloat($('#totalProceso').val()));
  }
  dato = parseFloat($('#costotoli').val())+parseFloat($('#totalProceso').val());
  total = parseFloat(dato)+parseFloat(data)+parseFloat(TotalCostoApx);
   $('#totalref').val(total);
   $('#subtotal').html(formato_numero(total,2,'.','.'));
   if($('#margenContri').val()!=""){
    sumarMargen($('#margenContri').val());
   }
   else{
      $('#CostoFinal').val(total);
      //console.log(formato_numero(total,2,'.',','))
   }
}

//sumar cosotos dinamicos
function sumar(){
  controles = document.getElementsByTagName('input');
  TotalCostoApx = 0;
  for ( i=0; i<controles.length; i++){
   if(controles[i].className=='ostrosC'){
    if (controles[i].value=="" || controles[i].value == undefined){
      numero = 0;
    }
    else{
      numero = controles[i].value;
    }    
    TotalCostoApx= parseFloat(numero)+parseFloat(TotalCostoApx);
    //sumarOtrosCostos(TotalCostoApx);
   }
  }
  dato = parseFloat($('#costotoli').val())+parseFloat($('#totalProceso').val());
  total = parseFloat(dato)+parseFloat(TotalCostoApx)+parseFloat($('#otrosCostos').val());
   $('#totalref').val(total);
   $('#subtotal').html(formato_numero(total,2,'.','.'));
   if($('#margenContri').val()!=""){
    sumarMargen($('#margenContri').val());
   }
   else{
      $('#CostoFinal').val(total);
      //console.log(formato_numero(total,2,'.',','))
   }  
  //console.log('costoFloat'+TotalCostoApx);  
}

//sumar cosot modificar
function sumarOtrosCostosModifica(data){

  if (data == ""){
    data = 0;
   // $('#totalref').val(parseInt($('#costotoli').val())+parseInt($('#totalProceso').val()));
  }  
  controles = document.getElementsByTagName('input');
  dato = 0;
  for ( i=0; i<controles.length; i++){
    //console.log(controles[i].className)
   if(controles[i].className=='cmod'){
    if (controles[i].value==""){
      numero = 0;
    }else{
      numero = controles[i].value;
    }
      dato= parseFloat(numero)+parseFloat(dato);
    // controles[i].value; +parseFloat(dato);
   }
  }

//console.log(dato);
   total = parseFloat(dato);
   $('#totalref').val(total);
   $('#subtotal').html(formato_numero(total,2,'.','.'));
   if($('#margenContri').val()!=""){
    sumarMargen($('#margenContri').val());
   }
   else{
      $('#CostoFinal').val(total);
      //console.log(formato_numero(total,2,'.',','))
   }
}

//sumar margen de utilidad
function sumarMargen(data){
  if (data == ""){
    data = 0;
  }
  valor = (parseFloat($('#totalref').val()*parseFloat(data))/100);
  total = parseFloat($('#totalref').val())+parseFloat(valor);
  //console.log(total);
  $('#utilidad').val(valor.toFixed(2));
   $('#CostoFinal').val(total);
   $('#total').html(formato_numero(total,2,'.','.'));
   $('#totalMod').val(total);
   
}

//carcular porcentaje del margen
function hayarMargen(data){
  if (data == ""){
      data = 0;
  }
  valor = (parseFloat(data*100)/$('#totalref').val());
  total = parseFloat($('#totalref').val())+parseFloat(data);
  //console.log(valor);
   $('#margenContri').val(valor.toFixed(2));
   $('#CostoFinal').val(total);
   $('#total').html(formato_numero(total,2,'.','.'));
   $('#totalMod').val(total);
}



//eliminar ficha tecnica
function eliminarF(id,id2){
  $('.fontaVnetana').fadeIn();
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Ficha Técnica?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #si").attr("onclick","siEliminarF("+id+","+id2+")");
   $("#dialog #no").attr("onclick","noAccion()");
}

function siEliminarF (id,id2) {
  // alert(id)
  idq = id2;
  $("#dialog").dialog("close");
  $('.fontaVnetana').fadeIn();
  $.get('../controllers/controlador.php?eliminarFicha&id='+id,llegadaSiEliminarFicha);
}

function llegadaSiEliminarFicha(data){
  //console.log(data);
  
  //$("#dialog").dialog("close");
      if(data=='1'){

        alertaAcc('Registro Exitoso');
         $('#'+idq).fadeOut();        

      }         
      else{   
        alertaAcc(data);
      }  
      $('.fontaVnetana').fadeOut();
}

//validar si se puede modificar ficha ecnica
function pmodificarf(id,id2){
  $.get('../controllers/controlador.php?pmodificarF&id='+id+'&id2='+id2,llegadapregunta);  
}

function llegadapregunta(data){
  //console.log(data);
  if(data=="NO"){
    alertaAcc("Acción Inválida, existe orden de Integración");
  }
  else{
       mostrar('../controllers/modificarFichaTecnica.php?id='+data);
  }
}

function preguntaModificar(){
  $('.fontaVnetana').fadeIn();
   $("#dialog #si").attr("onclick",'ModificarFicha()');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Guardar Cambios?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");  
}

function ModificarFicha(){
  //alert ($('#modificarFicha').serialize())
  data= $('#modificarFicha').serialize();
 // alert(data)
  $.get('../controllers/controlador.php?modificarFicha&'+data,llegadaModificarFicha);
  return false;
}

function llegadaModificarFicha(data){
//console.log(data)
alertaAccion('Registro Exitoso');
$("#dialog").dialog("close");
$('.fontaVnetana').fadeOut();
//location.reload();
setTimeout("window.close()",3000);
}

function agragarOtrosC(){
  $('.modalLoad').fadeIn();
  dato = " <table width='100%'>";
  dato += "    <tr class='row-m'>";
  dato += "      <td width='70%'><input type='text' style='width:80%;border:0px solid #fff; text-align:left;' name='desCO[]' required/> $</td>";
  dato += "      <td class='bold' align='center' width='80%' ><input name='cosCO[]' onkeyup='sumar(this.value)' onkeypress='return justNumbers(event);' type='text' value='0' class='ostrosC' required><img src='../../img/erase.png' height='22' width='22' onclick='removerCosto(this)'></td>";
  dato += "    </tr> ";
  dato += "  </table> ";
  tr = "    <tr class='row-m'>";
  tr += "      <td width='70%'><input type='text' style='width:80%;border:0px solid #fff; text-align:left;' name='desCO[]' class='ostrosC' required/> $</td>";
  tr += "      <td class='bold' align='center' width='80%' ><input name='cosCO[]' onkeyup='sumarOtrosCostosModifica(this.value)' onkeypress='return justNumbers(event);' type='text' value='0' required class='cmod'><img src='../../img/erase.png' height='22' width='22' onclick='removerCosto(this)'></td>";
  tr += "    </tr> "; 
  $(' div#agragarOtroCosto').append(dato);
  $('table#agragarOtroCosto').append(tr);
}

//validar referencia
function validarRef(valor){
  ///alert(valor);
  $.get('../controllers/controlador.php?validarRefFicha&id='+valor,llegadavalidarREF);
}

function llegadavalidarREF (data) {
  //console.log(data);
  if (data=='si'){
    $('#referencia').val("");
    $('.fontaVnetana').fadeIn();
    alertaAcc('Esta referencia ya existe');
  }
  else{
    Costos();
  }
}

//
function OrdenFicha (id,ref,nombre) {
  $('.fontaVnetana').fadeIn();
  $("#dialog #si").attr("onclick",'$(location).attr("href","../controllers/orden_produccion.php?id='+id+'&ref='+ref+'&nombre='+nombre+'");');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Generar Orden de Producción?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");
}

// ************************* Orden de produccion *****************************************
function buscarOrdenProduccion(){
  $.get('../controllers/controlador.php?buscarOrdenProduccion',llegadaBuscarOrdenProduccion);
}

function llegadaBuscarOrdenProduccion(data){
  //console.log(data);
  var json = eval("(" + data + ")");
  //console.log(json);
  //for(i=0; i<json.length; i++){
    if (json == ""){
        $('#ordenP').val('0001');
        $('#nordenP').html('0001');
    }
    else{
    $('#ordenP').val(json); 
    $('#nordenP').html(json);
    }
  //}
}