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



$colname_vcu = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_vcu = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_vcu = sprintf("SELECT * FROM d89xz_vacunasion WHERE id_vacuno = %s ORDER BY fecha DESC", GetSQLValueString($colname_vcu, "int"));
$vcu = mysql_query($query_vcu, $conexion) or die(mysql_error());
$row_vcu = mysql_fetch_assoc($vcu);
$totalRows_vcu = mysql_num_rows($vcu);

$colname_pes = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_pes = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_pes = sprintf("SELECT * FROM d89xz_pesos WHERE id_vacuno = %s ORDER BY fecha DESC", GetSQLValueString($colname_pes, "int"));
$pes = mysql_query($query_pes, $conexion) or die(mysql_error());
$row_pes = mysql_fetch_assoc($pes);
$totalRows_pes = mysql_num_rows($pes);

$colname_w = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_w = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_w = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_w, "text"));
$w = mysql_query($query_w, $conexion) or die(mysql_error());
$row_w = mysql_fetch_assoc($w);
$totalRows_w = mysql_num_rows($w);

$colname_act = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_act = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_act = sprintf("SELECT `e_ingreso`, DATEDIFF( CURDATE(), `f_ingreso`)as e_actlb FROM d89xz_vacunos WHERE id_vacuno =%s", GetSQLValueString($colname_act, "int"));
$act = mysql_query($query_act, $conexion) or die(mysql_error());
$row_act = mysql_fetch_assoc($act);
$totalRows_act = mysql_num_rows($act);

$colname_padr = "-1";
if (isset($_GET['padre'])) {
  $colname_padr = $_GET['padre'];
}
mysql_select_db($database_conexion, $conexion);
$query_padr = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_padr, "text"));
$padr = mysql_query($query_padr, $conexion) or die(mysql_error());
$row_padr = mysql_fetch_assoc($padr);
$totalRows_padr = mysql_num_rows($padr);

$colname_madr = "-1";
if (isset($_GET['madre'])) {
  $colname_madr = $_GET['madre'];
}
mysql_select_db($database_conexion, $conexion);
$query_madr = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_madr, "text"));
$madr = mysql_query($query_madr, $conexion) or die(mysql_error());
$row_madr = mysql_fetch_assoc($madr);
$totalRows_madr = mysql_num_rows($madr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Vacuno</title>
<style type="text/css">
#seleccion table tr th {
	color: #FFF;
}
s {
	color: #FFF;
}
#s {
	color: #fff;
}
#seleccion table {
	color: #000;
}
</style>
<link rel="stylesheet" type="text/css" href="shadowbox.css">
<script type="text/javascript" src="shadowbox.js"></script>

<!--<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true
});
// </script>-->

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? 
@$vacuno=$_GET['vacuno'];
@$sexo=$_GET['sexo'];
@$macho=Macho;


?>
<ul id="MenuBar1" class="MenuBarHorizontal" >
  <li><a href="kardex_busqueda.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?> &amp;sexo=<?php echo $sexo?>&amp;sexo=<?php echo $sexo?>" class="current">Informacion</a>  </li>
   <li><a href="kardex_busqueda_sanitaria.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?> &amp;sexo=<?php echo $sexo?>&amp;sexo=<?php echo $sexo?>">Información Sanitaria</a>  </li>
    <li><a href="kardex_busqueda_peso.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?> &amp;sexo=<?php echo $sexo?>&amp;sexo=<?php echo $sexo?>">Información  Pesajes</a>  </li>
 
     
  <? 
   if($sexo != $macho){ 
 echo " <li><a href='krdex_reprod.php?vacuno=$vacuno&amp;id_vacuno=$vacuno&amp;sexo=$sexo' >Informacion Partos</a>  </li> "; 
  echo " <li><a href='krdex_reprod_palp.php?vacuno=$vacuno&amp;id_vacuno=$vacuno&amp;sexo=$sexo' >Control  Reproductivo</a></li>";
  };
  ?>
</ul>
<p>&nbsp;</p>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left"><a rel="shadowbox.open[ejemplos];options={continuous:true,modal: true}" href="editar_vacuno.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>&amp;sexo=<?php echo $sexo?>"><img src="modificar.png" alt="" width="68" height="20" /></a></td>
    <td width="121" align="left"><a onclick="return confirm('Realmente Desea Eliminar Vacuno');" href="eliminar_vacuno.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>"><img src="eliminar.png" alt="" width="68" height="20" /></a></td>
    <td width="308" align="center"><a href="kardex.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 







