// JavaScript Document

$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
	
	document.formulario.valor_unt.focus();
	
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
	
	
	$('#valor_unt').bind('change keyup', function(){
		//console.log('hhhh')
		var unita1 = new Number($(this).val());
		//var can1 = new Number($('#cantidad').val());
		var tal1 = numberWithCommas(unita1);
		$('#tal1').val(tal1);
		//alert('dd')
	}); 
	
	
	// $("input:submit").click(function() { return false; }); // Para Bloquear el enter.
	
	
	$('#tf_fecha2').attr('disabled','disabled');
	
	$('#estado').bind('change', function () {
		//$(this).attr('disabled','disabled');
		var id = $(this).val();
		if(id =='Pendiente'){
			$('#tf_fecha2').removeAttr('disabled');
		}else{
			$('#tf_fecha2').attr('disabled','disabled');
		}
		////////////////////////////pruebas
		  $("#tf_resp").change(function(){
            alert('Hola');
           // $('#valor2').val($(this).val());
    });	
	
	$("#tf_resp").each(
		function(index, value) {
			$(this).change(cantidad_cambiada)
		}
	);	
  $('#tf_resp').change(function () { alert('test'); });	
	
	}); 
	
	
	function cantidad_cambiada(){
	alert("Me han llamado desde el campo: " + this.id);
}




//Multiplicacion para el total 


	
//2
	$('#valor_unt2').bind('change keyup', function(){
		var unita2 = new Number($(this).val());
		var can2 = new Number($('#cantidad2').val());
		var tal2 = numberWithCommas(unita2);
		$('#tal2').val(tal2);
	}); 
//3
	$('#valor_unt3').bind('change keyup', function(){
		var unita3 = new Number($(this).val());
		var can3 = new Number($('#cantidad3').val());
		var tal3 = numberWithCommas(unita3);
		$('#tal3').val(tal3);
	}); 
//4
	$('#valor_unt4').bind('change keyup', function(){
		var unita4 = new Number($(this).val());
		var can4 = new Number($('#cantidad4').val());
		var tal4 = numberWithCommas(unita4 );
		$('#tal4').val(tal4);
	}); 
//5
	$('#valor_unt5').bind('change keyup', function(){
		var unita5 = new Number($(this).val());
		var can5 = new Number($('#cantidad5').val());
		var tal5 = numberWithCommas(unita5 );
		$('#tal5').val(tal5);
	}); 
//6
	$('#valor_unt6').bind('change keyup', function(){
		var unita6 = new Number($(this).val());
		var can6 = new Number($('#cantidad6').val());
		var tal6 = numberWithCommas(unita6);
		$('#tal6').val(tal6);
	}); 
//7
	$('#valor_unt7').bind('change keyup', function(){
		var unita7 = new Number($(this).val());
		var can7 = new Number($('#cantidad7').val());
		var tal7 = numberWithCommas(unita7);
		$('#tal7').val(tal7);
	}); 
//8
	$('#valor_unt8').bind('change keyup', function(){
		var unita8 = new Number($(this).val());
		var can8 = new Number($('#cantidad8').val());
		var tal8 = numberWithCommas(unita8 );
		$('#tal8').val(tal8);
	}); 
//9
	$('#valor_unt9').bind('change keyup', function(){
		var unita9 = new Number($(this).val());
		var can9 = new Number($('#cantidad9').val());
		var tal9 = numberWithCommas(unita9);
		$('#tal9').val(tal9);
	}); 

 
});
//FUNCION DECIMALES
function numberWithCommas(n) {
		var parts=n.toString().split(".");
		return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
	}

	
	



	

///////////////////////////////////////////////////////////////77

	function alerta(){ 
							// console.log(datos)
							   
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									 parent.location.reload();
									$('#tabla').load('kardex.php'  + ' #tabla ' )  
								}, 2000); 
					
					}


function cuadro(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Usuario Existente').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.parent.Shadowbox.close();
	}, 2000);					
}


		
			
			
			
			



	function confirmar(){
	//	$("#formulario").submit();
		
			if($('#formulario')[0].checkValidity()){
				
				confirmar2()
			}else{
					
				$('#formulario')[0].find(':submit').click()			
			}
	}
			
	function confirmar2(){
				//un confirm
			alertify.confirm("<p>Desea Ingresar Registro... ?<br /><br />",
			   function (e) {
					if (e) {
					 alertify.success("Has pulsado '" + alertify.labels.ok + "'");
					 
					 setTimeout(function () { document.formulario.submit(); confirmar3();}, 1000);
					
						
					} else { alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
					}
				}); 
				return false
			}
	function confirmar3(){
			setTimeout(function () { parent.location.reload();}, 1000);
			}	
			
			
			
			
	//funcion para validar que el input es un numero Entero

function checkNum(itm){

	var itm=itm.id

	var costo_u=$("#"+itm).val();	

	while(isNaN(costo_u)||costo_u.match(' ')||costo_u.match(/\./g)){

		var tamano = costo_u.length;

		var costo_u=costo_u.substring(0,costo_u.length-1);

		$("#"+itm).val(costo_u);		

	}

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
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})
