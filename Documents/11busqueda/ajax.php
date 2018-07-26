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
<?php include 'Connections/conexion.php';?>

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

//function llamarAjaxGETdis(){
//var aleatorio=parseInt(Math.random()*999999999);
//valor=document.getElementById("provincia").value;
//var url="distrito.php?valor="+valor+"&r="+aleatorio;
//alert(respuestaAjaxdis);

//peticion.open("GET",url,true);
//peticion.onreadystatechange =respuestaAjaxdis;
//peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
//peticion.send(null);
//}

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
//function respuestaAjaxdis(){

	//if(peticion.readyState==4){
		//if(peticion.status==200){
		//alert(peticion.responseText);
		//document.getElementById("dis").innerHTML=peticion.responseText;
		//}else{
		//alert("ha ocurrido un error"+peticion.statusText);
		//}
	//}
//}


</script>


<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<style type="text/css">
#form1 table tr th {
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
  <li><a href="diario_pendientes.php" class="current">Vacunas</a></li>
  <li><a href="jornada_peso1.php" >Peso</a></li>
  <li><a href="traslado.php" >Traslados</a></li>
</ul>


<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="diario_pendientes_agen.php" >Agenda / Grupo</a>  </li>
  <li><a href="ajax.php" class="current" >Individual</a></li>
  <li><a href="jornada_vacuna_detalle.php">Reportes</a>  </li>
 
</ul>
  
<p>&nbsp;</p>
<form action="" method="post" enctype="application/x-www-form-urlencoded" name="form1" id="form1">
  <table width="500" border="1" align="center" cellspacing="0">
  <tr>
    <th colspan="2" bgcolor="#4D68A2">Ingrese los datos de la Jornada</th>
    </tr>
  <tr>
    <td width="214" id="g" style="color: #000">Fecha</td>
    <th width="241" style="color: #000">D<span id="spry_dia">
      <label for="select_mes"></label>
      <select name="select_dia" id="select_dia">
        <option value="">D</option>
        <?php
do {  
?>
        <option value="<?php echo $row_dias['id']?>"><?php echo $row_dias['dias']?></option>
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
          <option value="<?php echo $row_mes['id']?>"><?php echo $row_mes['meses']?></option>
          <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
        </select>
        </span>A<span id="sprytextfield1">
        <label for="text_anos"></label>
        <span class="textfieldInvalidFormatMsg"></span></span><span id="spryselect3">
        <label for="text_anos"></label>
        <select name="text_anos" id="text_anos">
          <option value="">A</option>
          <?php
do {  
?>
          <option value="<?php echo $row_an['anos']?>"><?php echo $row_an['anos']?></option>
          <?php
} while ($row_an = mysql_fetch_assoc($an));
  $rows = mysql_num_rows($an);
  if($rows > 0) {
      mysql_data_seek($an, 0);
	  $row_an = mysql_fetch_assoc($an);
  }
?>
        </select>
      </span></th>
    </tr>
  <tr>
    <td id="g">Hacienda</td>
    <td><span id="spryselect5">
      <label for="hacinda2"></label>
      <select name="hacinda" id="hacinda2" style="width:270px">
        <option value="">Seleccione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_hda2["hacienda"]?>"><?php echo $row_hda2['hacienda']?></option>
        <?php
} while ($row_hda2 = mysql_fetch_assoc($hda2));
  $rows = mysql_num_rows($hda2);
  if($rows > 0) {
      mysql_data_seek($hda2, 0);
	  $row_hda = mysql_fetch_assoc($hda2);
  }
