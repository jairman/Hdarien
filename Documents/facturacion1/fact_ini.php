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

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$c_date = date('Y-m-d');

$ptov_url=$_GET['p'];

$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Facturación</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="js/fact_ini.js" type="text/javascript"></script>
<style>
.sub{
	font-size:11px !important;
	font-weight:bold !important;
}
</style>
</head>


<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_cexist" >
<input type="hidden" id="tf_i" value="<?php echo $i?>">
<input type="hidden" id="tf_consecf" >
<input type="hidden" id="tf_no">
<input type="hidden" id="tf_exist" >

<div id="dialog"></div>
<div id="dialog2" title="Pago Factura">
<table align="center" width="90%">
<tr>
	<td align="right" class="bold" width="50%">Total Neto</td>
    <td class="cont" width="50%"><label id="lb_cdtotal"></label></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Saldo a Favor</td>
    <td class="cont" width="50%"><input type="text" id="tf_favor" class="long" disabled
    onKeyUp="totfact()"> </td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Efectivo</td>
    <td class="cont" width="50%"><input type="text" id="tf_efectivo" class="long" 
    onKeyUp="totfact(), checkNum(this)"> </td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">PAC</td>
    <td class="cont" width="50%"><input type="text" id="tf_pac" class="long"
    onKeyUp="totfact(), checkNum(this)"></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Redeban</td>
    <td class="cont" width="50%"><input type="text" id="tf_tarjeta" class="long"
    onKeyUp="totfact(), checkNum(this)"></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">&nbsp;</td>
    <td class="cont" width="50%"><select id="sl_tarjeta" class="long">
    <option value="">Seleccione</option>
    <option value="Visa">Visa</option>
    <option value="Mastercard">Mastercard</option>
    <option value="American">American Exp.</option>
    <option value="Dinners">Dinners</option>
    <option value="Maestro">Maestro</option>
    </select></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Cambio</td>
    <td class="cont" width="50%"><input type="text" id="tf_cambio" disabled class="long"></td>
</tr>
<tr>
	<td align="center">
    <img id="theImg" src="../img/money.png" width="50" height="50" 
    style="cursor:pointer" onclick="aprov()" title="Pago en Efectivo"/>
    </td>
    <td align="center">
    <img src="../img/credit.png" width="50" height="50" 
    style="cursor:pointer" onclick="aprov()" title="Pago en Tarjeta" />
    
    </td>
</tr>
<tr>
	<td colspan="2" align="center">
    <img id="theImg2" src="../img/erase.png" width="50" height="50" 
    style="cursor:pointer" onclick="cerrar_dialogo2()" />
    </td>
</tr>
</table>
</div>

<form id="form1" name="form1">

