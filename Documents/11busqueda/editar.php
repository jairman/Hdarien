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
@$fecha=$_GET['fecha'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tcalendario SET fecha=%s, evento=%s, comen=%s WHERE id=%s",
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['evento'], "text"),
					   GetSQLValueString($_POST['comen'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "loco.php?fecha=$fecha";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edt = "-1";
if (isset($_GET['id'])) {
  $colname_edt = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_edt = sprintf("SELECT * FROM tcalendario WHERE id = %s", GetSQLValueString($colname_edt, "int"));
$edt = mysql_query($query_edt, $conexion) or die(mysql_error());
$row_edt = mysql_fetch_assoc($edt);
$totalRows_edt = mysql_num_rows($edt);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="500" border="1" align="center">
    <tr valign="baseline">
      <td width="195" align="left" nowrap="nowrap" bgcolor="#4D68A2">Id:</td>
      <td width="293" bgcolor="#4D68A2"><?php echo $row_edt['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2" style="color: #FFF"><strong>Fecha:</strong></td>
      <td><input type="text" name="fecha" value="<?php echo htmlentities($row_edt['fecha'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2" style="color: #FFF"><strong>Evento:</strong></td>
      <td><input name="evento" type="text" value="<?php echo htmlentities($row_edt['evento'], ENT_COMPAT, 'utf-8'); ?>" size="50" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2" style="color: #FFF"><strong>Comentario</strong></td>
      <td><input name="comen" type="text" id="comen" value="<?php echo htmlentities($row_edt['comen']); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#4D68A2">
      <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_edt['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($edt);
?>
