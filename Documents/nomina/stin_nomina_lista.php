<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

<?php
if ($acceso =='0'){ 
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({	 
    handleOversize: "drag",
    modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){
		recarga_tabla();
	}
});
</script>
<script type="text/javascript" src="js/format_table.js"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />


<script src="../js/js-xlsx/jszip.js" type="text/javascript"></script>
<script src="../js/js-xlsx/jszip-deflate.js" type="text/javascript"></script>
<script src="../js/js-xlsx/jszip-inflate.js" type="text/javascript"></script>
<script src="../js/js-xlsx/jszip-load.js" type="text/javascript"></script>
<script src="../js/js-xlsx/xlsx.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style>
#overlay {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    z-index:50;
	display:none;
}
</style>


</head>

<body>

<table width="98%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" >
  <tr align="center" class="">
    <td align="right"  >
    <img src="../img/generate.png" width="40" height="40" style="cursor:pointer; float:right; margin-left:100px; margin-right:20px" onclick="planilla()" title="Generar Planilla" />
    <img src="../img/Excell_Down.png" width="40" height="40" name="button2" id="button2" title="Exportar a Excel" onclick="excel()" style="float:right; cursor:pointer; margin-right:20px; margin-left:20px" />
    <img src="../img/historial.png" width="40" height="40" name="button2" id="button2" title="Historial De Planillas" onclick="planti()" style="float:right; cursor:pointer; margin-right:20px; margin-left:20px" />
    
    <img src="../img/Calculator.png" width="40" height="40" name="nuevo2" id="nuevo2" title="Parámetros Fijos" onclick="fijos()"  style="float:right; cursor:pointer; margin-left:20px" />  
    <img src="../img/addpersonas.png" width="40" height="40" name="nuevo" id="nuevo" title="Agregar Empleado" onclick="nuevo_emple()" style="float:right; cursor:pointer"  />

     <label for="filtro"></label>
    <?php
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT DISTINCT hacienda FROM d89xz_hacienda WHERE `delete`=0",$conexion);	
		
	?>
       <select name="filtro" id="filtro" style="float:left; margin-left:15px; width:250px" onchange="recarga_tabla()" class="cont">
      <?php
	  while($row_rs_usus=mysql_fetch_assoc($rs_usus)){
	  ?>
      <option value="<?php echo $row_rs_usus['hacienda'] ?>"><?php echo $row_rs_usus['hacienda'] ?></option>
      <?php
	  }		  
	  ?>
      </select>      
     <?php
	}else{
	 ?> 
     <input type="hidden" value="<?php echo $usuario ?>" id="filtro" />
     <?php
	}
	 ?>
      </td>
    </tr>
    <tr align="center" style="font-size:16px">
    <th  class="tittle" >Listado De Empleados</th>
    </tr> 
    </table>
    <div id="recargar">
<?php
@$filtro = stripslashes(trim($_GET["filtro"]));
$query_lugar = "SELECT DISTINCT lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0 ORDER BY lugar_trabajo ASC";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$totalRows_lugar = mysql_num_rows($lugar);

