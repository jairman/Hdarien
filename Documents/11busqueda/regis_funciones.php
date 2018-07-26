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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO d89xz_funciones (funcion) VALUES (%s)",
                       GetSQLValueString($_POST['funcion'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_fun = "SELECT * FROM d89xz_funciones";
$fun = mysql_query($query_fun, $conexion) or die(mysql_error());
$row_fun = mysql_fetch_assoc($fun);
$totalRows_fun = mysql_num_rows($fun);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
</head>

<body>

<img src="idsolutions--este.png" width="162" height="59" />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="305" border="1" align="center">
    <tr valign="baseline">
      <th colspan="2" align="center" nowrap="nowrap" bgcolor="#4D68A2">Registro de funciones</th>
    </tr>
    <tr valign="baseline">
      <th width="76" align="center" nowrap="nowrap" style="color: #000">Función:</th>
      <td width="192"><input type="text" name="funcion" value="" size="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <th><input type="submit" value="Registrar" /></th>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<table width="305" border="1" align="center">
  <tr class="c">
    <th width="172" bgcolor="#4D68A2">Función</th>
    <th width="59" bgcolor="#4D68A2">Eliminar</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_fun['funcion']; ?></td>
      <td align="center"><a href="eliminar_funciones.php?id=<?php echo $row_fun['id']; ?>">Eliminar</a></td>
    </tr>
    <?php } while ($row_fun = mysql_fetch_assoc($fun)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($fun);
?>
