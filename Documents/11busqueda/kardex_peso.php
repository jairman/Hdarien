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
$raza = $_POST['raza'];
$color = $_POST['color'];
$sexo = $_POST['sexo'];
$clase = $_POST['clase'];
$hierro = $_POST['hierro'];


mysql_select_db($database_conexion, $conexion);
$query_kard = "SELECT * FROM d89xz_vacunos WHERE `raza`= '$raza' AND color= '$color' AND sexo = '$sexo'  AND clase = '$clase' AND hierro = '$hierro'";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



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

<a href="javascript:imprSelec('seleccion1')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>
</head>

<body>
<DIV ID="seleccion2">
  <p><img src="idsolutions--este.png" width="162" height="59" /></p>

<form id="form2" name="form2" method="post" action="">
  <table width="692" border="1">
    <tr>
      <th colspan="6" bgcolor="#4D68A2">Busqueda  por  Raza, Color, Sexo<span style="color: #FFF"></span></th>
    </tr>
    <tr>
      <td width="131"><label for="raza"></label>
        <select name="raza" id="raza">
          <option value="">Seleccione Raza</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rz['raza']?>"><?php echo $row_rz['raza']?></option>
          <?php
} while ($row_rz = mysql_fetch_assoc($rz));
  $rows = mysql_num_rows($rz);
  if($rows > 0) {
      mysql_data_seek($rz, 0);
	  $row_rz = mysql_fetch_assoc($rz);
  }
?>
      </select></td>
      <td width="133"><label for="color"></label>
        <select name="color" id="color">
          <option value="">Seleccione Color</option>
          <?php
do {  
?>
          <option value="<?php echo $row_cl['color']?>"><?php echo $row_cl['color']?></option>
          <?php
} while ($row_cl = mysql_fetch_assoc($cl));
  $rows = mysql_num_rows($cl);
  if($rows > 0) {
      mysql_data_seek($cl, 0);
	  $row_cl = mysql_fetch_assoc($cl);
  }
?>
      </select></td>
      <td width="99"><label for="sexo"></label>
        <select name="clase" id="select2">
          <option>Seleccione</option>
          <option value="Puro">Puro</option>
          <option value="Comercial">Comercial</option>
      </select></td>
      <td width="104"><label for="select2">
        <select name="sexo" id="sexo">
          <option>Seleccione Sexo</option>
          <option value="Macho">Macho</option>
          <option value="Hembra">Hembra</option>
        </select>
      </label></td>
      <td width="104" align="center"><label for="select3"></label>
        <select name="hierro" id="select3">
          <option value="">Hierro</option>
          <?php
do {  
?>
          <option value="<?php echo $row_hr['hierro']?>"><?php echo $row_hr['hierro']?></option>
          <?php
} while ($row_hr = mysql_fetch_assoc($hr));
  $rows = mysql_num_rows($hr);
  if($rows > 0) {
      mysql_data_seek($hr, 0);
	  $row_hr = mysql_fetch_assoc($hr);
  }
?>
      </select></td>
      <td width="85" align="center"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>




</DIV>
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

<title></title>

<style type="text/css">
#seleccion table tr th {
	color: #FFF;
}
</style>
<DIV ID="seleccion">
  
  
  
  
  <table border="1" width="692">
    <tr>
  <th colspan="7" bgcolor="#4D68A2" style="color: #FFF"><strong>Kardex</strong></th>
  </tr>
<tr>
      <th width="114" bgcolor="#4D68A2" style="color: #FFF">ID</th>
    <th width="82" bgcolor="#4D68A2" style="color: #FFF">Hierro</th>
    <th width="113" bgcolor="#4D68A2" style="color: #FFF">Raza</th>
    <th width="78" bgcolor="#4D68A2" style="color: #FFF">Color</th>
    <th width="77" bgcolor="#4D68A2" style="color: #FFF">Clase</th>
    <th width="75" bgcolor="#4D68A2" style="color: #FFF">Sexo</th>
    <th width="124" bgcolor="#4D68A2" style="color: #FFF">Ubicacion</th>
    
  </tr>
  <?php do { ?>
    <tr>
      <th><a href="peso.php?id_vacuno=<?php echo $row_kard['id_vacuno']; ?>"><?php echo $row_kard['id_vacuno']; ?></a></th>
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