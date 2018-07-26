<?php //require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

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
$c_date = date('Y-m-d');

$consec_url=$_POST['c'];

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_despachos` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	


$i = 1;
//-----------------------------------------Empresa-----------------------------------------------------------------------
	
	mysql_select_db($database_conexion, $conexion);
	@$query_clien = sprintf("SELECT * FROM d89xz_empresa ", GetSQLValueString($colname_clien, "text"));
	$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
	$row_clien = mysql_fetch_assoc($clien);
	$totalRows_clien = mysql_num_rows($clien);
	$color=$row_clien['color'];
	$remitente=$row_clien["mail"];
//______________________________________________________________________________________________________
	$ced=$row_fact['punto_venta'];
	mysql_select_db($database_conexion, $conexion);
	@$query_prove ="SELECT * FROM wani_users where usertype2='$ced'";
	$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
	$row_prove = mysql_fetch_assoc($prove);
	$totalRows_prove = mysql_num_rows($prove);
	$email=$row_prove['email'];
	
//_______________________________________________________________________________________________________
	$punto=$row_fact['punto_venta'];	
	mysql_select_db($database_conexion, $conexion);
	$query_hd = "SELECT * FROM d89xz_hacienda where `hacienda`='$punto'";
	$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
	$row_hd = mysql_fetch_assoc($hd);
	$empresa=$row_hd['empresa'];


$mensaje = " 
<!doctype html>
<html>
<head>
<meta charset='UTF-8'>
</head>

<body>

<input type='hidden' id='tf_user' value='$usuario2'>
<input type='hidden' id='tf_user2' value='$usuario'>
<input type='hidden' id='tf_i' value='$i'>
<input type='hidden' id='tf_consecf' >
<input type='hidden' id='tf_exist' >


<table width='98%' align='center' id='table_header'>
    <tr>
      <td align='left' width='93' >
      <img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' alt='logo' name='logo' width='200' height='70' id='logo' />
      </td>
      <td width='7%' align='left'>&nbsp;</td>
    </tr>
</table>
<table width='98%'  align='center' cellspacing='0'>
  <tr >
    <td colspan='4' align='center' bgcolor='$color'  style='color: #FFF'>Despachos</td>
  </tr>
  <tr>
    <td width='15%' align='left' bgcolor='#F0F0F0' >Consecutivo</td>
    <td width='35%' align='center' >
    <label class='red' id='lb_consec'><?php echo $consec_url?></label>
    </td>
    <td width='15%' align='left' bgcolor='#F0F0F0'>Fecha</td>
    <td width='35%' align='center' ><label id='lb_fecha'>$row_fact[fecha]</label></td>
  </tr>
  <tr>
    <td align='left' bgcolor='#F0F0F0' >Tipo Movimiento</td>
    <td align='center' >
    <label id='sl_tipo'>Despacho</label>
    </td>
    <td width='15%' align='left' bgcolor='#F0F0F0'>Origen</td>
    <td width='35%' align='center' >$row_fact[punto_ini]</td>
  </tr>
  <tr>
  	<td align='left' bgcolor='#F0F0F0'>Destino</td>
    <td align='center' >$row_fact[punto_venta]</td>
    <td align='left' bgcolor='#F0F0F0' >Observaciones</td>
    <td align='center' >$row_fact[obs]</td>
  </tr>
</table>
<table width='98%'  align='center' cellspacing='0' id='tb_detail'>
  <tr >
    <!--<td width='15%'>Cod. Barras</td>-->
    <td width='20%' bgcolor='$color'  style='color: #FFF'>Referencia</td>
    <td width='15%' bgcolor='$color'  style='color: #FFF'>Descripcion</td>
    <td width='15%' bgcolor='$color'  style='color: #FFF'>talla</td>
    <td width='15%' bgcolor='$color'  style='color: #FFF'>Marca</td>
    <td width='15%' bgcolor='$color'  style='color: #FFF'>Costo</td>
    <td width='20%' bgcolor='$color'  style='color: #FFF'>Cantidad</td>
  </tr>";
  
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `consec`='$consec_url' 
  AND `mov`='d' AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
	  $ref = $row_prod['ref'];
$mensaje.="
  
  <tr id='fila_$i'>
    <td align='center'> $ref</td>
    <td align='center'>";
	
    
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det);
   
$mensaje.="
		 $row_det[desc]</td>
    <td align='center'>$row_det[talla]</td>
    <td align='center'>$row_det[marca]</td>
    <td align='center'>$row_prod[costo]</td>
    <td align='center'>$row_prod[cant]</td>
  </tr>";
 
  	$i++;
  }
$mensaje.="
</table>
<table width='98%'  align='center' cellspacing='0'>
	<tr>
  	<td width='20%' >Total Items</td>
    <td width='30%' ><label id='lb_toti'>$row_fact[cant]</label></td>
    <td width='20%' >Total</td>
    <td width='30%' ><label id='lb_totc' >$row_fact[costo]</label></td>
  </tr>
    <td align='center' colspan='4'>
    
    &nbsp;</td>
</table>

</body>
</html>
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
$título =$empresa;
// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras .= 'From: DESPACHO<'.$remitente.'>' . "\r\n";
	mail($email, $título, $mensaje, $cabeceras);
if (mail($remitente, $título, $mensaje, $cabeceras)){
			echo "exitoso";
	}else{
		
			echo "Nooooexitoso";
	}
