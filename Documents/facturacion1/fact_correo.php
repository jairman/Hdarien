<?php //require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>

<?php

	
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
$correo_url=($_POST['m']);

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	
//-----------------------------------------Empresa-----------------------------------------------------------------------
	mysql_select_db($database_conexion, $conexion);
	@$query_clien = sprintf("SELECT color,mail FROM d89xz_empresa ", GetSQLValueString($colname_clien, "text"));
	$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
	$row_clien = mysql_fetch_assoc($clien);
	$totalRows_clien = mysql_num_rows($clien);
	$color=$row_clien['color'];
	$remitente=$row_clien["mail"];
//______________________________________________________________________________________________________
$i = 1;
?>

<?php
$mensaje = "  
<style>
.sub{
	font-size:12px;
	font-weight:bold}
</style>

<input type='hidden' id='tf_user' value='$usuario2'>
<input type='hidden' id='tf_user2' value='$usuario'>
<div id='dialog'></div>

<table width='90%' align='center' id='table_header'>
  <tr>
    <td width='89%' align='left'>&nbsp;</td>
    <td width='6%' align='center'>&nbsp;</td>
    <td width='5%' align='left'>&nbsp;</td>
  </tr>
</table>


<table width='90%' align='center' id='tb_header'>
  <tr>
    <td rowspan='3' width='34%' class='print'><img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' width='200' height='70' id='logo' /></td>
    <td rowspan='2' align='center' width='33%'>
    <label class='sub p1'>";
	

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
    <td align='center' width='33%' class='print 1'><label class='sub p2'>FACTURA DE VENTA</label></td>
  </tr>
  <tr>
    <td align='center' class='print 1'>
    <div id='d_consec'>
    No: <label id='lb_consec' class='red p2'>$consec_url</label>
    </div>
    </td>
  </tr>
  <tr>
    <td align='center'>
    <label class='sub p1'>
    NIT: $row_hd[nit]
    </label>
    </td>
    <td align='center' class='print 1'>Fecha: <label id='lb_fecha' class='p2'>$row_fact[fecha]</label></td>
  </tr>
</table>

<table width='90%' align='center' id='tb_cdata'>
  <tr >
    <td colspan='4' bgcolor='$color'  style='color: #FFF' align='center'><label style='font-size:18px'>Información de Venta</label></td>
  </tr>
  <tr>
  	<td bgcolor='#F0F0F0'>Punto de Venta</td>
  	<td class='cont'><label class='p2'> $ptov_url</label></td>
    <td bgcolor='#F0F0F0'>Tipo</td>
    <td class='cont print'><label>$row_fact[tipo]</label></td>
  </tr>
  <tr>
  	<td width='20%' bgcolor='#F0F0F0'>NIT</td>
    <td width='30%' class='cont print'>
    <label>$row_fact[ced]</label>
    </td>
    <td width='20%' bgcolor='#F0F0F0'>Cliente</td>
    <td width='30%' class='cont'>
    <label class='p2'>$row_fact[cliente]</label>
    </td>
    
  </tr>
  <tr>
    <td bgcolor='#F0F0F0'>Dirección</td>";
    $nit = $row_fact['ced'];
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir);
    
    
$mensaje.= "     
    <td ><label>$row_dir[dir]</label></td>
    <td bgcolor='#F0F0F0'>Telefono</td>
    <td ><label>$row_dir[telefono]</label></td>
  </tr>
  <tr>
  	<td bgcolor='#F0F0F0'>Forma de Pago</td>
    <td ><label> $row_fact[forma_pago]</label></td>
    <td bgcolor='#F0F0F0'>Fecha Pago</td>
    <td ><label> $row_fact[fecha_p]</label></td>
  </tr>
</table>

<table width='90%' align='center' id='tb_prod'>
  <tr align='center' >
    <td colspan='6'bgcolor=' $color'  style='color: #FFF' align='center'>Detalle de Venta</td>
  </tr>
  <tr align='center'  >
    <td width='20%' bgcolor=' $color'  style='color: #FFF' align='center'>Referencia</td>
    <td width='20%' bgcolor=' $color'  style='color: #FFF' align='center'>Descripción</td>
    <td width='20%'bgcolor=' $color'  style='color: #FFF' align='center'>Cantidad</td>
    <td width='20%' bgcolor=' $color'  style='color: #FFF' align='center'>Precio</td>
    <td width='20%' bgcolor=' $color'  style='color: #FFF' align='center'>Valor</td>
  </tr>";
  
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
	$ref = $row_prod["ref"];
	
