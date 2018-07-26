<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<!--<style>
.modal {
    display:    block;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 0, 0, 0, .8 ) 
                url('../img/loading.gif') 
                50% 50% 
                no-repeat;
}
</style>-->




<?php


date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$c_date = date('Y-m-d');

$ptov_url=$_GET['p'];

$consec_url=$_GET['c'];

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	

$i = 1;
//------------------------------Abonos-----------------------------------------------------------------
@$hacienda = $_GET['p'];
$factura = $_GET['factura'];
@$colname_abon = "-1";
if (isset($_GET['factura'])) {
$colname_abon = $_GET['factura'];
}
mysql_select_db($database_conexion, $conexion);
@$query_abon = sprintf("SELECT * FROM d89xz_abonos WHERE hacienda='$hacienda'and  orden = %s ORDER BY orden DESC", GetSQLValueString($colname_abon, "text"));
$abon = mysql_query($query_abon, $conexion) or die(mysql_error());
$row_abon = mysql_fetch_assoc($abon);
$totalRows_abon = mysql_num_rows($abon);



@$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE  hacienda='$hacienda'and`factura` = '$factura'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
$tal = number_format(abs($tal1));

//el total de abonos
$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE hacienda='$hacienda'and `orden` = '$factura'"); 
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
<!--<div class="modal"></div>-->

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
    <td rowspan='3' width='34%' class='print'><img src='http://idsaga.com/administrativo/Documents/img/Logo.png' alt='logo' name='logo' width='200' height='70' id='logo' /></td>
    <td rowspan='2' align='center' width='33%'>
    <label class='sub p1'>
		";
		
	
    mysql_select_db($database_conexion, $conexion);
	$query_hd = 'SELECT * FROM d89xz_empresa';
	$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
	$row_hd = mysql_fetch_assoc($hd);
	
	
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
    <td colspan='4'><label style='font-size:18px'>Información de Venta</label></td>
  </tr>
  <tr>
  	<td class='bold'>Punto de Venta</td>
  	<td class='cont'><label class='p2'>$ptov_url</label></td>
    <td class='bold print'>Tipo</td>
    <td class='cont print'><label><?php echo $row_fact[tipo]?></label></td>
  </tr>
  <tr>
  	<td width='20%' class='bold print'>NIT</td>
    <td width='30%' class='cont print'>
    <label>$nit $row_fact[ced]</label>
    </td>
    <td width='20%' class='bold'>Cliente</td>
    <td width='30%' class='cont'>
    <label class='p2'>$row_fact[cliente]</label>
    </td>
    
  </tr>
  <tr>
    <td class='bold print'>Dirección</td>
		
		";
		
    
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir);
   
	 
	 
	 
	 
$mensaje.="	 
    <td class='cont print'><label>$row_dir[dir]</label></td>
    <td class='bold print'>Telefono</td>
    <td class='cont print'><label>$row_fact[telefono]</label></td>
  </tr>
  <tr>
  	<td class='bold print'>Forma de Pago</td>
    <td class='cont print'><label>$row_fact[forma_pago]</label></td>
    <td class='bold print'>Fecha Pago</td>
    <td class='cont print'><label>$row_fact[fecha_p]</label></td>
  </tr>
</table>";

$mensaje.="	

<table width='90%' align='center' id='tb_prod'>
  <tr align='center' class='tittle print'>
    <td colspan='6'>Detalle de Venta</td>
  </tr>
  <tr align='center' class='stittle'>
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
 
 
 
 $mensaje.= "
  <tr id='fila_$i' class='p2'>
    <td class='cont print' align='center'><label>$ref  $row_prod[ref]</label>
	</td>
    <td class='cont'>
		";
		
		
	
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
   $row_det = mysql_fetch_assoc($det);
   $mediovalor = number_format($row_prod['valor'], 2);
	 $mediototal=number_format($row_prod['total'], 2);
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
    <td width='20%' class='bold'>Descuentos</td>
    <td width='30%' class='cont'><label class='red p2'>$findescu</label></td>
    <td width='20%' class='bold'>SUBTOTAL</td>
    <td width='30%' class='cont'><label class='red p2'>$finsubtotal</label></td>
  </tr>
  <tr align='center'>
    <td width='20%' class='bold'>Items</td>
    <td width='30%' class='cont'><label id='lb_itemst' class='red p2'>$row_fact[total_items]</label></td>
    <td width='20%' class='bold'>IVA</td>
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
    <td align='center'>
    <label class='sub'>
    Resolución DIAN No xxxxxxx de xxx xx xxxx
    </label>
    </td>
  </tr>
  <tr>
    <td align='center' >
    </td>
  </tr>
</table>




<table width='90%' border='0' align='center' cellspacing='0'>
<tr align='center' bgcolor='#4D68A2' style='color: #000'>
<td colspan='3' align='center'  class='tittle' style='color: #000'>Relación De Pagos</td>
</tr>
<tr align='center' bgcolor='#4D68A2' class='tittle' style='color: #FFF'>
<td style='font-family: Helvetica'>Total ($)</td>
<td style='font-family: Helvetica'>Total Abonos ($)</td>
<td width='366' style='font-family: Helvetica'>Saldo ($)</td>
</tr>
<tr align='center' bgcolor='#E5F1D4' class='bold' style='color: #FFF'>
<th bgcolor='#FFFFFF' style='font-family: Helvetica'><span style='color: #000'> $tal; </span></th>
<th bgcolor='#FFFFFF' style='color: #000'> $total_abono</th>
<th bgcolor='#FFFFFF' style='color: #000'> $saldo </th>
</tr>
<tr align='center' >
<td colspan='3' class='tittle' style='font-family: Helvetica'>Detalle de Abonos</td>
</tr>
<tr align='center' bgcolor='#4D68A2' class='tittle' style='color: #FFF'>
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
    <td align='center'>
    <label class='subtitle' style='font-size:10px'>
   
	 ";
	 
	//echo '-'.$ptov_url.'-';
	
	
    if ($ptov_url == 'Laureles'){
		echo 'Resolución DIAN No 110000557012 noviembre 25 , 2013';
	}
	if ($ptov_url == 'Centro'){
		echo 'Resolución DIAN No 110000568103 febrero 19 , 2014 ';
	}
	if ($ptov_url == 'Lleras'){
		echo 'Resolución DIAN No 110000426845';
	}
	$mensaje.= "
    </label>
    </td>
  </tr>
  <tr>
    <td align='center' >
    </td>
  </tr>
</table>
</div>
</form>
</body>

</html>";

$email ='jair.quinto@solucionesscol.com';
//$sBCC="azapata@profesionalesenimportacion.com"; //me envio una copia oculta
$sBCC="jair.quinto@solucionesscol.com"; //me envio una copia oculta
//$sBCC="jair.quinto@solucionesscol.com"; //me envio una copia oculta

$cabeceras  = 'From: ID Solutions <jair.quinto@solucionesscol.com>'."\r\n"; 
$cabeceras .= "BCC: <$sBCC>\n"; //aqui fijo el BCC 
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
     
//Se manda el correo 
//mail("$docu1","Orden De Compra Importamos Todo", $mensaje, $cabeceras);  
mail("jairman301@hotmail.com","ID Solutions", $mensaje, $cabeceras); 

?>

<?php
		echo "<script type=''>
				parent.location.reload();
			</script>";
	?>