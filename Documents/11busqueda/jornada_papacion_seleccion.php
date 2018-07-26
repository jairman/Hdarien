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

mysql_select_db($database_conexion, $conexion);
$query_dias = "SELECT dias FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_meses = "SELECT meses FROM d89xz_meses";
$meses = mysql_query($query_meses, $conexion) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);

mysql_select_db($database_conexion, $conexion);
$query_tareas = "SELECT * FROM d89xz_tareas ORDER BY fecha_ini DESC";
$tareas = mysql_query($query_tareas, $conexion) or die(mysql_error());
$row_tareas = mysql_fetch_assoc($tareas);
$totalRows_tareas = mysql_num_rows($tareas);

mysql_select_db($database_conexion, $conexion);
$query_anf = "SELECT * FROM d89xz_anos";
$anf = mysql_query($query_anf, $conexion) or die(mysql_error());
$row_anf = mysql_fetch_assoc($anf);
$totalRows_anf = mysql_num_rows($anf);

mysql_select_db($database_conexion, $conexion);
$query_raza = "SELECT raza FROM d89xz_razas";
$raza = mysql_query($query_raza, $conexion) or die(mysql_error());
$row_raza = mysql_fetch_assoc($raza);
$totalRows_raza = mysql_num_rows($raza);

mysql_select_db($database_conexion, $conexion);
$query_color = "SELECT color FROM d89xz_color_raza";
$color = mysql_query($query_color, $conexion) or die(mysql_error());
$row_color = mysql_fetch_assoc($color);
$totalRows_color = mysql_num_rows($color);

mysql_select_db($database_conexion, $conexion);
$query_hierro = "SELECT * FROM d89xz_hierros";
$hierro = mysql_query($query_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);
$totalRows_hierro = mysql_num_rows($hierro);

mysql_select_db($database_conexion, $conexion);
$query_vac = "SELECT * FROM d89xz_vacunos WHERE vacuna = 'si'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);

mysql_select_db($database_conexion, $conexion);
$query_ubc = "SELECT hacienda FROM d89xz_hacienda";
$ubc = mysql_query($query_ubc, $conexion) or die(mysql_error());
$row_ubc = mysql_fetch_assoc($ubc);
$totalRows_ubc = mysql_num_rows($ubc);

mysql_select_db($database_conexion, $conexion);
$query_vcn = "SELECT DISTINCT `jpeso`,`hierro`,`cmpes`,`respes` FROM d89xz_vacunos WHERE jpeso !='0000-00-00' and `cmpes` !=' ' and `respes` != ' '";
$vcn = mysql_query($query_vcn, $conexion) or die(mysql_error());
$row_vcn = mysql_fetch_assoc($vcn);
$totalRows_vcn = mysql_num_rows($vcn);

