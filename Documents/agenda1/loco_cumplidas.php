<?
$ruta_a_joomla = "/../../../saga/";
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
<?php require_once('../Connections/conexion.php'); ?>
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

 $fecha=$_GET['fecha'];
$colname_pen = "-1";
if (isset($_GET['fecha'])) {
  $colname_pen = $_GET['fecha'];
}
mysql_select_db($database_conexion, $conexion);
$query_pen = sprintf("SELECT * FROM d89xz_tareas WHERE estado ='Cumplida' and fecha = %s", GetSQLValueString($colname_pen, "date"));
$pen = mysql_query($query_pen, $conexion) or die(mysql_error());
$row_pen = mysql_fetch_assoc($pen);
$totalRows_pen = mysql_num_rows($pen);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda</title>
<link href="../agenda/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../agenda/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../agenda/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../semen/js/shadowbox.js" type="text/javascript"></script>
<script src="../semen/js/jquery.validate.js" type="text/javascript"></script>


 <style> 
a{text-decoration:none} 
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,
	onClose: function(){ $('#seleccion').load('loco.php'  + ' #seleccion ' );  
	}
});
// </script>
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
</head>

<body>

<table width="98%" border="0" align="center" cellspacing="0" >
  <tr bgcolor="#f0f0f0">
    <td width="15%" align="left" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="15%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <DIV ID="seleccion">
</table>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <td colspan="2" bgcolor="#FFFFFF"><img src="img/Logo SAGA sin texto.png" alt="" width="200" height="70" /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td width="27%" align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="5%" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="6"  class="tittle" >Actividades Pendientes</th>
  </tr>
  <tr class="bold">
    <th width="10%" class="row">Fecha Inicio</th>
    <th width="14%" class="row">Fecha Final</th>
    <th width="9%" class="row">Hora</th>
    <th width="35%" class="row">Tipo </th>
    <th colspan="2" class="row">Comentario</th>
  </tr>
  <?php do { ?>
   <tr class="row" align="center" id="fila_<? echo $row_pen['id']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_pen['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<? echo $row_pen['id']; ?>')" >
    
    
    
      <td class="row" onClick="CrearEnlace('loco_detalle_c.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['jorn']; ?></td>
      <td class="row" onClick="CrearEnlace('loco_detalle_c.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['fecha']; ?></td>
      <td class="row" onClick="CrearEnlace('loco_detalle_c.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['hora']; ?></td>
      <td class="row" onClick="CrearEnlace('loco_detalle_c.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['comen']; ?></td>
      <td colspan="2" class="row" onClick="CrearEnlace('loco_detalle_c.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;id=<?php echo $row_pen['id']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>');"><?php echo $row_pen['tarea']; ?></td>
    </tr>
    <?php } while ($row_pen = mysql_fetch_assoc($pen)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($pen);
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