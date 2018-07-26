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
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="inseminacion2_act.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<p><img src="idsolutions--este.png" width="162" height="59" />
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="577" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="4" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <th width="144">Toro Usado</th>
      <th width="127">Tipo  Servicio</th>
      <th width="227">Fecha Servicio</th>
      <th width="51" rowspan="2"><input type="submit" name="button" id="button" value="Enviar" /></th>
    </tr>
    <tr>
      <td><span id="sprytextfield1">
        <label for="toro"></label>
        <input type="text" name="toro" id="toro" />
      </span></td>
      <td><span id="spryselect1">
        <label for="servicio"></label>
        <select name="servicio" id="servicio">
          <option>Seleccione</option>
          <option value="Monta Directa">Monta Directa</option>
          <option value="Inseminacion">Inseminacion</option>
        </select>
      </span></td>
      <td width="227">D<span id="spryselect2">
        <label for="select2"></label>
        <select name="dia" id="select2">
          <option value="">D</option>
          <?php
do {  
?>
          <option value="<?php echo $row_dia['dias']?>"><?php echo $row_dia['dias']?></option>
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
      </span>A<span id="spryselect4">
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
      </span></td>
    </tr>
  </table>

  
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sjairman = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
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
$vaca =$_GET['id_vacuno'];
$toro =$_POST['toro'];
$pario =Edit;
$servicio=$_POST['servicio'];
$diab=trim(strip_tags($_POST['dia']));
$mesb=trim(strip_tags($_POST['mes']));
$anob=trim(strip_tags($_POST['anos']));
$fecha_servicio=$anob.'-'.$mesb.'-'.$diab;


?>
<?
$fecha_parto= date("Y-m-d", strtotime("$fecha_servicio + 9 month"));

?>

<?
  	if ($anob != 0 ){
		

		
$insertar = mysql_query("INSERT INTO d89xz_detalle_inseminacion(vaca,toro,t_serv,f_serv)
		VALUES ('{$vaca}','{$toro}','{$servicio}', '{$fecha_servicio}')", $conexion);
		
$insertar = mysql_query("INSERT INTO d89xz_inseminacion (toro,servic,fe_ser,d_criar,vaca,pario)
		VALUES ('{$toro}','{$servicio}', '{$fecha_servicio}', '{$fecha_parto}', '{$vaca}', '{$pario}')", $conexion);
		
$sql = mysql_query("UPDATE d89xz_vacunos SET `toro` = '$toro',`servic`= '$servicio',`fe_ser`= '$fecha_servicio',`d_criar`= '$fecha_parto' ,`pario`= '$pario' WHERE id_vacuno = '$vaca'");

$sql22 = mysql_query("UPDATE d89xz_detalle_palpacion SET `es` = '2' WHERE id = '$id'");					

			
			echo "<script type=''>
					alert('Registro  Exitoso');
				</script>";

		echo "<script type=''>
		window.location='inseminacion2_act.php';
		</script>";
			
	
					mysql_close($conexion);

		}
		
		
?>



