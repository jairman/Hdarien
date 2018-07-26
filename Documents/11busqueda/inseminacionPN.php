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
$anoss= date("Y"); // Year (2012)
$mess= date('m'); 
$dia3 =date('d');
mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="99%" border="0" align="center">
  <tr>
    <td align="center" bgcolor="#f0f0f0"><a href="palpacion2.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="414" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="2" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <th width="189" align="left">Vaca</th>
      <th width="215"><span id="sprytextfield3">
        <label for="vaca"></label>
        <input name="vaca" type="text" id="vaca" size="29" />
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
      <th align="left">Fecha Palpación</th>
      <th>D<span id="spryselect2">
      <label for="dia"></label>
      <select name="dia" id="dia">
        <option value="" <?php if (!(strcmp("", $dia3))) {echo "selected=\"selected\"";} ?>>D</option>
        <?php
do {  
?>
        <option value="<?php echo $row_dia['dias']?>"<?php if (!(strcmp($row_dia['dias'], $dia3))) {echo "selected=\"selected\"";} ?>><?php echo $row_dia['dias']?></option>
        <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
      </select>
      </span>M<span id="spryselect3">
      <label for="mes"></label>
      <select name="mes" id="mes">
        <option value="" <?php if (!(strcmp("", $mess))) {echo "selected=\"selected\"";} ?>>M</option>
        <?php
do {  
?>
        <option value="<?php echo $row_mes['meses']?>"<?php if (!(strcmp($row_mes['meses'], $mess))) {echo "selected=\"selected\"";} ?>><?php echo $row_mes['meses']?></option>
        <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
      </select>
      </span>A<span id="spryselect4">
      <label for="anos"></label>
      <select name="anos" id="anos">
        <option value="" <?php if (!(strcmp("", $anoss))) {echo "selected=\"selected\"";} ?>>A</option>
        <?php
do {  
?>
        <option value="<?php echo $row_anos['anos']?>"<?php if (!(strcmp($row_anos['anos'], $anoss))) {echo "selected=\"selected\"";} ?>><?php echo $row_anos['anos']?></option>
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
    </tr>
    <tr>
      <th align="left">Toro Usado / S.Colectivo</th>
      <th><span id="sprytextfield1">
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
  </table>

  
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);
?>


<?
$id=$_GET['id'];
$vaca =$_POST['vaca'];
$toro =$_POST['toro'];
$dias = $_POST['dias'];
$comen=$_POST['comen'];
@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$fecha_palpa=$anob.'-'.$mesb.'-'.$diab;
//$fecha_palpa1=$fecha_palpa -$dias;

$servicio=$_POST['servicio'];
$fecha_parto= date("Y-m-d", strtotime("$fecha_palpa + 9 month - $dias day "));
//echo "Dias:$dias----$fecha_palpa ------Parto:$fecha_parto";
  	if ($vaca != '' ){
		

		
$insertar = mysql_query("INSERT INTO d89xz_detalle_inseminacion(vaca,toro,t_serv,f_serv)
		VALUES ('{$vaca}','{$toro}','{$servicio}',NOW())", $conexion);
		
$insertar = mysql_query("INSERT INTO d89xz_inseminacion (toro,servic,fe_ser,d_criar,vaca,estad)
		VALUES ('{$toro}','{$servicio}', NOW(), '{$fecha_parto}', '{$vaca}','Vaca Prenada')", $conexion);
		
$sql = mysql_query("UPDATE d89xz_vacunos SET `toro` = '$toro',`servic`= '$servicio',`fe_ser`= NOW(),`d_criar`= '$fecha_parto',`tp_rep`='Vaca Prenada', coment_pal='$comen',estrepr='PN' WHERE id_vacuno = '$vaca'");

$sql22 = mysql_query("UPDATE d89xz_detalle_palpacion SET `es` = '2' WHERE id = '$id'");					

			
			echo "<script type=''>
					alert('Registro  Exitoso');
				</script>";

		echo "<script type=''>
		window.location='palpacion2.php';
		</script>";
			
	
					mysql_close($conexion);

		}
		
		
?>



