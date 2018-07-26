// JavaScript Document
$(document).ready(function(){
	<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
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
	//console.log(categoria) 
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
	
});

<!------------------------------------------------------------------------------------------------->
function primero(){
	if($('#form1')[0].checkValidity()){
		confirmacion()
	}else{
		 $('#form1')[0].find(':submit').click();
	}
}
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

function eliminar(idn){
	overlay.show()
	$("#dialog2").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Eliminar Cliente &nbsp;&nbsp;&nbsp;&nbsp;    ').css('text-align','center');
	$("#dialog2").prepend('<img id="theImg2" src="../../img/warning.png" width="40" height="40"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog2").dialog("open");
	$("#dialog2").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="40" height="40" title="Aceptar" style="cursor:pointer" onclick="eliminar2('+idn+')"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="40" height="40" style="cursor:pointer" title="Cancelar" onclick="cerrar_dialogo2()"/>');
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
			$('#tabla').load('kardex.php'  + ' #tabla ' )  
			setTimeout(function () {
			   $("#dialog").dialog("close");
			   overlay.hide();
			}, 2000);
      }	  
	})
}


function searchid(id){
	//console.log('search id:'+id);
	$.ajax({
		type: "GET",
		url: "../controllers/base_conex.php",
		data: "verifP="+id,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
			//console.log(op);
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
/////////////////////////  Valortipo/////////////////////////////////////////////7

$('#tf_lab2').bind('change keyup', function(){
	var lab11=$('#tf_lab2').val();
	$('#tipo').val(lab11);
}); 
		
$("#sl_lab2").change(function(){
	 var lab22=$('#sl_lab2').val();
	$('#tipo').val(lab22);
});
			
function load1(){
	var y = $('#pais').val();
	$('#city').load('prove.php?y=' + y.replace(/ /g,"+") +' #city > *' );	
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
			data: {'insertarP': ids, 'vals': vals},
			success: function(datos){ 
							 console.log(datos)
							   
							$("#dialog").html("Actualización Exitosa");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									 /* parent.location.reload();
										window.close()
									$('#tabla').load('kardex.php'  + ' #tabla ' ) */ 
									window.opener.location.reload();
									window.close();	
								}, 2000); 
					
					}
		})
}


<!------------------------------------------------------------------------------------------------->
Shadowbox.init({
handleOversize: "drag",
modal: true,
onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},

onClose: function(){
		$('#seleccion1').load('kardex.php' + ' #seleccion1 ' );
				  }

});
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

	 


<!---------------------------->