border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">

  <table width="100%" border="0" cellspacing="2">
  <tr>
    <td colspan="6" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="167" height="56" /></td>
    </tr>
  <tr>
    <th colspan="6" bgcolor="#4D68A2">Informacion General Vacuno</th>
    </tr>
  <tr>
    <th colspan="6" bgcolor="#c0c0c0">&nbsp;</th>
    </tr>
  <tr>
    <td colspan="4" rowspan="3" bgcolor="#FFFFFF">&nbsp;</td>
    <th align="left" bgcolor="#f0f0f0"><span style="color: #000">Vacuno N°</span></th>
    <th width="156" align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['id_vacuno']; ?></th>
    </tr>
  <tr>
    <th align="left" bgcolor="#c0c0c0"><span style="color: #000">Hierro</span></th>
    <th align="left" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['hierro']; ?></th>
    </tr>
  <tr>
    <th align="left" bgcolor="#f0f0f0"><span style="color: #000">Registro N°</span></th>
    <th align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['registro']; ?></th>
    </tr>
  <tr>
    <th align="left" bgcolor="#c0c0c0" style="color: #000">Hacienda</th>
    <td colspan="3" align="center" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['ubicasion']; ?></td>
    <th align="left" bgcolor="#c0c0c0" style="color: #000">Clase</th>
    <td bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['clase']; ?></td>
    </tr>
  <tr>
    <th width="207" align="left" bgcolor="#f0f0f0" style="color: #000">Raza</th>
    <td width="197" align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['raza']; ?></td>
    <th width="176" align="left" bgcolor="#f0f0f0" style="color: #000">Color</th>
    <td width="123" align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['color']; ?></td>
    <th align="left" bgcolor="#f0f0f0" style="color: #000">Sexo</th>
    <td align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['sexo']; ?></td>
    </tr>
 
<tr align="center">
      <th align="left" bgcolor="#c0c0c0" style="color: #000">ID Padre</th>
      <td align="left" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['padre']; ?></td>
      <th align="left" bgcolor="#c0c0c0" style="color: #000">Registro N°</th>
      <td align="left" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_padr['registro']; ?></td>
      <td width="197" align="left" bgcolor="#c0c0c0" style="color: #000">Estado Actual</td>
      <td align="left" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['tp_rep']; ?></td>
    </tr>
    <tr>
      <th align="left" bgcolor="#f0f0f0" style="color: #000">ID Madre</th>
      <td bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['madre']; ?></td>
      <th align="left" bgcolor="#f0f0f0" style="color: #000">Registro N°</th>
      <td align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_madr['registro']; ?></td>
      <th bgcolor="#f0f0f0" style="color: #000">&nbsp;</th>
      <td align="center" bgcolor="#f0f0f0" style="color: #000">&nbsp;</td>
    </tr>
<tr align="center">
      <th align="left" bgcolor="#c0c0c0" style="color: #000">Fecha Ingreso(m)</th>
      <td align="center" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['f_ingreso']; ?></td>
      <th align="left" bgcolor="#c0c0c0" style="color: #000">Edad Ingreso(m)</th>
      <td align="center" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['e_ingreso']; ?></td>
      <th align="left" bgcolor="#c0c0c0" style="color: #000">Peso Ingreso(Kg)</th>
      <td bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['p_ncto']; ?></td>
    </tr>
<tr align="center">
  <th align="left" bgcolor="#f0f0f0" style="color: #000">Edad Actual(M)</th>
  <td align="center" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['edad']; ?></td>
  <th align="left" bgcolor="#f0f0f0" style="color: #000">Clasificacion</th>
  <td align="left" bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['clasificasion']; ?></td>
  <th align="left" bgcolor="#f0f0f0" style="color: #000">Calificación</th>
  <td bgcolor="#f0f0f0" style="color: #000"><?php echo $row_w['calificasion']; ?></td>
</tr>
<tr>
  <th align="left" bgcolor="#c0c0c0" style="color: #000">Costo Ingreso</th>
  <td align="center" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['cos_entro']; ?></td>
  <th align="left" bgcolor="#c0c0c0" id="s" style="color: #000">Observasiones</th>
  <td colspan="3" align="left" bgcolor="#c0c0c0" style="color: #000"><?php echo $row_w['observasiones']; ?></td>
  </tr>
<tr>
  <th colspan="6" align="left" bgcolor="#FFFFFF" style="color: #000">&nbsp;</th>
  </tr>
<tr>
  <th colspan="6" align="left" bgcolor="#4D68A2" style="color: #000">&nbsp;</th>
  </tr>
   
  </table>
</DIV>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($w);;

mysql_free_result($vcu);

mysql_free_result($act);

mysql_free_result($padr);

mysql_free_result($madr);

//mysql_free_result($w);

mysql_free_result($pes);


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