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

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	

$i = 1;
$j = '';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Facturación</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/fact_cred1.js" type="text/javascript"></script>

<style>
.sub{
	font-size:12px;
	font-weight:bold}
</style>
</head>


<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_exist" >
<input type="hidden" id="cdate" value="<?php echo $c_date?>" >

<div id="dialog"></div>
<div id="dialog2">
    <div class="demo-wrapper html5-progress-bar" align="center">
        <div class="progress-bar-wrapper">
            <progress id="progressbar" value="0" max="100" style="width:98%"></progress>
            <span class="progress-value" id="progreso">0%</span>
        </div>
    </div>
	<input type="button" id="aceptar" style="width:150px; display:none" value="Aceptar" class="ext" />
</div>

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
    <td align="center" width="33%"><label class="sub">FACTURA DE VENTA</label></td>
  </tr>
  <tr>
    <td align="center">
    <div id="d_consec">
    No: <label id="lb_consec" class="red"><?php echo $consec_url?></label>
    </div>
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
    <td align="center">Fecha: <label id="lb_fecha"><?php echo $row_fact['fecha']?></label></td>
  </tr>
</table>

<table width="90%" align="center" id="tb_cdata">
  <tr class="tittle">
    <td colspan="5"><label style="font-size:18px">Información de Venta</label></td>
  </tr>
  <tr>
  	<td class="bold">Punto de Venta</td>
  	<td class="cont"><label id="lb_puntov"><?php echo $ptov_url?></label></td>
    <td class="bold" >Tipo</td>
    <td colspan="2" class="cont"><label id="lb_tipo"><?php echo $row_fact['tipo']?></label></td>
  </tr>
  <tr>
  	<td width="20%" class="bold">Cedula/Nit</td>
    <td width="30%" class="cont">
    <label id="tf_ced"><?php echo $nit = $row_fact['ced']?></label>
    </td>
    <?php
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir)
    ?>
    <td width="20%" class="bold">Razon Social</td>
    <td width="30%" colspan="2" class="cont">
    <label id="tf_cliente"><?php echo $row_dir['nombre']?></label>
    </td>
    
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="cont"><label><?php echo $row_dir['dir']?></label></td>
    <td class="bold">Telefono</td>
    <td colspan="2" class="cont"><label><?php echo $row_dir['telefono']?></label></td>
  </tr>
  <tr>
  	<td class="bold">Forma de Pago</td>
    <td class="cont"><label><?php echo $row_fact['forma_pago']?></label></td>
    <td class="bold">Fecha Pago</td>
    <td class="cont"><label id="lb_fechap"><?php echo $row_fact['fecha_p']?></label></td>
    <td class="cont" width="10%">
    <img src="../../img/add.png" alt="" width="25" height="25" border="0" align="right" 
    title="Agregrar Producto" style="cursor:pointer" id="bt_add" />
    </td>
  </tr>
  <tr align="center" class="tittle" >
    <td colspan="5">Detalle de Venta</td>
  </tr>
</table>

