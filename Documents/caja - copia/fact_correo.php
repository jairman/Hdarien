<?php //require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

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

$ptov_url=$_GET['p'];

$consec_url=$_GET['c'];
//-----------------------------------------Empresa-----------------------------------------------------------------------
	mysql_select_db($database_conexion, $conexion);
	@$query_clien = sprintf("SELECT * FROM d89xz_empresa ", GetSQLValueString($colname_clien, "text"));
	$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
	$row_clien = mysql_fetch_assoc($clien);
	$totalRows_clien = mysql_num_rows($clien);
	$color=$row_clien['color'];
//______________________________________________________________________________________________________


mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	
$cedula_cli=$row_fact['ced'];

$i = 1;
//------------------------------Abonos-----------------------------------------------------------------
@$hacienda = $_GET['p'];
$factura = $_GET['factura'];
@$colname_abon = "-1";
if (isset($_GET['factura'])) {
$colname_abon = $_GET['factura'];
}
mysql_select_db($database_conexion, $conexion);
$query_abon = sprintf("SELECT * FROM d89xz_abonos WHERE hacienda='$hacienda'and  orden = %s ORDER BY orden DESC", GetSQLValueString($colname_abon, "text"));
$abon = mysql_query($query_abon, $conexion) or die(mysql_error());
$row_abon = mysql_fetch_assoc($abon);
$totalRows_abon = mysql_num_rows($abon);



@$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE  hacienda='$hacienda'and`factura` = '$factura'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
$tal = number_format(abs($tal1));

//el total de abonos

@$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE hacienda='$hacienda'and `orden` = '$factura'"); 
$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
$total_abono1=$row_abono['total'];
$total_abono2= abs($total_abono1);

$total_abono = number_format($total_abono1);

// Saldo
	$saldo1 = $tal1 - $total_abono1;
  $saldo =  number_format($saldo1);
	
	



?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Facturación</title>



</head>


<body>

<?php
$mensaje = "  
<input type='hidden' id='tf_user' value='$usuario2'>
<input type='hidden' id='tf_user2' value=' $usuario '>


<div id='dialog'></div>

<table width='90%' align='center' id='table_header'>
  <tr>
    <td width='93%' align='left'>&nbsp;
     
    </td>
    <td width='7%' align='left'>  </td>
  </tr>
</table>
<div id='recargar2'>

<table width='90%' align='center' id='tb_header'>
  <tr>
    <td rowspan='3' width='34%' class='print'><img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' alt='logo' name='logo' width='200' height='70' id='logo' /></td>
    <td rowspan='2' align='center' width='33%'>
    <label class='sub p1'>
		";
		
	
    mysql_select_db($database_conexion, $conexion);
	$query_hd = "SELECT * FROM d89xz_hacienda where `hacienda`='$hacienda'";
	$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
	$row_hd = mysql_fetch_assoc($hd);
	$empresa=$row_hd['empresa'];
	
	
  $mensaje.= "  $row_hd[empresa]<br>
    					 $row_hd[telefono]
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
    <td align='center' class='print 1'>Fecha: <label id='lb_fecha' class='p2'> $row_fact[fecha]</label></td>
  </tr>
</table>

<table width='90%' align='center' id='tb_cdata'>
  <tr class='tittle print'>
    <td colspan='4' align='center' ><label style='font-size:18px'>Información de Venta</label></td>
  </tr>
  <tr>
  	<td class='bold' bgcolor='#F0F0F0'>Punto de Venta</td>
  	<td class='cont'><label class='p2'>$row_hd[empresa]</label></td>
    <td class='bold print'  bgcolor='#F0F0F0'>Tipo</td>
    <td class='cont print'><label> $row_fact[tipo]</label></td>
  </tr>
  <tr>
  	<td width='20%' class='bold print'  bgcolor='#F0F0F0'>NIT</td>
    <td width='30%' class='cont print'>
    <label>$nit $row_fact[ced]</label>
    </td>
    <td width='20%' class='bold'  bgcolor='#F0F0F0'>Cliente</td>
    <td width='30%' class='cont'>
    <label class='p2'>$row_fact[cliente]</label>
    </td>
    
  </tr>
  <tr>
    <td class='bold print'  bgcolor='#F0F0F0'>Dirección</td>
		
		";
		
    
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$cedula_cli'AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir);
		//echo "siiiii".$row_dir['mail'];
   
	 
	 
	 
	 
$mensaje.="	 
    <td class='cont print'><label>$row_dir[dir]</label></td>
    <td class='bold print' bgcolor='#F0F0F0'>Telefono</td>
    <td class='cont print'><label>$row_fact[telefono]</label></td>
  </tr>
  <tr>
  	<td class='bold print' bgcolor='#F0F0F0'>Forma de Pago</td>
    <td class='cont print'><label>$row_fact[forma_pago]</label></td>
    <td class='bold print' bgcolor='#F0F0F0'>Fecha Pago</td>
    <td class='cont print'><label>$row_fact[fecha_p]</label></td>
  </tr>
</table>";

$mensaje.="	

