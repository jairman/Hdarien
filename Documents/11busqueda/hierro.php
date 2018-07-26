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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO d89xz_hierros (hierro,nombre, comentarios) VALUES (%s,%s, %s)",
                       GetSQLValueString($_POST['hierro'], "text"),
					   GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['comentarios'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

$maxRows_hierro = 100;
$pageNum_hierro = 0;
if (isset($_GET['pageNum_hierro'])) {
  $pageNum_hierro = $_GET['pageNum_hierro'];
}
$startRow_hierro = $pageNum_hierro * $maxRows_hierro;

mysql_select_db($database_conexion, $conexion);
$query_hierro = "SELECT * FROM d89xz_hierros";
$query_limit_hierro = sprintf("%s LIMIT %d, %d", $query_hierro, $startRow_hierro, $maxRows_hierro);
$hierro = mysql_query($query_limit_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);

if (isset($_GET['totalRows_hierro'])) {
  $totalRows_hierro = $_GET['totalRows_hierro'];
} else {
  $all_hierro = mysql_query($query_hierro);
  $totalRows_hierro = mysql_num_rows($all_hierro);
}
$totalPages_hierro = ceil($totalRows_hierro/$maxRows_hierro)-1;
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
 <li><a href="hacienda.php">Empresa</a>  </li>
  <li><a href="clientes_kardex.php"  >Clientes</a> </li>
  <li><a href="prove_kardex.php">Proveedores</a></li>
  <li><a href="regis_empleados.php">Empleados</a>  </li>
  <li><a href="hierro.php" class="current">Hierros</a></li>
  
</ul>
<p>&nbsp;</p>

  <p>
    </form>
</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="585" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="2" bgcolor="#4D68A2">Ingrese Hierro  y  Observasiones</th>
    </tr>
    <tr>
      <td width="219"><strong>Ingrese Hierro</strong></td>
      <td width="356" align="center"><input type="text" name="hierro" value="" size="52" /></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td align="center"><input name="nombre" type="text" id="nombre" value="" size="52" /></td>
    </tr>
    <tr>
      <td><strong>Comentarios</strong></td>
      <td align="center"><label for="textarea_comentario">
        <input type="text" name="comentarios" value="" size="52" />
      </label></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<DIV ID="seleccion">
<table width="585" border="1" align="center" cellspacing="0">
  <tr class="c">
    <td colspan="4" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
    </tr>
  <tr class="c">
    <th width="97" bgcolor="#4D68A2">Hierro</th>
    <th width="232" bgcolor="#4D68A2">Nombre</th>
    <th width="182" bgcolor="#4D68A2">Comentarios</th>
    <th width="56" bgcolor="#4D68A2">Eliminar</th>
  </tr>
  <?php do { ?>
  <tr>
    <th><?php echo $row_hierro['hierro']; ?></th>
    <th><?php echo $row_hierro['nombre']; ?></th>
    <td align="center"><?php echo $row_hierro['comentarios']; ?></td>
    <td align="center"><a href="eliminar_hierro.php?id=<?php echo $row_hierro['id']; ?>" onclick="return confirm('Desea Eliminar El Hierro ');">Eliminar</a></td>
  </tr>
  <?php } while ($row_hierro = mysql_fetch_assoc($hierro)); ?>
</table>
</DIV> 
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($hierro);
?>





<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>

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