<table width="90%" align="center" id="tb_header">
  <tr>
    <td rowspan="3" width="34%"><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
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
    <strong>No: <label id="lb_consec" class="red">
    <?php
    mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_venta` 
	WHERE `delete`<>1 AND `punto_venta`='$ptov_url' ORDER BY `consec` DESC ", $conexion) or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['consec'];
	if($factura1!=''){
		$factura2=$factura1;
	}else{
		$factura2=0;	
	}
	$factura=$factura2 + 1;
	echo $factura
	?>
    </label></strong>
    </div>
    </td>
  </tr>
  <tr>
    <td align="center"><div id="d_nit">
    <label class="sub">
    NIT: <?php echo $row_hd['nit']; ?>
    </label>
    </div></td>
    <td align="center">Fecha: <label id="lb_fecha"><?php echo $c_date?></label></td>
  </tr>
</table>

<table width="90%" align="center" id="tb_cdata">
  <tr class="tittle">
    <td colspan="4"><label style="font-size:18px">Información de Venta</label></td>
  </tr>
  <tr>
  	<td class="bold">Punto de Venta</td>
  	<td class="cont"><?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_ptov" id="sl_ptov" class="long">
        <option value="">Seleccione</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
        <option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
        <?php
        } 
        ?>
        </select>
        <?php 
        }else{
        ?>
        <input type="text" readonly id="tf_ptov" class="long" value="<?php echo $usuario2 ?>">
        <?php
        }
        ?></td>
        <td class="bold" >Tipo</td>
        <td class="cont"><select name="sl_fpago" id="sl_fpago" class="long" align="center">
        <option value="">Seleccione</option>
        <option value="Mayor">Por Mayor</option>
        <option value="Detal">Detal</option>
        <!--<option value="Credito">Crédito</option>-->
        </select></td>
  </tr>
  <tr>
  	<td width="20%" class="bold">NIT</td>
    <td width="30%" class="cont">
    <input name="tf_nit" id="tf_nit" type="text" style="width:80%">
    <img src="../img/search.png" alt="Busqueda" name="bt_client" 
    width="20" height="20" id="bt_client" style="cursor:pointer" title="Busqueda" onClick="searchClient()" />
    </td>
    <td width="20%" class="bold">Cliente</td>
    <td width="30%" class="cont"><input name="tf_nombre" id="tf_nombre" type="text" class="long">
    </td>
    
  </tr>
  <tr>
    <td class="bold">Email</td>
    <td class="cont"><input name="tf_dir" id="tf_email" type="email" class="long" placeholder="ejemplo@mail.com"></td>
    <td class="bold">Cumpleaños</td>
    <td class="cont"><input name="tf_tel" id="tf_cumple" type="text" class="long"></td>
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="cont"><input name="tf_dir" id="tf_dir" type="text" class="long"></td>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="tf_tel" id="tf_tel" type="text" class="long"></td>
  </tr>
  <tr>
    <td class="bold">Forma de Pago</td>
    <td class="cont">
    <select name="sl_formap" id="sl_formap" class="long" align="center">
        <option value="">Seleccione</option>
        <option value="Contado">Contado</option>
        <option value="Credito">Crédito</option>
        <!--<option value="Credito">Crédito</option>-->
        </select>
    </td>
    <td class="bold">Fecha Pago</td>
    <td class="cont">
    <input name="tf_fechap" id="tf_fechap" type="text" style="width:80%" value="<? echo date ('Y-m-d') ?>">
    <img src="../img/add.png" alt="" width="25" height="25" border="0" align="right" 
    title="Agregrar Producto" style="cursor:pointer" id="bt_add" />
    </td>
  </tr>
</table>

<table width="90%" align="center" id="tb_prod">
  <tr align="center" class="tittle">
    <td colspan="7">Detalle de Venta</td>
  </tr>
  <tr align="center" class="stittle">
    <td width="20%">Referencia</td>
    <td width="30%">Descripción</td>
    <td width="10%">Cantidad</td>
    <td width="10%">Precio</td>
    <td width="10%">Descuento</td>
    <td width="10%">Valor</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <tr id="fila_<?php echo $i?>">
    <td class="cont">
    <input name="tf_ref<?php echo $i?>" type="text" id="tf_ref<?php echo $i?>" style="width:76%" class="ref" 
    onChange="checkref('<?php echo $i?>')" required>
	<img src="../img/search.png" alt="Busqueda" name="bt_sproduct<?php echo $i?>" 
    width="20" height="20" id="bt_sproduct<?php echo $i?>" style="cursor:pointer" title="Busqueda" onClick="searchProd('<?php echo $i?>')" /></td>
    <td class="cont"><input type="text" class="long" id="lb_det<?php echo $i?>" readonly></td>
    <td class="cont">
    <input name="tf_cant<?php echo $i?>" type="text" id="tf_cant<?php echo $i?>" class="long cant" 
    required onkeyup="checkNum(this),compare('<?php echo $i?>'), total('<?php echo $i?>')">
    <input type="hidden" id="tf_cantmax<?php echo $i?>">
    </td>
    <td class="cont">
    <input type="text" class="long" id="lb_val<?php echo $i?>" readonly>
    <input type="hidden" id="tf_valm<?php echo $i?>">
    </td>
    <td class="cont">
    <input type="text" id="tf_dcto<?php echo $i?>" class="long" onkeyup="getdcto(<?php echo $i?>),compare('<?php echo $i?>')" >
    </td>
    <td class="cont"><input type="text" class="long" id="lb_totprod<?php echo $i?>" readonly></td>
    <td class="cont" align="center"><img src="../img/erase.png" id="bt_img<?php echo $i?>" width="20" height="20" 
    style="cursor:pointer;" onClick="quitar('<?php echo $i?>')"></td>
  </tr>
</table>
<table width="90%" align="center" id="tb_cost">
  <tr align="center">
    <td width="20%" class="bold">DESCUENTOS</td>
    <td width="30%" class="cont"><label id="lb_dtotal" class="red"></label></td>
    <td width="20%" class="bold">SUBTOTAL</td>
    <td width="30%" class="cont"><label id="lb_sub" class="red"></label></td>
  </tr>
  <tr align="center">
    <td width="20%"  class="bold">Items</td>
    <td width="30%" ><label id="lb_itemst" class="red"></label></td>
    <td width="20%" class="bold">IVA</td>
    <td width="30%" class="cont"><label id="lb_iva" class="red"></label></td>
  </tr>
  <tr  align="center">
    <td class="bold">Saldo a Favor</td>
    <td><label id="lb_ssfavor"></label></td>
    <td align="center" class="bold">TOTAL</td>
    <td class="cont"><label id="lb_total" class="red"></label></td>
  </tr>
</table>
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
    value="Cancelar" onclick="redirect()">
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