?>
    <table width="98%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" id="t_formato">
    <thead>
  
  <tr align="center" class="tittle">
    <th width="376" style="font-family: 'Arial Black', Gadget, sans-serif">Nombre</th>
    <th width="142" style="font-family: 'Arial Black', Gadget, sans-serif">Cédula</th>
    <th width="230" style="font-family: 'Arial Black', Gadget, sans-serif">Cargo</th>
    <th style="font-family: 'Arial Black', Gadget, sans-serif">Salario</th>
    <th width="145" style="border-right:none; border-top:none; border-bottom:none; margin-left:15px" align="center" >&nbsp;</th>
  </tr>
  </thead>
  <?php
  while($row_lugar = mysql_fetch_assoc($lugar)){
	  $lugar_tra=$row_lugar['lugar_trabajo'];
  ?>
  <tr align="center" class="bold">
    <td colspan="5" align="left" style="font-family: 'Arial Black', Gadget, sans-serif; border:none" class="row" ><strong><?php echo $row_lugar['lugar_trabajo'] ?></strong></td>
    </tr>
  <?php 
  mysql_select_db($database_conexion, $conexion);
$query_lista = "SELECT * FROM nomina_valle WHERE lugar_trabajo='$lugar_tra' and hacienda='$filtro' and `delete`=0 ";
$lista = mysql_query($query_lista, $conexion) or die(mysql_error());
$totalRows_lista = mysql_num_rows($lista);
  while ($row_lista = mysql_fetch_assoc($lista)){ ?>
  <tr align="center" name="filas" class="row" id="<?php echo $row_lista['id'] ?>" style="background-image:none; border-right:none" >
    <td align="center" style="font-family: Arial" onclick="mostrar(<?php echo $row_lista['id']?>)"><?php echo $row_lista['nombre'] ?></td>
    <td style="font-family: Arial" align="center" onclick="mostrar(<?php echo $row_lista['id']?>)"><?php echo $row_lista['cedula'] ?></td>
    <td style="font-family: Arial" align="center" onclick="mostrar(<?php echo $row_lista['id']?>)"><?php echo $row_lista['cargo'] ?></td>
    <td align="center" style="font-family: Arial" onclick="mostrar(<?php echo $row_lista['id']?>)"><?php echo @number_format($row_lista['salario']) ?></td>
    <?php
	$id=$row_lista['id'];
	$query_estado = "SELECT nomina_liquidar.id_nomina, nomina_liquidar.estado FROM nomina_liquidar WHERE estado='ok' and id_nomina='$id' and `delete`=0";
$estado = mysql_query($query_estado, $conexion) or die(mysql_error());
$row_estado = mysql_fetch_assoc($estado);
$valor=$row_estado['estado'];
	?>
    <td style="border-top:none; border-bottom:none; border-right:none; width:30px;  " >
    <?php
	if($valor!='ok'){
	?>
    <img src="../img/dollar-icon.png" width="23" height="22"  id='<?php echo $row_lista['cedula']?>' title="Generar Liquidación"   onclick="mostrar2('<?php echo $row_lista['id']?>')" />
    
    <?php
	
	} else {
		
	?>
    
	</script>
    <img src="../img/good.png" width="23" height="22" name="aceptar" id='<?php echo $row_lista['cedula']?>' title="Ver Detalle Liquidación"  onclick="mostrar3('<?php echo $row_lista['id']?>')"/>
    <?php
	}
	?>
    <img src="../img/erase.png" width="22" height="22" title="Eliminar Empleado" onclick="eliminar_emple(<?php echo $row_lista['id']?>)" style="float:right; margin-right:10px;" />    
  <?php } 
  }
  
  ?>
  </td>
  </tr>
  </tbody>
</table>

<table id="pa_excel" style="display:none">
<tr><td alt="Nombre">Nombre</td>
	<td alt="Cedula">Cédula</td>
	<td alt="RFID">RFID</td>
    <td alt="F. Nacimiento">Fecha Nacimiento</td>
    <td alt="Estado Civil">Estado Civil</td>
    <td alt="Direccion">Dirección</td>
    <td alt="Telefono">Teléfono</td>
    <td alt="Celular">Celular</td>
    <td alt="Mail">Mail</td>
    <td alt="EPS">EPS</td>
    <td alt="Pensiones">Pensiones</td>
    <td alt="ARP">ARP</td>
    <td alt="Fecha Ingreso">Fecha de Ingreso</td>
    <td alt="Fecha Terminacion Contrato">Fecha de Terminación del Contrato</td>
    <td alt="Tipo de Contrato">Tipo de Contrato</td>
    <td alt="Cargo">Cargo</td>
    <td alt="Salario">Salario</td>
    </tr>
<?php

$rs_exp = mysql_query("SELECT * FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0 ");
while($row_exp=mysql_fetch_assoc($rs_exp)){
	?>
    <tr>
    <td alt="Nombre"><?php echo $row_exp['nombre']  ?></td>
    <td alt="Cedula"><?php echo $row_exp['cedula']  ?></td>
	<td alt="RFID"><?php echo $row_exp['rfid']  ?></td>
    <td alt="F. Nacimiento"><?php echo (string)$row_exp['nacimiento'];  ?></td>
    <td alt="Estado Civil"><?php echo $row_exp['civil']  ?></td>
    <td alt="Direccion"><?php echo $row_exp['direccion']  ?></td>
    <td alt="Telefono"><?php echo $row_exp['telefono']  ?></td>
    <td alt="Celular"><?php echo $row_exp['celular']  ?></td>
    <td alt="Mail"><?php echo $row_exp['mail']  ?></td>
    <td alt="EPS"><?php echo $row_exp['eps']  ?></td>
    <td alt="Pensiones"><?php echo $row_exp['pensiones']  ?></td>
    <td alt="ARP"><?php echo $row_exp['arp']  ?></td>
    <td alt="Fecha Ingreso"><?php echo $row_exp['fecha_ingreso']  ?></td>
    <td alt="Fecha Terminacion Contrato"><?php echo $row_exp['fecha_terminacion_contrato']  ?></td>
    <td alt="Tipo de Contrato"><?php echo $row_exp['tipo_contrato']  ?></td>
    <td alt="Cargo"><?php echo $row_exp['cargo']  ?></td>
    <td alt="Salario"><?php echo $row_exp['salario']  ?></td>
    </tr>
    <?php
}
?>
</table>


