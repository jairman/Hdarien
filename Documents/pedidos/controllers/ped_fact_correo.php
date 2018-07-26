<?php require_once('joom.php'); ?>
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

//header("Content-Type: text/html;charset=UTF-8");
date_default_timezone_set('America/Bogota');

$consec_url=$_POST['c'];

$c_date = date('Y-m-d');

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_pedidos` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);			

$i = 0;
//-----------------------------------------Empresa-----------------------------------------------------------------------
	
	mysql_select_db($database_conexion, $conexion);
	@$query_clien = sprintf("SELECT * FROM d89xz_empresa ", GetSQLValueString($colname_clien, "text"));
	$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
	$row_clien = mysql_fetch_assoc($clien);
	$totalRows_clien = mysql_num_rows($clien);
	$color=$row_clien['color'];
	$remitente=$row_clien["mail"];
//______________________________________________________________________________________________________
	$ced=$row_fact['ced'];
	mysql_select_db($database_conexion, $conexion);
	@$query_prove ="SELECT * FROM d89xz_prove where cedula='$ced'";
	$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
	$row_prove = mysql_fetch_assoc($prove);
	$totalRows_prove = mysql_num_rows($prove);
	$email=$row_prove['mail'];
	
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

<input type='hidden' id='tf_user' value='$usuario2'>
<input type='hidden' id='tf_user2' value='$usuario'>

<table width='98%' align='center' id='table_header'>
    
    <tr>
    <td width='70%' rowspan='3' align='left' >
    <img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' alt='logo' name='logo' width='200' height='70' id='logo' />
    </td>
    <td width='20%' align='center'>&nbsp;</td>
    <td align='right' width='10%' rowspan='3'>&nbsp;</td>
    </tr>
    <tr>
      <td align='center'>
      <label style='font-weight:bold; font-size:16px'>Pedido No</label>&nbsp;
      <label class='red' style='font-weight:bold; font-size:16px'>$row_fact[consec]</label>
      </td>
    </tr>
    <tr>
      <td align='center'>&nbsp;</td>
    </tr>
    <tr>
    <td colspan='3'  align='center'>Registro de Pedido</td>
    </tr>
</table>

<table width='98%'  cellspacing='0' align='center'>
    <tr>
      <td bgcolor='#F0F0F0' width='20%'>Punto de Venta</td>
      <td width='30%' align='center' ><label>$row_fact[punto_venta]</label></td>
      <td bgcolor='#F0F0F0' width='20%'>Fecha Pedido</td>
      <td width='30%' align='center' ><label>$row_fact[f_fact]</label></td>
    </tr>
    <tr>
      <td bgcolor='#F0F0F0' >Provedor</td>
      <td align='center' >
      <label>$row_fact[cliente]</label></td>
      <td bgcolor='#F0F0F0' >NIT</td>
      <td align='center' ><label>$row_fact[ced]</label></td>
    </tr>
    <tr>
      <td bgcolor='#F0F0F0' >Telefono</td>
      <td align='center' ><label>$row_fact[tel]</label></td>
      <td bgcolor='#F0F0F0' >Cotización No</td>
      <td align='center' ><label>$row_fact[cot]</label></td>
    </tr>
    <tr>
      <td bgcolor='#F0F0F0' >Fecha Entrega</td>
      <td align='center' ><label>$row_fact[f_despacho]</label></td>
      <td bgcolor='#F0F0F0' >Observaciones</td>
      <td align='center' ><label>$row_fact[obs]</label></td>
    </tr>
  </table>
  <table width='98%'  cellspacing='0' align='center' id='tb_data'>
  <tr >
    <td align='center' width='16%' bgcolor='$color'  style='color: #FFF'>Ref.</td>
    <td align='center' width='20%' bgcolor='$color'  style='color: #FFF'>Descripción</td>
    <td align='center' width='20%' bgcolor='$color'  style='color: #FFF'>Marca</td>
    <td align='center' width='16%' bgcolor='$color'  style='color: #FFF'>Cantidad</td>
    <td align='center' width='17%' bgcolor='$color'  style='color: #FFF'>Costo</td>
    <td align='center' width='11%' bgcolor='$color'  style='color: #FFF'>&nbsp;</td>
  </tr>";
  
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_pedidos_detalle` WHERE `consec`='$consec_url' 
  AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  	$estado = $row_prod['delete'];
	  if ($estado == 0){
		  $costo=number_format($row_prod['costo'],2) ;
		  
$mensaje.="	  
  <tr id='fila_$i'>
    <td  align='center'>
    <label> $row_prod[ref]</label>
    </td>
    <td align='center' class='cont'>
    <label>$row_prod[desc]</label>
    </td>
    <td align='center' >
    <label>$row_prod[marca] </label>
    </td>
    <td  align='center'>
    <label>$row_prod[cant]</label>
    </td>
    <td  align='center'>
    <label>$costo</label>
    </td>
    <td  align='center'>&nbsp;</td>
  </tr>";
 
  	  $i++;
	  }
	  if ($estado == 2){
		  $costo2=number_format($row_prod['costo'],2);
$mensaje.="
  <tr id='fila_ $i'>
    <td  align='center'>
    <label>$row_prod[ref]</label>
    </td>
    <td align='center' >
    <label>$row_prod[desc]</label>
    </td>
    <td align='center' >
    <label>$row_prod[marca]</label>
    </td>
    <td align='center'>
    <label>$row_prod[cant]</label>
    </td>
    <td  align='center'>
    <label>$costo2</label>
    </td>
    <td  align='center'><label >Pedido</label></td>
  </tr>";
 
  	  $i++;
	  }
  }
  $canti=number_format($row_fact['cant'],2);
  $costo3=number_format($row_fact['costo'],2);
$mensaje.="
</table>
<table width='98%' cellspacing='0' align='center'>
  <tr>
  	<td width='20%' class='bold'>Total Items</td>
    <td width='30%' class='bold'><label id='lb_toti' >$canti</label></td>
    <td width='20%' >Total</td>
    <td width='30%' ><label id='lb_totc' >$costo3</label></td>
  </tr>
  <tr>
    <td align='center' colspan='4'>&nbsp;</td>
  </tr>
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
$cabeceras .= 'From: PEDIDO<'.$remitente.'>' . "\r\n";
	mail($email, $título, $mensaje, $cabeceras);
if (mail($remitente, $título, $mensaje, $cabeceras)){
			echo "exitoso";
	}else{
		
			echo "Nooooexitoso";
	}