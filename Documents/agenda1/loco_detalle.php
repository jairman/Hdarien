<?
$ruta_a_joomla = "/../../../saga/";
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
<?php require_once('../Connections/conexion.php'); ?>
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

$jorn=$_GET['jorn'];
@$id=$_GET['id'];
@$tarea=$_GET['tarea'];

mysql_select_db($database_conexion, $conexion);
$query_tar = "SELECT * FROM d89xz_tareas WHERE id='$id' ";
$tar = mysql_query($query_tar, $conexion) or die(mysql_error());
$row_tar = mysql_fetch_assoc($tar);
$totalRows_tar = mysql_num_rows($tar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../agenda/css/style.css" rel="stylesheet" type="text/css" />
<link href="../agenda/css/shadowbox.css" rel="stylesheet" type="text/css" />
<script src="../agenda/js/shadowbox.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
</head>

<body>

<table width="99%" border="0" align="center">
  <tr>
    <td align="center"><a href="loco.php?fecha=<?php echo $row_tar['fecha']; ?>"><img src="img/last.png" alt="" width="40" height="40" /></a></td>
  </tr>
</table>
<table width="99%" border="0" align="center">
  <tr>
    <td height="61" align="left"><img src="img/Logo SAGA sin texto.png" alt="" width="200" height="70" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="99%" align="center">
  <tr>
    <td colspan="4"  class="tittle">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" style="font-weight: bold">&nbsp;</td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td width="31%"  class="bold">Actividad</td>
    <td width="28%" class="cont"><?php echo $row_tar['comen']; ?></td>
    <td width="22%" class="bold">Ref. N°</td>
    <td width="19%" class="cont"><?php echo $row_tar['jorn']; ?></td>
  </tr>
  <tr>
    <td class="bold">Hacienda</td>
    <td class="cont"><?php echo $row_tar['hac']; ?></td>
    <td class="bold">Fecha Jornada</td>
    <td class="cont"><?php echo $row_tar['fecha']; ?></td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td bgcolor="#f0f0f0" class="bold">Responsable  De La  Jornada</td>
    <td class="cont"><?php echo $row_tar['respon']; ?></td>
    <td class="bold">&nbsp;</td>
    <td class="cont">&nbsp;</td>
  </tr>
  <tr>
    <td class="bold">Comentarios</td>
    <td colspan="3" class="cont"><?php echo $row_tar['tarea']; ?></td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td class="bold">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="bold">Estado</td>
    <th class="cont"><?php echo $row_tar['estado']; ?></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#4D68A2">
    <td colspan="4" class="tittle">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($tar);
?>
