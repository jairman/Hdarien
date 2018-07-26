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
<input type="hidden" id="tf_cexist" >

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
    <div id="d_nit"></div>
    </td>
    <td align="center" class="r">
    <div id="d_fecha">
    <?php
	//echo $consec_url.'-';
	mysql_select_db($database_conexion, $conexion);
	$fact = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_fact = mysql_fetch_assoc($fact);	
	?>
    Fecha: <label id="lb_fecha"><?php echo $c_date?></label>
    <input type="hidden" id="tf_fecha" value="<?php echo $c_date?>" >
    </div>
    </td>
  </tr>
</table>
<div id="d_table">
<?php
mysql_select_db($database_conexion, $conexion);
$fact1 = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact1 = mysql_fetch_assoc($fact1);	
?>
<table width="90%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">Punto de venta</td>
      <td width="30%" align="center" class="cont">
      <label id="lb_ptov"><? echo $row_fact1['punto_venta']?></label>
      </td>
      <td class="bold" width="20%">Fecha</td>
      <td width="30%" align="center" class="cont"><label><? echo $row_fact1['f_fact']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
      <label id="lb_prove"><? echo $row_fact1['cliente']?></label></td>
      <td class="bold" > NIT</td>
      <td align="center" class="cont"><label id="lb_ced"><? echo $row_fact1['ced']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Forma de Pago</td>
      <td align="center" class="cont"><label><? echo $row_fact1['forma_pago']?></label></td>
       <td class="bold" width="20%">Fecha Pago</td>
      <td align="center" class="cont"><label><? echo $row_fact1['f_pago']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont" colspan="3"><label><? echo $row_fact1['obs']?></label></td>
    </tr>
  </table>
  
  <table width="90%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="tittle" id="stittle">
    <td align="center" width="20%">Referencia</td>
    <td align="center" width="20%">Descripción</td>
    <td align="center" width="20%">Marca</td>
    <td align="center" width="20%">Cantidad</td>
    <td align="center" width="20%">Costo</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `consec`='$consec_url' 
  AND `mov`='c' AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {

  ?>
  <tr id="fila_<?php echo $i?>" class="row">
    <td class="cont" align="center">
    <label id="ref<?php echo $i?>"><?php echo $ref=$row_prod['ref'] ?></label>
    </td>
    <td align="center" class="cont">
    <label><?php 
	mysql_select_db($database_conexion, $conexion);
	$det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_det = mysql_fetch_assoc($det);
	echo $row_det['desc'] ?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo $row_det['marca'] ?></label>
    </td>
    <td class="cont" align="center">
    <?php 
	mysql_select_db($database_conexion, $conexion);
	$dev = mysql_query("SELECT * FROM `h01sg_compras_devoluciones_detalle` WHERE `ref`='$ref' AND `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_dev = mysql_fetch_assoc($dev);
	$cantd = $row_dev['cant_dev'];
	if ($cantd){
	?>
    <input type="text" id="cant<?php echo $i?>" class="long cant" placeholder="Max (<?php echo $row_prod['cant'] ?>)"
    onKeyUp="checkNum(this), total(), compare(<?php echo $i?>)" onChange="total()" value="<?php echo $cantd?>">
    <input type="hidden" id="cante<?php echo $i?>" value="<?php echo $cantd ?>">
    <?php	
	}else{
	?>
    <input type="text" id="cant<?php echo $i?>" class="long cant" placeholder="Max (<?php echo $row_prod['cant'] ?>)"
    onKeyUp="checkNum(this), total(), compare(<?php echo $i?>)" onChange="total()">
    <input type="hidden" id="cante<?php echo $i?>" value="<?php echo 0 ?>">
    <?php 
	}
	?>
    
    <input type="hidden" id="cantc<?php echo $i?>" value="<?php echo $row_prod['cant'] ?>">
    </td>
    <td class="cont" align="center">
    <label id="costo<?php echo $i?>"><?php echo $row_det['costo_und'] ?></label>
    </td>
    
  </tr>
  <?php
  $i++;
  }
  ?>
</table>
<table width="90%" align="center">
   <tr>
    <td colspan="4" align="right"><label style="font-size:10px">*En el campo cantidad se debe poner la cantidad que se devuelve de un producto</label></td>
  </tr>
  <tr>
  	<td colspan="4" class="bold" align="center">
    Total Items: <label id="lb_toti" class="red"></label>
    </td>
  </tr>
  <tr>
  	<td width="20%" class="bold">Costo</td>
    <td width="30%" class="bold"><label id="lb_tot" class="red"><? echo number_format($row_fact1['costo'],2)?></label></td>
    <td width="20%" class="bold">Costo Nuevo</td>
    <td width="30%" class="bold"><label id="lb_totcn" class="red"></label></td>
  </tr>
  <tr>
    <td align="center" colspan="4">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close();">
    </td>
  </tr>
</table>
</div>
</form>

</body>

</html>
<?php
}
?>