?>
        </select>
    </td>
    </tr>
  <tr>
    <td id="g">Responsable</td>
    <td><span id="spryselect4">
      <label for="respon2"></label>
      <select name="respon" id="respon2" style="width:270px">
        <option value="">Seleccione</option>
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
    </td>
    </tr>
  <tr>
    <td id="g"><p>Tratamiento</p></td>
    <td><span style="width:100px; float:left">
      <select name="departamento" id="departamento" onChange="llamarAjaxGETpro()" style="width:270px">
        <option>Tratamiento.</option>
        <?php
		
  $re=mysql_query("select * from d89xz_departamento");
  
  while($f=mysql_fetch_array($re)){
  echo'<option value="'.$f['id_dep'].'">'.utf8_encode($f['det_dep']).'</option>';
 
  }
  ?>
        </select>
    </span></td>
    </tr>
  <tr>
    <td id="g"><label for="textfield">Nombre
    </label></td>
    <td><div id="pro" style="width:150px; float:left">
      <select name="select" disabled="disabled" style="width:270px">
        <option>Seleccione Tratamiento</option>
        </select>
    </div></td>
    </tr>
  <tr>
    <td id="g"><span style="color: #000">Dosis en (ml)</span></td>
    <th><span style="color: #000"><span id="sprytextfield2">
      <label for="distrito2"></label>
      <input name="distrito" type="text" id="distrito2" size="40">
      <span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span></span></span></th>
    </tr>
  <tr>
    <td id="g">
      <label for="textarea_observ"></label>
      <p><span style="color: #000">Observaciones</span>s</p></td>
    <th><span id="sprytextfield5">
      <input name="textarea_observ" type="text" id="textarea_observ" size="40">
    </span></th>
    </tr>
  <tr>
    <td id="g"><p style="color: #000">Comentario</p></td>
    <th><span id="sprytextfield4">
      <label for="comen2"></label>
      <input name="comen" type="text" id="comen2" size="40">
    </span></th>
    </tr>
  <tr>
    <th colspan="2" bgcolor="#4D68A2"><span style="color: #FFF">IDs </span></th>
  </tr>
  <tr>
    <th><input name="text_buscar2" type="text" id="text_buscar2" size="11" /></th>
    <th><input name="text_buscar3" type="text" id="text_buscar3" size="11" /></th>
    </tr>
  <tr>
    <th><input name="text_buscar7" type="text" id="text_buscar7" size="11" /></th>
    <th><input name="text_buscar8" type="text" id="text_buscar8" size="11" /></th>
    </tr>
  <tr>
    <th><input name="text_buscar4" type="text" id="text_buscar4" size="11" /></th>
    <th><input name="text_buscar5" type="text" id="text_buscar5" size="11" /></th>
    </tr>
  <tr>
    <th><input name="text_buscar6" type="text" id="text_buscar6" size="11" /></th>
    <th><input name="text_buscar11" type="text" id="text_buscar11" size="11" /></th>
    </tr>
  <tr>
    <th><input name="text_buscar9" type="text" id="text_buscar9" size="11" /></th>
    <th><input name="text_buscar10" type="text" id="text_buscar10" size="11" /></th>
    </tr>
  <tr>
    <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>


  </table>
</form>


<?

$jornada =$_POST['departamento'];
$select_diagnostico =$_POST['provincia'];
$fito = Fito_Sanitaria;
$select_tratamiento =$_POST['distrito'];
$textarea_observ =$_POST['textarea_observ'];
$respon = $_POST['respon'];
$hda=$_POST["hacinda"];


$diab=trim(strip_tags($_POST['select_dia']));
$mesb=trim(strip_tags($_POST['select_mes']));
$anob=trim(strip_tags($_POST['text_anos']));
$text_f_jornada=$anob.'-'.$mesb.'-'.$diab;
$comen=$_POST['comen'];
		
					
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
		
