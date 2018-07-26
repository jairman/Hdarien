// JavaScript Document

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
		// printd: false // aca se remueven los tds que tengan la clase print      
	});
}

function mostrar(url) {
console.log('hola')
	
		$.ajax({
			type: "POST",
			url: "desp_fact_correo.php",
			data: {'correo': ids, 'vals': vals},
			success: function(datos){ 
							$("#dialog").html("Registro Exitoso");
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