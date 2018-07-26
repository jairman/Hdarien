// JavaScript Document
$(document).ready(function(){
	<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
	$("#search").keyup(function(e){
		if(e.keyCode==13){
			var searchbox = $(this).val();
			search_ins(searchbox,"nombre","ASC")
		}
	})
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
	$( "#cumple").datepicker();
	
});

<!------------------------------------------------------------------------------------------------->
function agregar(){
	var url = 'prove.php' ;
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}

function mostrar(id){
	var url = 'verProve.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);
}
	
function mostrar1(id){
	var url = 'Editprove.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);
 }




function agregar_excel(){
	var url = '../../registro_p/excel.php';
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
	w.resizeTo(screen.width,screen.height);
}

function eliminar(id){
	//alert(id)
	overlay.show()
	$("#dialog").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Eliminar Proveedor &nbsp;&nbsp;&nbsp;&nbsp;    ').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="40" height="40"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="40" height="40" title="Aceptar" style="cursor:pointer" onclick="eliminar2('+id+')"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="40" height="40" style="cursor:pointer" title="Cancelar" onclick="cerrar_dialogo()"/>');
}

function eliminar2(id){
	//alert(id)

	$("#dialog").dialog("close");
	$.ajax({
        type: "GET",
        url: "../controllers/eliminar.php",
        data: "id="+id,
        success: function(datos){
			if(datos!='') alert(datos);
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");
			//window.parent.Shadowbox.close(); 
			//$('#tabla').load('kardex.php'  + ' #tabla ' )
			//window.opener.location.reload();
			 
			setTimeout(function () {
			   $("#dialog").dialog("close");
			   overlay.hide();
			   parent.location.reload() 
			}, 2000);
      }	  
	})
}








///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Actualizar Registro <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertar();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function insertar(){
		
	var vals=[];
	var ids=[];
	$('[name="registro"]').each(function(index, element) {
                ids.push(element.id);
				vals.push(element.value);
       });
						//alert(vals)
						console.log(ids)
						console.log(vals)
		$.ajax({
			type: "POST",
			url: "../controllers/base_conex.php",
			data: {'verifCA': ids, 'vals': vals},
			success: function(datos){ 
							 console.log(datos)
							   
							$("#dialog").html("Actualización Exitosa");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									  parent.location.reload();
										window.close()
									$('#tabla').load('kardex.php'  + ' #tabla ' )  
								}, 2000); 
					
					}
		})
}


<!------------------------------------------------------------------------------------------------->
/*Shadowbox.init({
handleOversize: "drag",
modal: true,
onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},

onClose: function(){
		$('#seleccion1').load('kardex.php' + ' #seleccion1 ' );
				  }

});*/
function cuadro(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Usuario Existente').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.parent.Shadowbox.close();
	}, 2000);					
}



function commaSeparateNumber(val){
	while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	}
	return val;
}



function cerrar_dialogo(){
	overlay.hide()
	$("#dialog").dialog("close");
}

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

<!-----------Busqueda  Valle-->
function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	valor=$('#search').val()
	search_ins(valor, tipo, ord)
	
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
				
				
			
			$('#tabla').load('kardex.php' + ' #tabla ' );
		overlay.hide();
    }
}	 



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


function search_ins(value, tipo, ord){
	var valor=encodeURIComponent(value);	
	var data = {valor: valor, tipo:tipo, ord:ord};
	$.ajax({
		type: "POST",		
		url: "pal_search.php",
		data: data,
		success: function(datos){ 
			$('html,body').css('cursor','default');	
			$("#registros").html(datos) 
		},   
	})
}
<!---------------------------->


