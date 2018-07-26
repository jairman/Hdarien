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
<div id="antes">
<input type="hidden" id="filtro" value="<?php echo $filtro ?>" /> 
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr >
    <td colspan="6" align="left" bgcolor="#FFFFFF" style="color:#FFF; border-right:none"><input type="image" src="../img/recycler.png" width="40" height="40" border="0" style="float:right; margin-right:15px; cursor:pointer; margin-top:30px" onclick="elimina(<?php echo $orden ?>)" title="Eliminar Orden de Corte" />
      
      <input type="image" src="../img/historial1.png" title="Historial"  width="40" height="40" border="0" style="float:right; cursor:pointer; margin-right:15px; margin-top:30px" onclick="location.href='stin_corte3.php'" />
      
      <input type="image" src="img/imprimir.png"  width="40" height="40" border="0" style="float:right; margin-right:15px; display:none; margin-top:30px" id="printer" onclick="rev_costos()" /></td>
  </tr>  
</table>
<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">

  <tr class="tittle">
    <td colspan="5" style="font-size:18px" align="center"  >ORDEN DE CORTE No. <?php echo $orden ?>
    
      
      </td>
  </tr>
  </table>
 <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">

  <?php
  $rs_ord=mysql_query("SELECT * FROM orden_corte WHERE orden_no='$orden' and hacienda='$filtro'");
  $row_ord=mysql_fetch_assoc($rs_ord);
  ?>
  <tr class="bold " align="center">
    <td  ><span style="margin-left:15px">Fecha: <?php echo $row_ord['fecha'] ?></span></td>
    <td >Ubicación: <?php echo $row_ord['hacienda'] ?></td>
  </tr>
  <tr class="bold cont" align="center">
    <td ><span style="margin-left:15px">Cantidad de Telas: <?php echo $row_ord['cant_telas'] ?></span></td>
    <td>Tipo: <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_ord[tipo_insumo]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	echo $row_ins['tipo_t'].' '.$row_ins['nombre'].' '.$row_ins['ancho'].' de Ancho '.$row_ins['descripcion']  ?></td>
    </tr>
  <tr class="bold cont" align="center">
    <td><span style="margin-left:15px">Largo: <?php echo $row_ord['largo'] ?></span></td>
   
    <td>Botón: <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_ord[tipo_boton]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
     <?php echo $row_ins['nombre'].' '.$row_ins['marca'].' '.$row_ins['descripcion'] ?></td>
    </tr>
    <?php
$rs_desc=mysql_query("SELECT * FROM orden_corte2 WHERE orden='$orden' and hacienda='$filtro'");
$desc_num_rows=mysql_num_rows($rs_desc);
while($row_desc=mysql_fetch_assoc($rs_desc)){
?>
</table> 
  <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" name='des_diseno'>
<tr class="tittle">
  <td colspan="30" align="center" >DESCRIPCION DEL DISEÑO
   </td>
</tr>
<tr class="bold">
  <td><strong style="margin-left:15px">Tallas</strong></td>
  <td colspan="2">37: <?php echo $row_desc['t37'] ?></td>
  <td colspan="2">38: <?php echo $row_desc['t38'] ?></td>
  <td colspan="2">39: <?php echo $row_desc['t39'] ?></td>
  <td colspan="2">40: <?php echo $row_desc['t40'] ?></td>
  <td colspan="2">41: <?php echo $row_desc['t41'] ?></td>
  <td colspan="2">42: <?php echo $row_desc['t42'] ?></td>
  <td colspan="2">44: <?php echo $row_desc['t44'] ?></td>
  <td colspan="2">46: <?php echo $row_desc['t46'] ?></td>
</tr>
</table>
 <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" name='des_diseno'>
<tr class="bold">
  <td style="width:33%" ><span style="margin-left:15px">Referencia: <?php echo $row_desc['referencia'] ?></span></td>
  <td style="width:33%">Diseño: <?php echo $row_desc['diseno'] ?></td>
  <td style="width:33%">Entretela: <?php
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_desc[entretela]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	echo $row_ins['descripcion'] ?></td>
</tr>
<tr class="bold">
  <td><span style="margin-left:15px">Manga: <?php
  if($row_desc['charretera']=='on') $charretera='Con Charretera'; else $charretera='Sin Charretera';
  echo $row_desc['manga'].' '.$charretera
  ?></span></td>
  <td colspan="2">Cuello:  <?php
  if($row_desc['cuello_c_b']=='on' && $row_desc['cuello_boton']!='0') $cuello_c_b='Con Botón'; else $cuello_c_b='Sin Botón';
  echo $row_desc['cuello'].' '.$cuello_c_b
  ?>
  <?php
  if($cuello_c_b=='Con Botón') {
	$rs_ins=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$row_desc[cuello_boton]'");
	$row_ins=mysql_fetch_assoc($rs_ins);
	?>
   <?php echo $row_ins['nombre'].' '.$row_ins['marca'].' '.$row_ins['descripcion'] ?>
  <?php
  }
  ?> 
    </td>
  </tr>
<tr class="bold">
  <td><span style="margin-left:15px">Cartera:  <?php echo $row_desc['cartera']?></span></td>
   <?php
  if($row_desc['bolsillo_c_b']=='on' ) $bolsillo_c_b='Con Botón'; else $bolsillo_c_b='Sin Botón'
  ?>
  <td colspan="2">Bolsillo: <?php echo $row_desc['bolsillo'].' '. $bolsillo_c_b?></td>
</tr>
<tr class="bold">
  <td><span style="margin-left:15px">Banda: <?php echo $row_desc['banda']?></span></td>
  <td>Espalda: <?php echo $row_desc['espalda']?></td>
  <td>Puño: <?php echo $row_desc['puno']?><select style="width:50px"><option value="uno">1</option>
  <option value="dos">2</option>
  <option value="tres">3</option></select></td>
  </tr>
</table>
<?php
}
?>
 <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center"> 
  <tr class="bold cont"><td colspan="3" ><span style="margin-left:15px">OBSERVACIONES: <?php echo $row_ord['comentario'] ?></span></td></tr>
