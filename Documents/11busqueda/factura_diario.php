<?
$ruta_a_joomla = "/../../Hdarien/";

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
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
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
 


  
/*mysql_select_db($database_conexion, $conexion);
$query_vnt = "SELECT * FROM d89xz_ventas WHERE fecha = '$fecha' ";
$vnt = mysql_query($query_vnt, $conexion) or die(mysql_error());
$row_vnt = mysql_fetch_assoc($vnt);
$totalRows_vnt = mysql_num_rows($vnt);*/

mysql_select_db($database_conexion, $conexion);
$query_hd = "SELECT * FROM d89xz_empresa";
$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
$row_hd = mysql_fetch_assoc($hd);
$totalRows_hd = mysql_num_rows($hd);

mysql_select_db($database_conexion, $conexion);
$query_clien = "SELECT * FROM d89xz_clientes";
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);

$colname_fac = "-1";
if (isset($_GET['id'])) {
  $colname_fac = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_fac = sprintf("SELECT * FROM d89xz_diario WHERE id = %s", GetSQLValueString($colname_fac, "int"));
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

$colname_clenfact = "-1";
if (isset($_POST['clientes'])) {
  $colname_clenfact = $_POST['clientes'];
}

mysql_select_db($database_conexion, $conexion);
$cedulacli =$_GET["clientes"];
$query_clenfact = "SELECT * FROM d89xz_clientes WHERE cedula = '$cedulacli' ";
$clenfact = mysql_query($query_clenfact, $conexion) or die(mysql_error());
$row_clenfact = mysql_fetch_assoc($clenfact);
$totalRows_clenfact = mysql_num_rows($clenfact);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#seleccion table tr th {
	color: #FFF;
}
#seleccion table tr th {
	color: #FFF;
}
.s {
	color: #FFF;
}
.x {
	color: #FFF;
}
a {
	color: #000;
}
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
  <table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="5"><img src="idsolutions--este.png" align="baseline" width="162" height="59" /></td>
    </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#d8d8d8"><strong>Empresa:</strong></td>
    <td bgcolor="#d8d8d8"><strong><?php echo $row_hd['empresa']; ?></strong></td>
    <td width="343" bgcolor="#d8d8d8">&nbsp;</td>
    <td width="116" align="left" bgcolor="#d8d8d8"><strong> Factura No :</strong></td>
    <td width="149" bgcolor="#d8d8d8"><strong><?php echo $row_fac['factura']; ?></strong></td>
  </tr>
  <tr>
    <td width="194"><strong>Nit:</strong></td>
    <td width="223"><strong><?php echo $row_hd['nit']; ?></strong></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#d8d8d8"><strong>Telefono:</strong></td>
    <td bgcolor="#d8d8d8"><strong><?php echo $row_hd['telefono']; ?></strong></td>
    <td bgcolor="#d8d8d8">&nbsp;</td>
    <td align="left" bgcolor="#d8d8d8"><strong>Fecha:</strong></td>
    <td bgcolor="#d8d8d8"><strong><?php echo $row_fac['fecha']; ?></strong></td>
  </tr>
  <tr>
    <td><strong>Cliente:</strong></td>
    <td><strong><?php echo $row_fac['cliente']; ?></strong></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#d8d8d8"><strong>Concepto:</strong></td>
    <td bgcolor="#d8d8d8"><strong><?php if ($row_fac['concep']=='Ingreso'){ echo "Venta";
		}else{
			echo "Compra";}
	; ?></strong></td>
    <td bgcolor="#d8d8d8">&nbsp;</td>
    <td bgcolor="#d8d8d8"><strong>Estado:</strong></td>
    <td bgcolor="#d8d8d8"><strong><?php echo $row_fac['estado']; ?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>Fecha De Pago</strong>:</td>
    <td bgcolor="#FFFFFF"><strong><?php echo $row_fac['f_alarma']; ?></strong></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#d8d8d8">&nbsp;</td>
    <td bgcolor="#d8d8d8">&nbsp;</td>
    <td bgcolor="#d8d8d8">&nbsp;</td>
    <td bgcolor="#d8d8d8">&nbsp;</td>
    <td bgcolor="#d8d8d8">&nbsp;</td>
  </tr>
  </table>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <th width="563" bgcolor="#4D68A2">Descripción</th>
    <th width="178" bgcolor="#4D68A2">Cantidad</th>
    <th width="142" bgcolor="#4D68A2">Unitario</th>
    <th width="134" bgcolor="#4D68A2">Total</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="left"><?php echo $row_fac['descrip']; ?></td>
      <td align="center"><?php echo $row_fac['cantid']; ?></td>
      <td align="center"><?php echo  number_format (abs ($row_fac['v_unit'])); ?></td>
      <td width="134" align="center"><?php echo number_format (abs ($row_fac['v_tal'])); ?></td>
    </tr>
   
</table>


<table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="12%"><p><strong>Observación:</strong></p></td>
    <td width="88%"><?php echo $row_fac['comen']; ?></td>
  </tr>
   <?php } while ($row_fac = mysql_fetch_assoc($fac)); ?>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td>_________________________________________</td>
    <td>__________________________________________</td>
  </tr>
  <tr>
    <td align="center"><p>Recibido  Por</p></td>
    <td align="center"><p>Administrador</p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;	  </p>
</DIV>
</body>
</html>
<?php
@mysql_free_result($vnt);

mysql_free_result($hd);

mysql_free_result($clien);

mysql_free_result($fac);

mysql_free_result($clenfact);
?>
<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 