// JavaScript Document
$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	



	//configurando el datepicker para las fechas
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
	
	//hace que los campos desplieguen un datepicker
	$( "#tf_fecha").datepicker();
	$( "#tf_fecha2").datepicker();





		//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
		 removebuttons:true       
	  });
}


// Funcion para cambiar cliente o proveedor
	$('#concepto').bind('change', function () {
		var tipo = $('#concepto').val();
		//alert(tipo)
		if (tipo == 'Egreso'){
			$('#lb_f1').text('Fecha Entrada: ');
			$('#lb_c1').text('Proveedor: ');
			
			$("#formapago").removeAttr("disabled");
			$("#estado").removeAttr("disabled");
			$("#tf_resp").removeAttr("disabled");
			$("#tf_cedula").removeAttr("disabled");
			

		}
		
		if (tipo == 'Ingreso'){
			$('#lb_f1').text('Fecha Salida: ');
			$('#lb_c1').text('Cliente: ');
			
			$("#formapago").removeAttr("disabled");
			$("#estado").removeAttr("disabled");
			$("#tf_resp").removeAttr("disabled");
			$("#tf_cedula").removeAttr("disabled");
						
		}
		
		if (tipo == 'Base'){
						
			$('#formapago').val('Base');
			$("#formapago").prop('disabled', 'true');
			
			$('#estado').val('Base');
			$("#estado").prop('disabled', 'true');
			
			$('#tf_resp').val('Base');
			$("#tf_resp").prop('disabled', 'true');
			
			$('#tf_cedula').val('Base');
			$("#tf_cedula").prop('disabled', 'true');
			
			
			$('#lb_c1').text('Cliente: ');
						
		}		
	});
	
$('#tf_fecha2').attr('disabled','disabled');
	
	$('#estado').bind('change', function () {
		//$(this).attr('disabled','disabled');
		var id = $(this).val();
		if(id =='Pendiente'){
			$('#tf_fecha2').removeAttr('disabled');
		}else{
			$('#tf_fecha2').attr('disabled','disabled');
		}
	
	}); 

	
	
//funcion autocomplete para el responsable
	$("#tf_resp").autocomplete({
		minLength: 1,
		source: getCliente,
		select: function(event, ui) {
			getCedula(ui.item.value);
		}
	});
//funcion para buscar la cedula del cliente
	$("#tf_cliente").bind('change', function(){
		getCedula($(this).val());	
	});

});
<!------------------------------------------------------------------------------------------------------------->
//------------------Validar Formulario --------------------------------
	function confirmar(){
	//	$("#formulario").submit();
		
			if($('#formulario')[0].checkValidity()){
				
				confirmacion();
			}else{
					
				$('#formulario')[0].find(':submit').click()			
			}
	}




function getCliente(request, response) {
	var tipo = $('#concepto').val();
	if (tipo == 'Ingreso'){
		$.ajax({
			type:"post",
			url: '../controllers/connect.php',
			dataType: "json",
			data: "cliente="+request.term+"&action=getCliente",
			success: function(data) {				
				//console.log(data);
				var array = new Array();
				var j = 0;
				$.each(data, function(i, item) {
					var nombre = data[i].nombre;
					if (nombre != null ){
						array[j]=nombre;	
						j++;
					}
					i++;
				});
				response(array);
				return;
			},
		});
	}
	if (tipo == 'Egreso'){
		$.ajax({
			type:"post",
			url: '../controllers/connect.php',
			dataType: "json",
			data: "cliente="+request.term+"&action=getProveedor",
			success: function(data) {				
				//console.log(data);
				var array = new Array();
				var j = 0;
				$.each(data, function(i, item) {
					var nombre = data[i].nombre;
					if (nombre != null ){
						array[j]=nombre;	
						j++;
					}
					i++;
				});
				response(array);
				return;
			},
		});	
		
	}
}

//funcion para traer la cedula del cliente
function getCedula(cliente) {
	var tipo = $('#concepto').val();
	if (tipo == 'Ingreso'){
		$.ajax({
			type:"post",
			url: '../controllers/connect.php',
			dataType: "json",
			data: "cliente="+cliente+"&action=getCedulaC",
			success: function(data) {				
				console.log(data);
				$('#tf_cedula').val(data[0]);
				$('#tf_tel').val(data[1]);
			}
		});
	}
	if (tipo == 'Egreso'){
		$.ajax({
			type:"post",
			url: '../controllers/connect.php',
			dataType: "json",
			data: "cliente="+cliente+"&action=getCedulaP",
			success: function(data) {				
				console.log(data);
				$('#tf_cedula').val(data[0]);
				$('#tf_tel').val(data[1]);
			}
		});
	
	}
}

//-------------------------------------- Agragar Fila ----------------------------------------------------



/*  <tr id="fila_'+i+'">
           <td width="108" align="center" class="bold">'+i+'</td>
           <td align="center" class="cont"><input name="descrip" type="text" id="descrip'+i+'"  style="width:98%" /></td>
           <td width="140" class="cont"><input name="valor_unt2" type="text" id="valor_unt'+i+'" style="width:98%" /></td>
           <td width="139" class="cont"><input name="tal2" type="text" id="tal'+i+'" readonly="readonly" style="width:98%" /></td>
           <img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" 
    style="cursor:pointer;" onClick="quitar('+i+')"/></td>
         </tr>
         */

