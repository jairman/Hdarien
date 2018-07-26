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
$query_hierro = "SELECT * FROM d89xz_hierros";
$hierro = mysql_query($query_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);
$totalRows_hierro = mysql_num_rows($hierro);

mysql_select_db($database_conexion, $conexion);
$query_hda = "SELECT hacienda FROM d89xz_hacienda";
$hda = mysql_query($query_hda, $conexion) or die(mysql_error());
$row_hda = mysql_fetch_assoc($hda);
$totalRows_hda = mysql_num_rows($hda);

mysql_select_db($database_conexion, $conexion);
$query_razas = "SELECT * FROM d89xz_razas";
$razas = mysql_query($query_razas, $conexion) or die(mysql_error());
$row_razas = mysql_fetch_assoc($razas);
$totalRows_razas = mysql_num_rows($razas);

mysql_select_db($database_conexion, $conexion);
$query_Clasificacion = "SELECT * FROM d89xz_clasificacion";
$Clasificacion = mysql_query($query_Clasificacion, $conexion) or die(mysql_error());
$row_Clasificacion = mysql_fetch_assoc($Clasificacion);
$totalRows_Clasificacion = mysql_num_rows($Clasificacion);

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_meses = "SELECT * FROM d89xz_meses";
$meses = mysql_query($query_meses, $conexion) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);

mysql_select_db($database_conexion, $conexion);
$query_clr = "SELECT * FROM d89xz_color_raza";
$clr = mysql_query($query_clr, $conexion) or die(mysql_error());
$row_clr = mysql_fetch_assoc($clr);
$totalRows_clr = mysql_num_rows($clr);

mysql_select_db($database_conexion, $conexion);
$query_a = "SELECT * FROM d89xz_anos";
$a = mysql_query($query_a, $conexion) or die(mysql_error());
$row_a = mysql_fetch_assoc($a);
$totalRows_a = mysql_num_rows($a);
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
#form15 table tr th {
	color: #FFF;
	
}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>&nbsp;</p>
<form id="form15" name="form15" method="post" action="">
  <table width="645" height="179" border="1" align="center" cellspacing="0" >
    <tr>
      <th colspan="4" bgcolor="#4D68A2" scope="col">Información de Ingreso </th>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="82" style="font-weight: bold" scope="col"><strong>ID </strong></td>
      <td width="216" scope="col"><span id="sprytextfield1">
        <input name="text_idvacuno2" type="text" id="text_idvacuno2" size="25" />
      </span></td>
      <td width="129" align="left" style="font-weight: bold" scope="col">ID Madre</td>
      <td width="190" scope="col"><label for="text_madre2"></label>
      <input name="text_madre2" type="text" id="text_madre2" size="25" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Hierro</td>
      <td><span id="spry_hierro2">
      <label for="select_hierro3"></label>
      <select name="select_hierro2" id="select_hierro3" style="width:190px">
        <option value="">Selec. Hierro</option>
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
      <td align="left" style="font-weight: bold">ID Padre</td>
      <td><input name="text_padre2" type="text" id="text_padre2" size="25" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Color</td>
      <td><span >
      <label for="color"></label>
      <select name="color" id="color" style="width:190px">
        <option value="">Color</option>
        <?php
do {  
?>
        <option value="<?php echo $row_clr['color']?>"><?php echo $row_clr['color']?></option>
        <?php
} while ($row_clr = mysql_fetch_assoc($clr));
  $rows = mysql_num_rows($clr);
  if($rows > 0) {
      mysql_data_seek($clr, 0);
	  $row_clr = mysql_fetch_assoc($clr);
  }
?>
      </select>
      </span></td>
      <td align="left" style="font-weight: bold">Ubicación</td>
      <td><span id="spry_ubichada2">
        <label for="select_ubic_hda2"></label>
        <select name="select_ubic_hda" id="select_ubic_hda2" style="width:190px">
          <option value="">Hacienda</option>
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
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Raza</td>
      <td><span id="spryselect1">
      <label for="select_raza3"></label>
      <select name="select_raza2" id="select_raza3" style="width:190px">
        <option value="">Seleccione  Raza</option>
        <?php
