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
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form15 table tr th {
	color: #FFF;
	
}
</style>
</head>
<script>
function comprobar() {
    if((document.formulario.nacimiento[1].selected)) {
        document.formulario.text_idvacuno2.disabled=true;
        document.formulario.pesonto.disabled=true;
		document.formulario.select_sexo2.disabled=true;
		document.formulario.select_raza2.disabled=true;
		document.formulario.color.disabled=true;
		document.formulario.select_clase.disabled=true;
		document.formulario.select_califique.disabled=true;
		document.formulario.select_hierro2.disabled=true;
		document.formulario.select_clasif.disabled=true;
		document.formulario.text_registro.disabled=true;
		document.formulario.textarea_observa2.disabled=true;
    }
    else {
        document.formulario.text_idvacuno2.disabled=false;
        document.formulario.pesonto.disabled=false;
		document.formulario.select_sexo2.disabled=false;
		document.formulario.select_raza2.disabled=false;
		document.formulario.color.disabled=false;
		document.formulario.select_clase.disabled=false;
		document.formulario.select_califique.disabled=false;
		document.formulario.select_hierro2.disabled=false;
		document.formulario.select_clasif.disabled=false;
		document.formulario.text_registro.disabled=false;
		document.formulario.textarea_observa2.disabled=false;
    }
}
function compruebaCombo() {
    if((document.formulario.nacimiento[0].selected)) {
        alert("Elija Una Opcion en Nacimiento.");
    }
}
</script>
<body>
<form id="formulario" name="formulario" method="post" action="">
  <table width="657" height="179" border="1" align="center" cellspacing="0">
    <tr style="color: #FFF">
      <th colspan="2" bgcolor="#4D68A2" scope="col">Información Parto</th>
      <th colspan="2" bgcolor="#4D68A2" scope="col">Información Cria</th>
    </tr>
    <tr>
      <td width="99">Nacimiento</td>
      <td width="213"><span id="spryselect1">
        <label for="nacimiento" ></label>
        <span id="spryselect3">
        <select name="nacimiento" id="nacimiento" style="width:206px"onChange="comprobar();" >
          <option  value="">Seleccione</option>
          <option value="Aborto">Aborto</option>
          <option value="Asistido">Asistido</option>
          <option value="Normal">Normal</option>
        </select>
        </span><span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
      <td width="130"><strong>ID </strong></td>
      <td width="185"><input name="text_idvacuno2" type="text" id="text_idvacuno2" size="24" /></td>
    </tr>
    <tr>
      <td>Fecha</td>
      <td>D<span id="spry_dia">
      <label for="select_dia2"></label>
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
      <label for="select_mes2"></label>
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
      </span>A<span id="spryselect4">
      <label for="text_anos2">
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
      </label>
      </span></td>
      <td>Sexo</td>
      <td><span id="spry_sexo2">
        <label for="select_sexo2"></label>
        <select name="select_sexo2" id="select_sexo2" style="width:180px">
          <option>Seleccione Sexo</option>
          <option value="Macho">Macho</option>
          <option value="Hembra">Hembra</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td>Ubicacion</td>
      <td><span id="spry_ubichada2">
      <label for="select_ubic_hda3"></label>
      <select name="select_ubic_hda" id="select_ubic_hda3" style="width:206px">
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
      <td>Raza</td>
      <td><span id="spryselect2">
        <label for="select_raza2"></label>
        <select name="select_raza2" id="select_raza2"  style="width:180px">
          <option value="">Selecc. Raza</option>
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
    </tr>
    <tr>
      <td>Responsable</td>
      <td><label for="respon"></label>
        <select name="respon" id="respon" style="width:206px">
          <option value="1">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_res['cedula']?>"><?php echo $row_res['nombre']?></option>
          <?php
} while ($row_res = mysql_fetch_assoc($res));
  $rows = mysql_num_rows($res);
  if($rows > 0) {
      mysql_data_seek($res, 0);
	  $row_res = mysql_fetch_assoc($res);
  }
?>
      </select></td>
      <td>Color</td>
      <td><span id="spryselect10">
        <label for="color2"></label>
        <select name="color" id="color2"  style="width:180px">
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
    </tr>
    <tr>
      <td>Observaciones</td>
      <th rowspan="2"><textarea name="observa_naci" id="observa_naci" cols="20" rows="2"></textarea></th>
      <td>Clase</td>
      <td><span id="spryselect9">
        <label for="select_clase2"></label>
        <select name="select_clase" id="select_clase2"  style="width:180px">
          <option>Seleccione</option>
          <option value="Puro">Puro</option>
          <option value="Comercial">Comercial</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td> Calificación </td>
      <td><span id="spry_calificacion2">
        <label for="select_califique"></label>
        <select name="select_califique" id="select_califique"  style="width:180px">
          <option>Califique</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Hierro</td>
      <td><span id="spry_hierro2">
        <label for="select_hierro2"></label>
        <select name="select_hierro2" id="select_hierro2"  style="width:180px">
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
      </span>        <label for="select_clase"></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Clasific.</td>
      <td><span id="spry_clasificacion2">
        <label for="select_clasif2"></label>
        <select name="select_clasif" id="select_clasif2"  style="width:180px">
          <option>Clasificacion</option>
          <option value="CRIA MACHO">CRIA MACHO</option>
          <option value="CRIA HEMBRA">CRIA HEMBRA</option>
        
 
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Peso</td>
      <td><input name="pesonto" type="text" id="pesonto" size="24" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Registro N°</td>
      <td><input name="text_registro" type="text" id="text_registro" size="24" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Observaciones</td>
      <td><label for="textarea_observa2"></label>
        <textarea name="textarea_observa2" id="textarea_observa2" cols="20" rows="1"></textarea></td>
    </tr>
    <tr bgcolor="#4D68A2">
    
      <td colspan="2" align="center"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar"  onclick="return confirm('¿ Desea Registrar evento …?');"/>        </a></td>
      <td colspan="2" align="center"><a  href="paritorio_vacas_proxi_parir.php"  onclick="return confirm('¿ Desea Salir …?');"><img src="cancelar.png" alt="" width="68" height="20" /></a></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script type="text/javascript">
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
</script>
</body>
</html>

