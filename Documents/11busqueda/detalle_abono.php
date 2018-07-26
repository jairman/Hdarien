<?
/*$ruta_a_joomla = "/../../Sganadero/";
define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
$usuario= $userx->username;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder a esta página sin estar logueado.");
$userx = JFactory::getUser();*/
?>
<?php require_once('Connections/conexion.php'); ?>
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

$colname_abon = "-1";
if (isset($_GET['factura'])) {
  $colname_abon = $_GET['factura'];
}
mysql_select_db($database_conexion, $conexion);
$query_abon = sprintf("SELECT * FROM d89xz_abonos WHERE orden = %s ORDER BY orden DESC", GetSQLValueString($colname_abon, "text"));
$abon = mysql_query($query_abon, $conexion) or die(mysql_error());
$row_abon = mysql_fetch_assoc($abon);
$totalRows_abon = mysql_num_rows($abon);


$factura = $_GET['factura'];
//echo "Factu".$factura;
/*
$queEmp ="SELECT * FROM d89xz_solicitus WHERE `zado` ='Cotizado' and `orden_cotiza` = '$orden'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$dolar1=	$rowEmp['dolar'];	
						$docum=	$rowEmp['docum'];			
						}
					}*/
					// para buscar el valor del dolar


//Detalle

$result = mysql_query("SELECT SUM(`v_tal`) as total FROM  d89xz_diario WHERE `factura` = '$factura' and estado ='Pendiente'	"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
$tal = number_format(abs($tal1));
// echo $tal;
//el total de abonos

$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$factura'"); 
$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
$total_abono1=$row_abono['total'];
$total_abono2= abs($total_abono1);

$total_abono = number_format($total_abono1);

// Saldo
	$saldo1 = $tal1 - $total_abono1;
	$saldo =  number_format($saldo1);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#FFFFFF"><a href="dia_dia_pendiente.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr align="center" bgcolor="#54B948" style="color: #000">
    <th bgcolor="#FFFFFF"><p>Factura</p></th>
    <th bgcolor="#FFFFFF"><span style="font-family: Helvetica"><?php echo $row_abon['orden']; ?></span></th>
    <th bgcolor="#FFFFFF"><a href="abonar_impor.php?factura=<?php echo $factura; ?>&amp;empre=<?php echo $row_abon['empre']; ?>&amp;saldo=<?php echo $saldo; ?>&amp;docu=<?php echo $docum; ?>"><img src="dinero.jpg" width="45" height="45"  title="Abonar"/></a></th>
  </tr>
  <tr align="center" bgcolor="#54B948" style="color: #FFF">
    <th bgcolor="#4D68A2" style="font-family: Helvetica">Total ($)</th>
    <th bgcolor="#4D68A2" style="font-family: Helvetica">Total Abonos ($)</th>
    <th width="366" bgcolor="#4D68A2" style="font-family: Helvetica">Saldo ($)</th>
  </tr>
  <tr align="center" bgcolor="#E5F1D4" style="color: #FFF">
    <th bgcolor="#FFFFFF" style="font-family: Helvetica"><span style="color: #000"><? echo $tal; ?></span></th>
    <th bgcolor="#FFFFFF" style="color: #000"><? echo $total_abono; ?></th>
    <th bgcolor="#FFFFFF" style="color: #000"><? echo $saldo; ?></th>
  </tr>
  <tr align="center" bgcolor="#54B948" style="color: #FFF">
    <th colspan="3" bgcolor="#4D68A2" style="font-family: Helvetica">Detalle de Abonos</th>
  </tr>
  <tr align="center" bgcolor="#54B948" style="color: #FFF">
    <th bgcolor="#4D68A2" style="font-family: Helvetica">Comentario</th>
    <th bgcolor="#4D68A2" style="font-family: Helvetica">Abono</th>
    <th bgcolor="#4D68A2" style="font-family: Helvetica">Fecha De Abono</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td style="font-family: Helvetica"><?php echo $row_abon['empre']; ?></td>
      <td style="font-family: Helvetica"><?php echo number_format($row_abon['abono']); ?></td>
      <td style="font-family: Helvetica"><?php echo $row_abon['fecha']; ?></td>
    </tr>
    <?php } while ($row_abon = mysql_fetch_assoc($abon)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($abon);
?>
