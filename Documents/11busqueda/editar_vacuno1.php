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
  $updateSQL = sprintf("UPDATE d89xz_vacunos SET id_vacuno=%s, raza=%s, color=%s, padre=%s, madre=%s, clasificasion=%s, calificasion=%s, sexo=%s,  hierro=%s, clase=%s, ubicasion=%s, registro=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_vacuno'], "text"),
                                            
                       GetSQLValueString($_POST['raza'], "text"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['padre'], "text"),
                       GetSQLValueString($_POST['madre'], "text"),
                       GetSQLValueString($_POST['clasificasion'], "text"),
                       GetSQLValueString($_POST['calificasion'], "int"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       
                       GetSQLValueString($_POST['hierro'], "text"),
                       GetSQLValueString($_POST['clase'], "text"),
                       GetSQLValueString($_POST['ubicasion'], "text"),
                       GetSQLValueString($_POST['registro'], "text"),
                      
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  	$updateGoTo = "kardex_busqueda.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));


}






mysql_select_db($database_conexion, $conexion);
$query_raza = "SELECT * FROM d89xz_razas";
$raza = mysql_query($query_raza, $conexion) or die(mysql_error());
$row_raza = mysql_fetch_assoc($raza);
$totalRows_raza = mysql_num_rows($raza);

mysql_select_db($database_conexion, $conexion);
$query_color = "SELECT * FROM d89xz_color_raza";
$color = mysql_query($query_color, $conexion) or die(mysql_error());
$row_color = mysql_fetch_assoc($color);
$totalRows_color = mysql_num_rows($color);

mysql_select_db($database_conexion, $conexion);
$query_clasificacion = "SELECT * FROM d89xz_clasificacion";
$clasificacion = mysql_query($query_clasificacion, $conexion) or die(mysql_error());
$row_clasificacion = mysql_fetch_assoc($clasificacion);
$totalRows_clasificacion = mysql_num_rows($clasificacion);

mysql_select_db($database_conexion, $conexion);
$query_hierro = "SELECT * FROM d89xz_hierros";
$hierro = mysql_query($query_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);
$totalRows_hierro = mysql_num_rows($hierro);

mysql_select_db($database_conexion, $conexion);
$query_ubicas = "SELECT hacienda FROM d89xz_hacienda";
$ubicas = mysql_query($query_ubicas, $conexion) or die(mysql_error());
$row_ubicas = mysql_fetch_assoc($ubicas);
$totalRows_ubicas = mysql_num_rows($ubicas);

$colname_mdff = "-1";
if (isset($_GET['vacuno'])) {
  $colname_mdff = $_GET['vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_mdff = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_mdff, "text"));
$mdff = mysql_query($query_mdff, $conexion) or die(mysql_error());
$row_mdff = mysql_fetch_assoc($mdff);
$totalRows_mdff = mysql_num_rows($mdff);
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
.a {
	color: #FFF;
}
</style>
</head>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>
<? 
@$vacuno=$_GET['vacuno'];

?>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex_busqueda.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>">Informacion</a>  </li>
  <li><a href="editar_vacuno.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>" class="current">Editar</a></li>
  <li onclick="return confirm('Realmente Desea Eliminar Vacuno');"><a href="eliminar_vacuno.php?vacuno=<?php echo $vacuno ?>">Eliminar</a>  </li>
 
</ul>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" border="0" align="center" cellspacing="0">
    <tr>
      <th align="center" bgcolor="#f0f0f0"><a href="kardex_busqueda.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></th>
    </tr>
  </table>
  <table border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <th width="90" align="center" nowrap="nowrap" bgcolor="#4D68A2"><span class="a"><?php echo $row_mdff['id']; ?></span></th>
      <th width="192" align="center" nowrap="nowrap" bgcolor="#4D68A2" class="a">Actual</th>
      <th width="170" align="center" bgcolor="#4D68A2">Cambio</th>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">ID</th>
      <td><input type="text" name="id_vacuno" value="<?php echo htmlentities($row_mdff['id_vacuno'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Raza:</th>
      <td><input type="text" name="raza1" value="<?php echo htmlentities($row_mdff['raza'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="raza"></label>
        <select name="raza" id="raza" style="width:200px">
          <?php
do {  
?>
          <option value="<?php echo $row_raza['raza']?>"<?php if (!(strcmp($row_raza['raza'], $row_mdff['raza']))) {echo "selected=\"selected\"";} ?>><?php echo $row_raza['raza']?></option>
          <?php
} while ($row_raza = mysql_fetch_assoc($raza));
  $rows = mysql_num_rows($raza);
  if($rows > 0) {
      mysql_data_seek($raza, 0);
	  $row_raza = mysql_fetch_assoc($raza);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Color:</th>
      <td><input type="text" name="color1" value="<?php echo htmlentities($row_mdff['color'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="color"></label>
        <select name="color" id="color" style="width:200px">
          <?php
do {  
?>
          <option value="<?php echo $row_color['color']?>"<?php if (!(strcmp($row_color['color'], $row_mdff['color']))) {echo "selected=\"selected\"";} ?>><?php echo $row_color['color']?></option>
          <?php
} while ($row_color = mysql_fetch_assoc($color));
  $rows = mysql_num_rows($color);
  if($rows > 0) {
      mysql_data_seek($color, 0);
	  $row_color = mysql_fetch_assoc($color);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Padre:</th>
      <td><input type="text" name="padre" value="<?php echo htmlentities($row_mdff['padre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Madre:</th>
      <td><input type="text" name="madre" value="<?php echo htmlentities($row_mdff['madre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Clasificación:</th>
      <td><input type="text" name="clasificasion1" value="<?php echo htmlentities($row_mdff['clasificasion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="clasificasion"></label>
        <select name="clasificasion" id="clasificasion" style="width:200px">
          <?php
do {  
?>
          <option value="<?php echo $row_clasificacion['clasificacison']?>"<?php if (!(strcmp($row_clasificacion['clasificacison'], $row_mdff['clasificasion']))) {echo "selected=\"selected\"";} ?>><?php echo $row_clasificacion['clasificacison']?></option>
          <?php
} while ($row_clasificacion = mysql_fetch_assoc($clasificacion));
  $rows = mysql_num_rows($clasificacion);
  if($rows > 0) {
      mysql_data_seek($clasificacion, 0);
	  $row_clasificacion = mysql_fetch_assoc($clasificacion);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Calificación</th>
      <td><input type="text" name="calificasion" value="<?php echo htmlentities($row_mdff['calificasion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Sexo:</th>
      <td><input name="sexo1" type="text" id="sexo1" value="<?php echo htmlentities($row_mdff['sexo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="sexo"></label>
        <select name="sexo" id="sexo" style="width:200px">
          <option value="Macho" <?php if (!(strcmp("Macho", $row_mdff['sexo']))) {echo "selected=\"selected\"";} ?>>Macho</option>
          <option value="Hembra" <?php if (!(strcmp("Hembra", $row_mdff['sexo']))) {echo "selected=\"selected\"";} ?>>Hembra</option>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Hierro:</th>
      <td><input name="hierro1" type="text" id="hierro1" value="<?php echo htmlentities($row_mdff['hierro'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="hierro"></label>
        <select name="hierro" id="hierro" style="width:200px">
          <?php
do {  
?>
          <option value="<?php echo $row_hierro['hierro']?>"<?php if (!(strcmp($row_hierro['hierro'], $row_mdff['hierro']))) {echo "selected=\"selected\"";} ?>><?php echo $row_hierro['hierro']?></option>
          <?php
} while ($row_hierro = mysql_fetch_assoc($hierro));
  $rows = mysql_num_rows($hierro);
  if($rows > 0) {
      mysql_data_seek($hierro, 0);
	  $row_hierro = mysql_fetch_assoc($hierro);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Clase:</th>
      <td><input name="clase1" type="text" id="clase1" value="<?php echo htmlentities($row_mdff['clase'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="clase"></label>
        <select name="clase" id="clase" style="width:200px">
          <option value="Puro" <?php if (!(strcmp("Puro", $row_mdff['clase']))) {echo "selected=\"selected\"";} ?>>Puro</option>
          <option value="Comercial" <?php if (!(strcmp("Comercial", $row_mdff['clase']))) {echo "selected=\"selected\"";} ?>>Comercial</option>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Ubicacion:</th>
      <td><input name="ubicasion1" type="text" id="ubicasion1" value="<?php echo htmlentities($row_mdff['ubicasion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td><label for="ubicasion"></label>
        <select name="ubicasion" id="ubicasion" style="width:200px">
          <?php
do {  
?>
          <option value="<?php echo $row_ubicas['hacienda']?>"<?php if (!(strcmp($row_ubicas['hacienda'], $row_mdff['ubicasion']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ubicas['hacienda']?></option>
          <?php
} while ($row_ubicas = mysql_fetch_assoc($ubicas));
  $rows = mysql_num_rows($ubicas);
  if($rows > 0) {
      mysql_data_seek($ubicas, 0);
	  $row_ubicas = mysql_fetch_assoc($ubicas);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline" bgcolor="#FFFFFF">
      <th align="left" nowrap="nowrap" style="color: #000">Registro:</th>
      <td><input type="text" name="registro" value="<?php echo htmlentities($row_mdff['registro'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="center" nowrap="nowrap" bgcolor="#4D68A2"><input type="image" src="modificar.png"  onmouseover="src='modificar1.png';"  onmouseout="src='modificar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_mdff['id']; ?>" />
</form>

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php


mysql_free_result($raza);

mysql_free_result($color);

mysql_free_result($clasificacion);

mysql_free_result($hierro);

mysql_free_result($ubicas);

mysql_free_result($mdff);
?>
