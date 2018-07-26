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

$ptov_url=$_POST['p'];
$consec_url=$_POST['c'];
$correo_url=trim($_POST['m']);

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	

mysql_select_db($database_conexion, $conexion);
$devo = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec_url' 
AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_devo = mysql_fetch_assoc($devo);
$nit = $row_devo['ced'];
//-----------------------------------------Empresa-----------------------------------------------------------------------
	mysql_select_db($database_conexion, $conexion);
	@$query_clien = sprintf("SELECT color FROM d89xz_empresa ", GetSQLValueString($colname_clien, "text"));
	$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
	$row_clien = mysql_fetch_assoc($clien);
	$totalRows_clien = mysql_num_rows($clien);
	$color=$row_clien['color'];
//______________________________________________________________________________________________________

$i = 1;
?>

<?php
$mensaje = "  
<input type='hidden' id='tf_user' value='$usuario2'>
<input type='hidden' id='tf_user2' value='$usuario'>


<div id='dialog'></div>

<table width='90%' align='center' id='table_header'>
  <tr>
    <td width='93%' align='left'>&nbsp;
     
    </td>
    <td width='7%' align='left'>&nbsp;</td>
  </tr>
</table>
<div id='recargar2'>

<table width='90%' align='center' id='tb_header'>
  <tr>
    <td rowspan='3' width='34%'><img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' alt='logo' name='logo' width='200' height='70' id='logo' /></td>
    <td rowspan='2' align='center' width='33%'>
    <label class='sub'>";
	
    mysql_select_db($database_conexion, $conexion);
	$query_hd = "SELECT * FROM d89xz_hacienda WHERE `hacienda`='$ptov_url'";
	$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
	$row_hd = mysql_fetch_assoc($hd);
	$empresa=$row_hd['empresa'];
	
$mensaje.= " 	
	
	$row_hd[empresa] <br>
	$row_hd[dir] <br>
	Telefono:$row_hd[telefono]
    </label>
    </td>
    <td align='center' width='33%'><label class='sub'>FACTURA DE VENTA</label></td>
  </tr>
  <tr>
    <td align='center'>
    <div id='d_consec'>
    No: <label id='lb_consec' class='red'>$consec_url</label>
    </div>
    </td>
  </tr>
  <tr>
    <td align='center'>
    <label class='sub'>
    NIT: $row_hd[nit]
    </label>
    </td>
    <td align='center'>Fecha: <label id='lb_fecha'>$row_fact[fecha]</label></td>
  </tr>
</table>





<table width='90%' align='center' id='tb_cdata'>
  <tr >
    <td colspan='4' bgcolor='$color'  style='color: #FFF'><label style='font-size:18px'>Información de Venta</label></td>
  </tr>
  <tr>
  	<td class='bold' bgcolor='#F0F0F0'>Punto de Venta</td>
  	<td class='cont'><label>$ptov_url</label></td>
    <td class='bold' bgcolor='#F0F0F0' >Tipo</td>
    <td class='cont'><label>$row_fact[tipo]</label></td>
  </tr>
  <tr>
  	<td width='20%' bgcolor='#F0F0F0'>NIT</td>
    <td width='30%' class='cont'>
    <label>$row_devo[ced]</label>
    </td>
    <td width='20%' bgcolor='#F0F0F0'>Cliente</td>";
   
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir);
	
   $mensaje.= " 	
    <td width='30%' class='cont'>
    <label>$row_dir[nombre]</label>
    </td>
    
  </tr>
  <tr>
    <td bgcolor='#F0F0F0'>Dirección</td>
    <td class='cont'><label>$row_dir[dir]</label></td>
    <td bgcolor='#F0F0F0' >Telefono</td>
    <td ><label>$row_dir[telefono]</label></td>
  </tr>
  <tr>
  	<td bgcolor='#F0F0F0'>Forma de Pago</td>
    <td ><label>$row_fact[forma_pago]</label></td>
    <td bgcolor='#F0F0F0'>Fecha Pago</td>
    <td ><label>$row_fact[fecha_p]</label></td>
  </tr>
</table>

