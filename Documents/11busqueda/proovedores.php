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
  $insertSQL = sprintf("INSERT INTO d89xz_proveedores (cedula, nombre, apellido, telefono, descr, empresa) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
					   GetSQLValueString($_POST['Descripci'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_client = "SELECT * FROM d89xz_proveedores";
$client = mysql_query($query_client, $conexion) or die(mysql_error());
$row_client = mysql_fetch_assoc($client);
$totalRows_client = mysql_num_rows($client);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.c {
	color: #FFF;
}
#form1 table {
	color: #FFF;
}
</style>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="364" border="1" align="center">
    <tr valign="baseline" bgcolor="#4D68A2">
      <th colspan="2" align="center" nowrap="nowrap">Registrar Proveedores</th>
    </tr>
    <tr valign="baseline">
      <td width="142" align="left" nowrap="nowrap" bgcolor="#4D68A2"><strong>Cedula:</strong></td>
      <td width="206"><input name="cedula" type="text" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"><strong>Nombre:</strong></td>
      <td><input type="text" name="nombre" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"><strong>Apellido:</strong></td>
      <td><input type="text" name="apellido" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"><strong>Telefono:</strong></td>
      <td><input type="text" name="telefono" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"><strong>Empresa:</strong></td>
      <td><input type="text" name="empresa" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"><strong>Descripción</strong></td>
      <td><label for="Descripci"></label>
      <input name="Descripci" type="text" id="Descripci" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">&nbsp;</td>
      <th><input type="submit" value="Registrar Proveedores" /></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<table width="630" border="1" align="center">
  <tr bgcolor="#4D68A2" class="c">
    <th width="89">Cedula</th>
    <th width="96" bgcolor="#4D68A2">Nombre</th>
    <th width="97">Apellido</th>
    <th width="98">Telefono</th>
    <th width="126">Empresa</th>
    <th width="126"><strong>Descripción</strong></th>
    <th width="126">Eliminar</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="edit_proveedores.php?cedula=<?php echo $row_client['cedula']; ?>"><?php echo $row_client['cedula']; ?></a></td>
      <td><?php echo $row_client['nombre']; ?></td>
      <td><?php echo $row_client['apellido']; ?></td>
      <td><?php echo $row_client['telefono']; ?></td>
      <td align="center"><?php echo $row_client['empresa']; ?></td>
      <td align="center"><?php echo $row_client['descr']; ?></td>
      <td align="center"><a href="eliminar_prove.php?cedula=<?php echo $row_client['cedula']; ?>">Eliminar</a></td>
    </tr>
    <?php } while ($row_client = mysql_fetch_assoc($client)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($client);
?>


	