<?php
mysql_free_result($hierro);

mysql_free_result($hda);

mysql_free_result($razas);

mysql_free_result($dia);

mysql_free_result($meses);

mysql_free_result($clr);

mysql_free_result($a);

mysql_free_result($res);
?>
<?
//informasion de ingreso



@$action =$_POST['text_idvacuno2'];
//$text_f_ingreso = $_POST['text_fechaingreso'];
@$edad_ingreso =0;
@$select_raza =$_POST['select_raza2'];
@$color =$_POST['color'];
@$text_padre=$_GET['toro']; //se coge url
@$text_madre=$_GET['vaca'];//se coge url
@$select_califique =$_POST['select_califique'];
@$select_clasif =$_POST['select_clasif'];
@$select_sexo =$_POST['select_sexo2'];
@$select_hierro =$_POST['select_hierro2'];
@$select_clase =$_POST['select_clase'];
@$select_ubic_hda=$_POST['select_ubic_hda'];
@$textarea_observ =$_POST['textarea_observa2'];
@$text_registro=$_POST['text_registro'];
@$tiporepr = $_POST['select_clasif'];

@$diab=trim(strip_tags($_POST['select_dia']));
@$mesb=trim(strip_tags($_POST['select_mes']));
@$anob=trim(strip_tags($_POST['text_anos']));
@$text_f_ingreso=$anob.'-'.$mesb.'-'.$diab;

@$pesonto=$_POST['pesonto'];
@$respon=$_POST['respon'];
@$nacimiento=$_POST['nacimiento']; 
@$observa_naci=$_POST['observa_naci'];
?>


<?

					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
							if ($totEmp> 0) {
						
				$id_vacuno1 = $id_vacuno;
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						
					@$id_vacuno=	$rowEmp['id_vacuno'];
			
										
						}
					}
					
					// responsable
					
	$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$respon'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$nombre=	$rowEmp['nombre'];	
						$apellido=	$rowEmp['apellido'];				
						}
					}
	$responsable = $nombre.' '.$apellido;	
	
	
	
	$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$consecutivo=	$rowEmp['nacimientos'];
	
						}
					}
						
			
?>



<?
if($anob != 0){	
	

  	if ($action!=$id_vacuno ){
		 if($nacimiento != 'Aborto'){

			
			echo "<script type=''>
					alert('Vacuno Registrado  Exitosamente');
				</script>";

$insertar = mysql_query("INSERT INTO d89xz_vacunos(`id_vacuno`,`f_ingreso`,`e_ingreso`,`raza`,`color`,`padre`,`madre`,`clasificasion`,`calificasion`,`sexo`,`observasiones`,`hierro`,`clase`,`ubicasion`,`registro`,`tp_rep`,p_ncto) VALUES ('{$action }','{$text_f_ingreso}','{$edad_ingreso}','{$select_raza}','{$color}','{$text_padre}','{$text_madre}','{$select_clasif}','{$select_califique}','{$select_sexo}','{$textarea_observ}','{$select_hierro}','{$select_clase}','{$select_ubic_hda}','{$text_registro}','{$tiporepr}','{$pesonto}')",$conexion);

		$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `tp_rep`='Vaca Parida', `d_criar`=''  WHERE `id_vacuno`='$text_madre'");
	}

	
}
		
		
$insertar1 = mysql_query("INSERT INTO d89xz_nacimientos(`conse`,`padre`,`madre`,`idcria`,`nacim`,`fecha`,`ubica`,`respon`,`observ`) VALUES ('{$consecutivo}','{$text_padre}','{$text_madre}','{$action}','{$nacimiento}','{$text_f_ingreso}','{$select_ubic_hda}','{$responsable}','{$observa_naci}')",$conexion);	


$insertar2 = mysql_query("UPDATE `d89xz_consecu_orden` SET `nacimientos`= nacimientos + 1", $conexion);
		
			if ($action==$id_vacuno ){ 

		echo "<script type=''>
					alert('Vacuno Existente O Nacido Muerto');
				</script>";
					
	
					}
					
					
 if($nacimiento = 'Aborto'){	
 
 $sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `tp_rep`='Vaca Horra', `d_criar`=''  WHERE `id_vacuno`='$text_madre'");
 
 }
					
					
		}

?>

<?
mysql_close($conexion);
?>
