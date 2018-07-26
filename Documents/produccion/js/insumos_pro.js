/* este archivo js contiene las fucniones para realizar el registro de insumos en el formulario
desing by  Fredis Vergara
*/

var TotalCostoApx = 0;
var IdCostoApx = "";

$(document).on('ready',function(){
	//filtroInsumos();
	mensaje();
	$('.cerrar label').on('click',cerrarVentana);


	$('#reInsumo #bt_close').on('click',cerrarVentana);
	$('#reInsumo').on('submit',gregarInsumo);
});

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
        //	$('.fontaVnetana').fadeOut();
        },         
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
            $('.fontaVnetana').fadeOut();
           // window.parent.Shadowbox.close();
         }, 2000);   
}
//se crea tabla de tipos
function crearTabla(id,tipo,codigo,desc,present,unidad,costo){
	tipo2 = tipo;
	tipo = tipo.replace(" ","");
	if (tipo!=undefined){
		elem = document.getElementById(tipo);
		if (elem==null){
			//console.log(tipo);
			var table = "";
			table += '<div><table id="'+tipo+'" width="90%"  border="1" cellspacing="0">';
			table += '		<tr>';
			table += '		<td colspan="9" align="center" class="subtitle"><strong>'+tipo2+'</strong></td>';
			table += '		</tr>';
			table += '		<tr class="stittle">';
			table += '		<td align="center" width="10%">Código</td>';
		    table += '      <td align="center" width="10%">Descripción</td>';
		    table += '      <td align="center" width="12%">Presentación</td>';
		    table += '      <td align="center" width="15%">Und. Medida</td>';
		    table += '      <td align="center" width="5%">Consumo</td>';
		    table += '      <td align="center" width="5%">Costo Und.</td>';
		    table += '      <td align="center" width="11%">Proveedor</td>';
		    table += '      <td align="center" width="5%">Costo</td>';
		    table += '      <td align="center" width="10%"></td>';
			table += '		</tr></table><div class="totalCosto" id="costaL'+tipo+'">Costo  0</div><input type="hidden" id="costaLC'+tipo+'" name="costaLCC[]"  class="costaLC" value="0"><input type="hidden" id="descLC'+tipo+'" name="descLCC[]" class="descLC'+tipo+'" value="'+ tipo+'"></div>';
			$('#tablas').append(table);
			 crearFila(id,tipo,codigo,desc,present,unidad,costo)
		}
		else{
			 crearFila(id,tipo,codigo,desc,present,unidad,costo);
		}
	}
}

//crear filas al toma rla categoria
function crearFila(id,tipo,codigo,desc,present,unidad,costo){
			var filas = "";
			filas += '<tr id="tr'+id+'" class="row-m caja'+tipo+' ">';
			filas += '<td align="center">'+codigo+'<input type="hidden" name="idI[]" value="'+id+'"></td>';
			filas += '<td align="center">'+desc+'</td>';
			filas += '<td align="center">'+present+'</td>';
			filas += '<td align="center">'+unidad+'</td>';
			filas += '<td align="center"><input style="width:50px; text-align:center;" type="text" required id="cant'+id+'" value="" onkeyup="costoFila(this,'+id+',\''+tipo+'\')" onkeypress="return justNumbers(event);" name="cantidadI[]"></td>';
			filas += '<td align="center"><input type="text" value="'+costo+'" id="cost'+id+'" name="costoU[]" readonly></td>';
			filas += '<td align="center"><select class="nuevoslelectp" name="proveedor[]" style="width:100px;"></select></td>';
			filas += '<td align="center"><input type="text" class="'+tipo+'" style="width:80px; text-align:center;" required id="costa'+id+'" name="costoA[]" readonly value=""></td>';
			filas += '<td align="center">';
				filas += '<img src="../../img/erase.png" id="quitarInsumo" width="20" height="20" style="cursor:pointer;" title="Eliminar" onclick="removerChild(\'tr'+id+'\',\''+tipo+'\','+id+')"/>';
			filas += '</td></tr>';
			$('#'+tipo).append(filas);
			//autocompletarProveedor();
			//autocompletarProveedor2();
			llenarnuevoslelectp();
}

//funcion solo numeros
function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
}

//calcular consto aproximado por fila
function costoFila(data,id,tipo){
	controles = document.getElementsByTagName('input');
	nombre = 'cost'+id;
	nombre2 = 'costa'+id;
	for ( i=0; i<controles.length; i++){
	 if(controles[i].id==nombre){
	 	if (controles[i].value==null){
	 		numero = 0;
	 	}
	 	else{
	 		if (data.value==""){
	 			numero = 0;
	 		}
	 		else{
	 			numero = data.value;	
	 		}
	 	}		
	 	mult = parseFloat(controles[i].value)*parseFloat(numero);
	 }
	}	

	for ( i=0; i<controles.length; i++){
	 if(controles[i].id==nombre2){	 	
	 	controles[i].value=mult;
	 }
	}

	costoTotalProximado(tipo);
	costoTotalProximadoInsumos();
	sumarOtrosCostosModifica($('#otrosCostos').val());
}