<table width="90%" align="center" id="tb_prod">
  <tr align="center" class="stittle" id="tittle">
    <td width="18%">Identificador</td>
    <td width="28%">Descripción</td>
    <td width="14%">Cantidad</td>
    <td width="10%">Precio</td>
    <td width="10%">Descuento</td>
    <td width="10%">Valor</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr id="fila_<?php echo $i?>">
    <td class="cont">
    <input type="text" id="tf_ref<?php echo $i?>" value="<?php echo $ref = $row_prod['ref']?>" class="ref long" readonly onChange="">
	</td>
    <td class="cont">
	<?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det)
    ?>
    <label id="lb_desc"><?php 
	$string = $row_det['desc']; 
	$a='';
	$b='';
	$c='';
	if ($row_det['talla']){
		$a= ' - '.$row_det['talla'];
	}
	if ($row_det['color']){
		$b= ' - '.$row_det['color'];
	}
	if ($row_det['marca']){
		$c= ' - '.$row_det['marca'];
	}
	echo $string.$b.$a.$c;
	?></label>
    </td>
    <td class="cont">
    <?php 
	mysql_select_db($database_conexion, $conexion);
    $max = mysql_query("SELECT `cant_final` FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_max = mysql_fetch_assoc($max);
	
	$maxi = mysql_query("SELECT `cant` FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `punto_venta`='$ptov_url' 
	AND `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_maxi = mysql_fetch_assoc($maxi);
	?>
    <input type="text" id="tf_cant<?php echo $i?>" value="<?php echo $row_prod['cant']?>" class="long a"
    onKeyUp="checkNum(this), getdcto(), getmaxo(<?php echo $i?>)" onChange="getdcto()" 
    required placeholder="maximo(<?php echo ($row_max['cant_final']+$row_maxi['cant'])?>)">
    <input type="hidden" id="tf_cantorg<?php echo $i?>" value="<?php echo $row_prod['cant']?>">
    <input type="hidden" id="tf_cantmax<?php echo $i?>" value="<?php echo ($row_max['cant_final']+$row_maxi['cant'])?>">
    </td>
    <td align="center" class="cont">
    <label id="lb_val<?php echo $i?>"><?php echo number_format($row_prod['valor'], 2)?></label>
    <input type="hidden" id="tf_valm<?php echo $i?>" />
    </td>
    <td align="center" class="cont">
    <input type="text" id="tf_dcto<?php echo $i?>" class="long" onkeyup="checkNum(this), getdcto()"
    value="<?php echo number_format($row_prod['dscto'], 2)?>">
    </td>
    <td align="center" class="cont">
    <label id="lb_tot<?php echo $i?>"><?php echo number_format($row_prod['total'], 2)?></label>
    </td>
    <td align="center">
    <img src="../../img/erase.png" id="img<?php echo $i?>" width="20" height="20" style="cursor:pointer;" 
    title="Eliminar" onClick="quitarsaved(<?php echo $i?>)">
    </td> 
    <?php 
	$i++;
  }
  $j = $i;
	?>  
  </tr>
</table>
<table width="90%" align="center" id="tb_cost">
  <tr align="center">
    <td width="20%" class="bold">DESCUENTOS</td>
    <td width="30%" class="cont"><label id="lb_dtotal" class="red"><?php echo number_format($row_fact['dscto'], 2)?></label></td>
    <td width="20%" class="bold">SUBTOTAL</td>
    <td width="30%" class="cont"><label id="lb_sub" class="red"><?php echo number_format($row_fact['sub_total'], 2)?></label></td>
  </tr>
  <tr align="center">
    <td width="20%"  class="bold">Items</td>
    <td width="30%" ><label id="lb_itemst" class="red"><?php echo $row_fact['total_items']?></label></td>
    <td width="20%" class="bold">IVA</td>
    <td width="30%" class="cont"><label id="lb_iva" class="red"><?php echo number_format($row_fact['iva'], 2)?></label></td>
  </tr>
  <tr  align="center">
    <td class="bold">&nbsp;</td>
    <td><label id="lb_ssfavor"></label></td>
    <td align="center" class="bold">TOTAL</td>
    <td class="cont"><label id="lb_total" class="red"><?php echo number_format($row_fact['tot_final'], 2)?></label></td>
  </tr>
  <tr  align="center">
    <td class="bold">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">%</td>
    <td class="cont"><input type="text" id="tf_dctofact" class="long" onkeyup="checkNum(this)" onChange="dctofact()"
    value="<?php echo number_format($row_fact['dctof'], 2)?>"></td>
  </tr>
</table>
<input type="hidden" id="tf_i" value="<?php echo $i ?>">
<input type="hidden" id="tf_j" value="<?php echo $j ?>">
<table width="90%" align="center" id="tb_footer">
  <tr>
    <td align="center">
    <div id="d_reso">
    <label class="sub">
    <?php echo 'Resolución DIAN No '.$row_hd['resol'].' Con vigencia desde '.$row_hd['f_vigi'].' hasta '.$row_hd['f_vigf'].' <br>' ?>
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
    value="Cerrar" onclick="window.close();">
    </td>
  </tr>
</table>

</form>
</body>
<script>

</script>
</html>
<?php
}
?>