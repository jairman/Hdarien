<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$factura=$_GET['factura'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>



</head>

<body>

<table width="80%" border="0" align="center" cellspacing="0">
  <tr>
    <td align="left" bgcolor="#FFFFFF"><img src="../img/Logo.png" width="200" height="70" />    </td>
  </tr>
</table>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="factura" value="<?php echo $_GET['factura'] ?>">
<input type="hidden" id="hacienda" value="<?php echo $_GET['hacienda'] ?>">


<form id="formulario" name="formulario" method="post" action="">
	
  <p>&nbsp;</p>
  <table width="514" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="2" align="center"  class="tittle">Cantidad  a  Abonar Factura <?php echo  $factura?> </td>
    </tr>
    <tr>
      <td align="left" class="bold" style="font-family: Helvetica">Fecha</td>
      <th width="313" style="font-family: Helvetica" class="cont"><input class="cont" type="text" name="tf_fecha" id="tf_fecha"  value="<?php echo date ('Y-m-d') ?>" style="width:95%" /></th>
    </tr>
    <tr>
      <td align="left" class="bold" style="font-family: Helvetica">Comentario</td>
      <th style="font-family: Helvetica" class="cont"><label for="comen"></label>
      <input name="comen" type="text" class="cont" id="comen"style="width:95%" /></th>
    </tr>
    <tr>
      <td align="left" class="bold" style="font-family: Helvetica">Forma De Pago</td>
      <th style="font-family: Helvetica" class="cont"><select name="formapago" id="formapago"   style="width:100%"  required="required"  >
        <option value="">Seleccione</option>
        <option value="Efectivo">Efectivo</option>
        <option value="Pac">Pac</option>
      </select></th>
    </tr>
    <tr>
      <td width="191" align="left" class="bold" style="font-family: Helvetica">Cantidad  a  Abonar</td>
      <th style="font-family: Helvetica" class="cont" >
        <input name="abono" type="text" class="cont" id="abono" style="width:95%"  required="required"
         onKeyUp="checkNum(this)"/>
      </th>
    </tr>
    <tr>
      <th colspan="2"><input name="button2" type="submit" class="ext" id="button2" value="Aceptar"  
      onclick="confirmar();return false" style="width:100px" /> &nbsp;&nbsp;<input type="submit" name="button1" id="button1" value="Cancelar"  onclick="window.parent.Shadowbox.close();" class="ext" style="width:100px"/></th>
    </tr>
  </table>
  
  
</form>
 <div id="dialog" >

	</div>


</body>
</html>

<script>
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
	  
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})


 

//--------------------------------funcion para validar que el input es un numero decimal------------------------
function checkNum(itm){
	var valor=itm.value;
	var itm_id=itm.id;
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)||valor.match(/\,/g)){
		var valor=valor.substring(0,valor.length-1);
		$(itm).val(valor);		
	}
}

//------------------Validar Formulario --------------------------------
	function confirmar(){
	//	$("#formulario").submit();
		
			if($('#formulario')[0].checkValidity()){
				
				confirmacion();
			}else{
					
				$('#formulario')[0].find(':submit').click()			
			}
	}

function confirmacion(){
	//var id = $('#tf_id').val();
	
	overlay.show()
	$("#dialog").html('Agregar Registro<br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insert();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}



 


function insert(){


		var factura = 	$('#factura').val();
		var hacienda =  $('#hacienda').val();
		var tf_fecha =   $('#tf_fecha').val();		
		var comen = 	$('#comen').val();
		var formapago = 	$('#formapago').val();
		var abono = $('#abono').val();
			
		
		//console.log("factura="+factura+"&hacienda="+hacienda+"&tf_fecha="+tf_fecha+"&comen="+comen+"&formapago="+formapago+"&action=abonos" + "&abono="+abono);
	
	
	
	$.ajax({
			type: "post",
			url: "connect.php",
			data:"factura="+factura+"&hacienda="+hacienda+"&tf_fecha="+tf_fecha+"&comen="+comen+"&formapago="+formapago+"&action=abonos" + "&abono="+abono,	
			success: function(datos){ 
						// console.log(datos)
							   
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
								
									$("#dialog").dialog("close");
									 parent.location.reload();
									//$('#tabla').load('dia_dia_pendiente.php'  + ' #tabla ' )  
								}, 2000); 
					
				}
		})
		
		
    	
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
	$( "#tf_fecha").datepicker();
</script>