if ($anob != '' ){


		$action =$_POST["text_buscar2"];
		
if ($action != ""){		
		
			$queEmp1 ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action' and ubicasion ='$hda'";
			$resEmp1 = mysql_query($queEmp1, $conexion) or die(mysql_error());
			$totEmp1 = mysql_num_rows($resEmp1);
					if ($totEmp1> 0) {
						while ($rowEmp1 = mysql_fetch_assoc($resEmp1)) {
							$id_vacuno=	$rowEmp1['id_vacuno'];
							$hierro   = $rowEmp1['hierro'];
																								
								}
							}
if (($id_vacuno==$action)){				
		
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - '$select_tratamiento' WHERE  `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
	$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);	
				

			}else{
					
echo "<script type=''>
		alert('$action-- Vacun: $id_vacuno Vacuno  No Existe  O  No  Pertenece a esta  Hacienda : $finca Hacienda : $hda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
		
		
			
		
 
 // 2
 $action3 =$_POST['text_buscar3'];
 
		if ($action3 != ""){
					
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action3' and ubicasion ='$hda' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno3=$rowEmp['id_vacuno'];
							$hierro  = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno3==$action3)){				
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno3}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
			$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);		

			}else{
						echo "<script type=''>
		alert('$action3--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";		
						
			}
		
 
		}
 
		
 
 // 3
 
  $action4 =$_POST['text_buscar4'];
  
		if ($action4 != ""){	
		
		$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action4' and ubicasion ='$hda'";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno4=$rowEmp['id_vacuno'];
							$hierro = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno4==$action4)){								
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno4}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
	$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);				

			}else{
								echo "<script type=''>
		alert('$action4--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action4--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
 // 4
 
 $action5 =$_POST['text_buscar5'];
		if ($action5 != ""){
			
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action5' and ubicasion ='$hda' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno5=	$rowEmp['id_vacuno'];
							$finca=$rowEmp['ubicasion'];
							$hierro  = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno5==$action5)){				
				
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno5}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
	$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);				

			}else{
										echo "<script type=''>
		alert('$action5--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action5--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
 
  // 5
 
 $action6 =$_POST['text_buscar6'];
		if ($action6 != ""){	
			
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action6' and ubicasion ='$hda'";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno6=$rowEmp['id_vacuno'];
							$hierro = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno6==$action6)){				
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno6}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);					

			}else{
										echo "<script type=''>
		alert('$action6--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action6--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
   // 6
 
 $action7 =$_POST['text_buscar7'];
		if ($action7 != ""){
					
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action7' and ubicasion ='$hda'";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno7=$rowEmp['id_vacuno'];
							$hierro   = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno7==$action7)){				
			
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno7}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
	$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);				

			}else{
										echo "<script type=''>
		alert('$action7--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action7--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
 
  // 7
 
 $action8 =$_POST['text_buscar8'];
		if ($action8 != ""){	
			
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action8' and ubicasion ='$hda' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno8=$rowEmp['id_vacuno'];
							$hierro   = $rowEmp['hierro'];	
																	
								}
							}
			if (($id_vacuno8==$action8)){					
		
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno8}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
	$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);				

			}else{
										echo "<script type=''>
		alert('$action7--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action8--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
 
  // 8
 
 $action9 =$_POST['text_buscar9'];
		if ($action9 != ""){	
			
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action9' and ubicasion ='$hda' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno9=$rowEmp['id_vacuno'];
							$hierro   = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno9==$action9)){						
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno9}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);					

			}else{
										echo "<script type=''>
		alert('$action9--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";
						//echo "<font size=10 color='#FF0000'>$action9--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
  // 9
 
 $action10 =$_POST['text_buscar10'];
		if ($action10 != ""){		
		
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action10' and ubicasion ='$hda' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno10=$rowEmp['id_vacuno'];
							$finca=$rowEmp['ubicasion'];
							$hierro   = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno10==$action10)){				
		
	
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno10}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
	$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);				

			}else{
										echo "<script type=''>
		alert('$action10--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action10--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
  // 10
 
 $action11 =$_POST['text_buscar11'];
		if ($action11 != ""){		
		
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action11' and ubicasion ='$hda' ";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							$id_vacuno11=$rowEmp['id_vacuno'];
							$finca=$rowEmp['ubicasion'];
							$hierro   = $rowEmp['hierro'];
																	
								}
							}
			if (($id_vacuno11==$action11)){				
			
	$insertar = mysql_query("INSERT INTO d89xz_vacunasion (id_vacuno,hierro,jornada,diagnostico,tratamiento,observasion,fecha,fito,respon,hacien,comen)
		VALUES ('{$id_vacuno11}','{$hierro}','{$jornada}', '{$select_diagnostico }', '{$select_tratamiento }','{$textarea_observ }', '{$text_f_jornada }','{$fito}','{$respon}','{$hda}','{$comen}')", $conexion);
		
		$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinas` SET `dosis`= dosis - $select_tratamiento WHERE `tipo` = '$jornada' AND `nombre` = '$select_diagnostico' and cont='$conte' and mark='$marca'", $conexion);
					
					
$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidas (concep,fecha,cantid,mark,cont,nombre,tipo,idm)
		VALUES ('Jornada Vacunacion','{$text_f_jornada}','{$select_tratamiento}', '{$marca}', '{$conte}','{$select_diagnostico}','{$jornada}','{$id_dep}')", $conexion);
			}else{
										echo "<script type=''>
		alert('$action11--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda');
	</script>";	
						//echo "<font size=10 color='#FF0000'>$action11--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
			}
		
 
		}
 
 
}
?>



<script type="text/javascript">
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {hint:"Observaciones :"});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var sprjamantfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_mes", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dia", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], hint:"Observaciones:"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {hint:"Comentario:", validateOn:["blur"]});
</script>
<?php
mysql_close($conexion);
mysql_free_result($dias);

mysql_free_result($mes);

mysql_free_result($an);

mysql_free_result($res);

mysql_free_result($hda2);
?>
