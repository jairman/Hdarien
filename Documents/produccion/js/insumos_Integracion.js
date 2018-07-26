/* este archivo js contiene las fucniones para realizar el registro de insumos en el formulario cde orden de integracion
desing by  Fredis Vergara
*/

var prov = new Array();
var nombrep = new Array();
var idprov = new Array();
var modificar = "";

$(document).on('ready',function(){
	//filtroInsumos();
	mensaje();
	regCantidad();
	fecha();
	$('#produccion_enviar').on('submit',validarFechas);
	$('#modificarOrdenP').on('submit',validarFechas2);
	$('#guardarIntegracion').on('submit',validarCheck);
	pedido();
	$('#modificarIntegracion').on('submit',validarCheck)
	$('#enviarcant').on('submit',function(){
		data = $('#enviarcant').serialize();
		//$('.modalLoad').fadeIn();
		$("#ventanaCantidad").dialog("close");
		//console.log(data);
		$.get('../controllers/controlador.php?PedirInsumos&'+data,llegadarealizarPedidoI);
		return false;
	});
});

function enviarPedido(){
	$('.modalLoad').fadeIn();
		data = $('#modificarIntegracion').serialize();
		noAccion();
		//console.log(data);
		$.get('../controllers/controlador.php?PedirInsumos&'+data,llegadarealizarPedidoI);	
	}

function enviarPedido1(){
		$('.modalLoad').fadeIn();
		data = $('#guardarIntegracion').serialize();
		noAccion();
		//console.log(data);
		$.get('../controllers/controlador.php?PedirInsumos2&'+data,llegadarealizarPedidoI);	
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
  
function editarOrdPro(url){
   //console.log(url);
   var w = window.open(url,'','width=900,height=400')
   window.win=w;
   //overlay.show();
   checkChildWindow(w, function() {  } );
   w.moveTo(0,0);
   w.resizeTo(900,400);          
}

function mostrarPro(url){
   //console.log(url);
   var w = window.open(url,'','width=900,height=400')
   window.win=w;
   overlay.show();
   //checkChildWindow(w, function() {  } );
   w.moveTo(0,0);
    w.resizeTo(900,400);      
}

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
        },         
      });
   });    	
}

function pedido(){
   $(function() {
      var dialogwidth=700
      $( "#solicitud" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {
        	$('.fontaVnetana').fadeOut();
        },         
      });
   });    	
}

