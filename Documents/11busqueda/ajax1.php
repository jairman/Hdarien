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
$query_dias = "SELECT * FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_an = "SELECT * FROM d89xz_anos";
$an = mysql_query($query_an, $conexion) or die(mysql_error());
$row_an = mysql_fetch_assoc($an);
$totalRows_an = mysql_num_rows($an);

mysql_select_db($database_conexion, $conexion);
$query_res = "SELECT * FROM d89xz_empleados";
$res = mysql_query($query_res, $conexion) or die(mysql_error());
$row_res = mysql_fetch_assoc($res);
$totalRows_res = mysql_num_rows($res);

mysql_select_db($database_conexion, $conexion);
$query_hda2 = "SELECT * FROM d89xz_hacienda";
$hda2 = mysql_query($query_hda2, $conexion) or die(mysql_error());
$row_hda2 = mysql_fetch_assoc($hda2);
$totalRows_hda2 = mysql_num_rows($hda2);
?>
<?php include "conexion.php";?>

<script>
//hacer que funcione con diferentes navegadores
function requerir(){
	try{
	req=new XMLHttpRequest();
	}catch(err1){
		try{
		req=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(err2){
			try{
			req=new ActiveXObject("Msxml2.XMLHTTP");
			}catch(err3){
			req= false;
			}
		}
	}
return req;
}


var peticion=requerir();

function llamarAjaxGETpro(){
var aleatorio=parseInt(Math.random()*999999999);
valor=document.getElementById("departamento").value;
var url="provincia.php?valor="+valor+"&r="+aleatorio;
peticion.open("GET",url,true);
peticion.onreadystatechange =respuestaAjaxpro;
peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
peticion.send(null);
}
function llamarAjaxGETpro1(){
var aleatorio=parseInt(Math.random()*999999999);
valor=document.getElementById("departamento2").value;
var url="provincia2.php?valor="+valor+"&r="+aleatorio;
peticion.open("GET",url,true);
peticion.onreadystatechange =respuestaAjaxpro1;
peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
peticion.send(null);
}
function llamarAjaxGETpro2(){
var aleatorio=parseInt(Math.random()*999999999);
valor=document.getElementById("departamento3").value;
var url="provincia.php?valor="+valor+"&r="+aleatorio;
peticion.open("GET",url,true);
peticion.onreadystatechange =respuestaAjaxpro2;
peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
peticion.send(null);
}

function respuestaAjaxpro(){

	if(peticion.readyState==4){
		if(peticion.status==200){
		//alert(peticion.responseText);
		document.getElementById("pro").innerHTML=peticion.responseText;
		}else{
		alert("ha ocurrido un error"+peticion.statusText);
		}
	}
	
}

function respuestaAjaxpro1(){

	if(peticion.readyState==4){
		if(peticion.status==200){
		//alert(peticion.responseText);
		document.getElementById("pro1").innerHTML=peticion.responseText;
		}else{
		alert("ha ocurrido un error"+peticion.statusText);
		}
	}
	
}
function respuestaAjaxpro2(){

	if(peticion.readyState==4){
		if(peticion.status==200){
		//alert(peticion.responseText);
		document.getElementById("pro2").innerHTML=peticion.responseText;
		}else{
		alert("ha ocurrido un error"+peticion.statusText);
		}
	}
	
}

</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>

<?
@$id_vacuno = $_GET['id_vacuno'];
@$vacuna=$_GET['vacuna'];
@$hierro=$_GET['hierro'];
@$cmvac =$_GET['cmvac'];
@$resvac=$_GET['resvac'];
?>



<body>

<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td colspan="4" align="center"><a href="diario_pendientes_detalle.php?vacuna=<?php echo $vacuna; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmvac=<?php echo $cmvac; ?>&amp;resvac=<?php echo $resvac; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
  </tr>
  <tr>
    <td width="121" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right">&nbsp;</td>
  </tr>
</table>
<form action="" method="post" enctype="application/x-www-form-urlencoded" name="form1" id="form1">
  <table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <th colspan="4" bgcolor="#4D68A2">Ingrese Los Datos De LaVacuna</th>
    </tr>
  <tr>
    <th style="color: #000">&nbsp;</th>
    <th style="color: #000">ID</th>
    <th align="center" bgcolor="#4D68A2" style="color: #000"><input name="text_buscar2" type="text" id="text_buscar2" size="11" readonly="readonly"  value="<? echo "$id_vacuno" ?>"/></th>
    <th style="color: #000">&nbsp;</th>
    </tr>
  <tr>
    <td width="396"><span style="width:100px; float:left">
      <select name="departamento" id="departamento" onChange="llamarAjaxGETpro()">
        <option>Tratamiento.</option>
        
        
   <?php
		
  $re=mysql_query("select * from d89xz_departamento");
  
  while($f=mysql_fetch_array($re)){
  echo'<option value="'.$f['id_dep'].'">'.utf8_encode($f['det_dep']).'</option>';
 
  }
  ?>
  
  
      </select>
    </span></td>
    <td width="341"><label for="textfield">
    <div id="pro" style="width:150px; float:left">
      <select name="select" disabled="disabled" >
        <option>Seleccione Tratamiento</option>
      </select>
    </div>
  </label></td>
    <td width="209" align="center">
      
      </span>Dosis en (ML)</td>
    <th width="114"><span id="sprytextfield2">
      <label for="distrito"></label>
      <input name="distrito" type="text" id="distrito" size="10">
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></th>
    </tr>
  <tr>
    <td><span style="width:150px; float:left">Observaciones :</span></td>
    <td colspan="2"><span style="width:150px; float:left">
      <textarea name="textarea_observ" id="textarea_observ" cols="34" rows="1"></textarea>
      </span></td>
    <th><input type="submit" name="button" id="button" value="Enviar" /></th>
    </tr>


  </table>
</form>


<p>
  <?


$jornada =$_POST['departamento'];
$jornada2 =$_POST['departamento2'];
$jornada3 =$_POST['departamento3'];

$select_diagnostico =$_POST['provincia'];
$select_diagnostico2 =$_POST['provincia2'];
$select_diagnostico3 =$_POST['provincia3'];


$fito = Fito_Sanitaria;
$select_tratamiento =$_POST['distrito'];
//$select_tratamiento =$_POST['distrito'];
//$text_f_jornada = $_POST['text_f_jornada'];
$textarea_observ =$_POST['textarea_observ'];

$respon =$_GET['resvac'];
$hda =$_GET['hacienda'];
$hierro=$_GET['hierro'];
$cmvac =$_GET['cmvac'];

//enviar url
				
					$queEmp = "SELECT * FROM `d89xz_provincia` WHERE `id_pro`='$select_diagnostico'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {						
							
							$select_diagnostico = $rowEmp['det_pro'];
							$marca = $rowEmp['mark'];
							$conte = $rowEmp['cont'];
							}
					}
						

					$queEmp = "SELECT * FROM `d89xz_departamento` WHERE `id_dep`='$jornada'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {							
							$jornada = $rowEmp['det_dep'];
						
							}
					}
  	$queEmp = "SELECT * FROM `d89xz_total_medicinas` WHERE  `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				$totEmp = mysql_num_rows($resEmp);
					
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {							
							
							
							$id_dep = $rowEmp['id'];
							}
					}					
				
if($select_tratamiento != 0){
			
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', NOW(),'{$fito}','{$respon}','{$hda}','{$cmvac}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - '$select_tratamiento' WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico'  and cont='$conte' and mark='$marca'", $conexion);
		
$insertar2 = mysql_query("UPDATE `d89xz_vacunos` SET `vacuna`='',`cmvac`='',`resvac`='' WHERE `id_vacuno`='$id_vacuno'", $conexion);

$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$vacuna}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);	
	
			
echo "<script type=''>
		window.location='diario_pendientes_detalle.php?resvac=".$resvac."&hda=".$hda."&hierro=".$hierro."&cmvac=".$cmvac."&vacuna=".$vacuna."';
	</script>";
	
				
		}

?>
  
  <?php
mysql_close($conexion);
mysql_free_result($dias);

mysql_free_result($mes);

mysql_free_result($an);

mysql_free_result($res);

mysql_free_result($hda2);
?>
</p>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {isRequired:false});
</script>
