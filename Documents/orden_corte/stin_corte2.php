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
$orden=$_GET['orden'];
$filtro=$_GET['filtro'];
$rs_ej=mysql_query("SELECT * FROM tba WHERE hacienda='$usuario' and nivel='$usuario_nivel' and nombre='$usuario_name' and `delete`=0",$conexion);

date_default_timezone_set('America/Bogota');
$today = date("Y/m/d"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({	
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	}, 
    handleOversize: "drag",
    modal: true,
	onClose: function(){  }
});
</script>
<script src="../print_jquery/printThis.js" type="text/javascript"></script>
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
@media print{
    .visible {display:none}
}
.visible {display:none}
</style>
</head>

<body >
<div id="todo">
<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCC">
    <td colspan="6" align="left" bgcolor="#FFFFFF" style="color:#FFF; border-right:none"><img src="../img/recycler.png" width="48" height="48"  alt="" style="float:right; margin-right:15px; cursor:pointer; margin-top:30px" onclick="elimina(<?php echo $orden ?>)" title="Eliminar Orden de Corte"/>
      <img src="../img/add.png" width="48" height="48"  alt="" style="float:right; margin-right:15px; cursor:pointer; margin-top:30px" onclick="location.href='stin_corte1.php'" title="Agregar Nueva orden de Corte"/>
      <img src="../img/historial1.png" width="48" height="48"   title="Historial" onclick="location.href='stin_corte3.php'" style="float:right; cursor:pointer; margin-right:15px; margin-top:30px" /></td>
  </tr>
  
</table>
<table width="98%" border="1" cellspacing="0" cellpadding="0">

  <tr class="tittle">
    <td colspan="5" style="font-size:18px"  >ORDEN DE CORTE No. <?php echo $orden ?>
     </td>
  </tr>
  <?php
  $rs_ord=mysql_query("SELECT * FROM orden_corte WHERE orden_no='$orden' and hacienda='$filtro'");
  $row_ord=mysql_fetch_assoc($rs_ord);
  ?>
  <tr class="bold cont">
    <td style="width:200px" ><strong style="margin-left:15px">Fecha</strong></td>
    <td colspan="2" align="left" >
    <input type="text"   readonly="readonly" value="<?php echo $row_ord['fecha'] ?>"/></td>
    <td ><strong>Ubicación</strong></td>
    <td align="left"><input type="text" id="filtro"   readonly="readonly" value="<?php echo $row_ord['hacienda'] ?>"/></td>
  </tr>
  <tr class="bold cont">
    <td ><strong style="margin-left:15px">Cantidad de Telas</strong></td>
    <td colspan="2"><input type="text"   readonly="readonly" value="<?php echo $row_ord['cant_telas'] ?>"/></td>
    <td><strong style="">Tipo</strong></td>
    <td >
     <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_ord[tipo_insumo]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
      <input type="text"   readonly="readonly" value="<?php echo $row_ins['tipo_t'].' '.$row_ins['nombre'].' '.$row_ins['ancho'].' de Ancho '.$row_ins['descripcion']  ?>" class="long"/></td>
    </tr>
  <tr class="bold cont">
    <td><strong style="margin-left:15px">Largo</strong></td>
    <td><input type="text"   readonly="readonly" value="<?php echo $row_ord['largo'] ?>"/></td>
    <td style="width:70px">&nbsp;</td>
    <td>Botón</td>
    <td>
    <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_ord[tipo_boton]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
      <input type="text"   readonly="readonly" value="<?php echo $row_ins['nombre'].' '.$row_ins['marca'].' '.$row_ins['descripcion'] ?>" class="long"/>
      
      </td>
    </tr>
