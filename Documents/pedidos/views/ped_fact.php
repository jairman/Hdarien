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

//header("Content-Type: text/html;charset=UTF-8");
date_default_timezone_set('America/Bogota');

$consec_url=$_GET['c'];

$c_date = date('Y-m-d');

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_pedidos` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);			

$i = 0;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Pedido</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/ped_fac.js" type="text/javascript"></script>

<style>
.picture{
	width:80px;
	height:80px;
}
.img{
	padding-top:2px;
}
</style>
</head>

<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<div id="dialog"></div>

<div id="recargar2">

<table width="98%" align="center" id="table_header">
    
    <tr>
    <td width="70%" rowspan="3" align="left" >
    <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    <td width="20%" align="center">&nbsp;</td>
    <td align="right" width="5%" rowspan="3"><input name="imgb" type="image" src="../../img/mail.png" width="40" height="40" title="Enviar Email"  onclick="mostrar1('<?= $_GET['c'] ?>')" /></td>
    <td align="right" width="5%" rowspan="3"><input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onClick="imprimir_esto('recargar2')" ></td>
    </tr>
    <tr>
      <td align="center">
      <label style="font-weight:bold; font-size:16px">Pedido No</label>&nbsp;
      <label class="red" style="font-weight:bold; font-size:16px"><? echo $row_fact['consec']?></label>
      </td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
    <td colspan="4" class="tittle" align="center">Registro de Pedido</td>
    </tr>
</table>

<table width="98%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">Punto de Venta</td>
      <td width="30%" align="center" class="cont"><label><? echo $row_fact['punto_venta']?></label></td>
      <td class="bold" width="20%">Fecha Pedido</td>
      <td width="30%" align="center" class="cont"><label><? echo $row_fact['f_fact']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
      <label><? echo $row_fact['cliente']?></label></td>
      <td class="bold" >NIT</td>
      <td align="center" class="cont"><label><? echo $row_fact['ced']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Telefono</td>
      <td align="center" class="cont"><label><? echo $row_fact['tel']?></label></td>
      <td class="bold" >Cotización No</td>
      <td align="center" class="cont"><label><? echo $row_fact['cot']?></label></td>
    </tr>
    <tr>
      <td class="bold" >Fecha Entrega</td>
      <td align="center" class="cont"><label><? echo $row_fact['f_despacho']?></label></td>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont"><label><? echo $row_fact['obs']?></label></td>
    </tr>
  </table>
  <table width="98%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="stittle" id="tittle">
    <td align="center" width="16%">Ref.</td>
    <td align="center" width="20%">Descripción</td>
    <td align="center" width="20%">Marca</td>
    <td align="center" width="16%">Cantidad</td>
    <td align="center" width="17%">Costo</td>
    <td align="center" width="11%">&nbsp;</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_pedidos_detalle` WHERE `consec`='$consec_url' 
  AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  	$estado = $row_prod['delete'];
	  if ($estado == 0){
  ?>
  <tr id="fila_<?php echo $i?>" class="row">
    <td class="cont" align="center">
    <label><?php echo $row_prod['ref'] ?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo $row_prod['desc'] ?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo $row_prod['marca'] ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo $row_prod['cant'] ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo number_format($row_prod['costo'],2) ?></label>
    </td>
    <td class="cont" align="center">&nbsp;</td>
  </tr>
  <?php
  	  $i++;
	  }
	  if ($estado == 2){
  ?>
  <tr id="fila_<?php echo $i?>" class="row">
    <td class="cont" align="center">
    <label><?php echo $row_prod['ref'] ?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo $row_prod['desc'] ?></label>
    </td>
    <td align="center" class="cont">
    <label><?php echo $row_prod['marca'] ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo $row_prod['cant'] ?></label>
    </td>
    <td class="cont" align="center">
    <label><?php echo number_format($row_prod['costo'],2) ?></label>
    </td>
    <td class="cont" align="center"><label class="red">Pedido</label></td>
  </tr>
  <?php
  	  $i++;
	  }
  }
  ?>
</table>
<table width="98%" border="1" cellspacing="0" align="center">
  <tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"><? echo number_format($row_fact['cant'],2)?></label></td>
    <td width="20%" class="bold">Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"><? echo number_format($row_fact['costo'],2)?></label></td>
  </tr>
  <tr>
    <td align="center" colspan="4">&nbsp;
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