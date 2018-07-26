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

mysql_select_db($database_conexion, $conexion);
$query_ven = " SELECT * FROM `d89xz_ventas` WHERE `factura`!=0 and `venta`='0' ";
$ven = mysql_query($query_ven, $conexion) or die(mysql_error());
$row_ven = mysql_fetch_assoc($ven);
$totalRows_ven = mysql_num_rows($ven);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
 <style> 
a{text-decoration:none} 
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="kar_ventas.php" >Vacunos Vendidos</a>  </li>
  <li><a href="ventas.php" class="current">Ventas</a>  </li>
    <li><a href="mostrar_nomina.php">Nomina</a>  </li>
  
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">

  <li><a href="ventas.php" >Ventas</a>  </li>
  <li><a href="ventas_reportes.php" class="current">Reportes</a></li>
 
</ul>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <th colspan="5" bgcolor="#4D68A2" style="color: #FFF">Reporte  De Ventas</th>
  </tr>
  <tr>
    <th colspan="5" bgcolor="#f0f0f0">&nbsp;</th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="20%">Fecha</th>
    <th width="30%">Cliente</th>
    <th width="24%">Hacienda</th>
    <th width="20%">Factura N°</th>
    <th width="6%">Detalle</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_ven['fecha']; ?></td>
      <td><?php echo $row_ven['nom_cli']; ?></td>
      <td><?php echo $row_ven['hacien']; ?></td>
      <td><?php echo $row_ven['factura']; ?></td>
      <td><a href="ventas_factura.php?factu=<?php echo $row_ven['factura']; ?>&amp;cliente=<?php echo $row_ven['client']; ?>">Detalle</a></td>
    </tr>
    <?php } while ($row_ven = mysql_fetch_assoc($ven)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($ven);
?>
<script type="text/javascript">

var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>