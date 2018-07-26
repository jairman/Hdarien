<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
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
$fact = mysql_query("SELECT * FROM `h01sg_cotizaciones` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);			

$i = 0;

mysql_select_db($database_conexion, $conexion);
$drio1 = mysql_query("SELECT * FROM `h01sg_pedidos` 
WHERE `delete`<>1 ORDER BY `consec` DESC ", $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);			
$factura1= $row_drio1['consec'];
if($factura1!=''){
	$factura2=$factura1;
}else{
	$factura2=0;	
}
$factura=$factura2 + 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registrar Pedido</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="js/ped_cot_form.js" type="text/javascript"></script>
</head>

<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_consecf" >

<div id="dialog"></div>

<form id="form1" name="form1">
	<table width="98%" align="center" id="table_header">
    <tr>
      <td width="80%" rowspan="3" align="left">
      <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td width="20%" align="center">&nbsp;</td>

    </tr>
    <tr>
        <td align="center">
        <label style="font-weight:bold; font-size:16px">Pedido No</label>&nbsp;
        <label class="red" id="tf_consec" style="font-weight:bold; font-size:16px"><? echo $factura?></label>      
        </td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="tittle" align="center">Registro de Pedido</td>
    </tr>
   </table>

  <table width="98%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">Punto de Venta</td>
      <td align="center" class="cont" width="30%">
      <input type="text" readonly id="tf_ptov" class="long" value="<?php echo $row_fact['punto_venta']?>">
      </td>
      <td class="bold" width="20%">Fecha Pedido</td>
      <td width="30%" align="center" class="cont">
      <input name="tf_fecha" type="text" 
      class="long" id="tf_fecha" value="<?php echo $c_date?>"> 
      </td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
        <input name="tf_prove" type="text" class="long" id="tf_prove"
        value="<?php echo $row_fact['cliente']?>" readonly >
      </td>
      <td class="bold" > NIT</td>
      <td align="center" class="cont"><input name="tf_ced" type="text" 
      class="long" id="tf_ced" value="<? echo $row_fact['ced']?>" readonly> </td>
    </tr>
    <tr>
      <td class="bold" >Telefono</td>
      <td align="center" class="cont"><input name="tf_tel" type="text" 
      class="long" id="tf_tel" value="<? echo $row_fact['tel']?>" readonly></td>
      <td class="bold" >Cotización No</td>
      <td align="center" class="cont">
      <input type="text" id="tf_cot" class="long" readonly value="<?php echo $consec_url?>">
      </td>
    </tr>
    <tr>
      <td class="bold" >Fecha Entrega</td>
      <td align="center" class="cont">
      <input name="tf_fdesp" type="text" class="long" id="tf_fdesp">
      </td>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont"><input name="tf_obs" type="text" class="long" 
      id="tf_obs" value="<? echo $row_fact['obs']?>"></td>	
    </tr>
  </table>
  
  <table width="98%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="stittle" id="tittle">
    <td align="center" width="15%">
    Todos
    <input type="checkbox" name="todos" id="todos" value="todos" onclick="check(this), totcant(), totcosto()">
    </td>
    <td align="center" width="17%">Referencia</td>
    <td align="center" width="18%">Descripción</td>
    <td align="center" width="20%">Marca</td>
    <td align="center" width="15%">Cantidad</td>
    <td align="center" width="15%">Costo</td>  
  </tr>
  <tbody>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_cotizaciones_detalle` WHERE `consec`='$consec_url' 
  AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
	$ref = $row_prod['ref'];
  ?>
  <tr id="fila_<?php echo $i?>" class="row">
  	 <td align="center">
     <input type="checkbox" name="radio" value="<?php echo $i?>" id="<?php echo $i?>" onClick="totcant(), totcosto()">
     </td>
    <td class="cont" align="center">
    <input name="tf_ref" type="text" class="long ref" id="tf_ref<?php echo $i?>" value="<?php echo  $ref?>" readonly >
    </td>
    <td class="cont">
    <input name="tf_desc" type="text" class="long" id="tf_desc<?php echo $i?>" value="<?php echo $row_prod['desc'] ?>">
    </td>
    <td class="cont">
    <input name="tf_marca" type="text" class="long" id="tf_marca<?php echo $i?>" value="<?php echo $row_prod['marca'] ?>">
    </td>
    <td class="cont" align="center">
    <input name="tf_cant" type="text" class="long cant" id="tf_cant<?php echo $i?>" 
    value="<?php echo $row_prod['cant'] ?>" onkeyup="checkNum(this)">
    
    <input type="hidden" id="tf_cantc<?php echo $i?>" value="<?php echo $row_prod['cant'] ?>" >
    </td>
    <td class="cont" align="center">
    <input name="tf_costo" type="text" class="long costo" id="tf_costo<?php echo $i?>" 
    value="<?php echo $row_prod['costo'] ?>" onkeyup="checkNum(this)">
    </td>
  </tr>
  <?php
  $i++;
  }
  ?>
  </tbody>
</table>
<input type="hidden" id="tf_i" value="<?php echo $i ?>">
<table width="98%" border="1" cellspacing="0" align="center">
  <tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"></label></td>
    <td width="20%" class="bold"> Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"></label></td>
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
</form>
    
</body>

</html>
<?php
}
?>