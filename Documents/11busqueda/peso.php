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
$query_peso = "SELECT * FROM d89xz_tipo_pesaje";
$peso = mysql_query($query_peso, $conexion) or die(mysql_error());
$row_peso = mysql_fetch_assoc($peso);
$totalRows_peso = mysql_num_rows($peso);

mysql_select_db($database_conexion, $conexion);
$query_hierro = "SELECT * FROM d89xz_hierros";
$hierro = mysql_query($query_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);
$totalRows_hierro = mysql_num_rows($hierro);

mysql_select_db($database_conexion, $conexion);
$query_dias = "SELECT * FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_meses = "SELECT * FROM d89xz_meses";
$meses = mysql_query($query_meses, $conexion) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

mysql_select_db($database_conexion, $conexion);
$query_emple = "SELECT * FROM d89xz_empleados";
$emple = mysql_query($query_emple, $conexion) or die(mysql_error());
$row_emple = mysql_fetch_assoc($emple);
$totalRows_emple = mysql_num_rows($emple);

mysql_select_db($database_conexion, $conexion);
$query_hda = "SELECT * FROM d89xz_hacienda";
$hda = mysql_query($query_hda, $conexion) or die(mysql_error());
$row_hda = mysql_fetch_assoc($hda);
$totalRows_hda = mysql_num_rows($hda);
$query_peso = "SELECT * FROM d89xz_tipo_pesaje";
$peso = mysql_query($query_peso, $conexion) or die(mysql_error());
$row_peso = mysql_fetch_assoc($peso);
$totalRows_peso = mysql_num_rows($peso);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
@$action = 0000000000000;

@$id_vacunopeso =$_GET['id_vacuno'];


?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<style type="text/css">
.c {
	color: #FFF;
}
</style>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php" >B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php" class="current">Peso</a></li>
  <li><a href="traslado.php">Traslados</a></li>
</ul>

<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="jornada_peso1agend.php" >Agenda / Grupo</a>  </li>
  <li><a href="peso.php"class="current" >Individual</a></li>
  <li><a href="jornada_repeso_detalle.php">Reportes</a>  </li>
 
</ul>
  
<p>&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
  <table width="437" border="1" align="center" cellspacing="0">
    <tr>
          <th colspan="2" bgcolor="#4D68A2"><label for="text_hierro"></label>
            <label for="select_actividad" class="c"> <strong>Ingrese los datos </strong></label>            <span style="color: #FFF">Individual</span></th>
    </tr>
<tr>
  		    <th>ID  <a href="kardex_peso.php"></a></th>
  		    <th><span id="spry_buscar">
            <label for="text_buscar"></label>
            <input name="text_buscar" type="text" id="text_buscar" value="<?php echo $id_vacunopeso ?>" />
  		    </span><a href="kardex_peso.php"><img src="buscar.jpg" alt="" width="20" height="20" /></a></th>
  		    </tr>
  		  <tr>
  		    <th align="left">Fecha</th>
  		    <th>D<span id="spry_dia">
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
            </span>M<span id="spryselect2">
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
            </span>A<span id="spryselect4">
            <label for="text_anos"></label>
            <select name="text_anos" id="text_anos">
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
    </tr>
  		  <tr>
    	  <th width="185" align="left">Tipo Pesaje</th>
     	 <td width="240"><label for="select_peso"></label>
     	   <span id="spryselect3">
     	   <label for="select_peso"></label>
     	   <select name="select_peso" id="select_peso" style="width:250px">
     	     <option value="">Seleccione Tipo de pesaje</option>
     	     <?php
do {  
?>
     	     <option value="<?php echo $row_peso['tipo_pesaje']?>"><?php echo $row_peso['tipo_pesaje']?></option>
     	     <?php
} while ($row_peso = mysql_fetch_assoc($peso));
  $rows = mysql_num_rows($peso);
  if($rows > 0) {
      mysql_data_seek($peso, 0);
	  $row_peso = mysql_fetch_assoc($peso);
  }
?>
           </select>
     	   </span>
     	   <label for="select_vacunas"></label></td>
      </tr>
  		  <tr>
  		    <th align="left">Responsable</th>
  		    <td><span id="spryselect5">
          <label for="responsable"></label>
  		      <select name="responsable" id="responsable" style="width:250px">
  		        <option value="">Seleccione Responsable</option>
  		        <?php
