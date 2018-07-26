<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}else{
	
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

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$c_date = date('Y-m-d');

$ptov_url=$_GET['p'];
$consec_url=$_GET['c'];

$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Devolución</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/dev_ini.js" type="text/javascript"></script>
<style>
.sub{
	font-size:12px;
	font-weight:bold}
</style>
</head>


<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<div id="dialog2">
    <div class="demo-wrapper html5-progress-bar" align="center">
        <div class="progress-bar-wrapper">
            <progress id="progressbar" value="0" max="100" style="width:98%"></progress>
            <span class="progress-value" id="progreso">0%</span>
        </div>
    </div>
	<input type="button" id="aceptar" style="width:150px; display:none" value="Aceptar" class="ext" />
</div>
<div id="dialog"></div>

<form id="form1" name="form1">

<table width="90%" align="center" id="tb_header">
  <tr>
    <td rowspan="3" width="34%"><img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
    <td rowspan="2" align="center" width="33%">
    <div id="d_empresa">
    <label class="sub">
	<?php
    mysql_select_db($database_conexion, $conexion);
	$query_hd = "SELECT * FROM d89xz_hacienda WHERE `hacienda`='$ptov_url'";
	$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
	$row_hd = mysql_fetch_assoc($hd);
	echo $row_hd['empresa'].' <br>'.$row_hd['dir'].' <br> Telefono:'.$row_hd['telefono'];
	?>
    </label>
    </div>
    </td>
    <td align="center" width="33%"><label class="sub">Devolución</label></td>
  </tr>
  <tr>
    <td align="center">
    No: <input type="text" name="tf_consec" id="tf_consec" class="red" style="width:60%">
    <img src="../../img/search.png" alt="Busqueda" name="bt_sfact" 
    width="20" height="20" id="bt_sfact" style="cursor:pointer" title="Busqueda de Factura" onClick="searchFact()" />    
    </td>
  </tr>
  <tr>
  	
    <td align="center">
    <div id="d_nit">
    <label class="sub">
    NIT: <?php echo $row_hd['nit']; ?>
    </label>
    </div>
    </td>
    <td align="center" class="r">
    <div id="d_fecha">
    <?php
	mysql_select_db($database_conexion, $conexion);
	$fact1 = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_fact1 = mysql_fetch_assoc($fact1);	
	?>
    Fecha: <label id="lb_fecha"><?php echo $row_fact1['fecha']?></label>
    </div>
    </td>
  </tr>
</table>
<div id="d_tables">
<?php
mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	
?>
<table width="90%" align="center">
  <tr class="tittle">
    <td colspan="4"><label style="font-size:18px">Información de Venta</label></td>
  </tr>
  <tr>
  	<td class="bold" width="20%">Punto de Venta</td>
  	<td class="cont" width="30%"><label id="sl_ptov"><?php echo $ptov_url?></label></td>
    <td class="bold" width="20%">Tipo</td>
    <td class="cont" width="30%">
    <label id="sl_fpago"><?php echo $row_fact['tipo']?></label>
    </td>
    
  </tr>
  <tr>
  	<td class="bold">NIT</td>
    <td class="cont">
    <input name="tf_nit" id="tf_nit" type="text" style="width:80%" value="<?php echo $nit = $row_fact['ced']?>">
    <img src="../../img/search.png" alt="Busqueda" name="bt_client" 
    width="20" height="20" id="bt_client" style="cursor:pointer" title="Busqueda" onClick="searchClient()" />
    </td>
    <?php 
	$exist = '';
	if ($nit){
		$exist='';	
	}else{
		$exist='NO';	
	}
	?>
    <td class="bold">Cliente</td>
    <td class="cont">
    <input name="tf_nombre" id="tf_nombre" type="text" class="long" value="<?php echo $row_fact['cliente']?>">
    </td>
  <tr>
  	<td class="bold" >Dirección</td>
    <?php
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir)
    ?>
    <td class="cont">
    <input name="tf_dir" id="tf_dir" type="text" class="long" value="<?php echo $row_dir['dir']?>">
    </td>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="tf_tel" id="tf_tel" type="text" class="long" value="<?php echo $row_fact['telefono']?>"></td>
  </tr>
  <tr>
  	<td class="bold">Forma de Pago</td>
    <td class="cont"><label id="tf_fpago"><?php echo $row_fact['forma_pago']?></label></td>
    <td class="bold">Fecha Pago</td>
    <td class="cont"><label id="tf_fechap"><?php echo $row_fact['fecha_p']?></label></td>
  </tr>

</table>

