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
$query_tipos = "SELECT * FROM d89xz_clasificacion";
$tipos = mysql_query($query_tipos, $conexion) or die(mysql_error());
$row_tipos = mysql_fetch_assoc($tipos);
$totalRows_tipos = mysql_num_rows($tipos);

mysql_select_db($database_conexion, $conexion);
$query_hm = "SELECT id_vacuno, raza, madre, hierro, clase, ubicasion, reprd, tp_rep, estrepr FROM d89xz_vacunos WHERE sexo = 'hembra' ORDER BY id_vacuno ASC";
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


<style type="text/css">
#form1 table tr th {
	color: #000;
}
.aa {
	color: #FFF;
}
</style>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<body>

<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="busq_kardex1.php">Búsqueda General</a>  </li>
  <li><a href="busq_kardex2.php">Búsqueda Filtrada</a></li>
  <li><a href="busqueda_reproductodas.php"  class="current">Estado Reproductivo</a>  </li>
  
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="kardex.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion1')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="3" bgcolor="#4D68A2" style="color: #fff">Búsqueda</th>
    </tr>
    <tr>
      <th width="238">Estado Reproductivo</th>
      <td width="238"><label for="select_tipo"></label>
        <select name="select_tipo" id="select_tipo">
          <option value="">Seleccione la opción a Buscar</option>
          <?php
do {  
?>
          <option value="<?php echo $row_tipos["clasificacison"]?>"><?php echo $row_tipos["clasificacison"]?></option>
          <?php
} while ($row_tipos = mysql_fetch_assoc($tipos));
  $rows = mysql_num_rows($tipos);
  if($rows > 0) {
      mysql_data_seek($tipos, 0);
	  $row_tipos = mysql_fetch_assoc($tipos);
  }
?>
      </select></td>
      <th width="47"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="aa">
    <th width="199" bgcolor="#4D68A2">ID</th>
    <th width="81" bgcolor="#4D68A2">Hierro</th>
    <th width="123" bgcolor="#4D68A2">Raza </th>
    <th width="158" bgcolor="#4D68A2">Color</th>
    <th width="111" bgcolor="#4D68A2">Clase</th>
    <th width="90" bgcolor="#4D68A2">Sexo</th>
    <th width="92" bgcolor="#4D68A2">Edad</th>
    <th width="182" bgcolor="#4D68A2">Ubicacion</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <th><?php echo $row_kr['id_vacuno']; ?></th>
      <td><?php echo $row_kr['hierro']; ?></td>
      <td><?php echo $row_kr['raza']; ?></td>
      <td><?php echo $row_kr['color']; ?></td>
      <td><?php echo $row_kr['clase']; ?></td>
      <td><?php echo $row_kr['sexo']; ?></td>
      <td><?php echo $row_kr['edad']; ?></td>
      <td><?php echo $row_kr['ubicasion']; ?></td>
    </tr>
    <?php } while ($row_kr = mysql_fetch_assoc($kr)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($kr);

mysql_free_result($tipos);
?>

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


