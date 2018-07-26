<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if ($acceso =='0'){ 

$orden=$_GET['orden'];
$filtro=$_GET['filtro'];
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
<link rel="stylesheet" href="css/estilo.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript" src="js/format_table.js"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />
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
#desc_ins{
	position:absolute;
	bottom:0;
	width:98%;

}
.radio{
	border:2px solid;
	border-radius:25px;
}
.selectedRow, .selectedRow:active, .childgrid tr:active {
background-color: #E7E7E7;
cursor: move;
}
.ui-state-hover{
	background-color: #E7E7E7;
}
.black td{
	background-color:#09F !important;
}
</style>
</head>

<body>
<div id="todo" >
<input type="hidden" id="filtro" value="<?php echo $filtro ?>" /> 
<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr >
    <td colspan="6" align="left" bgcolor="#FFFFFF" style="color:#FFF; border-right:none"><span style="font-size:18px"><img src="../img/edit.png" width="48" height="48"  alt="" style="float:right; margin-right:15px; cursor:pointer; margin-top:30px" title="Editar Descuento de Insumos" onclick="location.href='stin_corte5.php?filtro=<?php echo $filtro ?>&orden=<?php echo $orden ?>'"/></span></td>
  </tr>  
</table>
<div id="solicitados" style="overflow:auto;">
<?php 
$rs_ord=mysql_query("SELECT * FROM orden_corte WHERE orden_no='$orden' and hacienda='$filtro'");
$row_ord=mysql_fetch_assoc($rs_ord);
$tipo=$row_ord['tipo_insumo'];
$camisas=$row_ord['t_camisas'];
$boton_id=$row_ord['tipo_boton'];
$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$tipo'");
$row_ins=mysql_fetch_assoc($rs_ins);
$insumo=$row_ins['tipo_t'].' '.$row_ins['nombre'].' '.$row_ins['ancho'].' de Ancho';
$rs_bot=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$boton_id'");
$row_bot=mysql_fetch_assoc($rs_bot);
$boton=$row_bot['nombre'].' '.$row_bot['marca'].' '.$row_bot['descripcion'];
?>
<input type="hidden" id="filtro" value="<?php echo $filtro ?>"/>
<input type="hidden" id="orden" value="<?php echo $orden ?>"/>
<table width="98%" border="1" cellspacing="0" cellpadding="0" class="tirar" >
<thead>
<tr class="tittle">
<th colspan="4"  style="font-size:18px">ORDEN DE CORTE No. <?php echo $orden ?></th>
</tr>
<tr style="font-size:13px">
  <th class="bold2" >Insumo</th>
  <th class="bold2">Requerido</th>
  <th class="bold">Insumo</th
  >
  <th class="bold">Solicitado</th>
  </tr>
</thead>
<tbody>

<tr id="ins1" class="row">
  <td class="bold" align="center" style="width:25%;" ><?php echo $insumo ?></td>
  <td class="bold" align="center" style="width:25%"><?php echo number_format($row_ord['metros']).' Metros' ?></td>
  <td align="center" style="width:25%" id="nom1">Insumo</td>
  <td align="center" style="width:25%" class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins3" class="row">
  <td class="bold" align="center" >BOLSAS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['bolsas']).' Bolsas' ?></td>
  <td align="center"  id="nom3" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins4" class="row">
<td class="bold" align="center" >ALMAS Y TACOS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['almas']).' Almas' ?></td>
  <td align="center"  id="nom4">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins5" class="row">
  <td class="bold" align="center" >MARIPOSAS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['mariposas']).' Mariposas' ?></td>
  <td align="center"  id="nom5" >Insumo</td>
  <td align="center"  class="aca1" >Arrastre Acá</td>
  </tr>
<tr id="ins6" class="row">
  <td class="bold" align="center" >HORMACUELLOS PEQUEÑOS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['hormacuellos_p']).' Hormacuellos' ?></td>
  <td align="center"  id="nom6">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins7" class="row">
  <td class="bold" align="center" >HORMACUELLOS LARGOS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['hormacuellos_l']).' Hormacuellos' ?></td>
  <td align="center"  id="nom7">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins9" class="row">
  <td class="bold" align="center" >CINTAS COLECCIÓN</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['c_coleccion']).' Cintas ' ?></td>
  <td align="center"  id="nom9">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins10" class="row">
  <td class="bold" align="center" >CINTAS EXCLUSIVA</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['c_exclusiva']).' Cintas ' ?></td>
  <td align="center"  id="nom10" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins11" class="row">
 <td class="bold" align="center" >CINTAS ROYAL</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['c_royal']).' Cintas ' ?></td>
  <td align="center"  id="nom11">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins12" class="row">
  <td class="bold" align="center" >ETIQUETAS COLECCIÓN</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['e_coleccion']).' Etiquetas ' ?></td>
  <td align="center"  id="nom12">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins13" class="row">
  <td class="bold" align="center" >ETIQUETAS EXCLUSIVA</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['e_exclusiva']).' Etiquetas ' ?></td>
  <td align="center"  id="nom13">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins14" class="row">
  <td class="bold" align="center" >ETIQUETAS ROYAL</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['e_royal']).' Etiquetas ' ?></td>
  <td align="center"  id="nom14">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
  <tr id="ins15" class="row">
  <td class="bold" align="center" >PLUMILLAS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['plumillas']).' Plumillas ' ?></td>
  <td align="center"  id="nom15">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<tr id="ins2" class="row">
  <td class="bold" align="center" ><?php echo $boton ?></td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['botones']).' Botones' ?></td>
  <td align="center"  id="nom2">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá </td>
  </tr>
<?php
//tipo de boton del cuello
$rs_bot2=mysql_query("SELECT * FROM orden_corte2 WHERE orden='$orden' and hacienda='$filtro'");
$h=0;
$suma=0;
while($row_bot2=mysql_fetch_assoc($rs_bot2)){
	$suma=13+$h;
	$cuello_bot=$row_bot2['cuello_boton'];
	if($cuello_bot>0){
		$rs_nom_bot=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$cuello_bot'");
		$row_nom_bot=mysql_fetch_assoc($rs_nom_bot);
		$nom_bot=$row_nom_bot['nombre'].' '.$row_nom_bot['marca'].' '.$row_nom_bot['descripcion'];
		?>
        <tr id="<?php echo 'ins5'.$h; ?>" class="row">
  <td class="bold" align="center" ><?php echo $nom_bot.'(CUELLO)' ?></td>
  <td class="bold" align="center" ><?php echo number_format($row_bot2['cuello_boton_nec']).' Botones' ?></td>
  <td align="center"  id="<?php echo 'nom5'.$h ?>">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá </td>
  </tr>
        <?php
		$h++;
	}
}
?>
<tr id="ins8" class="row">
  <td class="bold" align="center" >MARQUILLAS DE COMPOSICIÓN</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['marquillas_c']).' Marquillas '.$row_ins['nombre'] ?></td>
  <td align="center"  id="nom8" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>
<?php
$rs_ref=mysql_query("SELECT * FROM orden_corte2 WHERE orden='$orden' and hacienda='$filtro'");
$j=0;
$l=0;
while($row_ref=mysql_fetch_assoc($rs_ref)){
	$ref=$row_ref['referencia'];
	$dis=$row_ref['diseno'];
	$tallas = array(
		't37' => array($row_ref["t37m"], 'TALLA 37'),
		't38' => array($row_ref["t38m"], 'TALLA 38'),
		't39' => array($row_ref["t39m"], 'TALLA 39'),
		't40' => array($row_ref["t40m"], 'TALLA 40'),
		't41' => array($row_ref["t41m"], 'TALLA 41'),
		't42' => array($row_ref["t42m"], 'TALLA 42'),
		't44' => array($row_ref["t44m"], 'TALLA 44'),
		't46' => array($row_ref["t46m"], 'TALLA 46'),
	);
	if($row_ref["t37"]==0) unset($tallas['t37']);
	if($row_ref["t38"]==0) unset($tallas['t38']);
	if($row_ref["t39"]==0) unset($tallas['t39']);
	if($row_ref["t40"]==0) unset($tallas['t40']);
	if($row_ref["t41"]==0) unset($tallas['t41']);
	if($row_ref["t42"]==0) unset($tallas['t42']);
	if($row_ref["t44"]==0) unset($tallas['t44']);
	if($row_ref["t46"]==0) unset($tallas['t46']);
	//print_r($tallas);
	
foreach ($tallas as $k) {
	?>
 <tr id="<?php echo 'ins9'.$j.$l; ?>" class="row">
  <td class="bold" align="center" > <?php echo 'MARQUILLAS '.$ref.' '.$k[1].' '.$dis ?></td>
  <td class="bold" align="center" ><?php echo number_format($k[0]).' Marquillas '.$row_ins['nombre'] ?></td>
  <td align="center"  id="<?php echo 'nom9'.$j.$l; ?>" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>   
    
    <?php
	$l++;
}
	$j++;
	unset($tallas);
}
	?>
<tr id="ins8000" class="row">
  <td colspan="2" align="center" class="bold" >OTROS</td>
  <td align="center"  id="nom8000" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  </tr>   
</tbody>
</table>

<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr >    
    <td align="right" style="width:50%" ><input type="submit" id="guarda" value="Ver Orden de Corte" class="ext" style="margin-right:15px" onclick="location.href='stin_corte2.php?filtro=<?php echo $filtro ?>&orden=<?php echo $orden ?>'" /></td>
    <td align="left" style="width:50%"><input type="submit" id="guarda" value="Descontar Insumos de Base de datos" class="ext" style="margin-right:15px" onclick="guardar(); return false" /></td>
  </tr>
</table>
</div>
<div id="desc_ins">
  <div id="mo_insumos" style="display:none">
  <table width="98%" border="1" cellspacing="0" cellpadding="0" id="busq">  
  <tr bgcolor="#CCC" >
    <td align="left"  class="tittle" style="border-top-left-radius:25px; border-top-right-radius:25px"><span style="float:left;margin-left:25px; font-size:14px"> Busqueda    
      </span>   
    <p class="s" style="float:left; margin-left:15px"> <input name="search" id="search" type="search"  autocomplete="off" ></p></td>
  </tr>
</table>
<div id="tabla" style="overflow:auto;"></div>
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
	window.band=false;
	window.arr=[];
	insumos_p();
	window.err=0;
}
function mostrar_err(){
	$("#dialog").html('No Hay Suficientes Insumos Para Hacer el Descuento, Revise Los Campos En Rojo y a Continuación Edite el Formulario').css('text-align','justify');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").append('<table><tr><td align="center"><input type="button" id="theImg2" value="Aceptar"  style="cursor:pointer;" class="ext" onclick="cerrar_dialogo2()"/></td></tr></table>');
	$("#dialog").dialog("open");
}
function guardar(){
	overlay.show()
	console.log(window.err)
	if(window.err==1){ 
		mostrar_err();
		return false;
	}
	$("#dialog").html('La Orden de Corte se Dará Como Finalizada y el Producto Final se Agregará al Inventario. Desea Continuar?').css('text-align','justify');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="img/good.png" width="53" height="41" style="cursor:pointer; margin-right:25px" onclick="guardar2()"/></td><td align="center"><img id="theImg2" src="img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:25px" onclick="cerrar_dialogo2()"/></td></tr></table>');
}
function guardar2(){
	$("span.ui-dialog-title").text('Guardando...').css("text-align", "center"); 
	$("#dialog").html('<img id="theImg2" src="img/loading.gif" width="90" height="90" style="cursor:pointer;margin-left:25px" onclick="cerrar_dialogo2()"/>').css("text-align","center");
	var filtro=$("#filtro").val()
	var orden=$("#orden").val()
	$.ajax({
        type: "POST",
        url: "stin_corte_php.php",
        data: "terminar_orden="+orden+"&filtro="+filtro,
        success: function(datos){
			console.log(datos)
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Registro Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");			
			setTimeout(function () {
			location.href='stin_corte7.php?orden='+orden+'&filtro='+filtro
			}, 2000);
      }
	  
	})
}
function cerrar_dialogo2(){
	overlay.hide()
	$("#dialog").dialog("close");
}
function organizar(datos){
	var nombre; var tr; var orig; var otros=0; var disp=0;
	for(j=0;j<datos['origs'].length;j++){
		orig=parseInt(datos['origs'][j]);
		tr='ins'+datos['origs'][j];
		id_inp='m'+datos['id_inp'][j];
		nombre=datos['tipo'][j];
		disp=datos['disp'][j];
		val=datos['vals'][j];
		if(val>disp){ 
			color='#F00';
			window.err=1;
		}
		else color='#FFF'
		if(orig <8000){
			$("#"+tr).find("td:nth-child(3)").html(nombre)
			$("#"+tr).find("td:nth-child(4)").html('<span class="desde1"><input type="text" name="maximo" id="'+id_inp+'" title="Máximo '+disp+'" onkeyup="verifica2(this); funcion_maximos(this, '+disp+')" style="height:17px; background-color:'+color+'" value="'+val+'" readonly="readonly" ></span>')
		}else if(orig==8000){
			$("#"+tr).find("td:nth-child(2)").html(nombre)
			$("#"+tr).find("td:nth-child(3)").html('<span class="desde1"><input type="text" name="maximo" id="'+id_inp+'" title="Máximo '+disp+'" onkeyup="verifica2(this); funcion_maximos(this, '+disp+')" style="height:17px; background-color:'+color+'" value="'+val+'" readonly="readonly" ></span>')
		}else{
			tr_in='<tr id="ins'+orig+'" class="row"><td colspan="2" align="center" class="bold" style="width:20%">OTROS</td><td align="center" style="width:20%" id="nom'+orig+'" >Insumo</td><td align="center" style="width:20%" class="aca1">Arrastre Acá</td><td align="center" style="width:20%"></td></tr>'
			$("#solicitados table:first tbody").append(tr_in)
			$("#"+tr).find("td:nth-child(2)").html(nombre)
			$("#"+tr).find("td:nth-child(3)").html('<span class="desde1"><input type="text" name="maximo" id="'+id_inp+'" title="Máximo '+disp+'" onkeyup="verifica2(this); funcion_maximos(this, '+disp+')" style="height:17px; background-color:'+color+'" value="'+val+'" readonly="readonly" ></span>');
		}
	}
}
function insumos_p(){
	var filtro=$("#filtro").val()
	var orden=$("#orden").val()
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "stin_corte_php.php",
		data: {recoger_ins: filtro, orden: orden},
		success: function(datos){
			organizar(datos)
		},
		
	})
}


function cerrar_dialogo2(){
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
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false,  
	  close: function() { overlay.hide() },  	     
    });
})

</script>