<table width="90%" align="center" id="tb_prod">
  <tr align="center" class="tittle">
    <td colspan="6">Detalle de Venta</td>
  </tr>
  <tr align="center" class="tittle">
    <td width="20%">Referencia</td>
    <td width="30%">Descripción</td>
    <td width="13%">Cantidad</td>
    <td width="12%">Precio</td>
    <td width="13%">Descuento</td>
    <td width="12%">Valor</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr id="fila_<?php echo $i?>">
    <td class="cont">
    <label id="tf_ref<?php echo $i?>" class="ref"><?php echo $ref = $row_prod['ref']?></label>
	</td>
    <td class="cont">
	<?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det)
    ?>
    <label><?php echo $row_det['desc']?></label>
    </td>
    <td class="cont">
    <?php 
	mysql_select_db($database_conexion, $conexion);
	$dev = mysql_query("SELECT * FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_dev = mysql_fetch_assoc($dev);
	
	$cantd = $row_dev['cant_dev'];
	if ($cantd){
	?>
    <input type="text" id="cant<?php echo $i?>" class="long cant" placeholder="Max (<?php echo $row_prod['cant'] ?>)"
    onKeyUp="checkNum(this), total(), compare(<?php echo $i?>)" onChange="total()" value="<?php echo $cantd?>">
    <input type="hidden" id="cantd<?php echo $i?>" value="<?php echo $cantd ?>">
    <?php	
	}else{
	?>
    <input type="text" id="cant<?php echo $i?>" class="long cant" placeholder="Max (<?php echo $row_prod['cant'] ?>)"
    onKeyUp="checkNum(this), total(), compare(<?php echo $i?>)" onChange="total()">
    <input type="hidden" id="cantd<?php echo $i?>" value="<?php echo 0 ?>">
    <?php 
	}
	?>
    
    <input type="hidden" id="cantc<?php echo $i?>" value="<?php echo $row_prod['cant'] ?>">
    </td>
    <td class="cont">
    <label id="lb_val<?php echo $i?>"><?php echo $row_prod['valor']?></label>
    </td>
    <td class="cont">
    <label id="lb_dscto<?php echo $i?>"><?php echo $row_prod['dscto']?></label>
    </td>
    <td class="cont">
    <label id="lb_totprod<?php echo $i?>" ><?php echo $row_prod['total']?></label>
    </td> 
    <?php 
	$i++;
  }
	?>  
  </tr>
</table>
<table width="90%" align="center" id="tb_cost">
  <tr>
    <td colspan="6" align="right"><label style="font-size:10px">*En el campo cantidad se debe poner la cantidad que se devuelve de un producto</label></td>
  </tr>
  <tr align="center">
    <td width="12%" class="bold">Descuentos</td>
    <td width="15%" class="cont"><label class="red"><?php echo $row_fact['dscto']?></label></td>
    <td width="12%" class="bold">SUBTOTAL</td>
    <td width="14%" class="cont"><label id="lb_sub" class="red"></label></td>
    <td width="12%" class="bold">NUEVO TOTAL</td>
    <td width="15%" class="cont"><label id="lb_ntot" class="red"></label></td>
  </tr>
  <tr align="center">
    <td class="bold">Items</td>
    <td class="cont"><label id="lb_itemst" class="red"><?php echo $row_fact['total_items']?></label></td>
    <td class="bold">IVA</td>
    <td class="cont"><label id="lb_iva" class="red"></label></td>
    <td class="bold">SALDO A FAVOR</td>
    <td class="cont"><label id="lb_sfavor" class="red"></label>
    <input type="hidden" id="tf_sfavor">
    </td>
  </tr>
  <tr  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">TOTAL</td>
    <td class="cont"><label id="lb_total" class="red"><?php echo $row_fact['tot_final']?></label></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">%</td>
    <td class="cont"><label id="lb_dctpf" class="red"><?php echo $row_fact['dctof']?></label></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
</table>
<table width="90%" align="center" id="tb_footer">
  <tr>
    <td align="center">
    <div id="d_reso">
    <label class="sub">
    <?php echo 'Resolución DIAN No '.$row_hd['resol'].' de '.$row_hd['f_vigi'].', del número '.$row_hd['desde'].' hasta '.$row_hd['hasta'].'<br>' ?>
    <?php echo 'Nota: '.$row_hd['empresa'].' Acepta únicamente el cambio o devolución de los productos en un plazo máximo de 30 días despues de la compra, es indispensable la presentación de la factura de compra.' ?>
    </label>
    </div>
    </td>
  </tr>
  <tr>
    <td align="center" >
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close();">
    </td>
  </tr>
</table>
</div>
</form>
<input type="hidden" id="tf_cexist" value="" >
</body>

</html>
<?php
}
?>