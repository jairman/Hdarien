<?
$ruta_a_joomla = "/../../Sganadero/";

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

$colname_fpes = "-1";
if (isset($_GET['factu'])) {
  $colname_fpes = $_GET['factu'];
}
mysql_select_db($database_conexion, $conexion);
$query_fpes = sprintf("SELECT * FROM d89xz_ventas WHERE  venta !=0 and factura = %s", GetSQLValueString($colname_fpes, "text"));
$fpes = mysql_query($query_fpes, $conexion) or die(mysql_error());
$row_fpes = mysql_fetch_assoc($fpes);
$totalRows_fpes = mysql_num_rows($fpes);

$colname_datos = "-1";
if (isset($_GET['factu'])) {
  $colname_datos = $_GET['factu'];
}
mysql_select_db($database_conexion, $conexion);
$query_datos = sprintf("SELECT * FROM d89xz_ventas WHERE  venta =0 and factura = %s", GetSQLValueString($colname_datos, "text"));
$datos = mysql_query($query_datos, $conexion) or die(mysql_error());
$row_datos = mysql_fetch_assoc($datos);
$totalRows_datos = mysql_num_rows($datos);


  $colname_clie = $_GET['cliente'];

mysql_select_db($database_conexion, $conexion);
$query_clie = sprintf("SELECT * FROM d89xz_clientes WHERE cedula = '$colname_clie'");
$clie = mysql_query($query_clie, $conexion) or die(mysql_error());
$row_clie = mysql_fetch_assoc($clie);
$totalRows_clie = mysql_num_rows($clie);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="ventas_reportes.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">

<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="18%"><img src="idsolutions--este.png" width="177" height="61" /></td>
    <th colspan="5" align="right" style="font-size: 36px">Factura De Venta</th>
  </tr>
  <tr bgcolor="#f0f0f0">
    <th align="left" bgcolor="#FFFFFF">&nbsp;</th>
    <th width="18%" align="left" bgcolor="#FFFFFF">&nbsp;</th>
    <th width="16%" align="left" bgcolor="#FFFFFF">&nbsp;</th>
    <th align="left" bgcolor="#FFFFFF">&nbsp;</th>
    <th align="left" bgcolor="#FFFFFF"> N°</th>
    <th align="left" bgcolor="#FFFFFF"><?php echo $row_datos['factura']; ?></th>
  </tr>
  <tr bgcolor="#f0f0f0">
    <th align="left">Empresa</th>
    <td colspan="2"><?php echo $row_datos['nom_cli']; ?></td>
    <td width="15%">&nbsp;</td>
    <th width="14%" align="left">Fecha</th>
    <th width="19%" align="left"><?php echo $row_datos['fecha']; ?></th>
  </tr>
  <tr>
    <th align="left">Cedula / Nit</th>
    <td><?php echo $row_clie['cedula']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <th align="left">Contacto</th>
    <td><?php echo $row_clie['empresa']; ?></td>
    <th align="left">Telefono</th>
    <td><?php echo $row_clie['telefono']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <th colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;</th>
  </tr>
</table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="24%">ID</th>
    <th width="19%">Peso(Kg)</th>
    <th width="20%">Precio (Kg)</th>
    <th width="21%">Precio Venta</th>
    <th width="16%">Precio Entrada</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_fpes['vacuno']; ?></td>
      <td><?php echo number_format ($row_fpes['peso']); ?></td>
      <td><?php echo number_format ($row_fpes['v_kilo']); ?></td>
      <td><?php echo number_format ($row_fpes['venta']); ?></td>
      <td><?php echo @number_format (@$row_fpes['cos_entro']); ?></td>
    </tr>
    <?php } while ($row_fpes = mysql_fetch_assoc($fpes)); ?>
</table>
<table width="100%" border="1" cellspacing="0">
  <tr>
    <th colspan="2" bgcolor="#f0f0f0">Descuentos</th>
    <th width="21%" align="left" bgcolor="#f0f0f0">Subtotal</th>
    <th width="16%" align="right" bgcolor="#f0f0f0"><?php echo number_format ($row_datos['tal']); ?></th>
  </tr>
  <tr>
    <th width="32%" align="left">B.N.A</th>
    <td width="31%"><?php echo number_format ($row_datos['bna']); ?></td>
    <th colspan="2" align="center">TOTALES</th>
  </tr>
  <tr>
    <th align="left" bgcolor="#f0f0f0">Fomento</th>
    <td bgcolor="#f0f0f0"><?php echo number_format ($row_datos['fomen']); ?></td>
    <th align="left" bgcolor="#f0f0f0">Total - Descuentos</th>
    <th align="right" bgcolor="#f0f0f0"><?php echo number_format ($row_datos['tal_des'],2); ?></th>
  </tr>
  <tr>
    <th align="left">Fletes</th>
    <td><?php echo number_format ($row_datos['fletes']); ?></td>
    <th align="left">Ganancia Neta</th>
    <th align="right"><?php echo number_format ($row_datos['tal_cost'],2); ?></th>
  </tr>
  <tr>
    <th align="left" bgcolor="#f0f0f0">Otros</th>
    <td bgcolor="#f0f0f0"><?php echo number_format ($row_datos['otros']); ?></td>
    <th align="left" bgcolor="#f0f0f0">Utilidad &nbsp; &nbsp;&nbsp;&nbsp; <?php echo $row_datos['liqui']; ?> %</th>
    <th align="center" bgcolor="#f0f0f0"><?php echo number_format ($row_datos['tal_liqui'],2); ?></th>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($fpes);

mysql_free_result($datos);

mysql_free_result($clie);
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