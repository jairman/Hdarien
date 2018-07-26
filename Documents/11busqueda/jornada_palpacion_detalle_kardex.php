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


$colname_kd = "-1";
if (isset($_GET['jornd'])) {
  $colname_kd = $_GET['jornd'];
}
mysql_select_db($database_conexion, $conexion);
$query_kd = sprintf("SELECT * FROM d89xz_detalle_palpacion WHERE jornd = %s ORDER BY estado desc", GetSQLValueString($colname_kd, "text"));
$kd = mysql_query($query_kd, $conexion) or die(mysql_error());
$row_kd = mysql_fetch_assoc($kd);
$totalRows_kd = mysql_num_rows($kd);$colname_kd = "-1";
if (isset($_GET['jornd'])) {
  $colname_kd = $_GET['jornd'];
}
mysql_select_db($database_conexion, $conexion);
$query_kd = sprintf("SELECT * FROM d89xz_detalle_palpacion WHERE jornd = %s ORDER BY estado DESC", GetSQLValueString($colname_kd, "date"));
$kd = mysql_query($query_kd, $conexion) or die(mysql_error());
$row_kd = mysql_fetch_assoc($kd);
$totalRows_kd = mysql_num_rows($kd);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#n {
	color: #FFF;
}
</style>
</head>

<body>
<table width="99%" border="0" align="center">
  <tr>
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="jornada_palpacion_detalle.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">

<table width="99%" border="0" align="center">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="4" bgcolor="#4D68A2">&nbsp;</th>
  </tr>
  <tr>
    <td><DIV ID="seleccion"></td>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
  
    <th colspan="4" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></th>
  </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th colspan="4" bgcolor="#f0f0f0">Registro De Palpación</th>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th width="220" align="left">Hacienda</th>
    <td width="328" align="left"><?php echo $row_kd['hda']; ?></td>
    <th width="216" align="right">Ref N°</th>
    <td width="306" align="center"><?php echo $row_kd['jornd']; ?></td>
  </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th align="left" bgcolor="#f0f0f0">Responsable</th>
    <td colspan="3" align="left"><?php echo $row_kd['resp']; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th align="left">Comentario Jornada</th>
    <td colspan="3" align="left"><?php echo $row_kd['cmpal']; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th align="left">&nbsp;</th>
    <th colspan="2">&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
</table>
<table width="99%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="187">ID</th>
    <th width="204">Estado</th>
    <th width="281">Fecha De  Palpación</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_kd['vaca']; ?></td>
      <td><?php echo $row_kd['estado']; ?></td>
      <td><?php echo $row_kd['f_palpa']; ?></td>
    </tr>
    <?php } while ($row_kd = mysql_fetch_assoc($kd)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($kd);
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







