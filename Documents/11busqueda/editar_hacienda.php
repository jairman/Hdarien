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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE d89xz_hacienda SET empresa=%s, nit=%s, telefono=%s, hacienda=%s, departamento=%s, municipio=%s, extension=%s, latitud=%s, longitud=%s, temperatura=%s WHERE id=%s",
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['nit'], "int"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['hacienda'], "text"),
                       GetSQLValueString($_POST['departamento'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['extension'], "int"),
                       GetSQLValueString($_POST['latitud'], "text"),
                       GetSQLValueString($_POST['longitud'], "text"),
                       GetSQLValueString($_POST['temperatura'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "hacienda.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_hcd = "SELECT * FROM d89xz_hacienda";
$hcd = mysql_query($query_hcd, $conexion) or die(mysql_error());
$row_hcd = mysql_fetch_assoc($hcd);
$totalRows_hcd = mysql_num_rows($hcd);$colname_hcd = "-1";
if (isset($_GET['id'])) {
  $colname_hcd = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_hcd = sprintf("SELECT * FROM d89xz_hacienda WHERE id = %s", GetSQLValueString($colname_hcd, "int"));
$hcd = mysql_query($query_hcd, $conexion) or die(mysql_error());
$row_hcd = mysql_fetch_assoc($hcd);
$totalRows_hcd = mysql_num_rows($hcd);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table {
	color: #FFF;
}
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#f0f0f0"><a href="hacienda.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table border="1" align="center" cellspacing="0">
    <tr valign="baseline" bgcolor="#4D68A2">
      <th align="center" nowrap="nowrap">ID</th>
      <td><?php echo $row_hcd['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Telefono:</strong></th>
      <td><input type="text" name="telefono" value="<?php echo htmlentities($row_hcd['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Hacienda:</strong></th>
      <td><input type="text" name="hacienda" value="<?php echo htmlentities($row_hcd['hacienda'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Departamento:</strong></th>
      <td><input type="text" name="departamento" value="<?php echo htmlentities($row_hcd['departamento'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Municipio:</strong></th>
      <td><input type="text" name="municipio" value="<?php echo htmlentities($row_hcd['municipio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Extension:</strong></th>
      <td><input type="text" name="extension" value="<?php echo htmlentities($row_hcd['extension'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Latitud:</strong></th>
      <td><input type="text" name="latitud" value="<?php echo htmlentities($row_hcd['latitud'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Longitud:</strong></th>
      <td><input type="text" name="longitud" value="<?php echo htmlentities($row_hcd['longitud'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF" style="color: #000"><strong>Temperatura:</strong></th>
      <td><input type="text" name="temperatura" value="<?php echo htmlentities($row_hcd['temperatura'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <th colspan="2" align="center" nowrap="nowrap" bgcolor="#FFFFFF"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_hcd['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($hcd);
?>
