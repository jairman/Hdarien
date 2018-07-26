// JavaScript Document
<!-- necesario para los cuadros de dialogo-->
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
overlay.click(function(){
	window.win.focus()
});
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

<!-- Fin  funciones cuadro de dialogo-->

<!-- Funcion para esconder el  segundo -->
function primero(){
	if($('#form1')[0].checkValidity()){
		
					confirmacion()
		 
	}else{
		 $('#form1')[0].find(':submit').click();
	}

	
}
<!-- Funcion para esconder el  primero con boton atras -->
function segundo(){
	//$("#button5").hide();
	$("#segundo").slideUp(500)
		setTimeout(function(){
		$("#primero").slideDown(500)
	 },500	)
	
}
<!-- Funcion para esconder el  primero con boton atras -->
function cuarto(){
	//$("#button5").hide();
	$("#tercero").slideUp(500)
		setTimeout(function(){
		$("#segundo").slideDown(500)
	 },500	)
	
}
function tercero(){
	if($('#form1')[0].checkValidity()){
		$("#segundo").slideUp(500)
		setTimeout(function(){
		$("#tercero").slideDown(500)
	 },500	)
	}else{
		 $('#form1')[0].find(':submit').click();
	}
}

function final(){
	

	$("#button1").hide();
	$("#button3").hide();
	$("#button4").hide();
	$("#button6").hide();
	$("#button7").hide();
	$("#primero").slideToggle();
	$("#segundo").slideToggle();
	$("#button5").slideToggle();
	
}
///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Insertar Registro <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertar();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function verificar(){
	var cedula = $('#cedula').val();
	cuadro();
	$.ajax({
			type: "GET",
			url: "../base_conex.php",
			data: {'verifC': cedula},
			success: function(datos){ 
							 //console.log(datos)
							 	//console.log('d:'+datos);
					var res = datos.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('r:'+res)
					if (res == 'existe'){
						//console.log('exitoso');
						cuadro();
						
					}
					if (res == 'noexiste'){
						//console.log('noexitoso');
						insertar();
					}
							 
				}
			});
	
}
function insertar(){
		
	var vals=[];
	var ids=[];
	$('[name="registro"]').each(function(index, element) {
                ids.push(element.id);
				vals.push(element.value);
       });
						//alert(vals)
						//console.log(ids)
						//console.log(vals)
		$.ajax({
			type: "POST",
			url: "../base_conex.php",
			data: {'insertarC': ids, 'vals': vals},
			success: function(datos){ 
							// console.log(datos)
							   
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
		$('#categoria').val(sl_lab);
		console.log(categoria)
			}else{ 
		$("#sl_lab").attr('disabled','disabled');
	}
}

$('#tf_lab').bind('change keyup', function(){
		var lab1=$('#tf_lab').val();
		$('#categoria').val(lab1);
		
	}); 
	
   $("#sl_lab").change(function(){
		 var lab2=$('#sl_lab').val();
		$('#categoria').val(lab2);
		  console.log(categoria) 
        });	
		
//Buscar si existe ID /////////////////////77

	$('#cedula').bind('change', function () {
		//searchid($(this).val());
		$(this).attr('disabled','disabled');
		var id = $(this).val();
		searchid(id);
	});


	
function searchid(id){
	//console.log('search id:'+id);
	$.ajax({
		type: "GET",
		url: "../base_conex.php",
		data: "verifC="+id,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
		//	console.log(op);
			if(op=="noexiste"){
				//console.log('ifnoexiste');
				$('#img_est2').attr('src','../../img/good.png');
				//$('#nombre').attr("disabled", "disabled");
				$('#nombre').removeAttr('disabled');
				
			}
			if(op=="existe"){
				//console.log('ifexiste');
				$('#img_est2').attr('src','../../img/erase.png');
				//$('#nombre').removeAttr('disabled');
				$("#nombre").attr('disabled','disabled');
				$('#nombre').focus();
				$('#cedula').removeAttr('disabled');
				
			}
			$('#img_est2').show()
		},
	});	
}
function load1(){
	var y = $('#pais').val();
	//alert(y)

	$('#city').load('Clientes.php?y=' + y.replace(/ /g,"+") +' #city > *' );

	
}

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