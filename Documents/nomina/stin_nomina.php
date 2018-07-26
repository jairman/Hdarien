<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if($acceso==0){
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
$filtro=$_GET['filtro'];
mysql_select_db($database_conexion, $conexion);
$query_lugar = "SELECT DISTINCT nomina_valle.lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());

$totalRows_lugar = mysql_num_rows($lugar);
?>
<?php
$hoy= date("Y/m/d"); 
list($ano, $mes, $dia) = explode("/", $hoy);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="-1" id="primero">Información Básica</li>
    <li class="TabbedPanelsTab" tabindex="-1" id="segundo">Información Laboral</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <form id="form1">
      <table width="80%" border="1" cellspacing="0" cellpadding="0" align="center" style="color:#000" >
        <tr class="tittle" >
          <td colspan="2" align="center">INFORMACION BASICA
            <input type="hidden" name="registro" id="hacienda" value="<?php echo $filtro ?>" /></td>
        </tr>
        <tr class="bold">
          <td>Carné No.</td>
          <td><input type="text" name="registro" id="rfid" style="width:98%" /></td>
        </tr>
        <tr class="bold" >
          <td><strong>Nombres y Apellidos</strong></td>
          <td>
            <input type="text" name="registro" id="nombre" style="width:98%; " required="required"  />
          </td>
        </tr>
        <tr class="bold">
          <td><strong>Cédula</strong></td>
          <td><input type="text" name="registro" required="required" id="cedula" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Fecha de Nacimiento</strong></td>
          <td ><input  name="registro" type="text" id="nacimiento"   value="" readonly="readonly" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Estado Civil</strong></td>
          <td><input type="text" name="registro" id="civil" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Télefono</strong></td>
          <td><input type="text" name="registro" id="telefono" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Dirección</strong></td>
          <td><input type="text" name="registro" id="direccion" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Célular</strong></td>
          <td><input type="text" name="registro" id="celular" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>E-Mail</strong></td>
          <td><input type="text" name="registro" id="mail" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>E.P.S</strong></td>
          <td><input type="text" name="registro" id="eps" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Pensiones</strong></td>
          <td><input type="text" name="registro" id="pensiones" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>A.R.P</strong></td>
          <td><input type="text" name="registro" id="arp" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Referencia</strong></td>
          <td><input type="text" name="registro" id="referencia" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Télefono</strong></td>
          <td><input type="text" name="registro" id="tel_ref" style="width:98%" /></td>
        </tr>
        
        <tr class="bold">
          <td colspan="2" align="center">
            <input type="submit" name="enviar" id="enviar" value="Aceptar" class="ext" onclick="aceptar(); return false" />
          </td>
        </tr>
      </table>
      </form>
    </div>
    <div class="TabbedPanelsContent">
    <form id="form2">
      <table width="80%" border="1" cellspacing="0" cellpadding="0" align="center" style="color:#000">
        <tr class="tittle">
          <td colspan="2" align="center" ><strong>Información Laboral</strong></td>
        </tr>
        <tr class="bold">
          <td ><strong>Fecha de Ingreso</strong></td>
          <td><input  name="registro2" type="text" id="fecha_ingreso"   value="<?php echo date('Y-m-d') ?>" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Cargo</strong></td>
          <td><input type="text" name="registro2" id="cargo" style="width:98%" required="required" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Lugar de Trabajo</strong></td>
          <td><input type="text" name="" id="lugar" style="width:48%" required="required" />
          <select name="" id="lugar_tra" style="width:48%">
          <option value="vacio"></option>
          <?php
		  while($row_lugar = mysql_fetch_assoc($lugar)){
		  ?>
          <option value="<?php echo $row_lugar['lugar_trabajo'] ?>"><?php echo $row_lugar['lugar_trabajo'] ?></option>
          <?php
		  }
		  ?>
          </select></td>
        </tr>
        <tr class="bold">
          <td><strong>Salario</strong></td>
          <td><input type="text" name="registro2" id="salario" style="width:98%" onkeyup="comas(this)" />            
          </td>
        </tr>
        <tr class="bold">
          <td><strong>Tipo de Contrato</strong></td>
          <td><input type="text" name="registro2" id="tipo_contrato" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Fecha de Terminación del Contrato</strong></td>
          <td><input  name="registro2" type="text" id="fecha_terminacion_contrato" value="" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Funciones a Desempeñar</strong></td>
          <td><input type="text" name="registro2" id="funciones" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Area de Trabajo</strong></td>
          <td><input type="text" name="registro2" id="area_trabajo" style="width:98%" /></td>
        </tr>
        <tr class="bold">
          <td><strong>Anotaciones</strong></td>
          <td ><textarea name="registro2" cols="20" rows="5" style="width:96%" id="anotaciones" ></textarea></td>
        </tr>
        <tr class="bold">
          <td colspan="2" align="center">
            <input type="submit" name="enviar2" id="enviar2" value="Aceptar" onclick="aceptar2(); return false" class="ext" />
          </td>
        </tr>
      </table>
      </form>
    </div>
  </div>
</div>
<div id="dialog" >
  </div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
<?php
}else{
	?>
    <table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo_afuera.jpg" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}
?>
<script>
function comas(itm){
	var valor=itm.value;
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)){
		var valor=valor.substring(0,valor.length-1);
		$("#salario").val(valor);		
	}
}
$('#lugar_tra').change(function(){
	var lugar=$('#lugar_tra').val();
	var lugar_inp=$('#lugar').val();
	if (lugar=="vacio" || lugar=="")
		document.getElementById("lugar").readOnly="";
	else{ 
	document.getElementById("lugar").readOnly="readOnly";
	}
	if((lugar=="vacio" || lugar=="")&&lugar_inp==''){
		$('#lugar').attr("required","required");
	}else{
		$('#lugar').remove("required");
	}
})
$('#lugar').keyup(function(){
	var lugar=$('#lugar_tra').val();
	var lugar_inp=$('#lugar').val();
	if (lugar_inp=="")
		document.getElementById("lugar_tra").disabled="";
	else document.getElementById("lugar_tra").disabled="disabled";
	if((lugar=="vacio" || lugar=="")&&lugar_inp==''){
		$('#lugar').attr("required","required");
	}else{
		$('#lugar').remove("required");
	}
})
$(document).ready(function(){
 
  $('.TabbedPanelsTabGroup').children().hide().eq(0).show();
});
function aceptar2(){
	if($('#form2')[0].checkValidity()){
		$("#enviar2").hide()
		var regs=[];
		var ced= $('#cedula').val();
		var hda=$("#hacienda").val()
		regs.push(ced);
		regs.push(hda);
		var lugar=$('#lugar_tra').val();
		var lugar_inp=$('#lugar').val();
		if (lugar=="vacio" || lugar=="")
			regs.push(lugar_inp)
		else regs.push(lugar)
		$("[name=registro2]").each(function(index, element) {
			var valor=element.value;
            regs.push(valor)
        });	
		$.ajax({
			type: "POST",
			url: "stin_nomina_guardar.php",
			data: {guardar_emple2:regs},
			success: function(datos){ 
			console.log(datos)
			mostrar(datos, "reg", "fin")
			},   
		})
	}else{
		$("#enviar2").show("slow")
		$('#formu2')[0].find(':submit').click()
		
	}
}
function aceptar(){
	if($('#form1')[0].checkValidity()){
		$("#enviar").hide()
		var regs=[];
		var ids=[];
		var filtro=$("#filtro").val()
		$("[name=registro]").each(function(index, element) {
			var valor=element.value;
			var id=element.id
			ids.push(id)
            regs.push(valor)
        });	
		$.ajax({
			type: "POST",
			url: "stin_nomina_guardar.php",
			data: {guardar_emple1: regs, ids: ids},
			success: function(datos){ 
			console.log(datos)
			mostrar(datos, "reg", "paso")
			},   
		})
	}else{
		$("#enviar").show();
		$('#formu1')[0].find(':submit').click()
	}
}
function mostrar(html, tipo, datos){
	$("#dialog").html(html);
	$("span.ui-dialog-title").text('Información de Registro'); 
	if(tipo=="error" || html=="El Empleado Ya Existe" || html=="El Carné Ya Existe"){
		$("#enviar").show();
		$("#dialog").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	
	} else {
		$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="53" height="41"/>')
	}
	
    $( "#dialog" ).dialog('open');
	   setTimeout(function () {
		   if(datos=="paso" && html!="El Empleado Ya Existe" && html!="El Carné Ya Existe"){
		   		$('#segundo').siblings().slideUp("slow");
				$('#segundo').slideDown("slow");
	 			TabbedPanels1.showPanel(1);
	 		}
	 			if (datos=="fin"){
				 window.parent.Shadowbox.close();
			 }
		   $("#dialog").dialog("close");
		}, 2000);	   
}
var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},    
	  width: dialogwidth,
	  height: "auto",
	   position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false,  	     
    });
})
$(function () {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$("#nacimiento").datepicker({ dateFormat: "yy-mm-dd",
		firstDay: 1,
		changeMonth: true,
		changeYear: true,
		yearRange : 'c-90:c+0',
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		monthNames: 
			["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
			"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthNamesShort: 
			["Ene", "Feb", "Mar", "Abr", "May", "Jun",
			"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			
	});						
});
$(function () {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$("#fecha_ingreso").datepicker({ dateFormat: "yy-mm-dd",
		firstDay: 1,
		changeMonth: true,
		changeYear: true,
		yearRange : 'c-50:c+0',
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		monthNames: 
			["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
			"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthNamesShort: 
			["Ene", "Feb", "Mar", "Abr", "May", "Jun",
			"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			
	});						
});	  
$(function () {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$("#fecha_terminacion_contrato").datepicker({ dateFormat: "yy-mm-dd",
		firstDay: 1,
		changeMonth: true,
		changeYear: true,
		yearRange : 'c-2:c+40',
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		monthNames: 
			["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
			"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthNamesShort: 
			["Ene", "Feb", "Mar", "Abr", "May", "Jun",
			"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			
	});						
});
</script>
</html>