// JavaScript Document
$(document).ready(function(){
	<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
	
	
});
//funcion para imprimir la pantalla en una tirilla
/*function imprimir_esto(id_tabla){
	console.log(id_tabla)
	$("#"+id_tabla).printThis({
		 debug: false,          
		 importCSS: true,           
		 printContainer: true,      				         
		 loadCSS: "../../css/style-print2.css", // este es el css que va a tener el diseño del formato
		 pageTitle: "",             
		 removeInline: false, 
		 removebuttons: true,
		 printd: true  // aca se remueven los tds que tengan la clase print    
	});
}*/
Shadowbox.init({
handleOversize: "drag",
modal: true,

onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	}
});

function mostrar(c, p, m) {
	console.log("c="+c+"&p="+p+"&m="+m);		
	$.ajax({
			type: "post",
			url: "../controllers/fact_correo.php",
			data:"c="+c+"&p="+p+"&m="+m,	
			success: function(datos){ 
				//console.log(datos)
				var op = datos.replace(/ /g,'');
				op = $.trim(op);
				if(op=="exitoso"){
					console.log(datos)
					cuadrox()
				}		 		
			}
    })
	//.done(cuadrox());
}

function cuadrox(){
	console.log('cuadrox')
	$("#dialog").html(" &nbsp;&nbsp;Envió  Exitoso");
	$("span.ui-dialog-title").text('Información Importante');
	$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
	$("#dialog").dialog("open");
	setTimeout(function () {	
		$("#dialog").dialog("close");
		// parent.location.reload();
	}, 2000);	
}

var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})
//funcion para imprimir la pantalla en una hoja completa
function imprimir_esto(id_tabla){
	console.log(id_tabla)
	$("#"+id_tabla).printThis({
		 debug: false,          
		 importCSS: true,           
		 printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", // este es el css que va a tener el diseño del formato
		 pageTitle: "",             
		 removeInline: false, 
		 removebuttons: true,
		 printd: false // aca se remueven los tds que tengan la clase print      
	});
}