$mensaje.= "
  
  <tr id='fila_ $i' class='p2'>
    <td class='cont print'>
    <label>$row_prod[ref]</label>
	</td>
    <td >";
	
	
	
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det);
	$valor=number_format($row_prod['valor'], 2);
	$totall=number_format($row_prod["total"], 2);

$mensaje.= "
    
    <label> $row_det[desc]</label>
    </td>
    <td align='center' class='cont'>
    <label> $row_prod[cant]</label>
    </td>
    <td >
    <label>$valor </label>
    </td>
    <td align='center' class='cont'>
    <label>$totall</label>
    </td>"; 
	
    
	$i++;
  }
  $descuento=number_format($row_fact["dscto"], 2);
  $subtotal=number_format($row_fact["sub_total"], 2);
  $iva=number_format($row_fact["iva"], 2);
  $tot_final=number_format($row_fact["tot_final"], 2);
$mensaje.= "	  
  </tr>
</table>
<table width='90%' align='center' id='tb_cost'>
  <tr align='center'>
    <td width='20%' bgcolor='#F0F0F0'>Descuentos</td>
    <td width='30%' class='cont'><label class='red p2'> $descuento</label></td>
    <td width='20%' bgcolor='#F0F0F0'>SUBTOTAL</td>
    <td width='30%' class='cont'><label class='red p2'>$subtotal</label></td>
  </tr>
  <tr align='center'>
    <td width='20%' bgcolor='#F0F0F0'>Items</td>
    <td width='30%' class='cont'><label id='lb_itemst' class='red p2'> $row_fact[total_items]</label></td>
    <td width='20%' bgcolor='#F0F0F0'>IVA</td>
    <td width='30%' class='cont'><label class='red p2'>$iva</label></td>
  </tr>
  <tr  align='center'>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align='center' bgcolor='#F0F0F0'>TOTAL</td>
    <td class='cont'><label id='lb_total' class='red p2'>$tot_final</label></td>
  </tr>
</table>
<table width='90%' align='center' id='tb_footer'>
  <tr>
    <td align='center'>";
 
 
 $mensaje.= "	   
    Resolución DIAN No $row_hd[resol] Con vigencia desde $row_hd[f_vigi] hasta $row_hd[f_vigf] <br>
    Nota: $row_hd[empresa] Acepta únicamente el cambio o devolución de los productos en un plazo máximo de 30 días despues de la compra, es indispensable la presentación de la factura de compra";
 $mensaje.= "   
    </td>
  </tr>
  <tr>
    <td align='center' >&nbsp;</td>
  </tr>
</table>
<table width='90%' align='center' id='tb_footer'>
 
  <tr>
    <td align='center' >Copyright © 2014 $row_hd[empresa] - All Rights Reserved. Designed by ID Solutions Group S.A.S
    </td>
  </tr>
</table>
";





//$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
/*$cabeceras= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras.= 'From:FACTURA DE VENTAS <jairman303@hotmail.com>\r\n'; 
$cabeceras.= 'Bcc:$correo_url\r\n';  
$cabeceras.= 'Cc:$remitente\r\n';*/ 

// título
$título =$empresa;
// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
//$cabeceras .= 'To: Mary <jairman301@hotmail.com>' . "\r\n";
$cabeceras .= 'From: FACTURA DE VENTAS<jair.quinto@idsolutions-group.com>' . "\r\n";
//$cabeceras.= 'Cc:$remitente'."\r\n";
//$cabeceras .= 'Bcc: tokinmym2@gmail.com\r\n';
//'Cc: algunamigo@gmail.com' . "\r\n

// Enviarlo
if (mail($correo_url, $título, $mensaje, $cabeceras)){

//if(mail($correo_url, $empresa, $mensaje, $cabeceras)){ 
			//echo $correo_url=$_POST['m'].'REMITENTE'.$remitente;
			echo "exitoso";
	}else{
		
			echo "Nooooexitoso";
	}
 
 
 
 


//$email =$row_dir['mail'];


     
//Se manda el correo 
//mail("$docu1","Orden De Compra Importamos Todo", $mensaje, $cabeceras);  




?>


