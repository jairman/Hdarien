<?
$ruta_a_joomla = "/../../Hdarien/";

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
<?

$ip = $_SERVER['REMOTE_ADDR'];

//echo "Su dirección IP es: $ip";

?>


<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>





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
  $insertSQL = sprintf("INSERT INTO d89xz_clientes (cedula, nombre, apellido, telefono, descr, empresa) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
					   GetSQLValueString($_POST['Descripci'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_client = "SELECT * FROM d89xz_prove";
$client = mysql_query($query_client, $conexion) or die(mysql_error());
$row_client = mysql_fetch_assoc($client);
$totalRows_client = mysql_num_rows($client);mysql_select_db($database_conexion, $conexion);
$query_client = "SELECT * FROM d89xz_prove";
$client = mysql_query($query_client, $conexion) or die(mysql_error());
$row_client = mysql_fetch_assoc($client);
$totalRows_client = mysql_num_rows($client);



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO d89xz_catego_prove (categ, `desc`) VALUES (%s, %s)",
                       GetSQLValueString($_POST['categ'], "text"),
                       GetSQLValueString($_POST['desc'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_ct = "SELECT * FROM d89xz_catego_prove";
$ct = mysql_query($query_ct, $conexion) or die(mysql_error());
$row_ct = mysql_fetch_assoc($ct);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.c {
	color: #FFF;
}
#form1 table {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
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
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="hacienda.php">Empresa</a>  </li>
 <li><a href="clientes_kardex.php">Clientes</a> </li>
  <li><a href="prove_kardex.php" class="current">Proveedores</a></li>
  <li><a href="regis_empleados.php">Empleados</a>  </li>
   
</ul>
<p>&nbsp;</p>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="">      Proveedores    </li>
    <li class="TabbedPanelsTab" tabindex="">      Categorías    </li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="100%" border="0" align="center" cellspacing="0" >
        <tr bgcolor="#f0f0f0">
          <td width="396">&nbsp;</td>
          <th width="388" align="right"><a rel="shadowbox[ejemplos];options={continuous:true}" href="prove.php"><img src="add.png" alt="" width="68" height="20" /></a></th>
        </tr>
      </table>
      <table width="100%" border="1" align="center" cellspacing="0">
        <tr bgcolor="#4D68A2" class="c">
          <th width="133">Cedula/NIT</th>
          <th width="220">Nombre</th>
          <th width="111">Telefono</th>
          <th width="155">Contacto</th>
          <th width="100">Categoría</th>
        </tr>
        <?php do { ?>
           <tr align="center" id="fila_<? echo $row_client['id']; ?>"  onMouseOver="ResaltarFila('fila_<? echo $row_client['id']; ?>');mano(this);" onMouseOut="RestablecerFila('fila_<? echo $row_client['id']; ?>')" onClick="CrearEnlace('legajador_prove.php?cedula=<?php echo $row_client['cedula']; ?>&amp;prove=<?php echo $row_client['cedula']; ?>');">
        
          <td><?php echo $row_client['cedula']; ?></td>
          <td><?php echo $row_client['nombre']; ?></td>
          <td><?php echo $row_client['telefono']; ?></td>
          <td><?php echo $row_client['empresa']; ?></td>
          <td><?php echo $row_client['categ']; ?></td>
          </tr>
        <?php } while ($row_client = mysql_fetch_assoc($client)); ?>
      </table>
      <p>&nbsp;</p>
    </div>
    <div class="TabbedPanelsContent">
    
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table width="500" border="1" align="center" cellspacing="0">
    <tr valign="baseline" bgcolor="#4D68A2">
      <th colspan="2" align="center" nowrap="nowrap"><span style="color: #FFF">Registro de  Categoría</span></th>
    </tr>
    <tr valign="baseline">
      <th width="157" align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span style="color: #000">Categoría</span></th>
      <th width="327"><input type="text" name="categ" value="" size="50" /></th>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#FFFFFF"><span style="color: #000">Descripción</span></th>
      <th><input type="text" name="desc" value="" size="50" /></th>
    </tr>
    <tr valign="baseline" bgcolor="#4D68A2">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#FFFFFF"><input type="submit" value="Registro Categoría" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />
</form>
<table width="500" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2">
    <th><span style="color: #FFF">Categoría</span></th>
    <th><span style="color: #FFF">Descripción</span></th>
  </tr>
  <?php do { ?>
    <tr align="center" bgcolor="#f0f0f0">
      <td><a href="edit_categ_prove.php?id=<?php echo $row_ct['id']; ?>"><?php echo $row_ct['categ']; ?></a></td>
      <td><?php echo $row_ct['desc']; ?></td>
    </tr>
    <?php } while ($row_ct = mysql_fetch_assoc($ct)); ?>
</table>
    
    
    </div>
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>

</body>
</html>
<?php
mysql_free_result($client);
mysql_free_result($ct);
?>
