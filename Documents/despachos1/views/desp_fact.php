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
$c_date = date('Y-m-d');

$consec_url=$_GET['c'];

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_despachos` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	


$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Movimientos de Inventarios</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/desp_fact.js" type="text/javascript"></script>
</head>

<body>

<div id="dialog"></div>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_i" value="<?php echo $i?>">
<input type="hidden" id="tf_consecf" >
<input type="hidden" id="tf_exist" >

<div id="recargar2">
<table width="98%" align="center" id="table_header">
    <tr>
      <td align="left" width="936" >
      <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td align="center" width="83" ><input name="imgb" type="image" src="../../img/mail.png"  title="Enviar Email" width="48" height="48"  onClick="mostrar('desp_fact_correo.php?c=<?php echo $consec_url ?>')" /></td>
      <td width="73" align="left">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" > 
    </td>
    </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr class="tittle">
    <td colspan="4">Despachos</td>
  </tr>
  <tr>
    <td width="15%" align="left" class="bold">Consecutivo</td>
    <td width="35%" align="center" class="cont">
    <label class="red" id="lb_consec"><?php echo $consec_url?></label>
    </td>
    <td width="15%" align="left" class="bold">Fecha</td>
    <td width="35%" align="center" class="cont"><label id="lb_fecha"><?php echo $row_fact['fecha']?></label></td>
  </tr>
  <tr>
    <td align="left" class="bold">Tipo Movimiento</td>
    <td align="center" class="cont">
    <label id="sl_tipo">Despacho</label>
    </td>
    <td width="15%" align="left" class="bold">Origen</td>
    <td width="35%" align="center" class="cont">
	<?php echo $row_fact['punto_ini']?>
    </td>
  </tr>
  <tr>
  	<td align="left" class="bold">Destino</td>
    <td align="center" class="cont">
      <?php echo $row_fact['punto_venta']?>
    </td>
    <td align="left" class="bold" >Observaciones</td>
    <td align="center" class="cont">
    <?php echo $row_fact['obs']?>
    </td>
  </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0" id="tb_detail">
  <tr class="stittle" id="tittle">
    <!--<td width="15%">Cod. Barras</td>-->
    <td width="20%">Referencia</td>
    <td width="15%">Descripcion</td>
    <td width="15%">talla</td>
    <td width="15%">Marca</td>
    <td width="15%">Costo</td>
    <td width="20%">Cantidad</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `consec`='$consec_url' 
  AND `mov`='d' AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
    <td align="center"><?php echo $ref = $row_prod['ref']?></td>
    <td align="center">
    <?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det);
    echo $row_det['desc'];
	?>
    </td>
    <td align="center"><?php echo $row_det['talla']?></td>
    <td align="center"><?php echo $row_det['marca']?></td>
    <td align="center"><?php echo $row_prod['costo']?></td>
    <td align="center"><?php echo $row_prod['cant']?></td>
  </tr>
  <?php 
  	$i++;
  }
  ?>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
	<tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"><?php echo $row_fact['cant']?></label></td>
    <td width="20%" class="bold">Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"><?php echo $row_fact['costo']?></label></td>
  </tr>
    <td align="center" colspan="4">
    
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerra" onclick="window.close()">
    </td>
</table>
</div>

</body>

</html>
<?php
}
?>