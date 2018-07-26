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
$query_hm = "SELECT id_vacuno, raza, madre, hierro, clase, ubicasion, reprd, tp_rep,edad,sexo FROM d89xz_vacunos WHERE sexo = 'macho' ORDER BY raza ASC";
$hm = mysql_query($query_hm, $conexion) or die(mysql_error());
$row_hm = mysql_fetch_assoc($hm);
$totalRows_hm = mysql_num_rows($hm);
$query_hm = "SELECT id_vacuno, raza, madre, hierro, clase, ubicasion, reprd, tp_rep,edad,sexo FROM d89xz_vacunos WHERE sexo = 'macho' ORDER BY raza ASC";
$hm = mysql_query($query_hm, $conexion) or die(mysql_error());
$row_hm = mysql_fetch_assoc($hm);
$totalRows_hm = mysql_num_rows($hm);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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

function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
} 

</script>

<style type="text/css">
.s {
	color: #FFF;
}
</style>

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

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>
 <style> 
a{
	text-decoration:none;
} 
 </style>

<body>



<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php">Inventario Vacuno</span></a>  </li>
  <li><a href="edit_reproduc_machos.php" class="current">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a></li>
   <li><a href="kardex_paridas_inven.php">Paridas</a></li>
   <li><a href="paritorio.php">Paritorio</a></li>
     <li><a href="movimiento_mensual.php">Movimientos</a></li>
      <li><a href="agregar_lotes_princi.php">Lotes</a></li>
</ul>
<p>&nbsp;</p>

  <table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr class="s">
    <td colspan="7" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="177" height="61" /></td>
  </tr>
  <tr class="s">
    <th colspan="7" bgcolor="#4D68A2">Inventario Machos</th>
    </tr>
  <tr class="s">
    <th colspan="7" bgcolor="#f0f0f0">&nbsp;</th>
  </tr>
  <tr class="s">
    <th width="173" bgcolor="#4D68A2">ID </th>
    <th width="126" bgcolor="#4D68A2">Hierro</th>
    <th width="123" bgcolor="#4D68A2">Raza</th>
    <th width="175" bgcolor="#4D68A2">Clase</th>
    <th width="67" bgcolor="#4D68A2">Edad</th>
    <th width="187" bgcolor="#4D68A2">Estado</th>
    <th width="218" bgcolor="#4D68A2">Ubicacion </th>
  </tr>
  <?php do { ?>
   <tr id="fila_<?php echo $row_hm['id_vacuno']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_hm['id_vacuno']; ?>');mano(this);" onMouseOut="RestablecerFila('fila_<? echo $row_hm['id_vacuno']; ?>')" onClick="CrearEnlace('kardex_busqueda.php?id_vacuno=<?php echo $row_hm['id_vacuno']; ?>&amp;vacuno=<?php echo $row_hm['id_vacuno']; ?>&amp;sexo=<?php echo $row_hm['sexo']; ?>');">
      <th align="left"><?php echo $row_hm['id_vacuno']; ?></th>
      <td align="center"><?php echo $row_hm['hierro']; ?></td>
      <td><?php echo $row_hm['raza']; ?></td>
      <td><?php echo $row_hm['clase']; ?></td>
      <td align="center"><?php echo $row_hm['edad']; ?></td>
      <td><?php echo $row_hm['tp_rep']; ?></td>
      <td align="center"><?php echo $row_hm['ubicasion']; ?></td>
    </tr>
    <?php } while ($row_hm = mysql_fetch_assoc($hm)); ?>
</table>

</DIV>
</body>
</html>
<?php
mysql_free_result($hm);
?>

 


<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>