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
@$cmpal=$_GET['cmpal'];
@$comen=$_POST['comen'];
@$jornada=$_GET['jpalpa'];
@$jpalpa = $_GET['jpalpa'];
  @$respal= $_GET['respal'];
  @$cmpal = $_GET['cmpal'];
  @$raza1=$_GET['raza1'];
  @$color1 =$_GET['color1'];
  @$clase1 =$_GET['clase1'];
  @$hierro1=$_GET['hierro1'];
mysql_select_db($database_conexion, $conexion);
$query_dias = "SELECT dias FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT meses FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT anos FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

$maxRows_in = 1;
$pageNum_in = 0;
if (isset($_GET['pageNum_in'])) {
  $pageNum_in = $_GET['pageNum_in'];
}
$startRow_in = $pageNum_in * $maxRows_in;

$colname_in = "-1";
if (isset($_GET['vaca'])) {
  $colname_in = $_GET['vaca'];
}
mysql_select_db($database_conexion, $conexion);
$query_in = sprintf("SELECT * FROM d89xz_inseminacion WHERE vaca = %s ORDER BY id DESC", GetSQLValueString($colname_in, "text"));
$query_limit_in = sprintf("%s LIMIT %d, %d", $query_in, $startRow_in, $maxRows_in);
$in = mysql_query($query_limit_in, $conexion) or die(mysql_error());
$row_in = mysql_fetch_assoc($in);

if (isset($_GET['totalRows_in'])) {
  $totalRows_in = $_GET['totalRows_in'];
} else {
  $all_in = mysql_query($query_in);
  $totalRows_in = mysql_num_rows($all_in);
}
$totalPages_in = ceil($totalRows_in/$maxRows_in)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0"><a href="jornada_palpacion+++.php?jpalpa=<? echo $jornada?>&amp;respal=<? echo $respal?>&amp;cmpal=<? echo $cmpal?>&amp;raza1=<? echo $raza1?>&amp;color1=<? echo $color1?>&amp;clase1=<? echo $clase1?>&amp;hierro1=<? echo $hierro1?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right" bgcolor="#f0f0f0">&nbsp;</td>
  </tr>
</table>
<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="571" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="3" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <td>Fecha Palpación </td>
      <th>D<span id="spryselect1">
        <label for="dia"></label>
        <select name="dia" id="dia">
          <option value="">D</option>
          <?php
do {  
?>
          <option value="<?php echo $row_dias['dias']?>"><?php echo $row_dias['dias']?></option>
          <?php
} while ($row_dias = mysql_fetch_assoc($dias));
  $rows = mysql_num_rows($dias);
  if($rows > 0) {
      mysql_data_seek($dias, 0);
	  $row_dias = mysql_fetch_assoc($dias);
  }
?>
        </select>
      </span>M<span id="spryselect2">
      <label for="mes"></label>
      <select name="mes" id="mes">
        <option value="">M</option>
        <?php
do {  
?>
        <option value="<?php echo $row_mes['meses']?>"><?php echo $row_mes['meses']?></option>
        <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
      </select>
      </span>A<span id="spryselect3">
      <label for="anos"></label>
      <select name="anos" id="anos">
        <option value="">A</option>
        <?php
do {  
?>
        <option value="<?php echo $row_anos['anos']?>"><?php echo $row_anos['anos']?></option>
        <?php
} while ($row_anos = mysql_fetch_assoc($anos));
  $rows = mysql_num_rows($anos);
  if($rows > 0) {
      mysql_data_seek($anos, 0);
	  $row_anos = mysql_fetch_assoc($anos);
  }
?>
      </select>
      </span></th>
      <td><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
<p>&nbsp; </p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>Toro</th>
    <th>Servicio</th>
    <th>Fecha Servicio</th>
    <th>Estado</th>
    <th>Fecha Palpación</th>
    <th>vaca</th>
  </tr>
  <?php do { ?>
   <? $id=$row_in['id']; ?>
    <tr>
      <td><?php echo $row_in['toro']; ?></td>
      <td align="center"><?php echo $row_in['servic']; ?></td>
      <td align="center"><?php echo $row_in['fe_ser']; ?></td>
      <td align="center"><?php echo $row_in['estad']; ?></td>
      <td align="center"><?php echo $row_in['f_palpa']; ?></td>
      <td align="center"><?php echo $row_in['vaca']; ?></td>
    </tr>
    <?php } while ($row_in = mysql_fetch_assoc($in)); ?>
</table>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var sprjamanct3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
  </script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($in);
?>


<?
//@$id =$_GET['id'];
@$vaca =$_GET['vaca'];
@$estado='Vaca Prenada';
@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$fecha_palpa=$anob.'-'.$mesb.'-'.$diab;

@$id_vacuno=$_GET['id_vacuno'];
@$vacuno=$_GET['vacuno'];
@$padre=$_GET['padre'];
@$madre=$_GET['madre'];

?>
<?

if ($anob != '' ){
   		
	
$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `tp_rep`='$estado',estrepr='PR'  WHERE `id_vacuno`='$vaca'");	
				
$sql =mysql_query( "UPDATE d89xz_inseminacion SET `estad` = '$estado',`f_palpa`= '$fecha_palpa' WHERE `id`= '$id' and vaca = '$vaca'");

$sql2 =mysql_query( "UPDATE d89xz_vacunos SET `estad` = '$estado',`f_palpa`= '$fecha_palpa' WHERE id_vacuno = '$vaca'");
 $sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`='' ,`respal`='',`cmpal`=''   WHERE `id_vacuno`='$vaca'");

$insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado)
		VALUES ('{$vaca}','{$fecha_palpa}','{$estado}')");
		
		
		echo "<script type=''>


		
			window.location='jornada_palpacion+++.php?jpalpa=" . $jornada . "&respal=" .$respal. "&cmpal=" .$cmpal. "&raza1=" .$raza1. "&color1=" .$color1. "&clase1=" .$clase1. "&hierro1=" .$hierro1. "';
		
	
	</script>";
	
		
}
	   
?>	   