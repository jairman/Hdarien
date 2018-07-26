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
$query_nv = "SELECT * FROM `d89xz_vacunos` WHERE `d_criar` >= CURDATE()   AND `d_criar` <= DATE_ADD(CURDATE(), INTERVAL  '31' DAY) ORDER BY `d_criar` ASC";
$nv = mysql_query($query_nv, $conexion) or die(mysql_error());
$row_nv = mysql_fetch_assoc($nv);
$totalRows_nv = mysql_num_rows($nv);
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

 <style> 
a{text-decoration:none} 
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>

<script type="text/javascript"><!--

Shadowbox.init({
    handleOversize:     "drag",
    displayNav:         false,
    handleUnsupported:  "remove",
});

// --></script>
<body>



<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php" >Inventario Vacuno</span></a>  </li>
    <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a></li>
  <li><a href="kardex_paridas_inven.php">Paridas</a></li>
  <li><a href="paritorio.php" class="current">Paritorio</a></li>
    <li><a href="movimiento_mensual.php">Movimientos</a></li>
     <li><a href="agregar_lotes_princi.php">Lotes</a></li>
</ul>
 <p>&nbsp;</p>
 <ul id="MenuBar1" class="MenuBarHorizontal">
 
  <li><a href="paritorio_vacas_proxi_parir.php" class="current"> Próximas A Parir</a></li>
    <li><a href="paritorio_vacas_prenadas.php"> Preñadas</a></li>
  
  <li><a href="paritorio_vacas_nacimientos.php"> Nacimientos</a></li>
    <li><a href="paritorio_vacas_abortos.php"> Abortos</a></li>
  
</ul>
 <p>&nbsp;</p>
   <td width="32%"><table width="100%" border="0" cellspacing="0">
     <tr>
       <td bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
     </tr>
   </table></td>
<DIV ID="seleccion">
  

 <table width="100%" border="1" cellspacing="0">
    <tr>
      <td colspan="6" bgcolor="#FFFFFF" style="color: #FFF"><img src="idsolutions--este.png" width="177" height="61" /></td>
    </tr>
    <tr>
      <th colspan="6" bgcolor="#4D68A2" style="color: #FFF">Inventario      Vacas Próximas  A  Parir</th>
    </tr>
    <tr>
      <th colspan="6" bgcolor="#f0f0f0" style="color: #FFF">&nbsp;</th>
    </tr>
    <tr>
      <th width="11%" bgcolor="#4D68A2" style="color: #FFF">ID</th>
      <th width="10%" bgcolor="#4D68A2" style="color: #FFF">Raza</th>
      <th width="6%" bgcolor="#4D68A2" style="color: #FFF">Color</th>
      <th width="16%" bgcolor="#4D68A2" style="color: #FFF">Posible Parto</th>
      <th width="49%" bgcolor="#4D68A2" style="color: #FFF">Observaciones</th>
      <th width="8%" bgcolor="#4D68A2" style="color: #FFF">Parto</th>
    </tr>
    <?php do { ?>
      <tr align="center">
        <td><?php echo $row_nv['id_vacuno']; ?></td>
        <td><?php echo $row_nv['raza']; ?></td>
        <td><?php echo $row_nv['color']; ?></td>
        <th bgcolor="#FF0000" style="color: #FFF"><?php echo $row_nv['d_criar']; ?></th>
        <td><?php echo $row_nv['coment_pal']; ?></td>
        <td><a href="ingreso_vacuno_paridas.php?vaca=<?php echo $row_nv['id_vacuno']; ?>&amp;toro=<?php echo $row_nv['toro']; ?>">Registrar</a></td>
      </tr>
      <?php } while ($row_nv = mysql_fetch_assoc($nv)); ?>
  </table>

</DIV>

</body>
</html>
<?php
mysql_free_result($nv);
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