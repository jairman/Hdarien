// JavaScript Document
$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});


	
<!-- Fin  funciones cuadro de dialogo-->
Shadowbox.init({
handleOversize: "drag",
modal: true,

onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
onClose: function(){
		//$('#seleccion').load('dia_dia.php' + ' #seleccion ' );
				  }
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

    $('#month').hide();
	$('#day').hide();
	
	//load2();
	
var user = $('#tf_user').val();
	if ( user != 'general'){
		var hac = '';
		//console.log(user)
		hac = $('#tf_user').val();
		load1(hac);
	}else{
		var hac = '';
		hac = $('#sl_hac').val();
		//load1(hac);
	}
	 
/*	$('#sl_hac').bind('change', function(){
		var hac = $(this).val();
		load1(hac);	
	});*/





function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord
	//console.log(order)
	load6(order)
	
}

// Recargar fechas
$('#tf_fecha2').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
	var concep=$('#concep').val();
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&con=' + concep.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});
	
})

$('#tf_fecha').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var user = $('#tf_user').val();
	
	if ( user == 'general'){
			hda = $('#sl_hac').val();
		} else {
			hda= $('#tf_user').val();	
	}
	
	var concep=$('#concep').val();
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&con=' + concep.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});
	
	
	
})

$('#sl_hac').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var hda=$('#sl_hac').val();
	
/*	var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}*/
	
	var concep=$('#concep').val();
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&con=' + concep.replace(/ /g,"+")  +' #table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});
})

$('#concep').change(function(){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	//var hda=$('#sl_hac').val();
	var user = $('#tf_user').val();
//alert(user)	
if ( user == 'general'){
		hda = $('#sl_hac').val();
	} else {
		hda= $('#tf_user').val();	
	}
	
	var concep=$('#concep').val();
	
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&con=' + concep.replace(/ /g,"+")  +' #table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});
})




});
<!------------------------------------------------------------------------------------------------------------->
function anular(f, h){	
	//overlay.hide()
	$('#f').val(f);
	$('#h').val(h);
	//console.log(f)
	$("span.ui-dialog-title").text('Anular Factura').css("text-align", "center");
	$("#dialog2").dialog("open");
}
function insert_anular(){
		var f=$('#f').val();
		var h=$('#h').val();
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






function load1(hac){
	var f1=$('#tf_fecha').val();
	var f2=$('#tf_fecha2').val();
	var hda=$('#sl_hac').val();
	//alert (hda)
	//alert (f1)
	var user = $('#tf_user').val();
	//alert(user)	
	if ( user == 'general'){
			hda = $('#sl_hac').val();
		} else {
			hda= $('#tf_user').val();	
		}
	
	var concep=$('#concep').val();	
	console.log ('h:'+f1+' t:'+f2+' y:'+hda+' concep:'+concep);
	
	$('#table').load('basc_hist.php?hda=' + hda.replace(/ /g,"+") +'&f1=' + f1.replace(/ /g,"+") +'&f2=' + f2.replace(/ /g,"+")+'&con=' + concep.replace(/ /g,"+")  +' #table ',  
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//totcosto();
				
		}
	});
	
	
}	

function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	var order='';
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);	
	
	$('#month').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' );
	
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
	var order='';
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")  +' #table ' );
	if (m == ''){
		//console.log('m:'+m);
		$('#day').hide();
		$('#sl_day').val('');
	}else{
		//console.log('m:'+m);
		$('#day').show();
	}	
}

function load4(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var t = $('#sl_tipo').val();
	var order='';
	
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #table ' );
	
}

function load5(){
	var y = '';
	var m = '';
	var d = '';
	var order='';
	var t = $('#sl_tipo').val();
	var user = $('#tf_user').val();
	var h = '';
	if ( user == 'general'){
		h = $('#sl_hac').val();
	} else {
		h = $('#tf_user').val();	
	}
	
	$('#month').hide();
	$('#day').hide();
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d);
	
	$('#year').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #year' );
	
	$('#month').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #day' );
	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+")+ '&o=' + order.replace(/ /g,"+") +' #table ' );
	
}

function load6(order){
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
	
	console.log ('h:'+h+' t:'+t+' y:'+y+' m:'+m+' d:'+d+' o:'+order);

	
	$('#table').load('basc_hist.php?h=' + h.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&t=' + t.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' );
	if (m == ''){
		console.log('m:'+m);
		
	}else{
		console.log('m:'+m);
		
	}	
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
function mostrar(url){
	//console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );	
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	 
}
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {  modal: true  }
	})
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