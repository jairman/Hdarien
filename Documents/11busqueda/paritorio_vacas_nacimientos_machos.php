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
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
@$mes=$_GET['mes'];
//echo $mes.'-'.$anoss;
@$dia2=1;
$fechaEsp1=$anoss.'-'.$mes.'-'.$dia2;
$prueba1 = strftime("Mes %B Del %Y ", strtotime($fechaEsp1));
//echo $prueba1;


mysql_select_db($database_conexion, $conexion);
$query_cr = " select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '$mes' ORDER BY edad DESC ";
$cr = mysql_query($query_cr, $conexion) or die(mysql_error());
$row_cr = mysql_fetch_assoc($cr);
$totalRows_cr = mysql_num_rows($cr);




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
 
    <li><a href="paritorio_vacas_nacimientos_machos.php?mes=<? echo $mes ?>" class="current">Crías Machos</a></li>
  <li><a href="paritorio_vacas_nacimientos_hembras.php?mes=<? echo $mes ?>">Crías Hembras</a></li>
  
</ul>
<p>&nbsp;</p>
 
 <table width="100%" border="0" align="center" cellspacing="0">
    <tr bgcolor="#f0f0f0">
      <td width="121" align="left">&nbsp;</td>
      <td width="121" align="left">&nbsp;</td>
      <td width="308" align="center"><a href="paritorio_vacas_nacimientos.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
      <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
    </tr>
</table>
 <td width="32%">&nbsp;</td>
<DIV ID="seleccion">
 
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <td colspan="6" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="177" height="61" /></td>
    </tr>
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="5" bgcolor="#4D68A2">Nacimientos Crías Machos</th>
      <th><? echo $prueba1?></th>
    </tr>
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="6" bgcolor="#f0f0f0">&nbsp;</th>
    </tr>
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th width="13%" bgcolor="#4D68A2">ID</th>
      <th width="11%">Edad</th>
      <th width="11%">Raza</th>
      <th width="8%">Color</th>
      <th width="13%">Madre</th>
      <th width="36%">Observaciones</th>
    </tr>
    <?php do { ?>
      <tr align="center">
        <td><?php echo $row_cr['id_vacuno']; ?></td>
        <td><?php echo $row_cr['edad']; ?></td>
        <td><?php echo $row_cr['raza']; ?></td>
        <td><?php echo $row_cr['color']; ?></td>
        <td><?php echo $row_cr['madre']; ?></td>
        <td><?php echo $row_cr['observasiones']; ?></td>
      </tr>
      <?php } while ($row_cr = mysql_fetch_assoc($cr)); ?>
  </table>
</DIV>

</body>
</html>
<?php
mysql_free_result($cr);
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