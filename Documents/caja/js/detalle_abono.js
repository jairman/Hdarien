// JavaScript Document
$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
	totcosto()


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


	
});

		//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
		 removebuttons:true       
	  });
}
<!------------------------------------------------------------------------------------------------------------->
//------------------Validar Formulario --------------------------------
function confirmar(){

if($('#formulario')[0].checkValidity()){
		
		insert();
	}else{
			
		$('#formulario')[0].find(':submit').click()			
	}
}
function abonar(){	
	//overlay.hide()
	$("span.ui-dialog-title").text('Abono Factura').css("text-align", "center");
	$("#dialog2").dialog("open");
}

function insert(){
		var factura = 	$('#factura').val();
		var hacienda =  $('#hacienda').val();
		var tf_fecha =   $('#tf_fecha').val();		
		var comen = 	$('#comen').val();
		var formapago = 	$('#formapago').val();
		var abono = $('#abono').val();
		$("#dialog2").dialog("close");	
		//console.log("factura="+factura+"&hacienda="+hacienda+"&tf_fecha="+tf_fecha+"&comen="+comen+"&formapago="+formapago+"&action=abonos" + "&abono="+abono);
	$.ajax({
			type: "post",
			url: "../controllers/connect.php",
			data:"factura="+factura+"&hacienda="+hacienda+"&tf_fecha="+tf_fecha+"&comen="+comen+"&formapago="+formapago+"&action=abonos" + "&abono="+abono,	
			success: function(datos){ 
						// console.log(datos)
				$("#dialog").html("&nbsp;&nbsp;Registro Exitoso");
				$("span.ui-dialog-title").text('Información Importante');
				$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
				$("#dialog").dialog("open");
								
					setTimeout(function () {
					
						$("#dialog").dialog("close");
						 parent.location.reload();
						//$('#tabla').load('dia_dia_pendiente.php'  + ' #tabla ' )  
					}, 2000); 
					
				}
		})
}




//-------------------------------------------Sumar Campos _____________________________________________________________///
	
	function totcosto(){
	//console.log('totcosto');
	var total = new Number();
	var $table = $('#t_suma tr:not(#tittle)').closest('table');  		
	$table.find('.costo').each(function() {
		//var cant = new Number($.trim($(this).text()));
		var id = $(this).attr('id');	
		var n = id.substr(5);
		//console.log('n:'+n);
		n = $.trim('suma_'+n);
		//console.log(n);
		var costo = new Number ($.trim(($('#'+n).text()).replace(/\,/g, '')));
		//console.log('co: '+costo);
		//console.log(typeof(costo));
		total = costo + parseFloat(total);
		//alert(total)
	});
	
	$('#total_sum').text(commaSeparateNumber(total));
}
	

<!------------------------------------------------------------------------------------------------------------->
///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function confirmacion(){
	//var id = $('#tf_id').val();
	
	overlay.show()
	$("#dialog").html('Agregar Registro<br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insert();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}




function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}

function cerrar_dialogo2(){	
	//overlay.hide()
	$("#dialog2").dialog("close");
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
//funcion para inicializar el cuadro de dialogo
var dialogwidth=600
$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { /*overlay.hide()*/ }, 	     
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
		$('#seleccion').load('dia_dia_pendiente1.php' + ' #seleccion ' );
				  }
});

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
  
  //--------------------------------funcion para validar que el input es un numero decimal------------------------
function checkNum(itm){
	var valor=itm.value;
	var itm_id=itm.id;
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)||valor.match(/\,/g)){
		var valor=valor.substring(0,valor.length-1);
		$(itm).val(valor);		
	}
}
