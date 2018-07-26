<?
$ruta_a_joomla = "/../../../carnesdana/";
define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
 $usuario= $userx->username;
  $usuario2= $userx->usertype2;
	$acceso= $userx->agenda;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
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
 //$_GET['id'];
$colname_clien = "-1";
if (isset($_GET['id'])) {
  $colname_clien = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_clien = sprintf("SELECT * FROM nomina_ingreso WHERE id = %s", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Clientes</title>
<link href="css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="js/shadowbox.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <table width="90%" align="center">
    <tr>
      <td><img src="img/Logo SAGA sin texto.png" alt="" width="200" height="90" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
<form  id="form1" method="post" name="form1">

  <p>&nbsp;</p>
  <table width="50%" border="1" align="center" cellspacing="0">
    <tr>
    <td colspan="2" align="center" class="tittle" style="">EDITAR ASISTENCIA : <?php echo $_GET['nombre'];?></td>
    </tr>
  <tr>
    <td width="43%" class="bold">Hora Salida</td>
    <td width="57%" class="cont"><label for="textfield"></label>
      <span id="sprytextfield1">
      <input name="registro" type="text"  required="required" id="final" style="width:98%" value="<?php echo '19:30' ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
  <tr>
    <td class="bold">Horas Ordinarias</td>
    <td class="cont">
    <input name="registro" type="text" id="hnormales" style="width:98%"  onkeyup="checkNum(this)" />
    </td>
    </tr>
  <tr>
    <td class="bold">Horas Extras</td>
    <td class="cont">
    <input name="registro" type="text" id="hextras" style="width:98%"  onkeyup="checkNum(this)" />
    </td>
    </tr>
  <tr>
      <td align="center" colspan="2"><input name="button5" type="submit" class="ext" id="button5" value="Aceptar" style="width:150px"   onclick="confirmacion(); return false"/> &nbsp;&nbsp;&nbsp;
    <input name="button9" type="submit" class="ext" id="button9" value="Cancelar" onclick=" window.parent.Shadowbox.close();" style="width:150px" /></td>
</table>

  <!--<div id="tercero" >-->
<input type="hidden" name="registro" id="id" value="<? echo $_GET['id']?>" >
<div id="dialog" >

</div>
 
</form>
<!-- Finaliza el primer Div de personas  segundo -->

<script>
var lab3=$('#tf_lab').val();
$('#categoria').val(lab3);
//alert(categoria)

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
		$("#primero").slideUp(500)
			setTimeout(function(){
			$("#segundo").slideDown(500)
		 },500	)
	}else{
		 $('#form1')[0].find(':submit').click();
	}

	
}







///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Desea Actualizar ? <br />').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertar();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
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
			type: "GET",
			url: "base_conex.php",
			data: {'verifPA': ids, 'vals': vals},
			success: function(datos){ 
							// console.log(datos)
							   
							$("#dialog").html("Actualización Exitosa");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									  parent.location.reload();
								//	$('#tabla').load('kardex.php'  + ' #tabla ' )  
								}, 2000); 
					
					}
		})
}

function cuadro(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Usuario Existente').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="50" height="50"/>');
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
		
		
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], hint:"Sugerencia- 19:45"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none");
</script>




</body>
</html>
<?php
mysql_free_result($clien);
?>
