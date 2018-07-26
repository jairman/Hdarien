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
 
@$tipo =$_GET['tipo'];
@$nombre =$_GET['nombre'];
@$coment = $_GET['coment'];
@$cont = $_GET['contenido'];
@$descrip = $_GET['decrip'];
@$mark = $_GET['marca'];


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE d89xz_total_medicinasins SET nombre=%s, descrip=%s, coment=%s, cont=%s, mark=%s, m_uso=%s, p_act=%s, admin=%s WHERE id=%s",
                       
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['descrip'], "text"),
                       GetSQLValueString($_POST['dosif'], "text"),
                       GetSQLValueString($_POST['cont'], "text"),
                       GetSQLValueString($_POST['mark'], "text"),
                       GetSQLValueString($_POST['m_uso'], "text"),
					   GetSQLValueString($_POST['activo'], "text"),
                       GetSQLValueString($_POST['admin'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
					   @$nombre1 =$_POST['nombre'];
					  	@$coment1 = $_POST['dosif'];
						@$cont1 = $_POST['cont'];
						@$descrip1 = $_POST['descrip'];
						@$mark1 = $_POST['mark'];

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  


  $updateGoTo = "kardex_medicinaINS.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_mdc = "-1";
if (isset($_GET['id'])) {
  $colname_mdc = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_mdc = sprintf("SELECT * FROM d89xz_total_medicinasins WHERE id = %s", GetSQLValueString($colname_mdc, "int"));
$mdc = mysql_query($query_mdc, $conexion) or die(mysql_error());
$row_mdc = mysql_fetch_assoc($mdc);
$totalRows_mdc = mysql_num_rows($mdc);
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
#form1 table {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="376" border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <th align="center" nowrap="nowrap" bgcolor="#4D68A2">Insumo</th>
      <td bgcolor="#4D68A2"><?php echo $row_mdc['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">Tipo:</td>
      <td bgcolor="#4D68A2"><?php echo $row_mdc['tipo']; ?></td>
     <!-- <td><input type="text" name="tipo" value="<?php // echo htmlentities($row_mdc['tipo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>-->
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">Nombre:</td>
      <th><input type="text" name="nombre" value="<?php echo htmlentities($row_mdc['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">Descripción:</td>
      <th><input type="text" name="descrip" value="<?php echo htmlentities($row_mdc['descrip'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">Contenido:</td>
      <th><span id="sprytextfield1">
      <input type="text" name="cont" value="<?php echo htmlentities($row_mdc['cont'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
</span></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">Marca:</td>
      <th><input type="text" name="mark" value="<?php echo htmlentities($row_mdc['mark'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2">Presentación:</td>
      <th><input type="text" name="m_uso" value="<?php echo htmlentities($row_mdc['m_uso'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"> P. Activo </td>
      <th><input name="activo" type="text" id="activo" value="<?php echo $row_mdc['p_act']; ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"> Vía Admin </td>
      <th><input name="admin" type="text" id="admin" value="<?php echo $row_mdc['admin']; ?>" size="32" /></th>
      
      
    </tr>
    <tr valign="baseline">
      <td align="left" nowrap="nowrap" bgcolor="#4D68A2"> Dosificación </td>
      <th><input name="dosif" type="text" id="dosif" value="<?php echo $row_mdc['coment']; ?>" size="32" /></th>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#4D68A2"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_mdc['id']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($mdc);
?>
