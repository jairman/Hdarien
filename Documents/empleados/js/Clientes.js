// JavaScript Document
$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
	$('#tf_lab').bind('change keyup', function(){
		var lab1=$('#tf_lab').val();
		$('#funcion').val(lab1);
	
	}); 
	
	$("#sl_lab").change(function(){
		var lab2=$('#sl_lab').val();
		$('#funcion').val(lab2);
		console.log(funcion) 
	});	
	
	//Buscar si existe ID /////////////////////77
	
	$('#cedula').bind('change', function () {
	//searchid($(this).val());
		$(this).attr('disabled','disabled');
		var id = $(this).val();
		searchid(id);
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
	$( "#cumple").datepicker();
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

<!-- Funcion validar formulario -->
function primero(){
	if($('#form1')[0].checkValidity()){
		confirmacion()	 
	}else{
		$('#form1')[0].find(':submit').click();
	}
}

function searchid(id){
	//console.log('search id:'+id);
	$.ajax({
		type: "GET",
		url: "../controllers/base_conex.php",
		data: "verifC="+id,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
		//	console.log(op);
			if(op=="noexiste"){
				$('#img_est2').attr('src','../../img/good.png');
				$('#nombre').removeAttr('disabled');
			}
			if(op=="existe"){
				$('#img_est2').attr('src','../../img/erase.png');
				$("#nombre").attr('disabled','disabled');
				$('#nombre').focus();
				$('#cedula').removeAttr('disabled');
			}
			$('#img_est2').show()
		},
	});	
}


function insertar(){
		
	var vals=[];
	var ids=[];
	$('[name="registro"]').each(function(index, element) {
                ids.push(element.id);
				vals.push(element.value);
				console.log(ids)
				console.log(vals)
       });
	   console.log(ids)
	   console.log(vals)
		$.ajax({
			type: "POST",
			url: "../controllers/base_conex.php",
			data: {'insertarC': ids, 'vals': vals},
			success: function(datos){ 
				console.log(datos)
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
							setTimeout(function () {
									$("#dialog").dialog("close");
									 parent.location.reload();
									 window.close()
									$('#tabla').load('kardex.php'  + ' #tabla ' )  
									window.opener.location.reload();
									window.close();	
								}, 2000); 
					
					}
		})
}

function load1(){
	var y = $('#pais').val();
	$('#city').load('Clientes.php?y=' + y.replace(/ /g,"+") +' #city > *' );
}
<!--select  de Categoria-->

function desb(){
	var lab=$('#sl_lab').val();
	if (lab==''){
		$('#tf_lab').removeAttr('disabled');
		
	}else{
		$("#tf_lab").attr('disabled','disabled');
	}
}

function desa(){
	var lab=$('#tf_lab').val();
	if (lab==''){
		$("#sl_lab").removeAttr('disabled');
		$('#funcion').val(sl_lab);
		console.log(funcion)
			}else{ 
		$("#sl_lab").attr('disabled','disabled');
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

<!-- Fin  funciones cuadro de dialogo-->
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