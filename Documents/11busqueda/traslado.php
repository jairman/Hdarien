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
$query_f_destino = "SELECT hacienda FROM d89xz_hacienda";
$f_destino = mysql_query($query_f_destino, $conexion) or die(mysql_error());
$row_f_destino = mysql_fetch_assoc($f_destino);
$totalRows_f_destino = mysql_num_rows($f_destino);

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
$query_emp = "SELECT * FROM d89xz_empleados";
$emp = mysql_query($query_emp, $conexion) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php" >B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php" >Peso</a></li>
  <li><a href="traslado.php" class="current">Traslados</a></li>
</ul>

<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="traslado1.php" class="current">Traslados</a></li>
  <li><a href="traslado_reporte.php" >Reportes</a></li>
</ul>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="578" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="4" bgcolor="#4D68A2">Ingrese vacuno a Trasladar</th>
    </tr>
    <tr>
      <td style="font-weight: bold">Responsable</td>
      <td><span id="spryselect3">
        <label for="responsable"></label>
        <select name="responsable" id="responsable" style="width:205px">
          <option value=""> Seleccione  Responsable</option>
          <?php
do {  
?>
          <option value="<?php echo $row_emp['nombre']?>"><?php echo $row_emp['nombre']?></option>
          <?php
} while ($row_emp = mysql_fetch_assoc($emp));
  $rows = mysql_num_rows($emp);
  if($rows > 0) {
      mysql_data_seek($emp, 0);
	  $row_emp = mysql_fetch_assoc($emp);
  }
?>
        </select>
      </span></td>
      <td style="font-weight: bold">Hacienda</td>
      <td><span id="hacienda">
        <label for="hacienda"></label>
        <select name="hacienda" id="hacienda" style="width:205px">
          <option value="">Seleccione Hacienda</option>
          <?php
do {  
?>
          <option value="<?php echo $row_f_destino['hacienda']?>"><?php echo $row_f_destino['hacienda']?></option>
          <?php
} while ($row_f_destino = mysql_fetch_assoc($f_destino));
  $rows = mysql_num_rows($f_destino);
  if($rows > 0) {
      mysql_data_seek($f_destino, 0);
	  $row_f_destino = mysql_fetch_assoc($f_destino);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td style="font-weight: bold">Fecha</td>
      <td><span id="spry_dia">
        <label for="select_dia"></label>
        D
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
        M</span><span id="spry_mes">
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
</span></td>
      <td style="font-weight: bold">Destino</td>
      <td width="194"><span id="spry_destino">
        <label for="select_destino"></label>
        <select name="select_destino" id="select_destino" style="width:205px">
          <option value="">Seleccione Destino</option>
          <?php
do {  
?>
          <option value="<?php echo $row_f_destino['hacienda']?>"><?php echo $row_f_destino['hacienda']?></option>
          <?php
} while ($row_f_destino = mysql_fetch_assoc($f_destino));
  $rows = mysql_num_rows($f_destino);
  if($rows > 0) {
      mysql_data_seek($f_destino, 0);
	  $row_f_destino = mysql_fetch_assoc($f_destino);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr align="center">
      <td width="84">ID</td>
      <td width="206"><label for="text_id_vacuno"></label>
      <input type="text" name="text_id_vacuno" id="text_id_vacuno" /></td>
      <td width="66">ID</td>
      <td width="194"><input type="text" name="text_id_vacuno6" id="text_id_vacuno6" /></td>
    </tr>
    <tr align="center">
      <td>ID</td>
      <td><input type="text" name="text_id_vacuno2" id="text_id_vacuno2" /></td>
      <td>ID</td>
      <th><input type="text" name="text_id_vacuno7" id="text_id_vacuno7" /></th>
    </tr>
    <tr align="center">
      <td>ID</td>
      <td><input type="text" name="text_id_vacuno3" id="text_id_vacuno3" /></td>
      <td>ID</td>
      <th><input type="text" name="text_id_vacuno8" id="text_id_vacuno8" /></th>
    </tr>
    <tr align="center">
      <td>ID</td>
      <td><input type="text" name="text_id_vacuno4" id="text_id_vacuno4" /></td>
      <td>ID</td>
      <th><input type="text" name="text_id_vacuno9" id="text_id_vacuno9" /></th>
    </tr>
    <tr align="center">
      <td>ID</td>
      <td><input type="text" name="text_id_vacuno5" id="text_id_vacuno5" /></td>
      <td>ID</td>
      <th><input type="text" name="text_id_vacuno10" id="text_id_vacuno10" /></th>
    </tr>
    <tr align="center">
      <td colspan="4"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spry_destino", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("hacienda", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryjamanct3 = new Spry.Widget.ValidationSelect("spry_mes", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($f_destino);

mysql_free_result($dias);

mysql_free_result($meses);

mysql_free_result($anos);

mysql_free_result($emp);
?>

<?
$hda = $_POST['hacienda'];
$responsable = $_POST['responsable'];
$action1 =$_POST['text_id_vacuno'];

$action2 =$_POST['text_id_vacuno2'];
$action3 =$_POST['text_id_vacuno3'];
$action4 =$_POST['text_id_vacuno4'];
$action5 =$_POST['text_id_vacuno5'];
$action6 =$_POST['text_id_vacuno6'];
$action7 =$_POST['text_id_vacuno7'];
$action8 =$_POST['text_id_vacuno8'];
$action9 =$_POST['text_id_vacuno9'];
$action10 =$_POST['text_id_vacuno10'];

$select_destino =$_POST['select_destino'];

$diab=trim(strip_tags($_POST['select_dia']));
$mesb=trim(strip_tags($_POST['select_mes']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_traslado=$anob.'-'.$mesb.'-'.$diab;

?>



<?
if ($anob != 0 ){
	
	//1
	if ($action1 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action1' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action1) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
						echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
					}
			}


//2
	if ($action2 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action2' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action2) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}

//3
	if ($action3 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action3' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action3) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}


//4
	if ($action4 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action4' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action4) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
							echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}


//5
	if ($action5 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action5' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action5) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}

//6
	if ($action6 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action6' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action6) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}

//7
	if ($action7 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action7' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action7) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}

//8
	if ($action8 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action8' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action8) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}
//9
	if ($action9 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action9' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action9) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}

//10
	if ($action10 != 0){
	
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action10' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno=	$rowEmp['id_vacuno'];
							$fecha_esta=$rowEmp['ubicasion'];
																	
								}
							}
			if (($id_vacuno==$action10) &&($fecha_esta==$hda)){
			
				$insertar = mysql_query("INSERT INTO d89xz_traslados (id_vacuno,finca_esta,finca_va,fecha,respon)
						VALUES ('{$id_vacuno}','{$fecha_esta}', '{$select_destino }', '{$text_f_traslado}', '{$responsable}')", $conexion);
						
				$sql =mysql_query( "UPDATE d89xz_vacunos SET `ubicasion` = '$select_destino' WHERE `id_vacuno`= '$id_vacuno'");    				
									
					}else{
								echo "<script type=''>
		alert(' Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
					}
			}





}
	   
?> 
     
         
     
<?
mysql_close($conexion);
?>