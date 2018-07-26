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
@$vacuno =$_GET['id_vacuno'];
@$hacien =$_GET['hacien'];
//$estado =$_GET['estado'];
@$jornada=$_GET['jpalpa'];

@$responsable =$_GET['responsable'];
@$estado=PN;
@$cmpal=$_GET['cmpal'];
@$comen=$_POST['comen'];

@$jpalpa = $_GET['jpalpa'];
  @$respal= $_GET['respal'];
  @$cmpal = $_GET['cmpal'];
  @$raza1=$_GET['raza1'];
  @$color1 =$_GET['color1'];
  @$clase1 =$_GET['clase1'];
  @$hierro1=$_GET['hierro1'];

$colname_v = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_v = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_v = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_v, "text"));
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0"><a href="jornada_palpacion+++.php?jpalpa=<? echo $jornada?>&respal=<? echo $respal?>&cmpal=<? echo $cmpal?>&raza1=<? echo $raza1?>&color1=<? echo $color1?>&clase1=<? echo $clase1?>&hierro1=<? echo $hierro1?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right" bgcolor="#f0f0f0">&nbsp;</td>
  </tr>
</table>
<p></p>
<p><img src="idsolutions--este.png" alt="" width="177" height="61" /></p>
<p> </p>
<form id="form1" name="form1" method="post" action="">
  <table width="600" border="1" align="center" cellspacing="0">
  <tr>    </tr>
  </table>
  <table width="414" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="2" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <th width="189" align="left">Vaca</th>
      <th width="215"><span id="sprytextfield3">
        <label for="vaca"></label>
        <input name="vaca" type="text" id="vaca" value="<?php echo $vacuno; ?>" size="29" />
      </span></th>
</tr>
    <tr>
      <th align="left">Días De Preñes</th>
      <th><span id="sprytextfield2">
        <label for="dias"></label>
        <input name="dias" type="text" id="dias" size="29" />
      </span></th>
</tr>
    <tr>
      <th align="left">Toro Usado / S.Colectivo</th>
      <th><span id="sprytextfield2">
        <label for="toro"></label>
        <input name="toro" type="text" id="toro" size="29" />
      </span></th>
</tr>
    <tr>
      <th align="left">Tipo  Servicio</th>
      <th><span id="spryselect1">
        <label for="servicio"></label>
        <select name="servicio" id="servicio" style="width:214px">
          <option>Seleccione</option>
          <option value="Monta Directa">Monta Directa</option>
          <option value="Inseminacion">Inseminacion</option>
        </select>
      </span></th>
</tr>
    <tr>
      <th align="left">Comentario</th>
      <th><input name="comen" type="text" id="comen" size="29" /></th>
    </tr>
    <tr>
      <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
  </table>
</form>
<p></p>
 <?

  
@$vacuno =$_GET['id_vacuno'];
@$hacien =$_GET['hacien'];
//$estado =$_GET['estado'];
@$jornada=$_GET['jpalpa'];

@$responsable =$_GET['responsable'];
@$estado=PN;
@$cmpal=$_GET['cmpal'];
@$comen=$_POST['comen'];

@$jpalpa = $_GET['jpalpa'];
  @$respal= $_GET['respal'];
  @$cmpal = $_GET['cmpal'];
  @$raza1=$_GET['raza1'];
  @$color1 =$_GET['color1'];
  @$clase1 =$_GET['clase1'];
  @$hierro1=$_GET['hierro1'];	
  
  
$id=$_GET['id'];
$vaca =$_POST['vaca'];
$toro =$_POST['toro'];
$dias = $_POST['dias'];
$comen=$_POST['comen'];

$servicio=$_POST['servicio'];
$fecha_parto= date("Y-m-d", strtotime(" 9 month - $dias day"));
  
if($dias !=''){

if ((isset($_GET['id_vacuno'])) && ($_GET['id_vacuno'] != "")) {
	
$insertar = mysql_query("INSERT INTO d89xz_detalle_inseminacion(vaca,toro,t_serv,f_serv)
		VALUES ('{$vaca}','{$toro}','{$servicio}',NOW())", $conexion);
		
$insertar = mysql_query("INSERT INTO d89xz_inseminacion (toro,servic,fe_ser,d_criar,vaca,estad)
		VALUES ('{$toro}','{$servicio}', NOW(), '{$fecha_parto}', '{$vaca}','Vaca Prenada')", $conexion);
		
$sql = mysql_query("UPDATE d89xz_vacunos SET `toro` = '$toro',`servic`= '$servicio',`fe_ser`= NOW(),`d_criar`= '$fecha_parto',`tp_rep`='Vaca Prenada', coment_pal='$comen',estrepr='PN' WHERE id_vacuno = '$vaca'");
$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`='' ,`respal`='',`cmpal`=''   WHERE `id_vacuno`='$vacuno'");

$sql22 = mysql_query("UPDATE d89xz_detalle_palpacion SET `es` = '2' WHERE id = '$id'");	

echo "<script type=''>


		window.location='jornada_palpacion+++.php?jpalpa=" . $row_v['jpalpa'] . "&respal=" .$respal. "&cmpal=" .$cmpal. "&raza1=" .$raza1. "&color1=" .$color1. "&clase1=" .$clase1. "&hierro1=" .$hierro1. "';
		
	
	</script>";
	
}
}

	?>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($v);
?>