</div>
<div id="dialog2" style="font-size:10px">
<table><tr><td colspan="3">Seleccione las Filas que Desea Exportar</td></tr>
<tr>
    <td><input type="checkbox" checked="checked" alt="Nombre" />Nombre</td>
    <td><input type="checkbox" checked="checked" alt="Cedula" />Cédula</td>
    <td><input type="checkbox" checked="checked" alt="RFID" />RFID</td>
</tr>
<tr>
    <td><input type="checkbox" checked="checked" alt="F. Nacimiento"/>F. Nacimiento</td>
    <td><input type="checkbox" checked="checked" alt="Estado Civil"/>Estado Civil</td>
    <td><input type="checkbox" checked="checked" alt="Direccion"/>Dirección</td>
</tr>
<tr>
    <td><input type="checkbox" checked="checked" alt="Telefono"/>Teléfono</td>
   <td><input type="checkbox" checked="checked" alt="Celular"/>Celular</td>
    <td><input type="checkbox" checked="checked" alt="Mail"/>Mail</td>
</tr>
<tr>
    <td><input type="checkbox" checked="checked" alt="EPS"/>EPS</td>
   <td><input type="checkbox" checked="checked" alt="Pensiones"/>Pensiones</td>
    <td><input type="checkbox" checked="checked" alt="ARP"/>ARP</td>
</tr>
<tr>
    <td><input type="checkbox" checked="checked" alt="Fecha Ingreso"/>Fecha Ingreso</td>
   <td><input type="checkbox" checked="checked" alt="Fecha Terminacion Contrato"/>Fecha Terminación Contrato</td>
    <td><input type="checkbox" checked="checked" alt="Tipo de Contrato"/>Tipo de Contrato</td>
</tr>
<tr>
    <td><input type="checkbox" checked="checked" alt="Cargo"/>Cargo</td>
   <td><input type="checkbox" checked="checked" alt="Salario"/>Salario</td>
    <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="3" align="center"><input type="button" value="Aceptar" class="ext" onclick="excel2()" /></td>
  </tr>
</table>

</div>
<div id="dialog" align="center">
</div>