<table width='90%' align='center' id='tb_prod'>
  <tr align='center' class='tittle print'>
    <td colspan='6' align='center' bgcolor=' $color'  style='color: #FFF'>Detalle de Venta</td>
  </tr>
  <tr align='center' bgcolor='$color'  style='color: #FFF'>
    <td width='20%' class='print'>Referencia</td>
    <td width='20%'>Descripción</td>
    <td width='20%'>Cantidad</td>
    <td width='20%' class='print'>Precio</td>
    <td width='20%'>Valor</td>
  </tr>
  ";
	
	
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
 		$ref=$row_prod['ref'];
 
 
 $mensaje.= "
  <tr id='fila_$i' class='p2'>
    <td class='cont print' align='center'><label>$row_prod[ref]</label>
	</td>
    <td class='cont'>
		";
		
		
	
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
   $row_det = mysql_fetch_assoc($det);
   $mediovalor = number_format($row_prod['valor'], 2);
	 $mediototal=number_format($row_prod['total'], 2);
	// echo "descr". $row_det[desc];
	 
	 $mensaje.= "
	 
    <label>$row_det[desc]</label>
    </td>
    <td align='center' class='cont'>
    <label>$row_prod[cant]</label>
    </td >
    <td class='cont print' align='center'>
    <label>$mediovalor</label>
    </td>
    <td align='center' class='cont'>
    <label>$mediototal</label>
    </td>
		";
		 
    
	$i++;
  }
	$findescu=number_format($row_fact['dscto'], 2);
	$finsubtotal=number_format($row_fact['sub_total'], 2);
	$fintotaliva=number_format($row_fact['iva'], 2);
	$fintotalfinal=number_format($row_fact['tot_final'], 2);
	$mensaje.= " 
  </tr>
</table>
<table width='90%' align='center' id='tb_cost'>
  <tr align='center'>
    <td width='20%' class='bold' bgcolor='#F0F0F0'>Descuentos</td>
    <td width='30%' class='cont'><label class='red p2'>$findescu</label></td>
    <td width='20%' class='bold' bgcolor='#F0F0F0'>SUBTOTAL</td>
    <td width='30%' class='cont'><label class='red p2'>$finsubtotal</label></td>
  </tr>
  <tr align='center'>
    <td width='20%' class='bold' bgcolor='#F0F0F0'>Items</td>
    <td width='30%' class='cont'><label id='lb_itemst' class='red p2'>$row_fact[total_items]</label></td>
    <td width='20%' class='bold' bgcolor='#F0F0F0'>IVA</td>
    <td width='30%' class='cont'><label class='red p2'>$fintotaliva</label></td>
  </tr>
  <tr  align='center'>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align='center' class='bold'>TOTAL</td>
    <td class='cont'><label id='lb_total' class='red p2'>$fintotalfinal</label></td>
  </tr>
</table>
<table width='90%' align='center' id='tb_footer'>
  <tr>
    <td align='center'><label class='sub'>Resolución DIAN No $row_hd[resol]</label></td>
  </tr>
  <tr>
    <td align='center' >
    </td>
  </tr>
</table>




<table width='90%'  align='center'>
<tr align='center' bgcolor='$color' style='color: #000'>
<td colspan='3' align='center'  bgcolor='$color'  style='color: #FFF'>Relación De Pagos</td>
</tr>
<tr align='center' bgcolor=' $color' class='tittle' style='color: #FFF'>
<td style='font-family: Helvetica'>Total ($)</td>
<td style='font-family: Helvetica'>Total Abonos ($)</td>
<td width='366' style='font-family: Helvetica'>Saldo ($)</td>
</tr>
<tr align='center' bgcolor='#E5F1D4' class='bold' style='color: #FFF'>
<th bgcolor='#FFFFFF' style='font-family: Helvetica'><span style='color: #000'> $tal </span></th>
<th bgcolor='#FFFFFF' style='color: #000'> $total_abono</th>
<th bgcolor='#FFFFFF' style='color: #000'> $saldo </th>
</tr>
<tr align='center' >
<td colspan='3' bgcolor=' $color'  style='color: #FFF'>Detalle de Abonos</td>
</tr>
<tr align='center' bgcolor=' $color'  style='color: #FFF'>
<td style='font-family: Helvetica'>Comentario</td>
<td style='font-family: Helvetica'>Abono</td>
<td style='font-family: Helvetica'>Fecha De Abono</td>
</tr>
";



 do { 
 	$secabono=number_format($row_abon['abono']);
 $mensaje.= "
 
			<tr align='center' class='row'>
			<td style='font-family: Helvetica' >$row_abon[empre]</td>
			<td style='font-family: Helvetica' >$secabono </td>
			<td style='font-family: Helvetica' >$row_abon[fecha] </td>
			</tr>
	";

 } while ($row_abon = mysql_fetch_assoc($abon)); 
 
$mensaje.= "
</table>
<p>&nbsp;</p>

<table width='90%' align='center' id='tb_footer'>
 
  <tr>
    <td align='center' >Copyright © 2014 $row_hd[empresa] - All Rights Reserved. Designed by ID Solutions Group S.A.S
    </td>
  </tr>
</table>
</div>
</form>
</body>

</html>";

$email =$row_dir['mail'];

$sBCC="jair.quinto@idsolutions-group.com"; //me envio una copia oculta


$cabeceras  = 'From: VENTAS <jair.quinto@solucionesscol.com>'."\r\n"; 
$cabeceras .= "BCC: <$sBCC>\n"; //aqui fijo el BCC 
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
     
//Se manda el correo 
//mail("$docu1","Orden De Compra Importamos Todo", $mensaje, $cabeceras);  
mail($email,"$empresa", $mensaje, $cabeceras); 

?>
<?php
echo"<script language='javascript'> parent.location.reload();</script>;"
	?>