do {  
?>
        <option value="<?php echo $row_razas['raza']?>"><?php echo $row_razas['raza']?></option>
        <?php
} while ($row_razas = mysql_fetch_assoc($razas));
  $rows = mysql_num_rows($razas);
  if($rows > 0) {
      mysql_data_seek($razas, 0);
	  $row_razas = mysql_fetch_assoc($razas);
  }
?>
      </select>
      </span></td>
      <td align="left" style="font-weight: bold">Edad Ingreso<span id="text_edad_ingreso">
      <label for="label"></label>
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span>(M)</span></td>
      <td><span id="sprytextfield6">
        <label for="text_edad_ingreso4"></label>
        <input name="text_edad_ingreso2" type="text" id="text_edad_ingreso4" size="25" />
      </span></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Clase</td>
      <td><span id="spryselect9">
      <label for="select_clase2"></label>
      <select name="select_clase" id="select_clase2" style="width:190px">
        <option>Seleccione</option>
        <option value="Puro">Puro</option>
        <option value="Comercial">Comercial</option>
      </select>
      </span></td>
      <td align="left" style="font-weight: bold">Registro</td>
      <td><input name="text_registro" type="text" id="text_registro" size="25" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Sexo</td>
      <td><span id="spry_sexo2">
      <label for="select_sexo3"></label>
      <select name="select_sexo2" id="select_sexo3" style="width:190px">
        <option>Seleccione Sexo</option>
        <option value="Macho">Macho</option>
        <option value="Hembra">Hembra</option>
      </select>
      </span></td>
      <td align="left" style="font-weight: bold">Peso Ingreso</td>
      <td width="190"><input name="pesonto" type="text" id="pesonto" size="25" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold"> Calificación </td>
      <td><span id="spry_calificacion2">
        <label for="select_califique"></label>
        <select name="select_califique" id="select_califique" style="width:190px">
          <option>Califique</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </span></td>
      <td align="left" style="font-weight: bold">Clasificación</td>
      <td><span id="spryselect4">
        <select name="select_clasif" id="select_clasif2" style="width:190px">
          <option value="">Clasifique</option>
          <?php
