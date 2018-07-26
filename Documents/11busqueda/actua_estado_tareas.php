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
  $updateSQL = sprintf("UPDATE d89xz_tareas SET estado=%s WHERE id=%s",
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "editar_diario.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conexion, $conexion);
$valor=$_GET['id'];
$query_edt = "SELECT * FROM d89xz_tareas WHERE id = $valor";
$edt = mysql_query($query_edt, $conexion) or die(mysql_error());
$row_edt = mysql_fetch_assoc($edt);
$totalRows_edt = mysql_num_rows($edt);

mysql_free_result($edt);
?>
<style type="text/css">
.x {
	color: #FFF;
}
.v {
	color: #FFF;
}
</style>


<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="400" border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <td width="160" align="center" nowrap bgcolor="#4D68A2" class="x">Id:</td>
      <td width="224" bgcolor="#4D68A2" class="v"><?php echo $row_edt['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td rowspan="2" align="left" valign="middle" nowrap><strong>Estado</strong></td>
      <th><p>
        <input name="estado1" type="text" id="estado1" value="<?php echo htmlentities($row_edt['estado'], ENT_COMPAT, ''); ?>" size="10">
      </p></th>
    </tr>
    <tr valign="baseline">
      <th><select name="estado" id="estado">
        <option value="Cumplida">Cumplida</option>
        <option value="Pendiente">Pendienter</option>
      </select></th>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_edt['id']; ?>">
</form>
<p>&nbsp;</p>