mysql_select_db($database_conexion, $conexion);
$query_res = "SELECT * FROM d89xz_empleados";
$res = mysql_query($query_res, $conexion) or die(mysql_error());
$row_res = mysql_fetch_assoc($res);
$totalRows_res = mysql_num_rows($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pendientes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<DIV ID="seleccion">
  
  <p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="456" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="4" bgcolor="#4D68A2"><p>Asignar Jornada de Palpación</p></th>
      </tr>
    <tr>
      <td width="180" style="font-weight: bold">Fecha De Jornada</td>
      <td width="260" colspan="3" align="center"> D<span id="spry_dia">
        <label for="select_dia"></label>
        <select name="select_dia" id="select_dia">
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
        </span>M<span id="spry_mes">
          <label for="select_mes"></label>
          <select name="select_mes" id="select_mes">
            <option value="">M</option>
            <?php
do {  
?>
            <option value="<?php echo $row_meses['meses']?>"><?php echo $row_meses['meses']?></option>
            <?php
} while ($row_meses = mysql_fetch_assoc($meses));
  $rows = mysql_num_rows($meses);
  if($rows > 0) {
      mysql_data_seek($meses, 0);
	  $row_meses = mysql_fetch_assoc($meses);
  }
?>
          </select>
          </span>A<span id="spryselect5">
          <label for="text_anos"></label>
          <select name="text_anos" id="text_anos">
            <option value="">A</option>
            <?php
do {  
?>
            <option value="<?php echo $row_anf['anos']?>"><?php echo $row_anf['anos']?></option>
            <?php
} while ($row_anf = mysql_fetch_assoc($anf));
  $rows = mysql_num_rows($anf);
  if($rows > 0) {
      mysql_data_seek($anf, 0);
	  $row_anf = mysql_fetch_assoc($anf);
  }
?>
          </select>
        </span></td>
      </tr>
    <tr>
      <td style="font-weight: bold">Fecha De Palpación</td>
      <td colspan="3" align="center">D<span id="spry_dia2">
      <label for="select_dia2"></label>
      <select name="select_dia2" id="select_dia2">
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
      </span>M<span id="spry_mes2">
      <label for="select_mes2"></label>
      <select name="select_mes2" id="select_mes2">
        <option value="">M</option>
        <?php
do {  
?>
        <option value="<?php echo $row_meses['meses']?>"><?php echo $row_meses['meses']?></option>
        <?php
} while ($row_meses = mysql_fetch_assoc($meses));
  $rows = mysql_num_rows($meses);
  if($rows > 0) {
      mysql_data_seek($meses, 0);
	  $row_meses = mysql_fetch_assoc($meses);
  }
?>
      </select>
      </span>A<span id="spryselect">
      <label for="text_anos2"></label>
      <select name="text_anos2" id="text_anos2">
        <option value="">A</option>
        <?php
do {  
?>
        <option value="<?php echo $row_anf['anos']?>"><?php echo $row_anf['anos']?></option>
        <?php
} while ($row_anf = mysql_fetch_assoc($anf));
  $rows = mysql_num_rows($anf);
  if($rows > 0) {
      mysql_data_seek($anf, 0);
	  $row_anf = mysql_fetch_assoc($anf);
  }
?>
      </select>
      </span></td>
    </tr>
    <tr>
      <td style="font-weight: bold">Responsable</td>
      <td colspan="3"><span id="spryselect10">
        <label for="respon"></label>
        <select name="respon" id="respon" style="width:250px">
          <option value="">Responsable</option>
          <?php
do {  
?>
          <option value="<?php echo $row_res['nombre']?>"><?php echo $row_res['nombre']?></option>
          <?php
} while ($row_res = mysql_fetch_assoc($res));
  $rows = mysql_num_rows($res);
  if($rows > 0) {
      mysql_data_seek($res, 0);
	  $row_res = mysql_fetch_assoc($res);
  }
?>
          </select>
      </span></td>
      </tr>
    <tr>
      <td style="font-weight: bold">Lugar</td>
      <td colspan="3"><span id="spryselect9">
        <label for="ubica2"></label>
        <select name="ubica" id="ubica2" style="width:250px">
          <option value="">Ubicacion</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ubc['hacienda']?>"><?php echo $row_ubc['hacienda']?></option>
          <?php
} while ($row_ubc = mysql_fetch_assoc($ubc));
  $rows = mysql_num_rows($ubc);
  if($rows > 0) {
      mysql_data_seek($ubc, 0);
	  $row_ubc = mysql_fetch_assoc($ubc);
  }
?>
          </select>
      </span></td>
      </tr>
    <tr>
      <td style="font-weight: bold">Raza</td>
      <td colspan="3"><span id="spryselect3">
        <select name="raza" id="raza" style="width:250px">
          <option value="">Raza</option>
          <?php
do {  
?>
          <option value="<?php echo $row_raza['raza']?>"><?php echo $row_raza['raza']?></option>
          <?php
} while ($row_raza = mysql_fetch_assoc($raza));
  $rows = mysql_num_rows($raza);
  if($rows > 0) {
      mysql_data_seek($raza, 0);
	  $row_raza = mysql_fetch_assoc($raza);
  }
?>
          </select>
      </span></td>
      </tr>
    <tr>
      <td style="font-weight: bold">Color</td>
      <td colspan="3"><span id="spryselect4">
        <select name="color" id="color" style="width:250px">
          <option value="">Color</option>
          <?php
do {  
?>
          <option value="<?php echo $row_color['color']?>"><?php echo $row_color['color']?></option>
          <?php
} while ($row_color = mysql_fetch_assoc($color));
  $rows = mysql_num_rows($color);
  if($rows > 0) {
      mysql_data_seek($color, 0);
	  $row_color = mysql_fetch_assoc($color);
  }
?>
          </select>
      </span></td>
      </tr>
    <tr>
      <td style="font-weight: bold">Clase</td>
      <td colspan="3"><span id="spryselect6">
        <select name="clase" id="clase" style="width:250px">
          <option>Seleccione</option>
          <option value="Puro">Puro</option>
          <option value="Comercial">Comercial</option>
          </select>
        </span></td>
    </tr>
    <tr>
      <td style="font-weight: bold">Hierro</td>
      <td colspan="3"><span id="spryselect8">
        <select name="hierro" id="hierro" style="width:250px">
          <option value="">Hierro</option>
          <?php
