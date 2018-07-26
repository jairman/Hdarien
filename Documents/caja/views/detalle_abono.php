<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');?>
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
$concep = $_GET['concep'];
$factura = $_GET['factura'];
$hacienda = $_GET['hacienda'];
$colname_abon = "-1";
if (isset($_GET['factura'])) {
  $colname_abon = $_GET['factura'];
}
mysql_select_db($database_conexion, $conexion);
$query_abon = sprintf("SELECT * FROM d89xz_abonos WHERE hacienda='$hacienda'and docu='$concep' and  orden = %s ORDER BY orden DESC", GetSQLValueString($colname_abon, "text"));
$abon = mysql_query($query_abon, $conexion) or die(mysql_error());
$row_abon = mysql_fetch_assoc($abon);
$totalRows_abon = mysql_num_rows($abon);



$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE  hacienda='$hacienda'and`factura` = '$factura'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
$tal = number_format(abs($tal1));

//el total de abonos

$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE hacienda='$hacienda' and docu='$concep' and `orden` = '$factura'"); 
$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
$total_abono1=$row_abono['total'];
$total_abono2= abs($total_abono1);

$total_abono = number_format($total_abono1);

// Saldo
	$saldo1 = $tal1 - $total_abono1;
	$saldo =  number_format($saldo1);
	
				mysql_select_db($database_conexion, $conexion);
				$query_prove1 = "SELECT * FROM `d89xz_diario` where `factura` = '$factura'  and  concep='$concep' and `hacienda` = '$hacienda' ";
				$prove1 = mysql_query($query_prove1, $conexion) or die(mysql_error());
				$row_prove1 = mysql_fetch_assoc($prove1);
				$totalRows_prove1 = mysql_num_rows($prove1);
			 	$concep=$row_prove1['concep'];
				
	
	
	if($saldo <='0'){
				
				
				$insertar1 = mysql_query("UPDATE `d89xz_diario` SET `estado`= 'Cancelada' where `factura` = '$factura' and concep='$concep' and `hacienda` = '$hacienda' ", $conexion);
				
				
						mysql_select_db($database_conexion, $conexion);
						$query_prove = "SELECT * FROM `d89xz_diario` where `factura` = '$factura' ";
						$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
						$row_prove = mysql_fetch_assoc($prove);
						$totalRows_prove = mysql_num_rows($prove);
						$consec_fact=$row_prove['consec_fact'];
			 
	if($concep =='Ingreso'){
				 $insertar2 = mysql_query("UPDATE `h01sg_venta` SET `delete`= '9' where `consec`='$consec_fact' 
				 and `punto_venta`= '$hacienda' ", $conexion);
				
		}
	if($concep =='Egreso'){
		
			 	 $insertar2 = mysql_query("UPDATE `h01sg_compra` SET `delete`= '9' where `consec`='$consec_fact' 
				 and `punto_venta`= '$hacienda' ", $conexion);
					
				}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/detalle_abono.js" type="text/javascript"></script>


</head>
<body>
<input type="hidden" id="tf_user" value="<?= $usuario2 ?>">
<input type="hidden" id="factura" value="<?= $_GET['factura'] ?>">
<input type="hidden" id="hacienda" value="<?= $_GET['hacienda'] ?>">
<!--<a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="abonar_impor.php?factura=<?= $factura; ?>&amp;empre=<?= $row_abon['empre']; ?>&amp;saldo=<?= $saldo; ?>&amp;hacienda=<?= $hacienda; ?>">-->
<table width="99%" border="1" align="center" cellspacing="0">
  <tr align="center" bgcolor="#54B948" style="color: #000">
    <th align="left" bgcolor="#FFFFFF"><p><img src="../../../img/Logo.png" width="200" height="70" /></p></th>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><img src="../../img/abonar2.png" width="40" height="40"  title="Abonar" style="cursor:pointer"  onclick="abonar('')"/></a></td>
  </tr>
  <tr align="center"  class="subtitle" >
<td >&nbsp;</td>
<td align="right"  class="bold">Factura No</td>
<td ><span style="font-family: Helvetica"><?= $factura ?></span></td>
</tr>
<tr align="center"  class="subtitle" >
<td >&nbsp;</td>
<td align="right"  class="bold">Origen</td>
<td ><span style="font-family: Helvetica"><?= $_GET['cliente'] ?></span></td>
</tr>
<tr align="center" bgcolor="#4D68A2" class="tittle" style="color: #FFF">
<td colspan="3" >Estado De Cuenta</td>
</tr>
<tr align="center" bgcolor="#4D68A2" class="tittle" style="color: #FFF">
  <td style="font-family: Helvetica">Total ($)</td>
  <td style="font-family: Helvetica">Total Abonos ($)</td>
  <td width="366" style="font-family: Helvetica">Saldo ($)</td>
</tr>
  <tr align="center" bgcolor="#E5F1D4" class="bold" style="color: #FFF">
    <th bgcolor="#FFFFFF" style="font-family: Helvetica"><span style="color: #000"><?= $tal; ?></span></th>
    <th bgcolor="#FFFFFF" style="color: #000"><?= $total_abono; ?></th>
    <th bgcolor="#FFFFFF" style="color: #000"><?= $saldo; ?></th>
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
      <td style="font-family: Helvetica" ><?= $row_abon['empre']; ?></td>
      <td style="font-family: Helvetica" ><?= number_format($row_abon['abono']); ?></td>
      <td style="font-family: Helvetica" ><?= $row_abon['fecha']; ?></td>
    </tr>
    <?php } while ($row_abon = mysql_fetch_assoc($abon)); ?>
</table>




<div id="dialog2" title="Abono Factura">
<form action="" id="formulario" method="post">
<table align="center" width="90%">
<tr>
	<td align="right" class="bold" width="50%">Fecha</td>
    <td class="cont" width="50%"><input  name="tf_fecha" type="text" id="tf_fecha" style="width:95%"  value="<?= date('Y-m-d') ?>" class="long" /></td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Forma De Pago</td>
    <td class="cont" width="50%">
<select name="formapago" id="formapago"   style="width:100%"  required="required"  >
<option value="">Seleccione</option>
<option value="Efectivo">Efectivo</option>
<option value="Pac">Pac</option>
</select>
</td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Cantidad  a  Abonar</td>
    <td class="cont" width="50%">
<input name="abono" type="text" class="long" id="abono" style="width:95%"  required="required"
         onkeyup="checkNum(this)"/>
</td>
</tr>
<tr>
	<td align="right" class="bold" width="50%">Comentario</td>
    <td class="cont" width="50%">
<input name="comen" type="text" class="long" id="comen"style="width:95%" />
</td>
</tr>
<tr>
	<td align="center">
    <img id="theImg" src="../../img/good.png" width="48" height="48" 
    style="cursor:pointer" onclick="confirmar();return false" title="Aceptar"/>
    </td>
    <td align="center">
    <img src="../../img/erase.png" width="48" height="48" 
    style="cursor:pointer" onclick="cerrar_dialogo2()" title="Pago en Tarjeta" />
    
    </td>
</tr>
</table>
</form>
</div>
<div id="dialog" title="Abono Factura">

</body>
</html>
<?php
mysql_free_result($abon);
?>