</table> 
</div>
<div id="solicitados">
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

<tr style="font-size:13px">
  <th colspan="5" class="tittle" align="center" >INSUMOS ORDEN DE CORTE <?php echo $orden ?></th>
  </tr>
<tr style="font-size:13px">
  <th class="bold2" >Insumo</th>
  <th class="bold2">Requerido</th>
  <th class="bold">Insumo</th
  >
  <th class="bold">Solicitado</th>
  <th name="costo" class="bold">Costo</th>
  </tr>
</thead>
<tbody>

<tr id="ins1" class="row" >
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo $insumo ?></td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['metros']).' Metros' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom1">Insumo</td>
  <td align="center" style="white-space:nowrap" class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
  </tr>
<tr id="ins3" class="row" >
  <td class="bold" align="center" style="white-space:nowrap" >BOLSAS</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['bolsas']).' Bolsas' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom3" >Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins4" class="row" >
<td class="bold" align="center" style="white-space:nowrap" >ALMAS Y TACOS</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['almas']).' Almas' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom4">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins5" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >MARIPOSAS</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['mariposas']).' Mariposas' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom5" >Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1" >Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo" >&nbsp;</td>
  </tr>
<tr id="ins6" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >HORMACUELLOS PEQUEÑOS</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['hormacuellos_p']).' Hormacuellos' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom6">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins7" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >HORMACUELLOS LARGOS</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['hormacuellos_l']).' Hormacuellos' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom7">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins9" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >CINTAS COLECCIÓN</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['c_coleccion']).' Cintas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom9">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins10" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >CINTAS EXCLUSIVA</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['c_exclusiva']).' Cintas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom10" >Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins11" class="row">
 <td class="bold" align="center" style="white-space:nowrap" >CINTAS ROYAL</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['c_royal']).' Cintas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom11">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
  </tr>
<tr id="ins12" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >ETIQUETAS COLECCIÓN</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['e_coleccion']).' Etiquetas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom12">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins13" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >ETIQUETAS EXCLUSIVA</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['e_exclusiva']).' Etiquetas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom13">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins14" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >ETIQUETAS ROYAL</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['e_royal']).' Etiquetas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom14">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
  <tr id="ins15" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >PLUMILLAS</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['plumillas']).' Plumillas ' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom15">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  </tr>
<tr id="ins2" class="row">
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo $boton ?></td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['botones']).' Botones' ?></td>
  <td align="center" style="white-space:nowrap"  id="nom2">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá </td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
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
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo $nom_bot.'(CUELLO)' ?></td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_bot2['cuello_boton_nec']).' Botones' ?></td>
  <td align="center" style="white-space:nowrap"  id="<?php echo 'nom5'.$h ?>">Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá </td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
        </tr>
        <?php
		$h++;
	}
}
?>
<tr id="ins8" class="row">
  <td class="bold" align="center" style="white-space:nowrap" >MARQUILLAS DE COMPOSICIÓN</td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($row_ord['marquillas_c']).' Marquillas '.$row_ins['nombre'] ?></td>
  <td align="center" style="white-space:nowrap"  id="nom8" >Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
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
  <td class="bold" align="center" style="white-space:nowrap" > <?php echo 'MARQUILLAS '.$ref.' '.$k[1].' '.$dis ?></td>
  <td class="bold" align="center" style="white-space:nowrap" ><?php echo number_format($k[0]).' Marquillas '.$row_ins['nombre'] ?></td>
  <td align="center" style="white-space:nowrap"  id="<?php echo 'nom9'.$j.$l; ?>" >Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
  </tr>   
    
    <?php
	$l++;
}
	$j++;
	unset($tallas);
}
	?>