do {  
?>
          <option value="<?php echo $row_Clasificacion['clasificacison']?>"><?php echo $row_Clasificacion['clasificacison']?></option>
          <?php
} while ($row_Clasificacion = mysql_fetch_assoc($Clasificacion));
  $rows = mysql_num_rows($Clasificacion);
  if($rows > 0) {
      mysql_data_seek($Clasificacion, 0);
	  $row_Clasificacion = mysql_fetch_assoc($Clasificacion);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Fecha</td>
      <td><span id="spry_clasificacion2">
        <label for="select_clasif2"></label>
      </span>        <label for="select_clase">D<span id="spry_dia">
      <select name="select_dia" id="select_dia2">
        <option value="">D</option>
        <?php
do {  
?>
        <option value="<?php echo $row_dia['id']?>"><?php echo $row_dia['dias']?></option>
        <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
      </select>
      </span>M<span id="spry_mes">
      <select name="select_mes" id="select_mes2">
        <option value="">M</option>
        <?php
do {  
?>
        <option value="<?php echo $row_meses['id']?>"><?php echo $row_meses['meses']?></option>
        <?php
} while ($row_meses = mysql_fetch_assoc($meses));
  $rows = mysql_num_rows($meses);
  if($rows > 0) {
      mysql_data_seek($meses, 0);
	  $row_meses = mysql_fetch_assoc($meses);
  }
?>
      </select>
      </span>A<span id="spryselect11">
      <select name="text_anos" id="text_anos2">
        <option value="">A</option>
        <?php
do {  
?>
        <option value="<?php echo $row_a['anos']?>"><?php echo $row_a['anos']?></option>
        <?php
} while ($row_a = mysql_fetch_assoc($a));
  $rows = mysql_num_rows($a);
  if($rows > 0) {
      mysql_data_seek($a, 0);
	  $row_a = mysql_fetch_assoc($a);
  }
?>
      </select>
      </span></label></td>
      <td style="font-weight: bold">Costo Ingreso ($)</td>
      <td><input name="costo" type="text" id="costo" size="25" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td style="font-weight: bold">Apuntes</td>
      <td colspan="3" align="center"><label for="textarea_observa2"></label>
        <textarea name="textarea_observa2" id="textarea_observa2" cols="60" rows="1"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="4" align="center"><label for="pesonto"></label>
        <input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
      <a  href="kardex.php" onclick="javascript:window.parent.Shadowbox.close();"><img src="cancelar.png" alt="" width="68" height="20" /></a> </a></td>
    </tr>
  </table>
</form>

<script type="text/javascript">
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_edad2", "integer", {hint:"3", validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_calificacion2", {validateOn:["blur"]});
var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spry_hierro2", {validateOn:["blur"]});
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spry_sexo2", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spry_ubichada2", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var spryselect11 = new Spry.Widget.ValidationSelect("spryselect11", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
var spryselect8 = new Spry.Widget.ValidationSelect("spry_mes", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
</script>
</body>
</html>

<?php
mysql_free_result($hierro);

mysql_free_result($hda);

mysql_free_result($razas);

mysql_free_result($Clasificacion);

mysql_free_result($dia);

mysql_free_result($meses);

mysql_free_result($clr);

mysql_free_result($a);
?>
<?
//informasion de ingreso



@$action =$_POST['text_idvacuno2'];
//$text_f_ingreso = $_POST['text_fechaingreso'];
@$edad_ingreso =$_POST['text_edad_ingreso2'];
@$select_raza =$_POST['select_raza2'];
@$color =$_POST['color'];
@$text_padre=$_POST['text_padre2'];
@$text_madre=$_POST['text_madre2'];
@$select_califique =$_POST['select_califique'];
@$select_clasif =$_POST['select_clasif'];
@$select_sexo =$_POST['select_sexo2'];
@$select_hierro =$_POST['select_hierro2'];
@$select_clase =$_POST['select_clase'];
@$select_ubic_hda=$_POST['select_ubic_hda'];
@$textarea_observ =$_POST['textarea_observa2'];
@$text_registro=$_POST['text_registro'];
@$tiporepr = $select_clasif;

@$diab=trim(strip_tags($_POST['select_dia']));
@$mesb=trim(strip_tags($_POST['select_mes']));
@$anob=trim(strip_tags($_POST['text_anos']));
@$text_f_ingreso=$anob.'-'.$mesb.'-'.$diab;

@$pesonto=$_POST['pesonto'];
@$cos_entro=$_POST['costo'];



?>


<?

					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
				

					if ($totEmp> 0) {
						
				$id_vacuno1 = $id_vacuno;
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						
					$id_vacuno=	$rowEmp['id_vacuno'];
			
										
						}
					}
		
			
?>



<?
	if($anob !=0){
 
  	if ($action!=$id_vacuno ){
	
			
echo "<script type=''>
		alert('Vacuno Registrado  Exitosamente');
	</script>";

$insertar = mysql_query("INSERT INTO d89xz_vacunos(`id_vacuno`,`f_ingreso`,`e_ingreso`,`raza`,`color`,`padre`,`madre`,`clasificasion`,`calificasion`,`sexo`,`observasiones`,`hierro`,`clase`,`ubicasion`,`registro`,`tp_rep`,`p_ncto`,`cos_entro`) VALUES ('{$action }','{$text_f_ingreso}','{$edad_ingreso}','{$select_raza}','{$color}','{$text_padre}','{$text_madre}','{$select_clasif}','{$select_califique}','{$select_sexo}','{$textarea_observ}','{$select_hierro}','{$select_clase}','{$select_ubic_hda}','{$text_registro}','{$tiporepr}','{$pesonto}','{$cos_entro}')",$conexion);


		}
		
		if($anob != 0){
		
			if ($action==$id_vacuno ){ 

		echo "<script type=''>
		alert('Vacuno Existente');
	</script>";
					
	
					}
		}
	}

?>


<?
mysql_close($conexion);
?>