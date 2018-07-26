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



<!-- Fin  funciones cuadro de dialogo-->
<!--select  de Categoria-->

function desb(){
	var lab=$('#sl_lab').val();
	
	if (lab==''){
		$('#tf_lab').removeAttr('disabled');
		
	}else{
		$('#categoria').val(lab);
		$("#tf_lab").attr('disabled','disabled');
	}
}

function desa(){
	
	var lab=$('#tf_lab').val();
	//alert(lab)
	console.log(lab)
	if (lab==''){
		$("#sl_lab").removeAttr('disabled');
		$('#categoria').val(sl_lab);
		
		console.log(categoria)
			}else{ 
			$('#categoria').val(lab);
		$("#sl_lab").attr('disabled','disabled');
	}
}

$('#tf_lab').bind('change keyup', function(){
		var lab1=$('#tf_lab').val();
		$('#categoria').val(lab1);
		 console.log(categoria)
		
}); 
	
$("#sl_lab").change(function(){
		 var lab2=$('#sl_lab').val();
		$('#categoria').val(lab2);
		  console.log(categoria) 
});	
		
		
//////////////////////////  select  de Modulo ////////////////////////////////////

function desb1(){
	var lab5=$('#sl_lab2').val();
	
	if (lab5==''){
		$('#tf_lab2').removeAttr('disabled');
		
		
	}else{
		$("#tf_lab2").attr('disabled','disabled');
		$('#tipo').val(lab5);
	}
}

function desa1(){
	var lab5=$('#tf_lab2').val();
	
	if (lab5==''){
		$("#sl_lab2").removeAttr('disabled');
				}else{ 
			$('#tipo').val(lab5);
		$("#sl_lab2").attr('disabled','disabled');
	}
}	 
/////////////////////////  Valor tipo /////////////////////////////////////////////7
var lab111=$('#tf_lab2').val();
$('#tipo').val(lab111);

$('#tf_lab2').bind('change keyup', function(){
		var lab11=$('#tf_lab2').val();
		$('#tipo').val(lab11);
		//alert(lab11)
		//console.log(tipo)		
}); 
	
$("#sl_lab2").change(function(){
		 var lab22=$('#sl_lab2').val();
		// alert(lab22)
		$('#tipo').val(lab22);
		//console.log(tipo)
});	
		
		



var lab3=$('#tf_lab').val();
$('#categoria').val(lab3);

<!-- Funcion para esconder el  segundo -->
function primero(){
	if($('#form1')[0].checkValidity()){
		$("#primero").slideUp(500)
			setTimeout(function(){
			$("#segundo").slideDown(500)
		 },500	)
	}else{
		 $('#form1')[0].find(':submit').click();
	}

	
}

/*function final(){
	$("#button1").hide();
	$("#button3").hide();
	$("#button4").hide();
	$("#button6").hide();
	$("#button7").hide();
	$("#primero").slideToggle();
	$("#segundo").slideToggle();
	$("#button5").slideToggle();
}*/
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
			data: {'verifPA': ids, 'vals': vals},
			success: function(datos){ 
							 console.log(datos)
							   
							$("#dialog").html("Actualización Exitosa");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									    window.opener.location.reload();
										window.close();	
									//$('#tabla').load('kardex.php'  + ' #tabla ' )  
								}, 2000); 
					
					}
		})
}

function cuadro(){
	console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Usuario Existente').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.parent.Shadowbox.close();
	}, 2000);					
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