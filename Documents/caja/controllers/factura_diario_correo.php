<?php //require_once('joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>

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

@$hda=$_POST['hda'];
@$colname_fac = $_POST['id'];

mysql_select_db($database_conexion, $conexion);
$query_hd = "SELECT * FROM d89xz_empresa";
$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
$row_hd = mysql_fetch_assoc($hd);
$totalRows_hd = mysql_num_rows($hd);
$color=$row_hd['color'];
@$remitente=$row_hd["mail"];

mysql_select_db($database_conexion, $conexion);
$query_fac ="SELECT * FROM d89xz_diario WHERE hacienda='$hda' and factura ='$colname_fac'";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

mysql_select_db($database_conexion, $conexion);
$query_fact1 ="SELECT * FROM d89xz_diario WHERE hacienda='$hda' and factura ='$colname_fac'";
$query_limit_fact1 = sprintf("%s LIMIT %d, %d", $query_fact1, $startRow_fact1, $maxRows_fact1);
$fact1 = mysql_query($query_limit_fact1, $conexion) or die(mysql_error());
$row_fact1 = mysql_fetch_assoc($fact1);

mysql_select_db($database_conexion, $conexion);
$query_haci = sprintf("SELECT * FROM d89xz_hacienda WHERE hacienda ='$hda'", GetSQLValueString($colname_haci, "text"));
$haci = mysql_query($query_haci, $conexion) or die(mysql_error());
$row_haci = mysql_fetch_assoc($haci);
$totalRows_haci = mysql_num_rows($haci);
$empresa=$row_haci['empresa'];

/*mysql_select_db($database_conexion, $conexion);
@$cedulacli =$_GET["clientes"];
$query_clenfact = "SELECT * FROM d89xz_clientes WHERE cedula = '$cedulacli' ";
$clenfact = mysql_query($query_clenfact, $conexion) or die(mysql_error());
$row_clenfact = mysql_fetch_assoc($clenfact);
$totalRows_clenfact = mysql_num_rows($clenfact);*/



@$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where hacienda='$hda' and `factura`='$colname_fac'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);




?>
<?php
$mensaje = " 
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin título</title>
</head>
<body>

  <table width='90%' border='0' align='center' cellspacing='0'>
  <tr bgcolor='#FFFFFF'>
    <td width='223' rowspan='3' valign='top'><img src='http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png' align='baseline' width='200' height='70' />
      <p> $row_hd[empresa]</p>
      NIT $row_hd[nit]</td>
    <td align='center'> $row_haci[empresa]<p>Teléfono &nbsp; $row_haci[telefono]<p> $row_haci[municipio]- Colombia</td>
    <td colspan='2' rowspan='2' align='center'  class='bold' style='font-size: 14px' >";
	
if($row_fac['concep'] == 'Egreso'){ 
	
	 $mensaje.= "<strong>COMPROBANTE DE EGRESO </strong>";
  } 
if($row_fac['concep'] == 'Ingreso'){ 
      $mensaje.= "<strong>RECIBO DE CAJA </strong>";
       } 
$mensaje.= "	   </td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td align='center'>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td align='center'>&nbsp;</td>
    <td colspan='2' align='center' ><strong style='font-size: 24px; color: #F00;'> N° $row_fac[factura]</strong></td>
  </tr>
  <tr>
    <td bgcolor='#F0F0F0'>";
	
if($row_fac['concep'] == 'Egreso'){ 
      $mensaje.= "PAGADO A ";
   } 
if($row_fac['concep'] == 'Ingreso'){ 
     $mensaje.= " RECIBIMOS DE ";
      }
	      
