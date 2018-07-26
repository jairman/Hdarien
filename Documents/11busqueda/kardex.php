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
$query_kard = "SELECT * FROM d89xz_vacunos ORDER BY id_vacuno ASC";
$kard = mysql_query($query_kard, $conexion) or die(mysql_error());
$row_kard = mysql_fetch_assoc($kard);
$totalRows_kard = mysql_num_rows($kard);

mysql_select_db($database_conexion, $conexion);
$query_rz = "SELECT raza FROM d89xz_razas";
$rz = mysql_query($query_rz, $conexion) or die(mysql_error());
$row_rz = mysql_fetch_assoc($rz);
$totalRows_rz = mysql_num_rows($rz);

mysql_select_db($database_conexion, $conexion);
$query_cl = "SELECT color FROM d89xz_color_raza";
$cl = mysql_query($query_cl, $conexion) or die(mysql_error());
$row_cl = mysql_fetch_assoc($cl);
$totalRows_cl = mysql_num_rows($cl);

mysql_select_db($database_conexion, $conexion);
$query_hr = "SELECT * FROM d89xz_hierros";
$hr = mysql_query($query_hr, $conexion) or die(mysql_error());
$row_hr = mysql_fetch_assoc($hr);
$totalRows_hr = mysql_num_rows($hr);

mysql_select_db($database_conexion, $conexion);
$query_bus = "SELECT * FROM d89xz_vacunos";
$bus = mysql_query($query_bus, $conexion) or die(mysql_error());
$row_bus = mysql_fetch_assoc($bus);
$totalRows_bus = mysql_num_rows($bus);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



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


<style type="text/css">
#seleccion #form1 table tr th {
	color: #FFF;
}
#c {
	color: #FFF;
}
#form2 table tr th {
	color: #FFF;
}
</style>


<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>
 <style> 
a{text-decoration:none} 
</style>
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true
});
// </script>
</head>
<body>



<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php" class="current">Inventario Vacuno</span></a>  </li>
    <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a></li>
  <li><a href="kardex_paridas_inven.php">Paridas</a></li>
  <li><a href="paritorio.php">Paritorio</a></li>
  <li><a href="movimiento_mensual.php">Movimientos</a></li>
   <li><a href="agregar_lotes_princi.php">Lotes</a></li>
</ul>
 <p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0" >

  <tr bgcolor="#f0f0f0">
    <td width="15%" align="center"><a rel="shadowbox[ejemplos];options={continuous:true,modal: true}" href="ingreso_vacuno.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
    <td width="15%" align="center"><a  href="busq_kardex1.php"><img src="buscar.png" /></a></td>
    <td align="center"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">
  <table width="100%" border="1" align="center" cellspacing="0" class="current" id="myTable2">
 
    <tr>
      <td colspan="7" bgcolor="#FFFFFF" class="current" style="color: #FFF"><img src="idsolutions--este.png" width="177" height="61" /></td>
    </tr>
    <tr>
  <th colspan="7" bgcolor="#4D68A2" class="current" style="color: #FFF">Inventario  Ganado  Vacuno</th>
  </tr>
    <tr>
      <th colspan="7" bgcolor="#f0f0f0" class="current" style="color: #FFF">&nbsp;</th>
    </tr>
<tr>



      <th width="173" bgcolor="#4D68A2" style="color: #FFF">ID</th>
    <th width="114" bgcolor="#4D68A2" style="color: #FFF">Hierro</th>
    <th width="154" bgcolor="#4D68A2" style="color: #FFF">Raza</th>
    <th width="140" bgcolor="#4D68A2" style="color: #FFF">Color</th>
    <th width="130" bgcolor="#4D68A2" style="color: #FFF">Clase</th>
    <th width="89" bgcolor="#4D68A2" style="color: #FFF">Sexo</th>
    <th width="154" bgcolor="#4D68A2" style="color: #FFF">Ubicacion</th>
    </tr>

   
    
  <?php do { ?>
   <tr align="center" id="fila_<? echo $row_kard['id']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_kard['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<? echo $row_kard['id']; ?>')" onClick="CrearEnlace('kardex_busqueda.php?id_vacuno=<?php echo $row_kard['id_vacuno']; ?>&amp;vacuno=<?php echo $row_kard['id_vacuno']; ?>&amp;padre=<?php echo $row_kard['padre']; ?>&amp;madre=<?php echo $row_kard['madre']; ?>&amp;sexo=<?php echo $row_kard['sexo']; ?>');">
   
      <th align="left"><?php echo $row_kard['id_vacuno']; ?></th>
      <td><?php echo $row_kard['hierro']; ?></td>
       <td><?php echo utf8_encode($row_kard['raza']); ?></td>
      <td><?php echo $row_kard['color']; ?></td>
      <td><?php echo $row_kard['clase']; ?></td>
      <td><?php echo $row_kard['sexo']; ?></td>
      <td><?php echo $row_kard['ubicasion']; ?></td>
      </tr>
    <?php } while ($row_kard = mysql_fetch_assoc($kard)); ?>
   
   
</table>

</DIV>

</body>
</html>




<?php
mysql_close($conexion);
mysql_free_result($kard);

mysql_free_result($rz);

mysql_free_result($cl);

mysql_free_result($hr);

mysql_free_result($bus);
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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>