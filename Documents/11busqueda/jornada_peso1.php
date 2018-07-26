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
$query_vcn = "SELECT DISTINCT `jpeso`,`hierro`,`cmpes`,`respes`,`tipo_pes`,ubicasion FROM d89xz_vacunos WHERE jpeso !='0000-00-00' and `cmpes` !=' ' and `respes` != ' '";
$vcn = mysql_query($query_vcn, $conexion) or die(mysql_error());
$row_vcn = mysql_fetch_assoc($vcn);
$totalRows_vcn = mysql_num_rows($vcn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pendientes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php" >B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php" class="current">Peso</a></li>
  <li><a href="traslado.php">Traslados</a></li>
</ul>

<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="jornada_peso1agend.php" class="current">Agenda / Grupo</a>  </li>
  <li><a href="peso.php" >Individual</a></li>
  <li><a href="jornada_repeso_detalle.php">Reportes</a>  </li>
 
</ul>
  
<p>&nbsp;</p>
<table width="99%" border="0" align="center">
  <tr>
    <th colspan="4" align="center" bgcolor="#4D68A2"><p style="color: #FFF">Agregar  Jornada  De Peso</p></th>
  </tr>
  <tr>
    <td align="left" style="font-weight: bold">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td width="340" align="left" style="font-weight: bold">Por  Fecha  De Nacimiento</td>
    <td width="193" align="left"><a rel="shadowbox[ejemplos];options={continuous:true}" href="jornada__peso1_agregar.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
    <td width="292" align="center"><p style="font-weight: bold">Por Hato</p></td>
    <td width="245" align="center"><a rel="shadowbox[ejemplos];options={continuous:true}" href="jornada_peso1seleccion.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
  </tr>
  <tr>
    <td colspan="4" align="left" style="font-weight: bold">&nbsp;</td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="4">Jornadas Programadas Pendientes</th>
    </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>Fecha</th>
    <th bgcolor="#4D68A2">Tipo</th>
    <th>Hacienda</th>
    <th>Comentario</th>
  </tr>
  <?php do { ?>
  <tr align="center">
    <td><a href="jornada_peso_pesar.php?jpeso=<?php echo $row_vcn['jpeso']; ?>&amp;hierro=<?php echo $row_vcn['hierro']; ?>&amp;cmpes=<?php echo $row_vcn['cmpes']; ?>&amp;respes=<?php echo $row_vcn['respes']; ?>"><?php echo $row_vcn['jpeso']; ?></a></td>
    <td><?php echo $row_vcn['tipo_pes']; ?></td>
    <td><?php echo $row_vcn['ubicasion']; ?></td>
    <td><?php echo $row_vcn['cmpes']; ?></td>
  </tr>
  <?php } while ($row_vcn = mysql_fetch_assoc($vcn)); ?>
</table>
</DIV>
<script type="text/javascript">
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
</script>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($vcn);

mysql_close($conexion);
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