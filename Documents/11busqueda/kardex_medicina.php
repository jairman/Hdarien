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

mysql_select_db($database_conexion, $conexion);
$query_km = "SELECT * FROM d89xz_total_medicinas order by tipo desc";
$km = mysql_query($query_km, $conexion) or die(mysql_error());
$row_km = mysql_fetch_assoc($km);
$totalRows_km = mysql_num_rows($km);
$query_km = "SELECT * FROM d89xz_total_medicinas order by tipo desc";
$km = mysql_query($query_km, $conexion) or die(mysql_error());
$row_km = mysql_fetch_assoc($km);
$totalRows_km = mysql_num_rows($km);
$query_km = "SELECT * FROM d89xz_total_medicinas order by tipo asc";
$km = mysql_query($query_km, $conexion) or die(mysql_error());
$row_km = mysql_fetch_assoc($km);
$totalRows_km = mysql_num_rows($km);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Inventario Medicinas</title>

<style type="text/css">
.s {
	color: #FFF;
}
</style>
<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>

<script type="text/javascript"><!--

Shadowbox.init({
    handleOversize:     "drag",
    displayNav:         false,
    handleUnsupported:  "remove",
});

// --></script>
 <style> 
a{text-decoration:none} 
</style>

<script> 
// Para la manito
function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
} 
</script> 

<script langiage="javascript" type="text/javascript">

// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
    location.href=url;
}
</script>



</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>
<ul id="MenuBar1" class="MenuBarHorizontal" >
  <li><a href="kardex_medicina.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>"class="current"  >Inventario</a>  </li>
</ul>
 <p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0" >
  <tr bgcolor="#f0f0f0">
    <td width="15%"><a  href="ingre_medicinas.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
    <td width="15%">&nbsp;</td>
    <td width="38%" align="center">&nbsp;</td>
    <td width="32%"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
  
<table width="100%" border="1" cellspacing="0">
  <tr class="s">
    <td colspan="5" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
  </tr>
  <tr class="s">
    <th colspan="5" bgcolor="#4D68A2"><span style="color: #FFF">Inventario Medicinas</span></th>
  </tr>
  <tr class="s">
    <th colspan="5" bgcolor="#f0f0f0" style="color: #000">&nbsp;</th>
    </tr>
  <tr class="s">
    <th width="71" bgcolor="#4D68A2">Tipo</th>
    <th width="161" bgcolor="#4D68A2">Nombre</th>
    <th width="175" bgcolor="#4D68A2">Marca </th>
    <th width="76" bgcolor="#4D68A2">Cont.(ML)</th>
    <th width="71" bgcolor="#4D68A2">T. Frascos</th>
    </tr>
  <?php do { ?>
    
     <tr align="center" id="fila_<? echo $row_km['id']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_km['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<? echo $row_km['id']; ?>')" onClick="CrearEnlace('ingreso_mas_medicinas_kardex.php?tipo=<?php echo $row_km['tipo']; ?>&amp;contenido=<?php echo $row_km['cont']; ?>&amp;nombre=<?php echo $row_km['nombre']; ?>&amp;marca=<?php echo $row_km['mark']; ?>&amp;id=<?php echo $row_km['id']; ?>&amp;descrip=<?php echo $row_km['descrip']; ?>&amp;comen=<?php echo $row_km['coment']; ?>');">
    
      <td align="center"><?php echo $row_km['tipo']; ?></td>
      <td align="center"><?php echo $row_km['nombre']; ?></td>
      <td align="center"><?php echo $row_km['mark']; ?></td>
      <td align="center"><?php echo $row_km['cont']; ?></td>
      <th><?php echo @round(($row_km['dosis']/$row_km['cont']),2); ?></th>
      </tr>
    <?php } while ($row_km = mysql_fetch_assoc($km)); ?>
</table>
</DIV>
</body>
</html>
<?php
mysql_free_result($km);
?>

<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 
</script> 
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>