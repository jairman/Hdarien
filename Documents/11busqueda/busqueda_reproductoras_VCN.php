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

$colname_kr = "-1";
if (isset($_POST['select_tipo'])) {
  $colname_kr = $_POST['select_tipo'];
}
mysql_select_db($database_conexion, $conexion);
$query_kr = sprintf("SELECT * FROM d89xz_vacunos WHERE tp_rep = %s", GetSQLValueString($colname_kr, "text"));
$kr = mysql_query($query_kr, $conexion) or die(mysql_error());
$row_kr = mysql_fetch_assoc($kr);
$totalRows_kr = mysql_num_rows($kr);

mysql_select_db($database_conexion, $conexion);
$query_tipos = "SELECT * FROM d89xz_tipo_reproductoras";
$tipos = mysql_query($query_tipos, $conexion) or die(mysql_error());
$row_tipos = mysql_fetch_assoc($tipos);
$totalRows_tipos = mysql_num_rows($tipos);

mysql_select_db($database_conexion, $conexion);
$query_hm = "SELECT id_vacuno, raza, madre,padre, hierro, clase, ubicasion, reprd, tp_rep, estrepr FROM d89xz_vacunos WHERE sexo = 'hembra' AND estrepr='VOE' ORDER BY id_vacuno ASC";
$hm = mysql_query($query_hm, $conexion) or die(mysql_error());
$row_hm = mysql_fetch_assoc($hm);
$totalRows_hm = mysql_num_rows($hm);

mysql_select_db($database_conexion, $conexion);
$query_ed = "SELECT `e_ingreso`, DATEDIFF( CURDATE(), `f_ingreso`)as e_actlb FROM d89xz_vacunos WHERE sexo = 'hembra' ORDER BY id_vacuno ASC";
$ed = mysql_query($query_ed, $conexion) or die(mysql_error());
$row_ed = mysql_fetch_assoc($ed);
$totalRows_ed = mysql_num_rows($ed);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reproductoras</title>
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
#form1 table tr th {
	color: #000;
}
.aa {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
</head>




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
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php">Inventario Vacuno</span></a>  </li>
    <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php"  class="current">Hembras</a>  </li>
    <li><a href="kardex_paridas_inven.php">Paridas</a></li>
    <li><a href="paritorio.php">Paritorio</a></li>
      <li><a href="movimiento_mensual.php">Movimientos</a></li>
 
</ul>
 <p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="busqueda_reproductoras.php" >Puras</a>  </li>
    <li><a href="busqueda_reproductoras_comer.php">Comerciales</a></li>
    <li><a href="busqueda_reproductoras_VCN.php"  class="current">VOE</a></li>
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0">
    <tr>
      <td bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion1')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
    </tr>
  </table>
<DIV ID="seleccion1">
  <table width="100%" border="1" cellspacing="0">
    <tr class="s" style="color: #FFF">
    <td colspan="7" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
  </tr>
  <tr class="s" style="color: #FFF">
    <th colspan="7" bgcolor="#4D68A2">Inventario Hembras VOE</th>
    </tr>
  <tr bgcolor="#f0f0f0" class="s" style="color: #FFF">
    <th colspan="7">&nbsp;</th>
  </tr>
  <tr class="s" style="color: #FFF">
    <th width="158" bgcolor="#4D68A2">ID </th>
    <th width="95" bgcolor="#4D68A2">Hierro</th>
    <th width="121" bgcolor="#4D68A2">Raza</th>
    <th width="87" bgcolor="#4D68A2">Edad(M)</th>
    <th width="260" bgcolor="#4D68A2">E. Fisiol.</th>
    <th width="124" bgcolor="#4D68A2">E. Repr.</th>
    <th width="224" bgcolor="#4D68A2">Ubicacion </th>
  </tr>
  <?php do {?>
      <tr id="fila_<?php echo $row_hm['id_vacuno']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_hm['id_vacuno']; ?>');mano(this);" onMouseOut="RestablecerFila('fila_<? echo $row_hm['id_vacuno']; ?>')" onClick="CrearEnlace('kardex_busqueda.php?id_vacuno=<?php echo $row_hm['id_vacuno']; ?>&amp;vacuno=<?php echo $row_hm['id_vacuno']; ?>&amp;sexo=<?php echo $row_hm['sexo']; ?>');">
      
      <td align="center"><?php echo $row_hm['id_vacuno']; ?></td>
      <td align="center"><?php echo $row_hm['hierro']; ?></td>
      <td align="center"><?php echo $row_hm['raza']; ?></td>
      <td align="center"><?php echo (floor(($row_ed['e_actlb'])/30) +($row_ed['e_ingreso']) ); ?></td>
      
      <td align="center"><?php echo $row_hm['tp_rep']; ?></a></td>
       <td align="center"><?php echo $row_hm['estrepr']; ?></td>
      <td align="center"><?php echo $row_hm['ubicasion']; ?></td>
    </tr>
    <?php //} while ($row_hm = mysql_fetch_assoc($hm)); ?>
    <?php } while (($row_ed = mysql_fetch_assoc($ed))&& ($row_hm = mysql_fetch_assoc($hm)) ); ?>
</table>

</DIV>
</body>
</html>
<?php
mysql_free_result($kr);

mysql_free_result($hm);

mysql_free_result($ed);
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