<table width='90%' align='center' id='tb_prod'>
  <tr align='center' >
    <td colspan='7' bgcolor='$color'  style='color: #FFF'>Detalle de Venta</td>
  </tr>
  <tr align='center' >
    <td width='15%' bgcolor='$color'  style='color: #FFF'>Referencia</td>
    <td width='20%' bgcolor='$color'  style='color: #FFF'>Descripción</td>
    <td width='13%' bgcolor='$color'  style='color: #FFF'>Cantidad</td>
    <td width='13%' bgcolor='$color'  style='color: #FFF'>Devolución</td>
    <td width='13%' bgcolor='$color'  style='color: #FFF'>Precio</td>
    <td width='13%' bgcolor='$color'  style='color: #FFF'>Descuento</td>
    <td width='13%' bgcolor='$color'  style='color: #FFF'>Valor</td>
  </tr>";
  
	
 
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  $ref = $row_prod['ref'];
  
  $mensaje.= "  
  <tr id='fila_$i'>
    <td align='left' >
    <label>$row_prod[ref]</label>
	</td>
    <td align='left' >";
    
    
	
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det);
	
  $mensaje.= "   
    <label>$row_det[desc]</label>
    </td>
    <td align='center' >
    <label>$row_prod[cant]</label>
    </td>
    <td align='center' >";
   
  mysql_select_db($database_conexion, $conexion);
  $prodd = mysql_query("SELECT * FROM `h01sg_devoluciones_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 AND `ref`='$ref' ORDER BY `id`", $conexion) or die(mysql_error());
  $row_prodd = mysql_fetch_assoc($prodd);
  $valor=number_format($row_prod['valor'], 2);
  $descuento=number_format($row_prod['dscto'], 2);
  $total=number_format($row_prod['total'], 2);
  
  $mensaje.= "  
    <label>$row_prodd[cant_dev]</label>
    </td>
    <td align='center' >
    <label>$valor</label>
    </td>
    <td align='center' >
    <label>$descuento</label>
    </td>
    <td align='center' >
    <label>$total</label>
    </td> ";
    
	$i++;
  }
  $devo_tal=number_format($row_devo['total'], 2);
$mensaje.= "  
  </tr>
</table>
<table width='90%' align='center' id='tb_cost'>
  <tr align='center'>
    <td width='20%' bgcolor='#F0F0F0'>Descuentos</td>
    <td width='30%' ><label class='red'>$row_fact[dscto]</label></td>
    <td width='20%' bgcolor='#F0F0F0'>SUBTOTAL</td>
    <td width='30%' ><label id='lb_sub' class='red'></label></td>
  </tr>
  <tr align='center'>
    <td width='20%' bgcolor='#F0F0F0'>Items</td>
    <td width='30%' ><label id='lb_itemst' class='red'> $row_fact[total_items]</label></td>
    <td width='20%' bgcolor='#F0F0F0'>IVA</td>
    <td width='30%' ><label id='lb_iva' class='red'></label></td>
  </tr>
  <tr  align='center'>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align='center' bgcolor='#F0F0F0'>TOTAL</td>
    <td ><label id='lb_total' class='red'>$devo_tal</label></td>
  </tr>
</table>
<table width='90%' align='center' id='tb_footer'>
  <tr>
    <td align='center'>
    <label class='sub'>
   Resolución DIAN No $row_hd[resol] Con vigencia desde $row_hd[f_vigi] hasta $row_hd[f_vigf] <br>
    Nota: $row_hd[empresa] Acepta únicamente el cambio o devolución de los productos en un plazo máximo de 30 días despues de la compra, es indispensable la presentación de la factura de compra.
    </label>
    </td>
  </tr>

</table>
<table width='90%' align='center' id='tb_footer'>
 
  <tr>
    <td align='center' >Copyright © 2014 $row_hd[empresa] - All Rights Reserved. Designed by ID Solutions Group S.A.S
    </td>
  </tr>
</table>
</div>";

//$sBCC='jair.quinto@idsolutions-group.com'; //me envio una copia oculta
$cabeceras  = 'From: VENTAS <jair.quinto@solucionesscol.com>'."\r\n"; 
$cabeceras .= "BCC: <$sBCC>\n"; //aqui fijo el BCC 
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
mail("$correo_url","$empresa", $mensaje, $cabeceras);
//echo $correo_url=$_POST['m']; 
  echo "exitoso";
}
?>