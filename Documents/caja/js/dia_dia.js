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


// Recargar
$('#sl_hac').change(function(){
	var hda=$('#sl_hac').val();
	$('#seleccion1').load('dia_dia.php?hda=' + hda.replace(/ /g,"+")  +' #seleccion1 ' );
	
})


});
<!------------------------------------------------------------------------------------------------------------->
function anular(f, h, c){	
	//overlay.hide()
	$('#f').val(f);
	$('#h').val(h);
	$('#c').val(c);
	//console.log(f)
	$("span.ui-dialog-title").text('Anular Factura').css("text-align", "center");
	$("#dialog2").dialog("open");
}
function insert_anular(){
		var f=$('#f').val();
		var h=$('#h').val();
		var c=$('#c').val();
		var comen = $('#comen').val();
		
		$("#dialog2").dialog("close");	
		//console.log("factura="+f+"&hacienda="+h+"&comen="+comen+"&concep="+c);
	$.ajax({
			type: "post",
			url: "../controllers/dia_dia_anular.php",
			data:"factura="+f+"&hda="+h+"&comen="+comen,	
			success: function(datos){ 
				console.log(datos)
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







// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
	Shadowbox.open({
		content: url,
		player: "iframe",
	options: {  modal: true	
	}})
}

function agre(){
	var url = 'dia_dia_agre.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function agre2(){
	var url = 'dia_dia_agre2.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function agre1(){
	var url = 'mostrar_nomina.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function agre11(){
	var url = 'bus_detalle_dia_dia_anuladas.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}

function pendi(){
	var url = 'dia_dia_pendiente.php';
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}

function histo(){
	var url = 'basc_hist.php';
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}
function histo1(){
	var url = 'dia_dia_histo.php';
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}




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

function cerrar_dialogo2(){	
	//overlay.hide()
	$("#dialog2").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
var dialogwidth=700
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