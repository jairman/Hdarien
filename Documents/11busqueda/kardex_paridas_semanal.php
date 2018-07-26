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
@$action =$_GET['vacuno'];

$date= date("d/m/Y");
$anoss= date("Y"); // Year (2012)
$mess= date('m'); 
$dia3 =date('d');

$numeroSemana = date("W"); //Numero semana del Año
//echo $numeroSemana;

////////////////////////////////////
$dia1= 01; 

    $date1 = mktime(0,0,0,$mess,$dia1,$anoss);
	$semana=strftime("%U", $date1); //Semana 
   // echo strftime("%U", $date1); 
/////////////////////////////////////////////////////////////7

$diaa= date('d')-1 ; // 
    @$date2 = mktime(0,0,0,$mess,$diaa,$anno);
	
	$a1=strftime("%U", $date2);
    //echo strftime("%U", $date2);
	//echo"<br/>";
	$semana_mes=$a1 -$semana +1;
	//echo $semana_mes; // Semana del mes.


mysql_select_db($database_conexion, $conexion);
$query_pd = "SELECT * FROM d89xz_vacunos WHERE tp_rep ='Vaca Parida' and leche ='si'";
$pd = mysql_query($query_pd, $conexion) or die(mysql_error());
$row_pd = mysql_fetch_assoc($pd);
$totalRows_pd = mysql_num_rows($pd);

//aca
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

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_clientes";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>




<style type="text/css">
.a {
	color: #FFF;
}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="kardex_paridas.php?vacuno=<?php echo $vacuno ?>"><img src="last.png" alt="" width="32" height="34" /></a></td>
    <td width="239" align="right">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="389" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="2" bgcolor="#4D68A2">Ingreso  de  Leche Semanal</th>
    </tr>
    <tr>
      <th colspan="2" bgcolor="#f0f0f0">&nbsp;</th>
    </tr>
    <tr>
      <th width="153" bgcolor="#4D68A2">ID</th>
      <th width="226" bgcolor="#4D68A2"><? echo $action?></th>
    </tr>
    <tr>
      <td style="font-weight: bold">Fecha</td>
      <th><label for="dia"></label>
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
        M<span id="spryselect2">
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
        </span>A<span id="spryselect3">
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
      <td style="font-weight: bold">Semana</td>
      <td><span id="spryselect1">
        <label for="semana2"></label>
        <select name="semana" size="1" id="semana2" style="width:180px">
          <option selected="selected" value="" <?php if (!(strcmp("", $semana_mes))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
          <option value="1" <?php if (!(strcmp(1, $semana_mes))) {echo "selected=\"selected\"";} ?>>1</option>
          <option value="2" <?php if (!(strcmp(2, $semana_mes))) {echo "selected=\"selected\"";} ?>>2</option>
          <option value="3" <?php if (!(strcmp(3, $semana_mes))) {echo "selected=\"selected\"";} ?>>3</option>
          <option value="4" <?php if (!(strcmp(4, $semana_mes))) {echo "selected=\"selected\"";} ?>>4</option>
<option value="5" <?php if (!(strcmp(5, $semana_mes))) {echo "selected=\"selected\"";} ?>>5</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td style="font-weight: bold">Peso(Kg)</td>
      <th><span id="sprytextfield2">
        <label for="klos2"></label>
        <input name="klos" type="text" id="klos2" size="24" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></th>
    </tr>
    <tr>
      <th colspan="2"><span id="vacuno">
        <label for="vacuno"></label>
        <input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
      </span></th>
    </tr>
  </table>
</form>
<DIV ID="seleccion">
<p>&nbsp;</p>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
  </script>
</body>
</html>
<?php
mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($cli);

mysql_free_result($dia);
mysql_free_result($pd);
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



<?

@$action =$_GET['vacuno'];
@$semana =$_POST['semana'];
@$klos = $_POST['klos'];
@$hierro=$_GET['hierro'];
@$raza=$_GET['raza'];


$diab= $dia3;
@$diab1=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$fecha=$anob.'-'.$mesb.'-'.$diab1;


  	if ($klos!= 0 ){
			
$insertar = mysql_query("INSERT INTO d89xz_detalle_leche (vacuno,semana,klos,fecha,sen_ano,hierro,raza)
					VALUES ('{$action}','{$semana}', '{$klos}', '{$fecha}', '{$numeroSemana}', '{$hierro}', '{$raza}')", $conexion);
			
echo "<script type=''>
		window.location='kardex_paridas.php';
	</script>";

		}
		

	   mysql_close($conexion);
?>