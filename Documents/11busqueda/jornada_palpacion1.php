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
$query_vac = "SELECT * FROM d89xz_vacunos WHERE jpalpa = 'si'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);

mysql_select_db($database_conexion, $conexion);
$query_ubc = "SELECT hacienda FROM d89xz_hacienda";
$ubc = mysql_query($query_ubc, $conexion) or die(mysql_error());
$row_ubc = mysql_fetch_assoc($ubc);
$totalRows_ubc = mysql_num_rows($ubc);

mysql_select_db($database_conexion, $conexion);
$query_rpn = "SELECT * FROM d89xz_empleados";
$rpn = mysql_query($query_rpn, $conexion) or die(mysql_error());
$row_rpn = mysql_fetch_assoc($rpn);
$totalRows_rpn = mysql_num_rows($rpn);

mysql_select_db($database_conexion, $conexion);
$query_jor = "SELECT DISTINCT  `jpalpa`,`raza`,`color`,`clase`,`hierro`,`ubicasion`,respal,cmpal FROM d89xz_vacunos WHERE `jpalpa` != '0000-00-00' ";
$jor = mysql_query($query_jor, $conexion) or die(mysql_error());
$row_jor = mysql_fetch_assoc($jor);
$totalRows_jor = mysql_num_rows($jor);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pendientes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
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
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="busqueda_jornada.php">B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php" class="current">Palpaci&oacute;n</a></li>
  <li><a href=""inseminacion2_act.php"">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="#">Peso</a></li>
  <li><a href="#">Traslados</a></li>
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="jornada_palpacion1.php" class="current">Agenda / Grupo</a>  </li>
  <li><a href="palpacion2.php" >Individual</a></li>
  <li><a href="jornada_palpacion_detalle.php">Reportes</a>  </li>
 
</ul>
<p>&nbsp;</p>



</DIV>
<table width="99%" border="0" align="center">
  <tr>
    <th colspan="4" align="center" bgcolor="#4D68A2" style="color: #FFF">Agregar  Jornada  De  Palpación</th>
  </tr>
  <tr>
    <td width="340" align="left" style="font-weight: bold">&nbsp;</td>
    <td width="193" align="left">&nbsp;</td>
    <td width="292" align="center"><p style="font-weight: bold">Por Selección</p></td>
    <td width="245" align="center"><a rel="shadowbox[ejemplos];options={continuous:true}" href="jornada_papacion_seleccion.php"><img src="add.png" alt="" width="68" height="20" /></a></td>
  </tr>
</table>
<script type="text/javascript">
var spjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
</script>
<table width="99%" border="1" align="center">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="12%"><p>Jornada </p></th>
    <th width="11%">Raza</th>
    <th width="11%">Color</th>
    <th width="12%">Clase</th>
    <th width="12%">Hierro</th>
    <th width="21%"><p>Responsable</p></th>
    <th width="21%">Comentario</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <th><a href="jornada_palpacion+++.php?jpalpa=<?php echo $row_jor['jpalpa']; ?>&amp;respal=<?php echo $row_jor['respal']; ?>&amp;cmpal=<?php echo $row_jor['cmpal']; ?>&amp;raza1=<?php echo $row_jor['raza']; ?>&amp;color1=<?php echo $row_jor['color']; ?>&amp;clase1=<?php echo $row_jor['clase']; ?>&amp;hierro1=<?php echo $row_jor['hierro']; ?>"><?php echo $row_jor['jpalpa']; ?></a></th>
      <td><?php echo $row_jor['raza']; ?></td>
      <td><?php echo $row_jor['color']; ?></td>
      <td><?php echo $row_jor['clase']; ?></td>
      <td><?php echo $row_jor['hierro']; ?></td>
      <td><?php echo $row_jor['respal']; ?></td>
      <td><?php echo $row_jor['cmpal']; ?></td>
    </tr>
    <?php } while ($row_jor = mysql_fetch_assoc($jor)); ?>
</table>
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

mysql_free_result($rpn);

mysql_free_result($jor);
?>

<?
@$textarea_tarea =$_POST['text_tareas'];
@$estado =$_POST['hiddenFiel_estado'];


@$diabini=trim(strip_tags($_POST['select_dia_ini']));
@$mesbini=trim(strip_tags($_POST['select_mes_ini']));
@$anobini=trim(strip_tags($_POST['text_anos_ini']));
@$text_f_tareaini=$anobini.'-'.$mesbini.'-'.$diabini;


@$diab=trim(strip_tags($_POST['select_dia']));
@$mesb=trim(strip_tags($_POST['select_mes']));
@$anob=trim(strip_tags($_POST['text_anos']));
@$text_f_tarea=$anob.'-'.$mesb.'-'.$diab;

?>

<?
//echo"$estado";
if ($text_f_tarea!=0000-00-00){
			
		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
		
		
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}
		
$insertar = mysql_query("INSERT INTO d89xz_tareas(`tarea`,`fecha_ini`,`fecha`,`estado`) VALUES ('{$textarea_tarea}',NOW(),'{$text_f_tarea}','{$estado}')",$conexion);



		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}

	}


?>

<?
@$raza = $_POST['raza'];
@$color = $_POST['color'];
@$sexo = $_POST['sexo'];
@$clase = $_POST['clase'];
@$hierro = $_POST['hierro'];
@$respon =$_POST['respon'];



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


?>

<?
if($sexo != 'sexo'){
$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$consecutivo=	$rowEmp['palpa'];	
									
						}
					}	
	
	
$insertar = mysql_query("UPDATE `d89xz_vacunos` SET `jpalpa`=NOW(),cmpal='$textarea_tarea' ,`respal`='$responsable'  WHERE `raza`='$raza' and `color`='$color' and `sexo`='hembra' and `clase`='$clase' and `hierro`='$hierro' ", $conexion);

$insertar = mysql_query("UPDATE `d89xz_consecu_orden` SET `palpa`= palpa+ 1", $conexion);
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

var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>