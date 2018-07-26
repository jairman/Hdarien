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
  $updateSQL = sprintf("UPDATE d89xz_empresa SET empresa=%s, nit=%s, telefono=%s WHERE id=%s",
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['nit'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
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
$query_empre = "SELECT * FROM d89xz_empresa";
$empre = mysql_query($query_empre, $conexion) or die(mysql_error());
$row_empre = mysql_fetch_assoc($empre);
$totalRows_empre = mysql_num_rows($empre);$colname_empre = "-1";
if (isset($_GET['empresa'])) {
  $colname_empre = $_GET['empresa'];
}
mysql_select_db($database_conexion, $conexion);
$query_empre = sprintf("SELECT * FROM d89xz_empresa WHERE empresa = %s", GetSQLValueString($colname_empre, "int"));
$empre = mysql_query($query_empre, $conexion) or die(mysql_error());
$row_empre = mysql_fetch_assoc($empre);
$totalRows_empre = mysql_num_rows($empre);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#f0f0f0"><a href="hacienda.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p>&nbsp;</p>
  <table width="325" border="1" align="center" cellspacing="0">
    <tr valign="baseline" bgcolor="#4D68A2">
      <td width="117" align="right" nowrap="nowrap" bgcolor="#4D68A2">&nbsp;</td>
      <td width="192"><?php echo $row_empre['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Empresa</strong></td>
      <td><input type="text" name="empresa" value="<?php echo htmlentities($row_empre['empresa'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Nit</strong></td>
      <td><input type="text" name="nit" value="<?php echo htmlentities($row_empre['nit'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF"><strong>Telefono</strong></td>
      <td><input type="text" name="telefono" value="<?php echo htmlentities($row_empre['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#FFFFFF"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_empre['id']; ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($empre);
?>