//calcular cposto total aproximado insumo
function costoTotalProximado(tipo){
	controles = document.getElementsByTagName('input');
	TotalCostoApx = 0;
	for ( i=0; i<controles.length; i++){
	 if(controles[i].className==tipo){
	 	if (controles[i].value==""){
	 		numero = 0;
	 	}
	 	else{
	 		numero = controles[i].value;
	 	}
	 	TotalCostoApx= parseInt(numero)+parseInt(TotalCostoApx);
	 	controles[i].value;
	 }
	}
	$('#costaL'+tipo).html('  Costo '+formato_numero(TotalCostoApx,2,'.','.'));
	$('#costaLC'+tipo).val(TotalCostoApx);
	$('#m'+tipo).html(formato_numero(TotalCostoApx,2,'.','.'));
	$('#c'+tipo).val(TotalCostoApx);
	//$('input[name!=costo'+tipo+']').val(TotalCostoApx);

}

function costoTotalProximadoInsumos(){
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
	 	TotalCostoApx= parseInt(numero)+parseInt(TotalCostoApx);
	 }
	}
	//console.log('costo tola insumos aprox: '+TotalCostoApx);
	$('.costotoli').html('Costo Insumos '+formato_numero(TotalCostoApx,2,'.','.'));
	$('#costotoli').val(TotalCostoApx,2);
}

//funcion cerrar ventana modal
function cerrarVentana(){
	$('.ventana').fadeOut();
	$('.ventanaProve').fadeOut();
	$('.ventanaCostos').fadeOut();
	$('.ventanaAddInsumo').fadeOut();
}

//funcion buscar filtro de insumos
function filtroInsumos(data){
	$.get('../controllers/controlador.php?filtroInsumos',llegadaFiltroInsumos);
}

function llegadaFiltroInsumos(data){	
	var datos = "";
	var capa = $('#b_tipo').html('');	
	var json = eval("(" + data + ")");
	for(i=0; i<json.length; i++){
		datos += '<option value="'+json[i].categoria+'" >'+json[i].categoria+'</option>';
		crearTabla(json[i].tipo);
	 }	
	 capa.append(datos);
}


//funcion buscar otros insumos
function buscarInsumo(id){
	$('.ventana').fadeIn();
}

//validar existe Insumo
function validaragregarInsumos(id){
	var controles = document.getElementById('tr'+id);
	//alert('controles '+controles);
	if(controles==null){
		return true
	}
	else{
		return false;
	}
}

function agregarInsumos(id,tipo,codigo,desc,present,unidad,costo){
	//validaragregarInsumos(id);
	if(validaragregarInsumos(id)){
		crearTabla(id,tipo,codigo,desc,present,unidad,costo);	
		$('#i'+id).fadeOut();
		costosModificarTabla(tipo);
	}
	else{
		alertaAcc("Ya Existe Este Insumo");
	}
	
	
}

//cosot modificar
function costosModificarTabla(cat){
	tipo = cat.replace(" ","");
	var controles = document.getElementById('costo'+tipo);

	if(controles==null){
		var fila = "<tr id='costo"+tipo+"'><td width='70%'>Costo "+cat+"</td>";
	        fila += '<td class="bold" align="center" width="80%">';
			// fila += '<input style="text-align:center" type="text" id="c'+tipo+'" readonly>';
			fila += '<input type="text" id="c'+tipo+'" style="text-align:center" name="cosCO[]" value="" class="cmod">';
			fila += '<input type="hidden" name="desCO[]" value="'+cat+'">';
			fila += '</td>	</tr>';
			$('#otrasCat').append(fila);
	}
}

//funcion registrar insumos
function ventanaRInsumo(){
	$('.ventanaAddInsumo').fadeIn();
}

function gregarInsumo () {
	//console.log('agragr insumos');
	$('.fontaVnetana').fadeIn()
	data = $('#reInsumo').serialize();
	//console.log(data);
	$.get('../controllers/controlador.php?registrarInsumoTabla&'+data,llegadaRegistrarInsumos);
	return false;
}

function llegadaRegistrarInsumos(data){
	//console.log(data);
  //$("#dialog").dialog("close");
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else  if(data=='Esta referencia ya existe'){   
         alertaAccion('Esta referencia ya existe');
      }
      else{
      	$('.ventanaAddInsumo').fadeOut();
      	alertaAccion('Registro Exitoso');
      	crearTabla(data,$("#tf_cat").val(),$("#tf_codigo").val(),$("#tf_desc").val(),$("#tf_desc").val(),$("#tf_und").val(),$("#tf_costo").val());
      	costosModificarTabla($("#tf_cat").val());
      	$('#reInsumo input[type=text]').val('');
      }
      $('.fontaVnetana').fadeOut();
}