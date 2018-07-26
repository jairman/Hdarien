// JavaScript Document
$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	

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

});
function mostrar1(c) {
	console.log("hda="+c);		
	$.ajax({
			type: "post",
			url: "../controllers/coti_fact_correo.php",
			data:"c="+c,	
			success: function(datos){ 
				console.log(datos)
				var op = datos.replace(/ /g,'');
				op = $.trim(op);
				console.log(op)
				//alert(op)
				if(op=="exitoso"){
					//console.log(datos)
					cuadrox()
				}		 		
			}
    })
	
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