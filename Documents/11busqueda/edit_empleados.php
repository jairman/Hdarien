<?
/*$ruta_a_joomla = "/../../Sganadero/";

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
$userx = JFactory::getUser();*/
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
	$cedula=$_GET['cedula'];
  $updateSQL = sprintf("UPDATE d89xz_empleados SET cedula=%s, nombre=%s, apellido=%s, funcion=%s, sueldo=%s, s_total=%s, hacienda=%s, fecha=%s WHERE cedula= '$cedula'",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['funcion'], "text"),
                       GetSQLValueString($_POST['sueldo'], "int"),
                       GetSQLValueString($_POST['s_total'], "int"),
                       GetSQLValueString($_POST['hacienda'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "regis_empleados.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_emple = "-1";
if (isset($_GET['cedula'])) {
  $colname_emple = $_GET['cedula'];
}
mysql_select_db($database_conexion, $conexion);
$query_emple = sprintf("SELECT * FROM d89xz_empleados WHERE cedula = %s", GetSQLValueString($colname_emple, "text"));
$emple = mysql_query($query_emple, $conexion) or die(mysql_error());
$row_emple = mysql_fetch_assoc($emple);
$totalRows_emple = mysql_num_rows($emple);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#d {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#f0f0f0"><a href="regis_empleados.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  
  <table border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <td width="183" align="center" nowrap="nowrap" bgcolor="#4D68A2" id="d" style="color: #000">Id:</td>
      <td width="215" bgcolor="#4D68A2"><?php echo $row_emple['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" id="d" style="font-weight: bold; color: #000;">Cedula</td>
      <th><input type="text" name="cedula" value="<?php echo htmlentities($row_emple['cedula'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" id="d" style="font-weight: bold; color: #000;">Nombre</td>
      <th><input type="text" name="nombre" value="<?php echo htmlentities($row_emple['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" id="d" style="font-weight: bold; color: #000;">Apellido</td>
      <th><input type="text" name="apellido" value="<?php echo htmlentities($row_emple['apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" id="d" style="font-weight: bold; color: #000;">Funcion</td>
      <th><input type="text" name="funcion" value="<?php echo htmlentities($row_emple['funcion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" id="d" style="font-weight: bold; color: #000;">Sueldo</td>
      <th><input type="text" name="sueldo" value="<?php echo htmlentities($row_emple['sueldo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" id="d" style="font-weight: bold; color: #000;">Sede</td>
      <th align="center"><span id="spryselect1">
        <label for="hacienda"></label>
        <select name="hacienda" id="hacienda" style="width:228px" >
          <option value="" <?php if (!(strcmp("", $row_emple['hacienda']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
          <option value="Hotel" <?php if (!(strcmp("Hotel", $row_emple['hacienda']))) {echo "selected=\"selected\"";} ?>>Hotel</option>
          <option value="Restaurante" <?php if (!(strcmp("Restaurante", $row_emple['hacienda']))) {echo "selected=\"selected\"";} ?>>Restaurante</option>
        </select>
      </span></th>
    </tr>
    <tr align="center" valign="baseline" bgcolor="#4D68A2" id="d">
      <th colspan="2" bgcolor="#FFFFFF"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_emple['id']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($emple);
?>