do {  
?>
  		        <option value="<?php echo $row_emple['nombre']?>"><?php echo $row_emple['nombre']?></option>
  		        <?php
} while ($row_emple = mysql_fetch_assoc($emple));
  $rows = mysql_num_rows($emple);
  if($rows > 0) {
      mysql_data_seek($emple, 0);
	  $row_emple = mysql_fetch_assoc($emple);
  }
?>
            </select>
  		    </span></td>
    </tr>
    <tr>
            <th align="left">Hacienda </th>
            <td><span id="spryselect6">
            <label for="hacienda2"></label>
            <select name="hacienda" id="hacienda2" style="width:250px">
              <option value="">Seleccione</option>
              <?php
do {  
?>
              <option value="<?php echo $row_hda['hacienda']?>"><?php echo $row_hda['hacienda']?></option>
              <?php
} while ($row_hda = mysql_fetch_assoc($hda));
  $rows = mysql_num_rows($hda);
  if($rows > 0) {
      mysql_data_seek($hda, 0);
	  $row_hda = mysql_fetch_assoc($hda);
  }
?>
            </select>
            </span></td>
    </tr>
    <tr>
      <th align="left">Peso (Kg)</th>
      <td><input name="text_peso" type="text" id="text_peso" size="35" /></td>
    </tr>
    <tr>
      <th align="left">Comentario</th>
      <td><span id="sprytextfield3">
        <input name="cmpes" type="text" id="cmpes" size="35" />
      </span></td>
    </tr>
    <tr>
      <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<?

$action =$_POST['text_buscar'];
//$select_hierro =$_POST['select_hierro'];
$select_peso =$_POST['select_peso'];
$text_peso = $_POST['text_peso'];
$respon= $_POST['responsable'];
$hacienda = $_POST['hacienda'];


$diab=trim(strip_tags($_POST['select_dia']));
$mesb=trim(strip_tags($_POST['select_mes']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_peso=$anob.'-'.$mesb.'-'.$diab;

$cmpes = $_POST['cmpes'];

					
$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
					if ($totEmp> 0) {
							 
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp['id_vacuno'];
						$hierro=	$rowEmp['hierro'];
						$ubicasion=$rowEmp['ubicasion'];						
			
										
						}
					}
			

mysql_free_result($peso);

mysql_free_result($dias);

mysql_free_result($meses);

mysql_free_result($anos);

mysql_free_result($emple);

mysql_free_result($hda);


if($anob !=0){

if (($id_vacuno != '') &&($hacienda == $ubicasion)){
	  
	  //general
   	$insertar = mysql_query("INSERT INTO d89xz_pesos (id_vacuno,hierro,tipo_pesaje,peso,fecha,respon,cmpes,hacien,comind)
					VALUES ('{$id_vacuno}','{$hierro}', '{$select_peso }','{$text_peso}', NOW(),'{$respon}','{$cmpes}','{$ubicasion}','{$cmpes}')", $conexion);
								 
					 echo "<script type=''>
							alert('Registro  Exitoso');
					</script>";
					 
	$insertar2 = mysql_query("UPDATE `d89xz_vacunos` SET `jpeso`='',`cmpes`='',`respes`='' WHERE `id_vacuno`='$id_vacuno'", $conexion);
		
		

  	if ($select_peso == Destete ){
						
		$sql =mysql_query( "UPDATE d89xz_vacunos SET `f_dtt` = '$text_f_peso',`p_dtt`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");
			
		}
 
  	if ($select_peso == PA_205_Dias ){
					
			$sql =mysql_query( "UPDATE d89xz_vacunos SET `p_205`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");

		}

  	if ($select_peso == PA_18_Meses ){
					
			$sql =mysql_query( "UPDATE d89xz_vacunos SET `p_18`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");
			
		}

  	if ($select_peso == Nacimiento ){

					
			$sql =mysql_query( "UPDATE d89xz_vacunos SET `p_ncto`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");
			
		}
				   
				   
 }

 
 if (($action!=$id_vacuno) &&($hacienda != $ubicasion) ){
		
		echo "<script type=''>
		alert('Vacuno No Existe  O  No  Pertenece a esta  Hacienda ');
	</script>";
		
		
	   }
	   
	   
	   if (($id_vacuno != 0) &&($hacienda != $ubicasion) ){
		echo "<script type=''>
		alert('Vacuno No Existe  O  No  Pertenece a esta  Hacienda ');
	</script>";
		
	   }
	   
}
?>

<?
mysql_close($conexion);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_buscar", "none", {validateOn:["blur"]});
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"], hint:"Ingrese  Comentario"});
</script>