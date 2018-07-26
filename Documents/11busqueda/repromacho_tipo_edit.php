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
  $updateSQL = sprintf("UPDATE d89xz_vacunos SET tp_rep=%s WHERE id_vacuno=%s",
                       GetSQLValueString($_POST['tp_rep'], "text"),
                       GetSQLValueString($_POST['id_vacuno'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   	$updateGoTo = "edit_reproduc_machos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));

}

mysql_select_db($database_conexion, $conexion);
$query_tp = "SELECT tipo FROM d89xz_tipo_reproductores";
$tp = mysql_query($query_tp, $conexion) or die(mysql_error());
$row_tp = mysql_fetch_assoc($tp);
$totalRows_tp = mysql_num_rows($tp);

mysql_select_db($database_conexion, $conexion);
$valor1 = $_GET['id_vacuno'];
$query_es = "SELECT * FROM d89xz_vacunos WHERE id_vacuno= '$valor1'";
$es = mysql_query($query_es, $conexion) or die(mysql_error());
$row_es = mysql_fetch_assoc($es);
$totalRows_es = mysql_num_rows($es);
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
    <td align="center" bgcolor="#f0f0f0"><a href="edit_reproduc_machos.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="396" border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <th width="186" align="left" nowrap="nowrap" bgcolor="#4D68A2" style="color: #FFF">ID Vacuno:</th>
      <td width="194" align="center" bgcolor="#4D68A2"><?php echo $row_es['id_vacuno']; ?></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="left">Estado Reproductivo:</th>
      <th><input type="text" name="tp_rep1" value="<?php echo htmlentities($row_es['tp_rep'], ENT_COMPAT, 'utf-8'); ?>" size="27" /></th>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="left">Cambiar  Por :</th>
      <th>
        <select name="tp_rep" id="tp_rep" style="width:194px">
          <?php
do {  
?>
          <option value="<?php echo $row_tp['tipo']?>"><?php echo $row_tp['tipo']?></option>
          <?php
} while ($row_tp = mysql_fetch_assoc($tp));
  $rows = mysql_num_rows($tp);
  if($rows > 0) {
      mysql_data_seek($tp, 0);
	  $row_tp = mysql_fetch_assoc($tp);
  }
?>
      </select></th>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_vacuno" value="<?php echo $row_es['id_vacuno']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($tp);

mysql_free_result($es);
?>