do {  
?>
          <option value="<?php echo $row_hierro['hierro']?>"><?php echo $row_hierro['hierro']?></option>
          <?php
} while ($row_hierro = mysql_fetch_assoc($hierro));
  $rows = mysql_num_rows($hierro);
  if($rows > 0) {
      mysql_data_seek($hierro, 0);
	  $row_hierro = mysql_fetch_assoc($hierro);
  }
?>
          </select>
        </span></td>
    </tr>
    <tr>
      <th colspan="4"><span id="sprytextfield1">
        <label for="text_tareas"></label>
        <input name="text_tareas" type="text" id="text_tareas" size="60" />
      </span></th>
    </tr>
    <tr>
      <th colspan="4"><label for="raza"></label>        <label for="color"></label>        <label for="clase"></label>        <label for="sexo"></label>
        <span id="spry_tarea2">
        <label for="text_tareas3"></label>
        <input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
        <a  href="jornada_palpacion.php" onClick="javascript:window.parent.Shadowbox.close();"><img src="cancelar.png" alt="" width="68" height="20" /></a> </a></span>
        <input name="hiddenFiel_estado" type="hidden" id="hiddenFiel_estado" value="Pendiente" /></th>
      </tr>
    </table>
  <p>&nbsp;</p>
</form>
</DIV>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_mes", {validateOn:["blur"]});
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
</script>
<p>&nbsp;</p>
<p>&nbsp; </p>
<script type="text/javascript">
var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {validateOn:["blur"]});
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Ingrese Comentario", validateOn:["blur"]});
var spryselect = new Spry.Widget.ValidationSelect("spryselect", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_mes2", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dia2", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($meses);

mysql_free_result($tareas);

mysql_free_result($anf);

mysql_free_result($raza);

mysql_free_result($color);

mysql_free_result($hierro);

mysql_free_result($vac);

mysql_free_result($ubc);

mysql_free_result($vcn);

mysql_free_result($res);
?>

<?
$textarea_tarea =$_POST['text_tareas'];
$estado =$_POST['hiddenFiel_estado'];


$diabini=trim(strip_tags($_POST['select_dia_ini']));
$mesbini=trim(strip_tags($_POST['select_mes_ini']));
$anobini=trim(strip_tags($_POST['text_anos_ini']));
$text_f_tareaini=$anobini.'-'.$mesbini.'-'.$diabini;


$diab=trim(strip_tags($_POST['select_dia']));
$mesb=trim(strip_tags($_POST['select_mes']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_tarea=$anob.'-'.$mesb.'-'.$diab;

$diab1=trim(strip_tags($_POST['select_dia2']));
$mesb1=trim(strip_tags($_POST['select_mes2']));
$anob1=trim(strip_tags($_POST['text_anos2']));
$fecha_palpa=$anob1.'-'.$mesb1.'-'.$diab1;
$respon =$_POST['respon'];

$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$consecutivo=	$rowEmp['palpa'];	
									
						}
					}

$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `nombre`= '$respon'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$nombre=	$rowEmp['nombre'];	
						$apellido=	$rowEmp['apellido'];				
						}
					}
	$responsable = $nombre.$apellido;

$raza = $_POST['raza'];
$color = $_POST['color'];
$sexo = Hembra;
$clase = $_POST['clase'];
$hierro = $_POST['hierro'];
$ubica =$_POST['ubica'];


//para validar la jornada
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `raza`='$raza' and `color`='$color' and `sexo`='$sexo' and `clase`='$clase' and `hierro`='$hierro' and ubicasion='$ubica' ",$conexion);
$existen = mysql_num_rows($sql);

if($mesb !=0){		
if($existen != 0){
	
$insertar = mysql_query("INSERT INTO d89xz_tareas(`tarea`,`fecha_ini`,`fecha`,`estado`,jorn,hac,respon,comen) VALUES ('{$textarea_tarea}',NOW(),'{$text_f_tarea}','{$estado}',NOW(),'{$ubica}','{$responsable}','Jornada Palpacion')",$conexion);
	
	
$insertar = mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`='$fecha_palpa',cmpal='$textarea_tarea' ,`respal`='$responsable'  WHERE `raza`='$raza' and `color`='$color' and `sexo`='hembra' and `clase`='$clase' and `hierro`='$hierro' and ubicasion='$ubica' ", $conexion);


$insertar = mysql_query("UPDATE `d89xz_consecu_orden` SET `palpa`= palpa+ 1", $conexion);

echo "<script type=''>
		window.location='jornada_palpacion.php';
	</script>";


}else { 
	
	echo "<script type=''>
		alert('No Existe Vacuno Con estas Características');
	</script>";
	
}
}
?>
 


<?

mysql_close($conexion);
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