<?php
}else{
	?>
   <table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo_out.png" width="300" height="140" /></td>
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
</body>
<script>
window.onload=function(){
	init_dialog()
	recarga_tabla()
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	formato("t_formato")

};

function recarga_tabla(){
	var filtro=$("#filtro").val();
		$('#recargar').load('stin_nomina_lista.php?filtro=' + filtro.replace(/ /g,"+") + ' #recargar ' );
				  }
function seguir(){ 
	$("#dialog").dialog("close");
	var filtro=$("#filtro").val();
	var url = 'stin_nomina_planilla.php?filtro='+filtro;
	window.open(url,'Planilla','width=1200,height=600').focus()
}
function cancela(){ 
	$("#dialog").dialog("close");
}
function planilla(){
	var filtro=$("#filtro").val();
	if(filtro==''){
		$("#filtro").effect("pulsate", { times:3 }, 1000);
		return false;
	}
	var filas= document.getElementsByName("filas").length;
	var faltan=document.getElementsByName("aceptar").length;
	if (filas!=faltan){
		$("#dialog").dialog("open");
		$("#dialog").html("No Todas Las Liquidaciones Fueron Generadas");
		$("#dialog").append("<br />");
		$("#dialog").append("Desea Continuar?");
		$("span.ui-dialog-title").text('Alerta!'); 	
		$("#dialog").append("<br />");	
		$("#dialog").append("<br />");	
		$("#dialog").append('<img id="continuar" src="../img/good.png" width="53" onclick="seguir()" height="41" title="Continuar" style="cursor:pointer" />')
		$("#dialog").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		$("#dialog").append('<img id="cancelar" src="../img/erase.png" width="53" height="41" title="Cancelar" style="cursor:pointer" onclick="cancela()" />')
	} else {
		$("#dialog").dialog("open");
		$("span.ui-dialog-title").text('Generación de Planilla!');
		$("#dialog").html("Generar Planilla de Liquidación?");
		$("#dialog").append("<br />");	
		$("#dialog").append("<br />");	
		$("#dialog").append('<img id="continuar" src="../img/good.png" width="53" onclick="seguir()" height="41" title="Continuar" style="cursor:pointer" />')
		$("#dialog").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		$("#dialog").append('<img id="cancelar" src="../img/erase.png" width="53" height="41" title="Cancelar" style="cursor:pointer" onclick="cancela()" />')
	}
	
	
}
function mostrar3(id){
	var filtro=$("#filtro").val();
	var url = 'stin_nomina_liquidar_ver.php?id_mira='+id + '&filtro=' + filtro;
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function mostrar2(id){
	var filtro=$("#filtro").val();
	var url = 'stin_nomina_liquidar.php?id='+id+'&filtro=' + filtro;
	var w = window.open(url,'','width=1200,height=600,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}
function checkChildWindow(win, onclose) {
    var w = win;
    var cb = onclose;
    var t = setTimeout(function() { checkChildWindow(w, cb); }, 500);
    var closing = false;
    try {
        if (win.closed || win.top == null) //happens when window is closed in FF/Chrome/Safari
        closing = true;        
    } catch (e) { //happens when window is closed in IE        
        closing = true;
    }
    if (closing) {
        clearTimeout(t);
		var ano= $('#ano').val();
		
		overlay.hide();
    }
}
overlay.click(function(){
	window.win.focus()
});


function fijos(){
	var filtro=$("#filtro").val();
	console.log(fijos)
	if(filtro==''){
		$("#filtro").effect("pulsate", { times:3 }, 1000);
		return false;
	}else{
		var url = 'stin_nomina_fijos.php?filtro='+filtro;
		Shadowbox.open({
		 content: url,
		 player: "iframe",
		 
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true		  
			}
		})
	}
}
function nuevo_emple(){
	var filtro=$("#filtro").val();
	if(filtro==''){
		$("#filtro").effect("pulsate", { times:3 }, 1000);
		return false;
	}
	var url = 'stin_nomina.php?filtro='+filtro;
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}

function planti(){
	var filtro=$("#filtro").val();
	if(filtro==''){
		$("#filtro").effect("pulsate", { times:3 }, 1000);
		return false;
	}
	var url = 'stin_nomina_planilla_hist.php?filtro='+filtro;
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function eliminar_emple(id){
	overlay.show()
	$("#dialog").html('Eliminar Empleado?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="../img/good.png" width="53" height="41" style="cursor:pointer; margin-right:20px" onclick="eliminar2('+id+')"/></td><td align="center"><img id="theImg2" src="../img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:20px" onclick="cerrar_dialogo2()"/></td></tr></table>');
}
function eliminar2(idn){
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "eliminar_emple="+idn,
        success: function(datos){
			console.log(datos)
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");			
			setTimeout(function () {
				recarga_tabla()
			   $("#dialog").dialog("close");
			   overlay.hide()
			}, 2000);
      }
	  
	})
}
function cerrar_dialogo2(){
	overlay.hide()
	$("#dialog").dialog("close");
}

function mostrar(id){
var filtro=$("#filtro").val();
var url = 'stin_nomina_ver.php?id=' + id+'&filtro='+filtro;
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
	

}
function init_dialog(){
	$(function() {
		var dialogwidth=400
		$( "#dialog, #dialog2" ).dialog({
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
}
function excel(){
	$("#dialog2").dialog("open");
	$(".expor").removeClass("expor");
	$("span.ui-dialog-title").text('Exportar a Excel');
}
function excel2(){
	$("#dialog2 table tr input[type=checkbox]").each(function(index, element) {
        if($(this).prop('checked')==true){
			nom=$(this).attr("alt")
			$("#pa_excel tr td").each(function(index, element) {
                if($(this).attr("alt")==nom){
					$(this).addClass("expor");
				}
            });
		}
    });
	exp_excel3();
	$("#dialog2").dialog("close");
}
function exp_excel3(){
	var file = {
		worksheets: [[]], 
		creator: '', 
		created: new Date('8/16/2012'),
		lastModifiedBy: '', 
		modified: new Date(),
		activeWorksheet: 0
	},
	w = file.worksheets[0]; 
	w.name = "Nomina";
	k=0;
	$('#pa_excel').find('tr').each(function() {
		var r = w.push([]) - 1; 
		j=0;
		$(this).find('td.expor').each(function() { 
			w[r].push($.trim($(this).html()));
			j++;
		});
		k++;
	});
   window.location=xlsx(file).href();
}
</script>
</html>
<?php
@mysql_free_result(@$estado);
@mysql_free_result($lista);
?>