function agregarFila(){
	var i = parseInt($('#tf_i').val());
	i= i+1;
	//console.log('i:'+i);
	$('#tb_prod tr:last').after(' <tr id="fila_'+i+'"><td width="108" align="center" class="bold">'+i+'</td><td align="center" class="cont"><input name="descrip" type="text" id="descrip'+i+'"  style="width:98%" class="a" /></td><td width="140" class="cont"><input name="valor_unt2" type="text" id="valor_unt'+i+'" style="width:98%" onKeyUp="checkNum(this),total('+i+')" /></td><td width="139" class="cont"><input name="tal" type="text" id="tal'+i+'" readonly="readonly"style="width:98%" /></td><td width="139" class="cont"><img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" onClick="quitar('+i+')"/></td></tr>');
	//$('#tf_ref'+i).attr('onChange', 'getProd("'+i+'")');
	//$('#lb_val'+i).attr('onChange', 'getdcto("'+i+'")');
	//$('#bt_sproduct'+i).attr('onClick', 'searchProd("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'compare("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'total("'+i+'")');
	//$('#tf_cant'+i).attr('onChange', 'checkNum(this)');
	//$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	
	$('#tf_i').val(i);
}	
//-------------------------------------- Eliminar Fila ----------------------------------------------------
function quitar(i){
	//console.log('quitar: '+i);
	$("#fila_"+i ).remove();
	
}



//--------------------------------funcion para validar que el input es un numero decimal------------------------
function checkNum(itm){
	var itm=itm.id
	var costo_u=$("#"+itm).val();
	//console.log('quitar: '+i);	
	while(isNaN(costo_u)||costo_u.match(' ')||costo_u.match(/\,/g)){
		var tamano = costo_u.length;
		var costo_u=costo_u.substring(0,costo_u.length-1);
		$("#"+itm).val(costo_u);
		
	}
}
//--------------------------------totalizar------------------------
function total(i){
	//console.log('total:'+i);
	var total = new Number($('#valor_unt'+i).val());
	
	var tal = numberWithCommas(total);
	
	$('#tal'+i).val(tal);
	
}


//------------------------------------------Insertar----------------------------------------

function insert(){
	//alert('insert')
	var i = 1;
	var x = 0;
	
		var user = $('#tf_user').val();
		//var ptov = '';
		if ( user != 'general'){
			sucursal = $('#tf_hac').val();
		}else{
			sucursal = $('#sl_hac').val();
		}
		
		var estado = 	$('#estado').val();
		var concepto =  $('#concepto').val();
		var cliente =   $('#tf_resp').val();		
		var cedula = 	$('#tf_cedula').val();
		var fecha = 	$('#tf_fecha').val();
		var fechapago = $('#tf_fecha2').val();
		var formapago = $('#formapago').val(); 
		var factura = 	$('#factura').val();
		var lado = 	$('#lado').val();
		//alert(factura)

	
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');   		
	$table.find('.a').each(function() {
		
		var ref = $(this).val();
		var id = $(this).attr('id');
		console.log('id: '+id);	
		var n = id.substr(7);
		n = $.trim(n);
		//console.log('i: '+n);
	
		var descrip =  $('#descrip'+n).val();
		var valor_unt =    $('#valor_unt'+n).val();
		
		
		//console.log("cliente="+cliente+"&fecha="+fecha+"&sucursal="+sucursal+"&estado="+estado+"&concepto="+concepto+"&action=pedido" + "&cedula="+cedula+ "&fechapago="+fechapago+ "&formapago="+formapago+ "&descrip="+descrip+ "&valor_unt="+valor_unt+ "&factura="+factura+ "&lado="+lado);
	
	
	
	$.ajax({
			type: "post",
			url: "../controllers/connect.php",
			data:"cliente="+cliente+"&fecha="+fecha+"&sucursal="+sucursal+"&estado="+estado+"&concepto="+concepto+"&action=pedido" + "&cedula="+cedula+ "&fechapago="+fechapago+ "&formapago="+formapago+ "&descrip="+descrip+ "&valor_unt="+valor_unt+ "&factura="+factura+ "&lado="+lado,	
			success: function(datos){ 
						// console.log(datos)
							   
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
								
									$("#dialog").dialog("close");
									parent.location.reload();
									// window.location.href='factura_diario.php?id=' + factura.replace(/ /g,"+") + 
									 //						'&hda=' + sucursal.replace(/ /g,"+");
									//$('#tabla').load('dia_dia.php'  + ' #tabla ' )  
								}, 2000); 
					
				}
		})
		
		x++;
		i++;
    });	
}


//------------------------------------Funcion Traer Consecutivo Factura -------------------------------------------------------
function factura() {
	//alert('hola')
	
		var user = $('#tf_user').val();
		//console.log(user);
		if ( user != 'general'){
			sucursal = $('#tf_hac').val();
		}else{
			sucursal = $('#sl_hac').val();
		}
			//console.log(sucursal);
	
		$.ajax({
			type:"GET",
			url: '../controllers/connect.php',
			//dataType: "json",
			data: "sucursal="+sucursal,
			success: function(data) {				
				//console.log(data);
				$('#factura').val(data);
				//$('#tf_tel').val(data[1]);
				insert()
			}
		});
	

}




<!------------------------------------------------------------------------------------------------------------->
///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////

function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Agregar Registro<br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="factura();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}


function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})

<!-- Fin  funciones cuadro de dialogo-->
Shadowbox.init({
handleOversize: "drag",
modal: true,

onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
onClose: function(){
		$('#seleccion').load('dia_dia.php' + ' #seleccion ' );
				  }
});

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
 
//FUNCION DECIMALES
function numberWithCommas(n) {
		var parts=n.toString().split(".");
		return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
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
        clearTimeout(t);
		$('#seleccion1').load('dia_dia.php' + ' #seleccion1 ' );
		var ano= $('#ano').val();
		overlay.hide();
    }
}