<tr id="ins8000" class="row">
  <td colspan="2" align="center" style="white-space:nowrap" class="bold" >OTROS</td>
  <td align="center" style="white-space:nowrap"  id="nom8000" >Insumo</td>
  <td align="center" style="white-space:nowrap"  class="aca1">Arrastre Acá</td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
  </tr>   
</tbody>
<tfoot>

<tr  class="row">
  <td colspan="2" align="center" style="white-space:nowrap" class="bold" name="costo" >TOTAL</td>
  <td align="center" style="white-space:nowrap" name="costo" >&nbsp;</td>
  <td align="center" style="white-space:nowrap"  name="costo">&nbsp;</td>
  <td align="center" style="white-space:nowrap" name="costo">&nbsp;</td>
  </tr>  
  </tfoot> 
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
	window.band=false;
	window.arr=[];
	insumos_p()
}
function organizar(datos){
	var nombre; var tr; var orig; var otros=0; var disp=0;
	suma=datos['suma'];
	for(j=0;j<datos['origs'].length;j++){
		orig=parseInt(datos['origs'][j]);
		tr='ins'+datos['origs'][j];
		id_inp='m'+datos['id_inp'][j];
		nombre=datos['tipo'][j];
		disp=datos['disp'][j];
		val=datos['vals'][j];
		costo=datos['costo'][j];		
		if(orig <8000){
			$("#"+tr).find("td:nth-child(3)").html(nombre)
			$("#"+tr).find("td:nth-child(4)").html(val)
			$("#"+tr).find("td:nth-child(5)").html(costo)
		}else if(orig==8000){
			$("#"+tr).find("td:nth-child(2)").html(nombre)
			$("#"+tr).find("td:nth-child(3)").html(val)
			$("#"+tr).find("td:nth-child(4)").html(costo)
		}else{
			tr_in='<tr id="ins'+orig+'" class="row"><td colspan="2" align="center" class="bold" style="width:20%">OTROS</td><td align="center" style="width:20%" id="nom'+orig+'" >Insumo</td><td align="center" style="width:20%" class="aca1">Arrastre Acá</td><td align="center" style="white-space:nowrap" name="costo">&nbsp;</td></tr>'
			$("#solicitados table:first tbody").append(tr_in)
			$("#"+tr).find("td:nth-child(2)").html(nombre)
			$("#"+tr).find("td:nth-child(3)").html(val);
			$("#"+tr).find("td:nth-child(4)").html(costo)
		}
	}
	$("#solicitados table:first tfoot tr:first").find("td:nth-child(4)").html(suma)
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
			$("#printer").show("slow")
		},
		
	})
}


function cerrar_dialogo2(){
	overlay.hide()
	$("#dialog").dialog("close");
}
function rev_costos(){
	overlay.show()
	$("#dialog").html('Desea Imprimir La Orden de Corte con Costos?').css('text-align','justify');
	$("span.ui-dialog-title").text('Información Necesaria').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><input type="button" id="theImg2" value="Si"  style="cursor:pointer; margin-right:25px" class="ext" onclick="con_costos()"/><input type="button" id="theImg2a" value="No"  style="cursor:pointer; margin-left:25px" class="ext" onclick="sin_costosm();"/></td></tr></table>');
}
function sin_costosm(){
	overlay.hide()
	$('[name="costo"]').each(function(index, element) {
		$(this).addClass("sin_costos");
	})
	imprimir_esto()
	$("#dialog").dialog("close");
}
function con_costos(){
	overlay.hide()
	$('[name="costo"]').each(function(index, element) {
		$(this).removeClass("sin_costos");
	})
	imprimir_esto()
	$("#dialog").dialog("close");
}
function imprimir_esto(){
	$("#todo").printThis({
		 td:true,
	     debug: false,          
	     importCSS: false,           
         printContainer: true,
		 loadCSS: "css/imprimir.css",       			        				
         pageTitle: "",             
         removeInline: false,  
		 removebuttons: true,   
		 
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