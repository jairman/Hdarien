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
$ced=$row_fact['ced'];	


mysql_select_db($database_conexion, $conexion);
$devo = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec_url' 
AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_devo = mysql_fetch_assoc($devo);

mysql_select_db($database_conexion, $conexion);
@$query_clien = sprintf("SELECT * FROM d89xz_clientes WHERE cedula ='$ced'", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
$correo=$row_clien['mail'];

$i = 1;
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
<script src="../js/factd.js" type="text/javascript"></script>
<style>
.sub{
	font-size:12px;
	font-weight:bold}
</style>
</head>


<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">


<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
  <tr>
    <td width="86%" align="left">&nbsp;
     
    </td>
    <td width="7%" align="center"><input name="imgb" type="image" src="../../img/mail.png"  title="Enviar Email" width="48" height="48"  onClick="mostrar('<?= $consec_url ?>', '<?= $ptov_url ?>', '<?= $correo ?>')" /></td>
    <td width="7%" align="left">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" > 
    </td>
  </tr>
</table>
<div id="recargar2">

<table width="90%" align="center" id="tb_header">
  <tr>
    <td rowspan="3" width="34%"><img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
    <td rowspan="2" align="center" width="33%">
    <label class="sub">
	<?php
    mysql_select_db($database_conexion, $conexion);
	$query_hd = "SELECT * FROM d89xz_hacienda WHERE `hacienda`='$ptov_url'";
	$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
	$row_hd = mysql_fetch_assoc($hd);
	echo $row_hd['empresa'].' <br>'.$row_hd['dir'].' <br> Telefono:'.$row_hd['telefono'];
	?>
    </label>
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
    <label class="sub">
    NIT: <?php echo $row_hd['nit']; ?>
    </label>
    </td>
    <td align="center">Fecha: <label id="lb_fecha"><?php echo $row_fact['fecha']?></label></td>
  </tr>
</table>

<table width="90%" align="center" id="tb_cdata">
  <tr class="tittle">
    <td colspan="4"><label style="font-size:18px">Información de Venta</label></td>
  </tr>
  <tr>
  	<td class="bold">Punto de Venta</td>
  	<td class="cont"><label><?php echo $ptov_url?></label></td>
    <td class="bold" >Tipo</td>
    <td class="cont"><label><?php echo $row_fact['tipo']?></label></td>
  </tr>
  <tr>
  	<td width="20%" class="bold">NIT</td>
    <td width="30%" class="cont">
    <label><?php echo $nit = $row_devo['ced']?></label>
    </td>
    <td width="20%" class="bold">Cliente</td>
    <?php
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir)
    ?>
    <td width="30%" class="cont">
    <label><?php echo $row_dir['nombre']?></label>
    </td>
    
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="cont"><label><?php echo $row_dir['dir']?></label></td>
    <td class="bold">Telefono</td>
    <td class="cont"><label><?php echo $row_dir['telefono']?></label></td>
  </tr>
  <tr>
  	<td class="bold">Forma de Pago</td>
    <td class="cont"><label><?php echo $row_fact['forma_pago']?></label></td>
    <td class="bold">Fecha Pago</td>
    <td class="cont"><label><?php echo $row_fact['fecha_p']?></label></td>
  </tr>
</table>

<table width="90%" align="center" id="tb_prod">
  <tr align="center" class="tittle">
    <td colspan="7">Detalle de Venta</td>
  </tr>
  <tr align="center" class="stittle">
    <td width="15%">Referencia</td>
    <td width="20%">Descripción</td>
    <td width="13%">Cantidad</td>
    <td width="13%">Devolución</td>
    <td width="13%">Precio</td>
    <td width="13%">Descuento</td>
    <td width="13%">Valor</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr id="fila_<?php echo $i?>">
    <td align="left" class="cont">
    <label><?php echo $ref = $row_prod['ref']?></label>
	</td>
    <td align="left" class="cont">
	<?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det)
    ?>
    <label><?php echo $row_det['desc']?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo $row_prod['cant']?></label>
    </td>
    <td align="center" class="cont">
    <?php
  mysql_select_db($database_conexion, $conexion);
  $prodd = mysql_query("SELECT * FROM `h01sg_devoluciones_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 AND `ref`='$ref' ORDER BY `id`", $conexion) or die(mysql_error());
  $row_prodd = mysql_fetch_assoc($prodd)
  ?>
    <label><?php echo $row_prodd['cant_dev']?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo number_format($row_prod['valor'], 2)?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo number_format($row_prod['dscto'], 2)?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo number_format($row_prod['total'], 2)?></label>
    </td> 
    <?php 
	$i++;
  }
	?>  
  </tr>
</table>
<table width="90%" align="center" id="tb_cost">
  <tr align="center">
    <td width="20%" class="bold">Descuentos</td>
    <td width="30%" class="cont"><label class="red"><?php echo $row_fact['dscto']?></label></td>
    <td width="20%" class="bold">SUBTOTAL</td>
    <td width="30%" class="cont"><label id="lb_sub" class="red"></label></td>
  </tr>
  <tr align="center">
    <td width="20%" class="bold">Items</td>
    <td width="30%" class="cont"><label id="lb_itemst" class="red"><?php echo $row_fact['total_items']?></label></td>
    <td width="20%" class="bold">IVA</td>
    <td width="30%" class="cont"><label id="lb_iva" class="red"></label></td>
  </tr>
  <tr  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">TOTAL</td>
    <td class="cont"><label id="lb_total" class="red"><?php echo number_format($row_devo['total'], 2)?></label></td>
  </tr>
  <tr  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">%</td>
    <td class="cont"><label id="lb_total" class="red p2"><?php echo number_format($row_fact['dctof'], 2)?></label></td>
  </tr>
</table>
<table width="90%" align="center" id="tb_footer">
  <tr>
    <td align="center">
    <label class="sub">
    <?php echo 'Resolución DIAN No '.$row_hd['resol'].' de '.$row_hd['f_vigi'].', del número '.$row_hd['desde'].' hasta '.$row_hd['hasta'].'<br>' ?>
    <?php echo 'Nota: '.$row_hd['empresa'].' Acepta únicamente el cambio o devolución de los productos en un plazo máximo de 30 días despues de la compra, es indispensable la presentación de la factura de compra.' ?>
    </label>
    </td>
  </tr>
  <tr>
    <td align="center" >
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.close();">
    </td>
  </tr>
</table>
</div>
</body>

</html>
<?php
}
?>