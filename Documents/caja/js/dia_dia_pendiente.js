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



// Recargar
$('#sl_hac').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var hda=$('#sl_hac').val();
	$('#seleccion1').load('dia_dia_pendiente.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #seleccion1 ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
})

// Recargar fechas
$('#tf_fecha2').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
		//console.log ('h:'+f1+' t:'+f2+' y:'+hda);
	
	$('#seleccion1').load('dia_dia_pendiente.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #seleccion1 ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
})

$('#tf_fecha').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
		//console.log ('h:'+f1+' t:'+f2+' y:'+hda);
	
	$('#seleccion1').load('dia_dia_pendiente.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")  +' #seleccion1 ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
	
	
})
	
	
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
function ver(c){
	var url = 'fact.php?c='+c.replace(/ /g,"+");
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function mostrar(url) {
	
	Shadowbox.open({
		content: url,
		player: "iframe",
	options: {  modal: true	
	}})
}



/*function load2(){
	
	
	alert ('hda')
	
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);	
	
	$('#month').load('dia_dia_pendiente.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+")  +' #month ' );
	

	
	$('#seleccion1').load('dia_dia_pendiente.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+")  +' #seleccion1 ' );
	
	if (y == ''){
		//console.log('y:'+y);
		$('#month').hide();
		$('#day').hide();
		$('#sl_month').val('');
		$('#sl_day').val('');
			
	}else{
		//console.log('y:'+y);
		$('#month').show();
		$('#day').hide();			
	}
}

function load3(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	

	
	$('#table').load('dia_dia_pendiente.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") +' #seleccion1' );
	if (m == ''){
		//console.log('m:'+m);
		$('#day').hide();
		$('#sl_day').val('');
	}else{
		//console.log('m:'+m);
		$('#day').show();
	}	
}



*/



//---------------Sumar Campos ____________///
	
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
	overlay.show()
	$("#dialog").html('Insertar Registro <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertar();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
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
		$('#seleccion').load('dia_dia_pendiente.php' + ' #seleccion ' );
				  }
});

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }