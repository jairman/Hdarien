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
<th colspan="5"  style="font-size:13px">ORDEN DE CORTE No. <?php echo $orden ?></th>
</tr>
<tr style="font-size:13px">
  <th class="bold2" >Insumo</th>
  <th class="bold2">Calculado</th>
  <th class="bold">Insumo</th
  >
  <th class="bold">Necesitado</th>
  <th class="bold">Acción</th>
</tr>
</thead>
<tbody>

<tr id="ins1" class="row">
  <td class="bold" align="center" style="width:23%;" ><?php echo $insumo ?></td>
  <td class="bold" align="center" style="width:23%"><?php echo number_format($row_ord['metros']).' Metros' ?></td>
  <td align="center" style="width:23%" id="nom1">Insumo</td>
  <td align="center" style="width:23%" class="aca1">Arrastre Acá</td>
  <td align="center" style="width:8%"><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom1')"/></td>
</tr>
<tr id="ins3" class="row">
  <td class="bold" align="center" >BOLSAS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['bolsas']).' Bolsas' ?></td>
  <td align="center"  id="nom3" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom3')"/></td>
</tr>
<tr id="ins4" class="row">
<td class="bold" align="center" >ALMAS Y TACOS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['almas']).' Almas' ?></td>
  <td align="center"  id="nom4">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom4')"/></td>
</tr>
<tr id="ins5" class="row">
  <td class="bold" align="center" >MARIPOSAS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['mariposas']).' Mariposas' ?></td>
  <td align="center"  id="nom5" >Insumo</td>
  <td align="center"  class="aca1" >Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom5')"/></td>
</tr>
<tr id="ins6" class="row">
  <td class="bold" align="center" >HORMACUELLOS PEQUEÑOS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['hormacuellos_p']).' Hormacuellos' ?></td>
  <td align="center"  id="nom6">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom6')"/></td>
</tr>
<tr id="ins7" class="row">
  <td class="bold" align="center" >HORMACUELLOS LARGOS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['hormacuellos_l']).' Hormacuellos' ?></td>
  <td align="center"  id="nom7">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom7')"/></td>
</tr>
<tr id="ins9" class="row">
  <td class="bold" align="center" >CINTAS COLECCIÓN</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['c_coleccion']).' Cintas ' ?></td>
  <td align="center"  id="nom9">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom9')"/></td>
</tr>
<tr id="ins10" class="row">
  <td class="bold" align="center" >CINTAS EXCLUSIVA</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['c_exclusiva']).' Cintas ' ?></td>
  <td align="center"  id="nom10" >Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom10')"/></td>
</tr>
<tr id="ins11" class="row">
 <td class="bold" align="center" >CINTAS ROYAL</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['c_royal']).' Cintas ' ?></td>
  <td align="center"  id="nom11">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom11')"/></td>
</tr>
<tr id="ins12" class="row">
  <td class="bold" align="center" >ETIQUETAS COLECCIÓN</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['e_coleccion']).' Etiquetas ' ?></td>
  <td align="center"  id="nom12">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom12')"/></td>
</tr>
<tr id="ins13" class="row">
  <td class="bold" align="center" >ETIQUETAS EXCLUSIVA</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['e_exclusiva']).' Etiquetas ' ?></td>
  <td align="center"  id="nom13">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom13')"/></td>
</tr>
<tr id="ins14" class="row">
  <td class="bold" align="center" >ETIQUETAS ROYAL</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['e_royal']).' Etiquetas ' ?></td>
  <td align="center"  id="nom14">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom14')"/></td>
</tr>
<tr id="ins15" class="row">
  <td class="bold" align="center" >PLUMILLAS</td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['plumillas']).' Plumillas ' ?></td>
  <td align="center"  id="nom15">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá</td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom15')"/></td>
</tr>
<tr id="ins2" class="row">
  <td class="bold" align="center" ><?php echo $boton ?></td>
  <td class="bold" align="center" ><?php echo number_format($row_ord['botones']).' Botones' ?></td>
  <td align="center"  id="nom2">Insumo</td>
  <td align="center"  class="aca1">Arrastre Acá </td>
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom2')"/></td>
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
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('<?php echo 'nom5'.$h ?>')"/></td>
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
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom8')"/></td>
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
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('<?php echo 'nom9'.$j.$l; ?>')"/></td>
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
  <td align="center" ><img src="../img/erase.png" width="15" height="15"  alt="" style="cursor:pointer" onclick="borrar_esto('nom8000')"/></td>
</tr>   
</tbody>
</table>

<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr >    
    <td align="right" style="width:50%" ><input type="submit" id="guarda" value="Guardar" class="ext" style="margin-right:15px" onclick="guardar(); return false" /></td>
    <td align="left" style="width:50%"><input type="button" name="button" id="cancela" value="Cancelar" class="ext"style="margin-left:15px" onclick="cancelar_ord()" /></td>
  </tr>
</table>
</div>
<div id="desc_ins">
<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr >    
    <td style="width:20%" >&nbsp;</td>
    <td  style="width:20%" >&nbsp;</td>
    <td class="tittle radio" style="width:20%; font-size:13px; cursor:pointer" onclick="togleo()" >Insumos<img src="img/arrow-up (1).png" width="20" height="20" style="float:right; margin-right:10px" id="arriba" />
    <img src="img/arrow-down.png" width="20" height="20" style="float:right; margin-right:10px; display:none" id="abajo"/> </td>
    <td style="width:20%"  >&nbsp;</td>
    <td style="width:20%" >&nbsp;</td>
  </tr>
</table>
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
	$("#solicitados").height($(window).height()*0.53)
	window.arr=[];
	insumos_p()
}
function cancelar_ord(){
	overlay.show()
	$("#dialog").html('Cancelar?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="img/good.png" width="53" height="41" style="cursor:pointer; margin-right:20px" onclick="cancelar_ord2()"/></td><td align="center"><img id="theImg2" src="img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:20px" onclick="cerrar_dialogo2()"/></td></tr></table>');
}
function cancelar_ord2(){
	var orden=$("#orden").val()
	var filtro=$("#filtro").val()
	location.href='stin_corte6.php?orden='+orden+'&filtro='+filtro;
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
		if(val>disp) val=disp
		if(orig <8000){
			$("#"+tr).find("td:nth-child(3)").html(nombre)
			$("#"+tr).find("td:nth-child(4)").html('<span class="desde1"><input type="text" name="maximo" id="'+id_inp+'" title="Máximo '+disp+'" onkeyup="verifica2(this); funcion_maximos(this, '+disp+')" style="height:17px" value="'+val+'" ></span>')
		}else if(orig==8000){
			$("#"+tr).find("td:nth-child(2)").html(nombre)
			$("#"+tr).find("td:nth-child(3)").html('<span class="desde1"><input type="text" name="maximo" id="'+id_inp+'" title="Máximo '+disp+'" onkeyup="verifica2(this); funcion_maximos(this, '+disp+')" style="height:17px" value="'+val+'" ></span>')
		}else{
			tr_in='<tr id="ins'+orig+'" class="row"><td colspan="2" align="center" class="bold" style="width:20%">OTROS</td><td align="center" style="width:20%" id="nom'+orig+'" >Insumo</td><td align="center" style="width:20%" class="aca1">Arrastre Acá</td><td align="center" style="width:20%"><img src="img/erase.png" width="15" height="15" alt="" style="cursor:pointer" onclick="borrar_otro(this)" /></td></tr>'
			$("#solicitados table:first tbody").append(tr_in)
			$("#"+tr).find("td:nth-child(2)").html(nombre)
			$("#"+tr).find("td:nth-child(3)").html('<span class="desde1"><input type="text" name="maximo" id="'+id_inp+'" title="Máximo '+disp+'" onkeyup="verifica2(this); funcion_maximos(this, '+disp+')" style="height:17px" value="'+val+'" ></span>');
		}
	}
	otro_mas('nom'+$("#solicitados table:first").find("tr:last").attr("id").split("ins")[1]);
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
function guardar(){
	var band=0;
	if(revisa()>0){
		$("#solicitados table tr").find("input[name='maximo']").each(function(index, element) {
			if($(this).val()==""){
				$(this).effect("pulsate", { times:5 }, 3000);
				$(this).focus()
				band=1;
				return false
			}
		});
		if(band==1) return false
		//$("#desc_ins, #guarda, #cancela").remove()
		//$("#solicitados").height($(window).height())
		guardar2();		
	}
}
function revisa(){
	var j=0;
	$("#solicitados table tr").find("input[name='maximo']").each(function(index, element) {
		j++;
	})
	return j;
}
function guardar2(){
	var data=[];
	var orden=$("#orden").val()
	var filtro=$("#filtro").val()
	data['id']=[];
	data['valor']=[];
	data['orig']=[];
	$("#solicitados table tr").find("input[name='maximo']").each(function(index, element) {
		var id_itm=$(this).attr("id").split("m")[1];
		var valor_itm=$(this).val();
		var orig_itm=$(this).parent().parent().parent().attr("id").split("ins")[1];
		data['id'].push(id_itm);
		data['valor'].push(valor_itm);
		data['orig'].push(orig_itm);
	})
	$.ajax({
		type: "POST",
		url: "stin_corte_php.php",
		data: {guarda_insumos: data["id"], guarda_insumos2: data["valor"], guarda_insumos3: data['orig'], filtro: filtro, orden: orden},
		success: function(datos){ 
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Registro Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");
			setTimeout(function () {
			   $("#dialog").dialog("close");
			   location.href='stin_corte6.php?orden='+orden+'&filtro='+filtro;
			}, 2000);
		},		
	})
}
function hacer_drags(){
	$("#tabla .childgrid span.desde1").draggable({
      helper: function(){
        var selected = $('.childgrid span desde1.selectedRow');
        if (selected.length === 0) {
          selected = $(this).addClass('selectedRow');
        }
        var container = $('<div/>').attr('id', 'draggingContainer');
    container.append(selected.clone().removeClass("selectedRow"));
    return container;
      }
 });

$("#solicitados .tirar td.aca1").droppable({
    drop: function (event, ui) {
		var ele=ui.helper.children();
		$(ele).find("img").remove()
		itm=ui.draggable.parent().attr("id")
		$(this).html(ui.helper.children());
		$('.selectedRow').removeClass("selectedRow").remove();
		recoger_datos(itm)
    }
});
$("#solicitados .tirar tr").droppable({
	hoverClass: "black",
})
$(document).on("click", ".childgrid tr", function () {
    $(this).toggleClass("selectedRow");
});
}
function recoger_datos(itm){
	var td_id="nom"+($("#m"+itm).parent().parent().parent().attr("id").split("ins")[1])
	var filtro = encodeURIComponent($("#filtro").val());
	$.ajax({
			type: "GET",
			url: "stin_corte_php.php",
			data: "recoger="+itm+"&filtro="+filtro,
			success: function(datos){ 						
				$("#"+td_id).html(datos)
				otro_mas(td_id);
				//window.arr.splice($.inArray("t"+itm, arr),1);			
			}, 
		})
}
function borrar_otro(itm){
	$(itm).parent().parent().find("td:nth-child(2)").html("Insumo")
	$(itm).parent().parent().find("td:nth-child(3)").html("Arrastre Acá")
}
function otro_mas(td_id){
	console.log(td_id)
	if($("#"+td_id).parent().is(":last-child")){
		var num=parseInt(td_id.split("nom")[1]);
		num++;
		
		var tr='<tr id="ins'+num+'" class="row"><td colspan="2" align="center" class="bold" style="width:20%">OTROS</td><td align="center" style="width:20%" id="nom'+num+'" >Insumo</td><td align="center" style="width:20%" class="aca1">Arrastre Acá</td><td align="center" style="width:20%"><img src="img/erase.png" width="15" height="15" alt="" style="cursor:pointer" onclick="borrar_otro(this)" /></td></tr>'
		//$("#solicitados table tbody").find("tr:last-child").after(tr);
		$("#solicitados table:first tbody").append(tr)
		//$("#solicitados table tbody").find("tr:last-child").find("img").attr("onclick","borrar_esto("+borrar+")")
		hacer_drags();
	}
}
function borrar_esto(imt){
	$("#"+imt).html("Insumo")
	$("#"+imt).closest("td").next().html("Arrastre Acá");
	search_ins($("#search").val());
}
function borrar_rep(){
	f=0	;
	$("#solicitados table tr").find("input").each(function(index, element) {
		var itm=$(this).attr("id");
		itm=itm.split("m")[1];
		$("#"+itm).html("")
    });
}
$('#search').keyup(function(e) {
	if(e.keyCode==13){
		search_ins(this.value)
	}
});
function orden_bus(tipo){
	console.log(tipo)
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	valor=$('#search').val()
	search_ins(valor, tipo, ord)
}
function search_ins(value, tipo, ord){
	$('html,body').css('cursor','wait');
	var valor=encodeURIComponent(value);
	var filtro = encodeURIComponent($("#filtro").val());
	var altura=$(window).height()*0.25;
	if(tipo) datos="busqueda="+valor+"&filtro="+filtro+'&tipo='+tipo+'&ord='+ord
	else datos="busqueda="+valor+"&filtro="+filtro;
	$.ajax({
		type: "GET",
		url: "stin_corte_php.php",
		data: datos,
		success: function(datos){ 						
			$("#tabla").html(datos);
			if($("#tabla").height()>altura)
				$("#tabla").height(altura);
			$('html,body').css('cursor','default')	
			borrar_rep();
			hacer_drags();							
		}, 
	})
}
function verifica2(itm){
	var valor=itm.value;
	var itm_id=itm.id;
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)||valor.match(/\,/g)){
		var valor=valor.substring(0,valor.length-1);
		$(itm).val(valor);		
	}
}
function funcion_maximos(itm, maxi){
	var valor=$(itm).val()
	if(valor>maxi) $(itm).val(maxi)
}
function insumos(){
	if(window.band==false){ 
		$("#mo_insumos").slideUp("slow")
	}
	else{ 
		$("#mo_insumos").slideDown("slow")
		$("#search").focus()
	}
}
function togleo(){
	$("#arriba, #abajo").toggle("slow")
	window.band=!window.band;	
	insumos()
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