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

$colname_idv = "-1";
if (isset($_POST['text_vaca'])) {
  $colname_idv = $_POST['text_vaca'];
}
mysql_select_db($database_conexion, $conexion);
$query_idv = sprintf("SELECT * FROM d89xz_vacunos WHERE madre = %s", GetSQLValueString($colname_idv, "text"));
$idv = mysql_query($query_idv, $conexion) or die(mysql_error());
$row_idv = mysql_fetch_assoc($idv);
$totalRows_idv = mysql_num_rows($idv);

$colname_reg = "-1";
if (isset($_POST['text_vaca'])) {
  $colname_reg = $_POST['text_vaca'];
}
mysql_select_db($database_conexion, $conexion);
$query_reg = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_reg, "text"));
$reg = mysql_query($query_reg, $conexion) or die(mysql_error());
$row_reg = mysql_fetch_assoc($reg);
$totalRows_reg = mysql_num_rows($reg);


$maxRows_ins = 1;
$pageNum_ins = 0;
if (isset($_GET['pageNum_ins'])) {
  $pageNum_ins = $_GET['pageNum_ins'];
}
$startRow_ins = $pageNum_ins * $maxRows_ins;

$colname_ins = "-1";
if (isset($_POST['text_vaca'])) {
  $colname_ins = $_POST['text_vaca'];
}
mysql_select_db($database_conexion, $conexion);
$query_ins = sprintf("SELECT * FROM d89xz_inseminacion WHERE vaca = %s ORDER BY id DESC", GetSQLValueString($colname_ins, "text"));
$query_limit_ins = sprintf("%s LIMIT %d, %d", $query_ins, $startRow_ins, $maxRows_ins);
$ins = mysql_query($query_limit_ins, $conexion) or die(mysql_error());
$row_ins = mysql_fetch_assoc($ins);

if (isset($_GET['totalRows_ins'])) {
  $totalRows_ins = $_GET['totalRows_ins'];
} else {
  $all_ins = mysql_query($query_ins);
  $totalRows_ins = mysql_num_rows($all_ins);
}
$totalPages_ins = ceil($totalRows_ins/$maxRows_ins)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reproductora</title>

<style type="text/css">
.j {
	color: #FFF;
}
#form1 table {
	color: #000;
}
#form1 table tr th {
	color: #FFF;
}
</style>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>

<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php">Inventario Vacuno</span></a>  </li>
    <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a>  </li>
  <li><a href="reprod.php"  class="current">Reproductoras</a></li>
  <li><a href="busq_kardex1.php">Búsqueda</a></li>
</ul>
<p>&nbsp; </p>
<p><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>
  
  <DIV ID="seleccion">
  
<img src="idsolutions--este.png" width="162" height="59" /></p>

<form id="form1" name="form1" method="post" action="">
  <td>&nbsp;</td>
  <table width="99%" border="1" align="center">
    <tr>
      <th colspan="2" bgcolor="#4D68A2" class="j">Reproductora</th>
      <td width="65"><input name="text_vaca" type="text" id="text_vaca" size="8" /></td>
      <td colspan="6">&nbsp;</td>
      <th width="139"><input type="submit" name="button" id="button" value="Enviar" /></th>
    </tr>
    <tr>
      <td width="72"><strong>Hacienda</strong></td>
      <td colspan="2"><?php echo $row_reg['ubicasion']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Vaca No</strong></td>
      <td width="70"><?php echo $row_reg['id_vacuno']; ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Registro</td>
      <td colspan="2"><?php echo $row_reg['registro']; ?></td>
      <td width="99">&nbsp;</td>
      <td colspan="2">F.Nacimiento</td>
      <td colspan="2"><?php echo $row_reg['f_ingreso']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Padre</td>
      <td width="92"><?php echo $row_reg['padre']; ?></td>
      <td>Registro</td>
      <td>&nbsp;</td>
      <td width="67">Madre</td>
      <td width="69"><?php echo $row_reg['madre']; ?></td>
      <td width="79">Registro</td>
      <td width="77">&nbsp;</td>
      <td>Clasificacion</td>
      <td><?php echo $row_reg['clasificasion']; ?></td>
    </tr>
    <tr>
      <td>P.205 D</td>
      <td><?php echo $row_reg['p_205']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>P.18M</td>
      <td><?php echo $row_reg['p_18']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong><a href="palpacion.php?id=<?php echo $row_ins['id']; ?>&amp;vaca=<?php echo $row_ins['vaca']; ?>">Palpacion #2</a></strong></td>
    </tr>
    <tr>
      <th rowspan="2" bgcolor="#4D68A2">Padre</th>
      <th rowspan="2" bgcolor="#4D68A2">F.Parto</th>
      <th rowspan="2" bgcolor="#4D68A2">Sexo</th>
      <th rowspan="2" bgcolor="#4D68A2">No. Cria</th>
      <th colspan="2" bgcolor="#4D68A2">Destete</th>
      <th colspan="3" bgcolor="#4D68A2">Pesos</th>
      <th rowspan="2" bgcolor="#4D68A2">Clasificacion y destino cria OBSERVACIONES</th>
    </tr>
    <tr>
      <th bgcolor="#4D68A2">Fecha</th>
      <th bgcolor="#4D68A2">Peso</th>
      <th bgcolor="#4D68A2">Peso Ncto.</th>
      <th bgcolor="#4D68A2">P.A 205 Dias</th>
      <th bgcolor="#4D68A2">P.A 18 Meses</th>
    </tr>
   
    <?php do { ?>
   
    <tr>
      <td><?php echo $row_idv['padre']; ?></td>
      <td><?php echo $row_idv['f_ingreso']; ?></td>
      <td><?php echo $row_idv['sexo']; ?></td>
      <td><?php echo $row_idv['id_vacuno']; ?></td>
      <td><?php echo $row_idv['f_dtt']; ?></td>
      <td><?php echo $row_idv['p_dtt']; ?></td>
      
      
      <td><?php echo $row_idv['p_ncto']; ?></td>
      <td><?php echo $row_idv['p_205']; ?></td>
      <td><?php echo $row_idv['p_18']; ?></td>
      <td><?php echo $row_idv['observasiones']; ?></td>
    </tr>
   <?php } while ($row_idv = mysql_fetch_assoc($idv)); ?>
   
   
  </table>
  <p>&nbsp;</p>
  <table width="99%" border="1" align="center">
    <tr>
      <th bgcolor="#4D68A2">Toro</th>
      <th bgcolor="#4D68A2">T. Servicio</th>
      <th bgcolor="#4D68A2">F. Servicio</th>
      <th bgcolor="#4D68A2">Estado</th>
      <th bgcolor="#4D68A2">F. Palpacion</th>
      <th bgcolor="#4D68A2">Dede Criar</th>
      <th bgcolor="#4D68A2">Vaca</th>
    </tr>
    <?php do { ?>
    <?
	$pre ='Preñada';
	$esta = $row_ins['estad'];
	
	?>
      <tr>
        <td><?php echo $row_ins['toro']; ?></td>
        <td><?php echo $row_ins['servic']; ?></td>
        <td><?php echo $row_ins['fe_ser']; ?></td>
        <td><?php echo $row_ins['estad']; ?></td>
        <td><?php echo $row_ins['f_palpa']; ?></td>
        <td><?php if ($esta==$pre){echo $row_ins["d_criar"]; };?></td>
        <td><?php echo $row_ins['vaca']; ?></td>
      </tr>
      <?php } while ($row_ins = mysql_fetch_assoc($ins)); ?>
  </table>
<p>&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($idv);

mysql_free_result($reg);

mysql_free_result($ins);
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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>