</table>
<?php
$rs_desc=mysql_query("SELECT * FROM orden_corte2 WHERE orden='$orden' and hacienda='$filtro'");
$desc_num_rows=mysql_num_rows($rs_desc);
while($row_desc=mysql_fetch_assoc($rs_desc)){
?>
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" name='des_diseno'>
<tr class="tittle">

  <td colspan="30" align="center" >DESCRIPCION DEL DISEÑO
   </td>
</tr>
<tr class="bold">
  <td style="width:10%"><strong style="margin-left:15px">Tallas</strong></td>
  <td style="width:1%">37</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t37'] ?>"  />
</td>
  <td style="width:1%">38</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t38'] ?>"  />
</td>
  <td style="width:1%">39</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t39'] ?>"  />
</td>
  <td style="width:1%">40</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t40'] ?>"  />
 </td>
  <td style="width:1%">41</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t41'] ?>"  /></td>
  <td style="width:1%">42</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t42'] ?>"  /></td>
  <td style="width:1%">44</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t44'] ?>"  /></td>
  <td style="width:1%">46</td>
  <td style="width:10.25%"><input type="text" style="width:30px" readonly="readonly" value="<?php echo $row_desc['t46'] ?>"  /></td>
</tr>
</table>
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" name='des_diseno'>
<tr class="bold">
  <td width="10%" ><strong style="margin-left:15px">Referencia</strong></td>
  <td>&nbsp;</td>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['referencia'] ?>"  /></td>
  <td>&nbsp;</td>
  <td colspan="8">&nbsp;</td>
  <td>&nbsp;</td>
  <td>Diseño</td>
  <td>&nbsp;</td>
  <td colspan="7"><input type="text"  readonly="readonly" value="<?php echo $row_desc['diseno'] ?>"  /></td>
  <td>&nbsp;</td>
  <td>Entretela</td>
  <td>&nbsp;</td>
  <td>
  <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_desc[entretela]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
    <input type="text"  readonly="readonly" value="<?php echo $row_ins['descripcion'] ?>"  />
    </td>
  <td width="10" colspan="2">&nbsp;</td>
  <td width="40" colspan="2">&nbsp;</td>
</tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Manga</strong></td>
  <td>&nbsp;</td>
  <?php
  if($row_desc['charretera']=='on') $charretera='Con Charretera'; else $charretera='Sin Charretera'
  ?>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['manga'].' '.$charretera ?>"  /></td>
  <td colspan="9">&nbsp;</td>
  <td>&nbsp;</td>
  <td>Cuello</td>
  <td>&nbsp;</td>
  <?php
  if($row_desc['cuello_c_b']=='on' && $row_desc['cuello_boton']!='0') $cuello_c_b='Con Botón'; else $cuello_c_b='Sin Botón'
  ?>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['cuello']?>"  /></td>
  <td colspan="9"><?php echo ' '.$cuello_c_b ?></td>
  <td colspan="5">
  <?php
  if($cuello_c_b=='Con Botón') {
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_desc[cuello_boton]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
      <input type="text"   readonly="readonly" value="<?php echo $row_ins['nombre'].' '.$row_ins['marca'].' '.$row_ins['descripcion'] ?>" class="long"/> 
  <?php
  }
  ?> 
    </td>
  </tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Cartera</strong></td>
  <td>&nbsp;</td>
  <td>
    <input type="text"  readonly="readonly" value="<?php echo $row_desc['cartera']?>"  /></td>
  <td colspan="9">&nbsp;</td>
  <td>&nbsp;</td>
  <td>Bolsillo</td>
  <td>&nbsp;</td>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['bolsillo']?>"  /></td>
  <?php
  if($row_desc['bolsillo_c_b']=='on' ) $bolsillo_c_b='Con Botón'; else $bolsillo_c_b='Sin Botón'
  ?>
  <td colspan="8"><?php echo $bolsillo_c_b ?>
  </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Banda</strong></td>
  <td>&nbsp;</td>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['banda']?>"  /></td>
  <td>&nbsp;</td>
  <td colspan="9">&nbsp;</td>
  <td>Espalda</td>
  <td>&nbsp;</td>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['espalda']?>"  /></td>
  <td colspan="7">&nbsp;</td>
  <td>Puño</td>
  <td>&nbsp;</td>
  <td><input type="text"  readonly="readonly" value="<?php echo $row_desc['puno']?>"  /></td>
  <td>&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  </tr>
</table>
<?php
}
?>
 <div id="rec_todo">
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr class="tittle">
    <td colspan="8" >INSUMOS REQUERIDOS
     </tr>
  <tr class="bold">
  	<td width="150" style="white-space:nowrap">Metros de Tela    </td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['metros']  ?>" />   
    </td>
    <td >Camisas</td>  
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['t_camisas']  ?>" />    </td>
    <td >Promedio   </td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['promedio']  ?>" />    </td>
    <td >Bolsas   </td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['bolsas']  ?>" />    </td>
    
  </tr>
  <tr class="bold">
    <td >Almas y Tacos</td>  
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['almas']  ?>" />   </td>
    <td >Mariposas   </td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['mariposas']  ?>" />    </td>
    <td >Hormacuellos Largos   </td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['hormacuellos_l']  ?>" />   </td>
    <td style="white-space:nowrap">Hormacuellos Pequeños    </td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['hormacuellos_p']  ?>" />   </td>
  </tr>
  <tr class="bold">
    <td >Botones</td>   

    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['botones']  ?>" />
   
    </td>
    <td style="white-space:nowrap">Botones Cuello</td>
    <td >
    <input type="text"   readonly="readonly" value="<?php echo $row_ord['bot_cuello']  ?>" /></td>
    <td >Marquillas(Composición)</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['marquillas_c']  ?>" /></td>
    <td >Plumillas</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['plumillas']  ?>" /></td>
  </tr>
  <tr class="bold">
    <td style="white-space:nowrap">Cintas Colección</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['c_coleccion']  ?>" /></td>
    <td style="white-space:nowrap">Cintas Exclusiva</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['c_exclusiva']  ?>" /></td>
    <td >Cintas Royal</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['c_royal']  ?>" /></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="bold">
    <td style="white-space:nowrap">Etiquetas Colección</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['e_coleccion']  ?>" /></td>
    <td style="white-space:nowrap">Etiquetas Exclusiva</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['e_exclusiva']  ?>"  /></td>
    <td >Etiquetas Royal</td>
    <td ><input type="text"   readonly="readonly" value="<?php echo $row_ord['e_royal']  ?>" /></td>
    
    
    <td colspan="2" >&nbsp;</td>
    </tr>
  </table>
  <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr class="tittle">
    <td colspan="8" align="center" >OBSERVACIONES</td>
    </tr>
  
  <tr class="bold">

    <td align="center" colspan="7"><textarea name="corte" id="corte" style="width:90%; height:70px"  ><?php echo $row_ord['comentario'] ?></textarea></td>
  </tr>
  <tr>
    <td colspan="8" align="center">
    
    <?php if($row_ord['estado']==''){ ?>
    <input type="button" name="guarda" id="guarda" value="Descontar Insumos" onclick="location.href='stin_corte4.php?orden=<?php echo $row_ord['orden_no'] ?>&filtro=<?php echo $row_ord['hacienda'] ?>'" class="ext" />
    <?php 
	}else{
		?>
		 <input type="button" name="guarda" id="guarda" value="Ver Insumos" onclick="location.href='stin_corte6.php?orden=<?php echo $row_ord['orden_no'] ?>&filtro=<?php echo $row_ord['hacienda'] ?>'" class="ext" />
         <?php
	}
	?>
    
    </td>
    </tr>
</table>
</div>
</div>
<div id="dialog" >
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
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	$("#rec_todo").find("input:text").width("80%");
}
function elimina(orden){
	overlay.show()
	$("#dialog").html('Eliminar Orden '+orden+' ?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="img/good.png" width="53" height="41" style="cursor:pointer; margin-right:25px" onclick="eliminar2('+orden+')"/></td><td align="center"><img id="theImg2" src="img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:25px" onclick="cerrar_dialogo2()"/></td></tr></table>');
}
function eliminar2(orden){
	var filtro=$("#filtro").val()
	$.ajax({
        type: "GET",
        url: "stin_corte_php.php",
        data: "eliminar_orden="+orden+"&filtro="+filtro,
        success: function(datos){
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");			
			setTimeout(function () {
				location.href='stin_corte3.php'
			}, 2000);
      }
	  
	})
}
function cerrar_dialogo2(){
	overlay.hide()
	$("#dialog").dialog("close");
}
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: false,           
         printContainer: true,      				         					
         pageTitle: "",             
         removeInline: false       
	  });
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