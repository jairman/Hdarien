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
$query_lot = "SELECT * FROM d89xz_lotes";
$lot = mysql_query($query_lot, $conexion) or die(mysql_error());
$row_lot = mysql_fetch_assoc($lot);
$totalRows_lot = mysql_num_rows($lot);

$colname_vac = "-1";
if (isset($_GET['lote'])) {
  $colname_vac = $_GET['lote'];
}
mysql_select_db($database_conexion, $conexion);
$query_vac = sprintf("SELECT * FROM d89xz_vacunos WHERE lote = %s", GetSQLValueString($colname_vac, "text"));
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script langiage="javascript" type="text/javascript">


function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
}

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

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php">Inventario Vacuno</span></a>  </li>
  <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a></li>
  <li><a href="kardex_paridas_inven.php">Paridas</a></li>
  <li><a href="paritorio.php">Paritorio</a></li>
  <li><a href="movimiento_mensual.php">Movimientos</a></li>
  <li><a href="agregar_lotes_princi.php" class="current">Lotes</a></li>
</ul>
 <p>&nbsp;</p>


<table width="100%" border="0" align="center" cellspacing="0" >
  <tr bgcolor="#f0f0f0">
    <td width="15%" align="center"><a rel="shadowbox[ejemplos];options={continuous:true}" href="agregar_generar_lote.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
    <td width="15%" align="center">&nbsp;</td>
    <td align="center"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="5">Lotes existentes</th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="16%">Lote</th>
    <th width="23%">Hacienda</th>
    <th width="25%">Responsable</th>
    <th width="24%">Comentario</th>
    <th width="12%">Fecha Creación</th>
  </tr>
  <?php do { ?>
    <tr align="center" id="fila_<? echo $row_lot['id']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_lot['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<? echo $row_lot['id']; ?>')" onClick="CrearEnlace('Agregar_lote.php?lote=<?php echo $row_lot['lote']; ?>');">
    
    
      <td><?php echo $row_lot['lote']; ?></td>
      <td><?php echo $row_lot['ubica']; ?></td>
      <td><?php echo $row_lot['resp']; ?></td>
      <td><?php echo $row_lot['comen']; ?></td>
      <td align="center"><?php echo $row_lot['fecha']; ?></td>
    </tr>
    <?php } while ($row_lot = mysql_fetch_assoc($lot)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($lot);

mysql_free_result($vac);
?>