$mensaje.= "    </td>
    <td > $row_fac[cliente]</td>
    <td width='186' bgcolor='#F0F0F0' >FECHA</td>
    <td width='202' >$row_fac[fecha]</td>
  </tr>
  <tr>
    <td bgcolor='#F0F0F0'>CÉDULA/NIT</td>
	<td width='241'>
    <td >$row_fac[cedula]</td>
	<td width='145' >&nbsp;</td>
    <td bgcolor='#F0F0F0'>TELÉFONO</td>
    <td >";
     
		mysql_select_db($database_conexion, $conexion);
		if($row_fac['concep'] == 'Egreso'){ 
			$query_clenfact = "SELECT telefono,	mail FROM d89xz_prove WHERE cedula = '$row_fac[cedula]' ";  
          } 
       if($row_fac['concep'] == 'Ingreso'){ 
	   		$query_clenfact = "SELECT telefono,	mail FROM d89xz_clientes WHERE cedula = '$row_fac[cedula]' ";     
          } 
		$clenfact = mysql_query($query_clenfact, $conexion) or die(mysql_error());
		$row_clenfact = mysql_fetch_assoc($clenfact);
		$totalRows_clenfact = mysql_num_rows($clenfact);
		$telefono=$row_clenfact['telefono'];
		$email =$row_clenfact['mail'];
		$totaa= number_format (abs($row["total"]));
    
    
 $mensaje.= " $telefono  &nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#F0F0F0'>LA SUMA DE</td>
    <td align='left' > $ $totaa</td>
    <td bgcolor='#F0F0F0'>ESTADO</td>
    <td > $row_fac[estado]</td>
  </tr>
  </table>

<table width='90%' border='1' align='center' cellspacing='0'>
  <tr align='center'  >
    <td width='59%' align='center' bgcolor=' $color'  style='color: #FFF' >POR CONCEPTO DE</td>
    <td align='center' bgcolor=' $color'  style='color: #FFF'>FORMA DE PAGO</td>
    <td width='14%' align='center' bgcolor=' $color'  style='color: #FFF'>TOTAL</td>
    </tr>";
	
   do { 
   		$valorrr=number_format (abs ($row_fac['valor']));
		
$mensaje.= "    
    <tr >
      <td align='center' > $row_fac[comentario]</td>
      <td align='center' > $row_fac[f_pago]</td>
      <td align='center' > $valorrr</td>
      </tr>";
	  
   }while ($row_fac = mysql_fetch_assoc($fac));
	 
$mensaje.= "      
	</table>
	<p>&nbsp;</p>
	<table width='80%' border='0' align='center' cellspacing='0'>
	  <tr>
		<td align='center'>_________________________________________</td>
		<td align='center'>__________________________________________</td>
	  </tr>
	  <tr>
		<td align='center'><p>Recibido  Por</p></td>
		<td align='center'><p>Administrador</p></td>
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
	if($row_fac['concep'] =='Egreso'){ 
	
	  $cabeceras .= 'From: COMPROBANTE DE EGRESO<'.$remitente.'>' . "\r\n";
	 //  $cabeceras.= 'From:  COMPROBANTE DE EGRESO<'.$remitente.'>'. "\r\n" .
    //'Reply-To: <$remitente>' . "\r\n" .
    //'X-Mailer: PHP/' . phpversion();
  } 
if($row_fac['concep'] = 'Ingreso'){ 

      $cabeceras .= 'From: RECIBO DE CAJA<'.$remitente.'>' . "\r\n";
	 // $cabeceras.= 'From:  RECIBO DE CAJA<'.$remitente.'>'. "\r\n" .
    //'Reply-To: <$remitente>' . "\r\n" .
    //'X-Mailer: PHP/' . phpversion();
	  
	  
	  
       } 
	



//$cabeceras .= 'From: FACTURA DE VENTAS<'.$remitente.'>' . "\r\n";
	mail($email, $título, $mensaje, $cabeceras);
if (mail($remitente, $título, $mensaje, $cabeceras)){
			echo "exitoso";
	}else{
		
			echo "Nooooexitoso";
	}


@mysql_free_result($vnt);
mysql_free_result($hd);
@mysql_free_result($fac);
@mysql_free_result($fact1);
mysql_free_result($haci);
mysql_free_result($clenfact);