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

$c_url=$_POST['c'];

$i = 0;

date_default_timezone_set('America/Bogota');

mysql_select_db($database_conexion, $conexion);
$cierre = mysql_query("SELECT * FROM `h01sg_inventario_cierre` 
WHERE `delete`<>1 AND `consec`='$c_url' ", $conexion) or die(mysql_error());
$row_cierre = mysql_fetch_assoc($cierre);
//-----------------------------------------Empresa-----------------------------------------------------------------------
	
	mysql_select_db($database_conexion, $conexion);
	$query_clien ="SELECT * FROM d89xz_empresa ";
	$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
	$row_clien = mysql_fetch_assoc($clien);
	$totalRows_clien = mysql_num_rows($clien);
	$color=$row_clien['color'];
	$remitente=$row_clien["mail"];
//______________________________________________________________________________________________________
	$ced=$row_cierre['ced'];
	mysql_select_db($database_conexion, $conexion);
	$query_prove ="SELECT * FROM d89xz_prove where cedula='$ced' ";
	$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
	$row_prove = mysql_fetch_assoc($prove);
	$totalRows_prove = mysql_num_rows($prove);
	$email=$row_prove['mail'];
	
//_______________________________________________________________________________________________________
	$punto=$row_cierre['punto_venta'];	
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

<table width='100%'  cellspacing='0' align='center'>
	<tr>
    <td width='76%'>
    <img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' alt='logo' name='logo' width='200' height='70' id='logo' />
    </td>
    <td width='8%'>&nbsp;</td>
    <td width='8%'>&nbsp;</td>
    <td width='8%'>&nbsp;</td>
    </tr>
    <tr >
    <td colspan='5' align='center' bgcolor='$color'  style='color: #FFF'>Cierre de Inventario</td>
    </tr>
</table>
<table width='100%'  cellspacing='0' align='center'>   
    <tr>
        <td width='20%' align='center' bgcolor='#F0F0F0'>No</td>
        <td width='30%' ><label id='lb_consec' >$c_url</label></td>
        <td align='center'  width='20%' bgcolor='#F0F0F0'>Punto de Venta</td>
        <td  width='30%'><label >$row_cierre[punto_venta]</label></td> 
    </tr>
    <tr>
        <td align='center'  width='20%' bgcolor='#F0F0F0'>Provedor</td>
        <td  width='30%'><label >$row_cierre[prove]</label></td> 
        <td width='20%' align='center' bgcolor='#F0F0F0'>NIT</td>
        <td width='30%' ><label id='lb_fecha' >$row_cierre[ced]</label></td> 
    </tr>
    <tr>
    	<td width='20%' align='center' bgcolor='#F0F0F0'>Fecha</td>
        <td width='30%' ><label id='lb_fecha' >$row_cierre[fecha]</label></td> 
        <td align='center'  width='20%'>&nbsp;</td>
        <td  width='30%'>&nbsp;</td> 
    </tr>

</table>


<table width='100%'  cellspacing='0' align='center' id='tb_detail'>
  <tr >
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Referencia</td>
    <td width='20%' bgcolor='$color'  style='color: #FFF'>Descripción</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Inicial</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Traslados</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Vendida</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Devolución</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Disponible</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Física</td>
    <td width='10%' bgcolor='$color'  style='color: #FFF'>Diferencia</td>
    
  </tr>";
  
  	//echo '*'.$ptov_url.'*';
	mysql_select_db($database_conexion, $conexion);
	$query_inv = mysql_query("SELECT * FROM `h01sg_inventario_cierre_detalle` 
	WHERE `delete`<>1 AND `consec`='$c_url' ORDER BY `ref`", $conexion) or die(mysql_error());
	
	while($row_inv = mysql_fetch_assoc($query_inv)){
		$ini = $row_inv['cant_ini'];
		$inv = $row_inv['cant_final'];
		$ref=$row_inv['ref'];
		
$mensaje.= "
  <tr  id='fila_$i'>    
  	<td align='center'><label id='ref_$i'>$ref</label></td>
    <td align='left'>";
    
	
		$query_det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ", $conexion) or die(mysql_error());
		$row_det = mysql_fetch_assoc($query_det);
		$abs=abs($row_inv['cant_trasl']);
		
$mensaje.= "		
		 $row_det[desc] - $row_det[marca]
		
    </td>
    <td align='center'><label id='ini$i' >$ini</label></td>
    <td align='center'><label id='tras$i'>$abs</label></td>
    <td align='center'><label id='vent$i'>$row_inv[cant_vend]</label></td>
    <td align='center'><label id='devo$i'>$row_inv[cant_devo]</label></td>
    <td align='center'><label  id='tot$i'>$inv</label></td>
    <td align='center'><label id='fis$i' >$row_inv[cant_fisica]</label></td>
    <td align='center'><label  id='dif$i'>$row_inv[diferencia]</label></td>
    
  </tr>";
 
		
  $i++;
	}
$mensaje.= "
  <tr>
  <td colspan='9'  align='left'>Comentarios: 
  <label>$row_cierre[obs]</label>
  </td>
  </tr>
</table>
<table width='98%' align='center'>
	<tr>
    <td align='center'>&nbsp;</td>
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
$cabeceras .= 'From: CIERRE DE INVENTARIO<'.$remitente.'>' . "\r\n";
	mail($email, $título, $mensaje, $cabeceras);
if (mail($remitente, $título, $mensaje, $cabeceras)){
			echo "exitoso";
	}else{
		
			echo "Nooooexitoso";
	}