function regCantidad(){
   $(function() {
      var dialogwidth=400
      $( "#ventanaCantidad" ).dialog({
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

function fecha(){
   var f=new Date();
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	var f=new Date();
	// $('.fecha').html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
	$('.fecha').html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()]);
   
}


function alertaAccion(data){
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
//se crea tabla de tipos
function crearTabla(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol,des){
	if (tipo!=undefined){
		tipo = tipo.replace(" ","");
		elem = document.getElementById(tipo);
		if (elem==null){
			var table = "";
			table += '<div><table id="'+tipo+'" width="90%"  border="1" cellspacing="0">';
			table += '		<tr>';
			table += '		<td colspan="12" align="center" class="subtitle"><strong>'+tipo+'</strong></td>';
			table += '		</tr>';
			table += '		<tr class="stittle">';
			table += '		<td align="center" width="10%">Código</td>';
		    table += '      <td align="center" width="10%">Descripción</td>';
		    table += '      <td align="center" width="5%">Unid. Medida</td>';
		    table += '      <td align="center" width="5%">Proveedor</td>';
		    table += '      <td align="center" width="5%">Consumo</td>';
		    table += '      <td align="center" width="5%">Costo consumo</td>';
		    table += '      <td align="center" width="5%">Cantidad Requerida</td>';
		    table += '      <td align="center" width="5%">Costo Total</td>';
		    table += '      <td align="center" width="5%">Inventario</td>';
		    table += '      <td align="center" width="5%">Solicitar</td>';
		    table += '      <td align="center" width="5%">Descargar</td>';
		    table += '      <td align="center" width="5%"></td>';
			$('#tablas').append(table);
			 if(modificar=="Pendiente" || modificar=="pendiente"){
			 	crearFila(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol,des);
			 }else{
			 	crearFilaM(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol,des);
			 }
		}
		else{
			 if(modificar=="Pendiente" || modificar=="pendiente"){
			 	console.log(modificar);
			 	crearFila(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol,des);
			 }else{
			 	crearFilaM(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol,des);
			 }
		}
	}
}

function completarProveedor(data){
   $.get('../controllers/controlador.php?buscarProve', LLegadaCompletarProveedor)
}

function LLegadaCompletarProveedor(data){
	//console.log('prov   -->'+prov.length);
			  	nombrep[0] = 'Sin proveedor';
		  		idprov[0] = 0;	
	for (var j = 0; j<= prov.length; j++) {
		   $('.selectProvee'+prov[j]).html('<option value="0">Sin proveedor</option>');	   
		   //$('.nuevoslelectp').html
		  var json = eval("(" + data + ")");
		  for(i=0; i<json.length; i++){
		  	if (json[i].id==prov[j]){
		  		$('.selectProvee'+prov[j]).append('<option value="'+json[i].id+'" selected>'+json[i].nombre+'</option>');	
		  	}
		  	else{
		  		$('.selectProvee'+prov[j]).append('<option value="'+json[i].id+'">'+json[i].nombre+'</option>');	
		  	}
		  	nombrep[i+1] = json[i].nombre;
		  	idprov[i+1] = json[i].id;
		  	//console.log(json[i].nombre);
		    
		   }
	};
}

function resumenP (val,ant,id,codigo,des,und) {
	crearTablaSol(codigo,des,$('#s'+id).val(),$('#i'+id).val(),val,id,und);	
	$('#tm'+ant).remove();
	$("#pr"+id).remove('onchange');
	$("#pr"+id).attr('onchange','resumenP(this.value,'+val+','+id+',"'+codigo+'","'+des+'")');
}

//crear filas al toma rla categoria editar registrar
function crearFila(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol, des){
			$('#cprogramada').html($('#cantidadOP').val());
			$('#cantidadOPI').val($('#cantidadOP').val());
			cantidadToral = (parseFloat($('#cantidadOP').val()*parseFloat(cantidad)));
			cantidadToral = cantidadToral.toFixed(2);
			costoTotal = parseFloat(costo)*parseFloat(cantidadToral);
			var filas = "";
			filas += '<tr id="tr'+id+'" class="row-m">';
			filas += '<td align="center">'+codigo+'<input type="hidden" name="idI[]" value="'+id+'"></td>';
			filas += '<td align="center">'+desc+'<input type="hidden" name="idFicha[]" value="'+id_ficha+'"></td>';
			filas += '<td align="center">'+unidad+'<input type="hidden" name="unidad" id="und'+id+'" value="'+unidad+'" /><input type="hidden" name="cantidad" value="'+cantidad+'" /><input type="hidden" name="cantidad_und[]" /></td>';
			filas += '<td align="center"><select style="width:125px" class="selectProvee'+proveedor+'" id="pr'+id+'" name="proveedor[]" onchange="resumenP(this.value,\''+proveedor+'\','+id+',\''+codigo+'\',\''+desc+'\',\''+unidad+'\')"></select></td>';
			filas += '<td align="center">'+cantidad+'<input type="hidden" name="costo_uni[]"  value="'+costo+'"/></td>';
			filas += '<td align="center">'+parseFloat(costo)*parseFloat(cantidad)+'<input type="hidden" name="costo[]" value="'+parseFloat(costo)*parseFloat(cantidad)+'" /></td>';
			filas += '<td align="center" class="bold">'+cantidadToral+'<input type="hidden" name="cantidadTotal[]" id="t'+id+'" value="'+cantidadToral+'" /></td>';
			filas += '<td align="center" class="bold">'+costoTotal+'</td>';
			
			 filas += '<td align="center">'+cantidad_inv+'</td>';
			if (parseInt(cantidad_inv)==0){
				filas += '<td align="center" >';
				filas += '<input type="text" style="width:110px" required placeholder="Min '+cantidadToral+'" id= "s'+id+'" value="'+sol+'"  onblur="minimoI(this.value,'+cantidadToral+','+id+','+cantidad_inv+',\''+codigo+'\',\''+desc+'\',\''+unidad+'\')" onkeyup="validarCantidadCampo(this.value,'+cantidadToral+','+id+','+cantidad_inv+',\''+codigo+'\',\''+desc+'\',\''+unidad+'\')" class="accion" name="sol[]" onkeypress="return justNumbers(event);">';
				filas += ' </td>';
				filas += '<td align="center">';
				filas += '<input type="text" readonly placeholder="Max '+cantidad_inv+'" id= "i'+id+'"  value="'+des+'" style="width:110px"  class="accion" name="des[]" onkeypress="return justNumbers(event);">';
				filas += '      <td align="center" width="5%" id="v'+id+'"><img src="" width="22" height="22" id="im'+id+'"></td>';
				filas += '</td></tr>';
			}
			else{

				minima = calculoMinimo(cantidad_inv,cantidadToral);
				filas += '<td align="center" >';
				filas += '<input type="text" style="width:110px" required   placeholder="Minimo '+minima+'" class="accion" name="sol[]" id= "s'+id+'" value="'+sol+'"  onkeyup="validarCantidadCampo(this.value,'+minima+','+id+','+cantidad_inv+',\''+codigo+'\',\''+desc+'\')" onblur="minimoI(this.value,'+minima+','+id+','+cantidad_inv+',\''+codigo+'\',\''+desc+'\',\''+unidad+'\')" onkeypress="return justNumbers(event);">';
				filas += ' </td>';
				filas += '<td align="center">';
				filas += '<input type="text" placeholder="Max '+cantidad_inv+'"  id= "i'+id+'" value="'+des+'" onkeyUp="maximo(this.value,'+cantidadToral+','+id+','+cantidad_inv+',\''+codigo+'\',\''+desc+'\')" onkeydown="maximo(this.value,'+cantidadToral+','+id+','+cantidad_inv+',\''+codigo+'\',\''+desc+'\')" style="width:110px" class="accion" name="des[]" onkeypress="return justNumbers(event);">';
				filas += '</td>';
				filas += '      <td align="center" width="5%" id="v'+id+'"><img src="" width="22" height="22" id="im'+id+'"></td></tr>';	
				calMin(cantidad_inv,cantidadToral);							
			}
			

			filas += '<td align="center"></td>';
			$('#'+tipo).append(filas);		
}

//crear filas al toma rla categoria mostrar
function crearFilaM(id,tipo,codigo,desc,present,cantidad,unidad,costo,cantidad_inv,id_ficha,proveedor,sol, des){
			$('#cprogramada').html($('#cantidadOP').val());
			$('#cantidadOPI').val($('#cantidadOP').val());
			cantidadToral = (parseFloat($('#cantidadOP').val()*parseFloat(cantidad)));
			cantidadToral = cantidadToral.toFixed(2);
			var filas = "";
			filas += '<tr id="tr'+id+'" class="row-m">';
			filas += '<td align="center">'+codigo+'<input type="hidden" name="idI[]" value="'+id+'"></td>';
			filas += '<td align="center">'+desc+'<input type="hidden" name="idFicha[]" value="'+id_ficha+'"></td>';
			filas += '<td align="center">'+unidad+'<input type="hidden" name="unidad" id="und'+id+'" value="'+unidad+'" /><input type="hidden" name="cantidad" value="'+cantidad+'" /><input type="hidden" name="cantidad_und[]" /></td>';
			filas += '<td align="center"><select style="width:125px" class="selectProvee'+proveedor+'" id="pr'+id+'" name="proveedor[]" onchange="resumenP(this.value,\''+proveedor+'\','+id+',\''+codigo+'\',\''+desc+'\',\''+unidad+'\')"></select></td>';
			filas += '<td align="center">'+cantidad+'<input type="hidden" name="costo_uni[]"  value="'+costo+'"/></td>';
			filas += '<td align="center">'+parseFloat(costo)*parseFloat(cantidad)+'<input type="hidden" name="costo[]" value="'+parseFloat(costo)*parseFloat(cantidad)+'" /></td>';
			filas += '<td align="center" class="bold">'+cantidadToral+'<input type="hidden" name="cantidadTotal[]" id="t'+id+'" value="'+cantidadToral+'" /></td>';
			filas += '<td align="center" class="bold">'+costoToral+'</td>';
			
			filas += '<td align="center">'+cantidad_inv+'</td>';
			filas += '<td align="center" >';
			filas += sol;
			filas += ' </td>';
			filas += '<td align="center">';
			filas += des;
			filas += '</td>';
			filas += '      <td align="center" width="5%" id="v'+id+'"><img src="" width="22" height="22" id="im'+id+'"></td></tr>';								

			filas += '<td align="center"></td>';
			$('#'+tipo).append(filas);			
}

function calculoMinimo (inventario,cantidad) {
	if(parseFloat(inventario) >parseFloat(cantidad)){
		return 0;
	}
	else if(parseFloat(inventario) <=parseFloat(cantidad)){
				minima = parseFloat(cantidad)-parseFloat(inventario);
				return  minima;
	}
}

//mostrar validar que cantiad >= requerida
function imagenValidacion(id,inv,codigo,desc,und){
	if($('#i'+id).val()==""){
		num1 = 0
	}
	else{
		num1 = parseFloat($('#i'+id).val());
	}

	if($('#s'+id).val()==""){
		num2 = 0
	}
	else{
		num2 = parseFloat($('#s'+id).val());
	}	
	

	// num2 = parseFloat($('#s'+id).val());
	num3 = parseFloat($('#t'+id).val());

	if(num1==""){
		num1=0;
	}
	if(num2==""){
		num2=0;
	}
	suma = num1+num2;
	//console.log(suma+' cantidad: '+num3)
	if(suma>=num3){
		$('#im'+id).attr('src','../../img/good.png');
		$('#im'+id).attr('title','Cantidad Pedida Correcta');
		$('#s'+id).removeAttr( "required" );
		$('#i'+id).removeAttr( "required" );
		crearTablaSol(codigo,desc,$('#s'+id).val(),$('#i'+id).val(),$('#pr'+id).val(),id,und);
		
	}
	else{
		$('#im'+id).attr('title','Cantidad Pedida Incorrecta');
		$('#im'+id).attr('src','../../img/erase.png');
		if(num2==0){
			$('#s'+id).attr('required','true');
		}	
		if(num1==0){
			$('#i'+id).attr('required','true');
		}		
	}
	if(num1=="" && num2==""){
		$('#im'+id).attr('src','');		
		$('#im'+id).attr('title','');

	}
}

function maximo(valor,total,id,inv,codigo,desc){
	if(parseFloat(valor)>parseFloat(inv)){
		$('#i'+id).val("");
	}
	else{
		calMin(valor,total,id,inv,codigo,desc);	
	}	
}

//calcular minimo cuando hay inventario 
function calMin(valor,total,id,inv,codigo,desc){
	if (valor==""){
		minimo = calculoMinimo(inv,total);
		// minimo = parseFloat(inv)-parseFloat(total);
		// if(minimo<0)
		// {
		// 	minimo = minimo*(-1);
		// }		
	}
	else{		
		//minimo = parseFloat(total)-parseFloat(valor);
		minimo = calculoMinimo(valor,total);
	}
	$('#s'+id).attr('placeholder','Minimo '+minimo);
	validarCantidadCampoInv(valor,inv,id);
	imagenValidacion(id,inv,codigo,desc);
}

//validar que el valor sea correcto
//
function minimoI(val,min,id,inv,codigo,desc){
	if(parseFloat(val)<parseFloat(min)){
		$('#s'+id).val("");
	}

	validarCantidadCampo($('#s'+id).val(),min,id,inv,codigo,desc);
}

function validarCantidadCampo(val,min,id,inv,codigo,desc,und){

	if (val<min && val!=""){
		$('#s'+id).css('border','2px solid red');		
	}
	else if(val>=min){
		$('#s'+id).css('border','2px solid #04B404');		
	}
	else if(val==""){
		$('#s'+id).css('border','1px solid #aaa');				
	}
	imagenValidacion(id,inv,codigo,desc,und);
}

function validarCantidadCampoInv(val,min,id,inv,codigo,desc,und){

	if (val>min){
		$('#i'+id).css('border','2px solid red'); 
	}
	else if(val<=min && val!=""){
		$('#i'+id).css('border','2px solid #04B404');		
	}
	else if(val==""){
		$('#i'+id).css('border','1px solid #aaa');			
	}
	imagenValidacion(id,inv,codigo,desc,und);

}

//realizarPedidoI()
function realizarPedidoI(orden,id,total){
  $("#dialog #si").attr("onclick",'siRealizarPedido(\''+orden+'\',\''+id+'\',\''+total+'\')');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Realizar Pedido?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");	
}

function siRealizarPedido(orden,id,total){
	$("#dialog").dialog("close");
	$('#cpedir').val(total);
		 console.log('orden de prod: '+orden+' id insumo: '+id+' orden integracion '+$('#ordenI').val());
		 $('#pordenp').val(orden);
		 $('#insumo').val(id);
		 $('#integracion').val($('#ordenI').val());
          $("span.ui-dialog-title").text('Cantidad a Pedir').css("text-align", "center"); 
          $("#ventanaCantidad").dialog("open");
}

function llegadarealizarPedidoI(data) {
	//console.log(data);
	if(data=="Registre orden de integración"){
		alertaAccion("Registre orden de integración");              
	}
	else{
		alertaAccion('Registro Exitoso');              
	}              
	$('.modalLoad').fadeOut();
	window.setTimeout('location.href="../views/listaOrdenProduccion.php"', 3000); 	
}

//function validar fecha inicio fecha de fin
function validarFechas(){
	inicio = $('#fecha_inicio').val();
	fin = $('#fecha_fin').val();
	if (fin<=inicio){
		$('.fontaVnetana').fadeIn();
			alertaAccion('Verifique las Fechas');    
		//return false;
	}
	else{
		
		mensajeConfirmacionEnvioOrden();
		//return true;
	}
	return false;
}

function mensajeConfirmacionEnvioOrden(){
	$('.fontaVnetana').fadeIn();
  $("#dialog #si").attr("onclick",'enviarOrdenProduccion()');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Crear Orden de Producción?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");	
   return false;
}

function enviarOrdenProduccion(){
	$('.fontaVnetana').fadeOut();
	//if (validarFechas()){
		$("#dialog").dialog("close");
		$('.modalLoad').fadeIn();

		data = $('#produccion_enviar').serialize();

		$.get("../controllers/controlador.php?agregarOrdenProd&"+data, llegadaEnviarOrdenProduccion);
	//}
	//return false;
}

function llegadaEnviarOrdenProduccion(data){
	console.log(data);
    if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
    }  	
    else{
		//buscarOrdenProduccion();
	    alertaAccion('Registro Exitoso');
	    buscarInsumosFicha($('#ficha').val(),'Pendiente');
	    $('#OrdenProduccion').fadeOut();
    $('.modalLoad').fadeOut();
    }
}

function buscarInsumosFicha (ficha,estado) {
	modificar = estado;
	$.get('../controllers/controlador.php?buscarFicha='+ficha+'&integracion='+$('#ordenII').val(),llegadaEnviarordenP);
}

function llegadaVerificarP(data){
	//console.log(data);
	$.get('../controllers/controlador.php?buscarFicha='+ficha,llegadaEnviarordenP);
}

function llegadaEnviarordenP (data) {
	//alert(modificar);
  //console.log('mensaje' +data);
  var json = eval("(" + data + ")");
  $('#ordenpr').html($('#ordenP').val());
  $('#ordenpro').val($('#ordenP').val());
  for(i=0; i<json.length; i++){
  	if (json[i].sol==0){
  		json[i].sol="";
  	}
  	if (json[i].des==0){
  		json[i].des="";
  	} 
  	//console.log(json[i].cantidad) 	
  	crearTabla(json[i].id,json[i].categoria,json[i].codigo,json[i].descr,json[i].present,json[i].consumo,json[i].unidad,json[i].costo,json[i].cantidad,json[i].id_ficha,json[i].proveedor,json[i].sol,json[i].des);
  	prov[i] = json[i].proveedor;
  }
  completarProveedor();
  $.get('../controllers/controlador.php?buscarOrdenIntegracion',llegadaBuscarOrdenIntegracion);
  $('#OrdenIntegracion').fadeIn();
}

function llegadaBuscarOrdenIntegracion(data){
  var json = eval("(" + data + ")");
    if (json == ""){
        $('#ordenP').val('0001');
        $('#nordenP').html('0001');
    }
    else{
    $('#ordenI').val(json); 
    $('#nordenI').html(json);
    }
    enviarOrdenIntegracion();
}

//eliminar Orden de Pedir
//eliminar insumo ficha
function preguntaEliminarOrdenProduccion(id){
  $("#dialog #si").attr("onclick",'EliminarOrdenProduccion(\''+id+'\')');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Esta orden de Producción?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");
}

function EliminarOrdenProduccion (id) {
  $('#'+id).fadeOut();
  $.get('../controllers/controlador.php?eliminarOrdenProduccion&id='+id,llegadaEliminarorden);
}

function llegadaEliminarorden(data){
  //console.log(data);
  $("#dialog").dialog("close");
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         alertaAccion('Registro Exitoso');
      }  
}

//buscar Orden de integracion
function enviarOrdenIntegracion(){
	if($('#modificarInsumosFicha').val()=="si"){
		data = $('#modificarIntegracion').serialize();
		$.get('../controllers/controlador.php?modificarOrdenIntegracion&'+data,llegadaModificarIntegracion);
	}
	else{
		data = $('#guardarIntegracion').serialize();
		$.get('../controllers/controlador.php?guardarOrdenIntegracion&'+data,llegadaRegistrarIntegracion);
	}
	//alert(data);
	return false;
}

function llegadaModificarIntegracion(data){	
	//console.log(data)
}

function llegadaRegistrarIntegracion(data){
	//console.log(data);
  $("#dialog").dialog("close");
  //$('#guardarIntegracion #ok').attr('disabled','disabled'); 
  alertaAccion('Registro Exitoso');
}

//verificar si existe 
function verificarExistencia(id){
	//console.log(id);
 	$.get('../controllers/controlador.php?verificarExisteOrden&orden_pro='+id,llegadaVerificarExistencia);
}

function llegadaVerificarExistencia(data){
	//console.log(data);
	
	if(data=="Operación no válida, existe orden de Integración"){
		alertaAccion(data);	
	}
	else{
		editarOrdPro('../controllers/editarOrden_produccion.php?id='+data);
	}
}

function validarFechas2(){
	inicio = $('#fecha_inicio').val();
	fin = $('#fecha_fin').val();
	if (fin<=inicio){
			alertaAccion('Verifique las Fechas');    
		//return false;
	}
	else{
		mensajeConfirmacionModOrden();
		//return true;
	}

	return false;
}

function mensajeConfirmacionModOrden(){
  $("#dialog #si").attr("onclick",'enviarOrdenModificarPro()');
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> Modificar Orden de Producción?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #no").attr("onclick","noAccion()");	
   return false;
}

function enviarOrdenModificarPro(){
	//if (validarFechas()){
		$("#dialog").dialog("close");
		$('.modalLoad').fadeIn();

		data = $('#modificarOrdenP').serialize();;

		$.get("../controllers/controlador.php?modificarOrdenProd&"+data, llegadaModificarOrdenProduccion);
	//}
	return false;
}

function llegadaModificarOrdenProduccion(data){
	//console.log(data);
    if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
    }  	
    else{
		//buscarOrdenProduccion();
	    alertaAccion('Registro Exitoso');
	    //buscarInsumosFicha($('#ficha').val());
	    //$('#OrdenProduccion').fadeOut();
    $('.modalLoad').fadeOut();
    }
}

///validar si registrar accio
function validarCheck(){
	
	cantidad = document.getElementsByClassName('tm').length;
	//console.log('cantidad '+cantidad);
	if (cantidad != 0){
	var i = 0; 

	$('.fontaVnetana').fadeIn();
	 $("span.ui-dialog-title").text('Resumen del Pedido').css("text-align", "center"); 
	 $("#solicitud").dialog("open");	
	}
	  return false;
}

function llegadaEnviarordenPSol (data) {
	//console.log(data);
  var json = eval("(" + data + ")");
  $('#ordenpr').html($('#ordenP').val());
  $('#ordenpro').val($('#ordenP').val());
  for(i=0; i<json.length; i++){
  	crearTablaSol(json[i].id,json[i].categoria,json[i].codigo,json[i].descr,json[i].present,json[i].consumo,json[i].unidad,json[i].costo,json[i].cantidad,json[i].id_ficha,json[i].proveedor,json[i].prove);  	  	
  }
		   $("span.ui-dialog-title").text('Pedidos').css("text-align", "center"); 
		   $("#solicitud").dialog("open");  
}

//se crea tabla de tipos
function crearTablaSol(codigo,desc,solicitar,inven,proveedor,id,und){
	//console.log('proveedor cod '+proveedor);
	for (var j = 0; j<= prov.length; j++) {
		for (var i = 0; i<= nombrep.length; i++) {
			if(proveedor==idprov[i]){
				prov = nombrep[i];
			}
		}
	}
	//console.log(id);
	if (id==0){
		prov="Sin proveedor";
	}	
	elem = document.getElementById('trm'+id);
	if (!(elem==null)){
		$('#trm'+id).remove();
	}
	if (proveedor!=undefined){
		elem = document.getElementById('tm'+proveedor);
		//console.log(elem)
		if (elem==null){
			var table = "";
			table += '<table id="tm'+proveedor+'" class="tm" width="90%"  border="1" cellspacing="0">';
			table += '		<tr>';
			table += '		<td colspan="5" align="center" class="subtitle"><strong>'+prov+'</strong></td>';
			table += '		</tr>';
			table += '		<tr class="stittle">';
			table += '		<td align="center" width="10%">Código</td>';
		    table += '      <td align="center" width="10%">Descripción</td>';
		    table += '      <td align="center" width="5%">Solicitar</td>';
		    table += '      <td align="center" width="5%">Descargar</td>';
		    table += '      <td align="center" width="5%">Unidad</td>';
			$('#tablasol').append(table);
			 crearFilaSol(codigo,desc,solicitar,inven,proveedor,id,und);
		}
		else{
			 crearFilaSol(codigo,desc,solicitar,inven,proveedor,id,und);
		}
	}
}

//crear filas al toma rla categoria
function crearFilaSol(codigo,desc,solicitar,inven,proveedor,id,und){
			//prov = proveedor;
			//alert($('#trm'+id).length);
			var filas = "";
			filas += '<tr id="trm'+id+'" class="row-m">';
			filas += '<td align="center">'+codigo+'</td>';
			filas += '<td align="center" >'+desc+'</td>';
			filas += '<td align="center" class="bold">'+solicitar+'</td>';
			filas += '<td align="center" class="bold">'+inven+'</td>';
			filas += '<td align="center">'+$('#und'+id).val()+'</td>';

			filas += '</tr>';
			$('#tm'+proveedor).append(filas);
}