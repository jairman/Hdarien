<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

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
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
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

<form id="form1" name="form1">
<table width="90%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">&nbsp;
     
    </td>
    <td width="7%" align="left"><img  title="Imprimir" src="../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')"/></td>
  </tr>
</table>
<div id="recargar2">

<table width="90%" align="center" id="tb_header">
  <tr>
    <td rowspan="3" width="34%"><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
    <td rowspan="2" align="center" width="33%">
    <label class="sub">
	<?php
	//echo '-'.$ptov_url.'-';
    if ($ptov_url == 'Laureles'){
		echo 'Wanitta laureles <br> 
		Carrera 73 # circular 1 - 23 . Laureles <br>
		Telefono : 2504478';
	}
	if ($ptov_url == 'Centro'){
		echo 'Wanitta metropolis <br>
		Calle 46 # 53-72 , local 331, centro comercial paseo real metropolis. <br>
		Telefono : 5141845';
	}
	if ($ptov_url == 'Lleras'){
		echo 'Wanitta lleras <br>
		Carrera 37 # 8a - 32 <br>
		Telefono : 3115756';
	}
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
	<?php
	//echo '-'.$ptov_url.'-';
    if ($ptov_url == 'Laureles'){
		echo 'Nit: 1128264152';
	}
	if ($ptov_url == 'Centro'){
		echo 'Nit: 1128264152-1';
	}
	if ($ptov_url == 'Lleras'){
		echo 'Nit: 32540178-5';
	}
	?>
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
  	<td width="20%" class="bold">Cedula/Nit</td>
    <td width="30%" class="cont">
    <label><?php echo $nit = $row_fact['ced']?></label>
    </td>
    <td width="20%" class="bold">Cliente</td>
    <td width="30%" class="cont">
    <label><?php echo $row_fact['cliente']?></label>
    </td>
    
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <?php
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir)
    ?>
    <td class="cont"><label><?php echo $row_dir['dir']?></label></td>
    <td class="bold">Telefono</td>
    <td class="cont"><label><?php echo $row_fact['telefono']?></label></td>
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
    <td colspan="6">Detalle de Venta</td>
  </tr>
  <tr align="center" class="tittle">
    <td width="20%">Referencia</td>
    <td width="30%">Descripción</td>
    <td width="13%">Cantidad</td>
    <td width="12%">Precio</td>
    <td width="13%">Descuento</td>
    <td width="12%">Valor</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr id="fila_<?php echo $i?>">
    <td class="cont">
    <label><?php echo $ref = $row_prod['ref']?></label>
	</td>
    <td class="cont">
	<?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det)
    ?>
    <label><?php echo $row_det['desc']?></label>
    </td>
    <td class="cont">
    <label><?php echo $row_prod['cant']?></label>
    </td>
    <td class="cont">
    <label><?php echo number_format($row_prod['valor'], 2)?></label>
    </td>
    <td class="cont">
    <label><?php echo number_format($row_prod['dscto'], 2)?></label>
    </td>
    <td class="cont">
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
    <td width="30%" class="cont"><label class="red"><?php echo number_format($row_fact['dscto'], 2)?></label></td>
    <td width="20%" class="bold">SUBTOTAL</td>
    <td width="30%" class="cont"><label class="red"><?php echo number_format($row_fact['sub_total'], 2)?></label></td>
  </tr>
  <tr align="center">
    <td width="20%" class="bold">Items</td>
    <td width="30%" class="cont"><label id="lb_itemst" class="red"><?php echo $row_fact['total_items']?></label></td>
    <td width="20%" class="bold">IVA</td>
    <td width="30%" class="cont"><label class="red"><?php echo number_format($row_fact['iva'], 2)?></label></td>
  </tr>
  <tr  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">TOTAL</td>
    <td class="cont"><label id="lb_total" class="red"><?php echo number_format($row_fact['tot_final'], 2)?></label></td>
  </tr>
</table>
<table width="90%" border="1" align="center" cellspacing="0">
<tr align="center" bgcolor="#54B948" style="color: #000">
<td colspan="3" align="center"  class="tittle"><p>Relación De Pagos</p></td>
</tr>
<tr align="center" bgcolor="#4D68A2" class="tittle" style="color: #FFF">
<td style="font-family: Helvetica">Total ($)</td>
<td style="font-family: Helvetica">Total Abonos ($)</td>
<td width="366" style="font-family: Helvetica">Saldo ($)</td>
</tr>
<tr align="center" bgcolor="#E5F1D4" class="bold" style="color: #FFF">
<th bgcolor="#FFFFFF" style="font-family: Helvetica"><span style="color: #000"><?php echo $tal; ?></span></th>
<th bgcolor="#FFFFFF" style="color: #000"><?php echo $total_abono; ?></th>
<th bgcolor="#FFFFFF" style="color: #000"><?php echo $saldo; ?></th>
</tr>
<tr align="center" >
<td colspan="3" class="tittle" style="font-family: Helvetica">Detalle de Abonos</td>
</tr>
<tr align="center" bgcolor="#4D68A2" class="tittle" style="color: #FFF">
<td style="font-family: Helvetica">Comentario</td>
<td style="font-family: Helvetica">Abono</td>
<td style="font-family: Helvetica">Fecha De Abono</td>
</tr>
<?php do { ?>
<tr align="center" class="row">
<td style="font-family: Helvetica" ><?php echo $row_abon['empre']; ?></td>
<td style="font-family: Helvetica" ><?php echo number_format($row_abon['abono']); ?></td>
<td style="font-family: Helvetica" ><?php echo $row_abon['fecha']; ?></td>
</tr>
<?php } while ($row_abon = mysql_fetch_assoc($abon)); ?>
</table>
<p>&nbsp;</p>
<table width="90%" align="center" id="tb_footer">
  <tr>
    <td align="center">
    <label class="subtitle" style="font-size:10px">
    <?php
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
	?>
    </label>
    </td>
  </tr>
  <tr>
    <td align="center" >
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.parent.Shadowbox.close();">
    </td>
  </tr>
</table>
</div>
</form>
</body>
<script>

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
} 

</script>
</html>
<?php
}
?>