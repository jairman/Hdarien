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


@$id=$_GET['id'];

mysql_select_db($database_conexion, $conexion);

$query_m = "SELECT tipo, nombre, cont,mark, cantid, fecha, concep FROM d89xz_total_medicinas_salidas WHERE idm ='$id' ORDER BY fecha DESC";
$m = mysql_query($query_m, $conexion) or die(mysql_error());
$row_m = mysql_fetch_assoc($m);
$totalRows_m = mysql_num_rows($m);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Entrada/Salida de Medicinas</title>

<style type="text/css">
.x {
	color: #FFF;
}
</style>



</head>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>

<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="ingreso_mas_medicinas_kardex.php?id=<?php echo $id ?>">Entrada / Salida</a>  </li>
  <li><a href="kardex_ingre_mas_medici.php?id=<?php echo $id ?>" >Historial</a></li>
 
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="30%" bgcolor="#f0f0f0">&nbsp;</td>
    <th width="40%" bgcolor="#f0f0f0"><a href="kardex_medicina.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></th>
    <td width="30%" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2">
    <td width="30%">&nbsp;</td>
    <td width="70%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><img src="idsolutions--este.png" width="162" height="59" /></td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <th align="left"><span style="color: #000">Tipo</span></th>
    <td><span style="color: #000"><?php echo $row_m['tipo']; ?></span></td>
  </tr>
  <tr>
    <th align="left"><span style="color: #000">Nombre</span></th>
    <td><span style="color: #000"><?php echo $row_m['nombre']; ?></span></td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <th align="left"><span style="color: #000">Contenido</span></th>
    <td><span style="color: #000"><?php echo $row_m['cont']; ?></span></td>
  </tr>
</table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="x">
    <th colspan="3" align="right" bgcolor="#4D68A2">Nota: Para las Jornadas   De Vacunación La Cantidad Esta Dada En (ml)</th>
  </tr>
  <tr class="x">
    <th colspan="3" align="right" bgcolor="#f0f0f0">&nbsp;</th>
  </tr>
  <tr class="x">
    <th width="66" bgcolor="#4D68A2">Cantidad</th>
    <th width="179" bgcolor="#4D68A2">Fecha</th>
    <th width="294" bgcolor="#4D68A2">Concepto</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_m['cantid']; ?></td>
      <td align="center"><?php echo $row_m['fecha']; ?></td>
      <td align="center"><?php echo $row_m['concep']; ?></td>
    </tr>
    <?php } while ($row_m = mysql_fetch_assoc($m)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php


mysql_free_result($m);
?>
</DIV>
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

<script type="text/javascript">

var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>