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
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />  

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="css/clean.css" />
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({	 
    handleOversize: "drag",
    modal: true,
	onClose: function(){
		recarga_tabla();
	}
});
</script>
<script type="text/javascript" src="js/format_table.js"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />
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

<table width="98%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="858" align="left" bgcolor="#FFFFFF"><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="agenda.php" class="current">Historial Colectivo</a></li>
      <li><a href="agenda2.php" >Historial Individual</a></li>
    </ul></td>
    <td width="94" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="58" align="left" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" >
  <tr align="center" style="color:#FFF; background-color:#ccc;">
    <td colspan="5" align="left" bgcolor="#FFFFFF" style="border-right:none" ><img src="img/Logo SAGA sin texto.png" width="200" height="70" /></td>
    </tr>
  <tr align="center" style="color:#FFF; background-color:#999;" class="">
    <td colspan="5" align="right" bgcolor="#999" style="font-family: 'Arial Black', Gadget, sans-serif" ><label for="filtro"></label>
    <?
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT  hacienda FROM d89xz_hacienda where `delete` ='0'",$conexion);	
		
	?>
       <select name="filtro" id="filtro" style="float:left; margin-left:15px" onchange="recarga_tabla()" class="cont">
       <option value="">Hacienda</option>
      <?
	  while($row_rs_usus=mysql_fetch_assoc($rs_usus)){
	  ?>
      <option value="<? echo $row_rs_usus['hacienda'] ?>"><? echo $row_rs_usus['hacienda'] ?></option>
      <?
	  }		  
	  ?>
      </select>      
     <?
	}else{
	 ?> 
     <input type="hidden" value="<? echo $usuario ?>" id="filtro" />
     <?
	}
	 ?></td>
    </tr>
    </table>
    <div id="recargar">
<?
@$filtro = stripslashes(trim($_GET["filtro"]));
$query_lugar = "SELECT DISTINCT lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0 ORDER BY lugar_trabajo ASC";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$totalRows_lugar = mysql_num_rows($lugar);

?>
    <table width="98%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" id="t_formato">
    <thead>
  <tr align="center" style="font-size:16px">
    <th colspan="5"  class="tittle" >Listado De Empleados</th>
    </tr> 
  <tr align="center" class="tittle">
    <th width="376" style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Nombre</strong></th>
    <th width="142" style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Cédula</strong></th>
    <th width="158" style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Cargo</strong></th>
    <th style="font-family: 'Arial Black', Gadget, sans-serif"><strong>Salario</strong></th>
    <th width="145" style="border-right:none; border-top:none; border-bottom:none; margin-left:15px" align="center" >&nbsp;</th>
  </tr>
  </thead>
  <?
  while($row_lugar = mysql_fetch_assoc($lugar)){
	  $lugar_tra=$row_lugar['lugar_trabajo'];
  ?>
  <tr align="center" class="bold">
    <td colspan="5" align="left" style="font-family: 'Arial Black', Gadget, sans-serif; border:none" class="row" ><strong><? echo $row_lugar['lugar_trabajo'] ?></strong></td>
    </tr>
  <? 
  mysql_select_db($database_conexion, $conexion);
$query_lista = "SELECT * FROM nomina_valle WHERE lugar_trabajo='$lugar_tra' and hacienda='$filtro' and `delete`=0 ";
$lista = mysql_query($query_lista, $conexion) or die(mysql_error());
$totalRows_lista = mysql_num_rows($lista);
  while ($row_lista = mysql_fetch_assoc($lista)){ ?>
  <tr align="center" name="filas" onmouseover="dibujar('<? echo $row_lista['id']?>','<? echo $row_lista['cedula'] ?>')"  onmouseout= "desdibujar('<? echo $row_lista['id']?>','<? echo $row_lista['cedula'] ?>')" id="<? echo $row_lista['id'] ?>" style="background-image:none; border-right:none" class="row">
    <td align="center" style="font-family: Arial" onclick="mostrar(<? echo $row_lista['id']?>)"><? echo $row_lista['nombre'] ?></td>
    <td style="font-family: Arial" align="center" onclick="mostrar(<? echo $row_lista['id']?>)"><? echo $row_lista['cedula'] ?></td>
    <td style="font-family: Arial" align="center" onclick="mostrar(<? echo $row_lista['id']?>)"><? echo $row_lista['cargo'] ?></td>
    <td align="center" style="font-family: Arial" onclick="mostrar(<? echo $row_lista['id']?>)"><? echo @number_format($row_lista['salario']) ?></td>
    <?
	$id=$row_lista['id'];
	$query_estado = "SELECT nomina_liquidar.id_nomina, nomina_liquidar.estado FROM nomina_liquidar WHERE estado='ok' and id_nomina='$id' and hacienda='$filtro' and `delete`=0";
$estado = mysql_query($query_estado, $conexion) or die(mysql_error());
$row_estado = mysql_fetch_assoc($estado);
$valor=$row_estado['estado'];
	?>
    <td style="border-top:none; border-bottom:none; border-right:none; width:30px; background-color:#FFF " >
    <?
	if($valor!='ok'){
	?>
    <?
	
	} else {
		
	?>
    
	</script>
	<?
	}
	?>
	<? } 
  }
  
  ?>
  </td>
  </tr>
  </tbody>
</table>
</div>
<div id="dialog" align="center">
</div>

<?
}else{
	?>
    <table width="70%" border="0" align="center">
  <tr>
    <td><img src="img/Logo SAGA sin texto.png" width="200" height="70" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?
}
?>
</body>
<script>
window.onload=function(){
	recarga_tabla()
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
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
		$("#dialog").append('<img id="continuar" src="img/good.png" width="53" onclick="seguir()" height="41" title="Continuar" style="cursor:pointer" />')
		$("#dialog").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		$("#dialog").append('<img id="cancelar" src="img/erase.png" width="53" height="41" title="Cancelar" style="cursor:pointer" onclick="cancela()" />')
	} else {
		$("#dialog").dialog("open");
		$("span.ui-dialog-title").text('Generación de Planilla!');
		$("#dialog").html("Generar Planilla de Liquidación?");
		$("#dialog").append("<br />");	
		$("#dialog").append("<br />");	
		$("#dialog").append('<img id="continuar" src="img/good.png" width="53" onclick="seguir()" height="41" title="Continuar" style="cursor:pointer" />')
		$("#dialog").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		$("#dialog").append('<img id="cancelar" src="img/erase.png" width="53" height="41" title="Cancelar" style="cursor:pointer" onclick="cancela()" />')
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
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
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
function nuevo(){
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
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<img id="theImg2" src="img/good.png" width="53" height="41" style="cursor:pointer; float:left" onclick="eliminar2('+id+')"/><img id="theImg2" src="img/erase.png" width="53" height="41" style="cursor:pointer;float:right" onclick="cerrar_dialogo2()"/>');
}
function eliminar2(idn){
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "eliminar_emple="+idn,
        success: function(datos){
			console.log(datos)
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="43" height="31"/>');
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
function dibujar(fila, ced){	
	document.getElementById(fila).style.backgroundColor = "#CCC"; 
	
	document.getElementById(fila).style.color = "#fff"; 
	document.getElementById(fila).style.cursor="pointer";
	document.getElementById(fila).title = 'Ver Detalle';
}
function desdibujar(fila, ced){	
	document.getElementById(fila).style.color = "#000"; 
	 document.getElementById(fila).style.backgroundColor = "#FFF"; 
	 document.getElementById(fila).style.cursor="auto";
	 
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
</script>
</html>
<?php
@mysql_free_result(@$estado);
@mysql_free_result($lista);
?>
