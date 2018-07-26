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
$query_dias = "SELECT dias FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT meses FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT anos FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_empleados";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);

mysql_select_db($database_conexion, $conexion);
$query_hda = "SELECT hacienda FROM d89xz_hacienda";
$hda = mysql_query($query_hda, $conexion) or die(mysql_error());
$row_hda = mysql_fetch_assoc($hda);
$totalRows_hda = mysql_num_rows($hda);






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />


<script language="javascript"> 
//Su explorador no soporta java o lo tiene deshabilitado; esta pagina necesita javascript para funcionar correctamente<!-- 
//Copyright © McAnam.com 
    function navegar(direccion, nueva_ventana){ 
        if(direccion.toLowerCase().substring(0,3) == "") 
            direccion = "http://" + direccion 
        if(direccion != ""){ 
            if (nueva_ventana) 
                window.open(direccion); 
            else 
                location.href = direccion; 
        } 
    } 
//--> 
</script>


<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php">B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php" class="current">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="#">Peso</a></li>
  <li><a href="#">Traslados</a></li>
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="jornada_palpacion.php" >Agenda / Grupo</a>  </li>
  <li><a href="palpacion2.php" class="current">Individual</a></li>
    <li><a href="palpacion_pp.php" >Confirmar  (PP)</a></li>
  <li><a href="jornada_palpacion_detalle.php">Reportes</a>  </li>
 
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="586" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="4" bgcolor="#4D68A2" style="color: #FFF">Palpación Individual</th>
    </tr>
    <tr>
      <td width="104">Estado</td>
      <th width="216"><span id="spryselect4">
      <label for="select2"></label>
      <select name="estado" id="select2"style="width:205px" onchange="navegar(this.value,0)">
      <!--  <option value="<? echo $estado?>">Seleccione</option>-->
        <option value="palpacion2.php?pal=VOE">VOE</option>
        <option value="palpacion2VCN.php?pal=VCN" selected="selected">VCN</option>
        <option value="palpacion2PP.php?pal=PP">PP</option>
        <option value="inseminacionPN.php">P(N)</option>
      </select>
      </span></th>
      <td width="77">Hacienda</td>
      <th width="171"><span id="spryselect6">
        <label for="hda"></label>
        <select name="hda" id="hda" style="width:155px">
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
      </span></th>
    </tr>
    <tr>
      <td>Fecha Palpación </td>
      <td>D<span id="spryselect1">
        <label for="dia"></label>
        <select name="dia" id="dia">
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
      </span>A<span id="spryselect3">
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
      <td>Responsable</td>
      <th><span id="spryselect5">
      <label for="respon2"></label>
      <select name="respon" id="respon2" style="width:155px">
        <option value="">Seleccione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_cli['cedula']?>"><?php echo $row_cli['nombre']?></option>
        <?php
} while ($row_cli = mysql_fetch_assoc($cli));
  $rows = mysql_num_rows($cli);
  if($rows > 0) {
      mysql_data_seek($cli, 0);
	  $row_cli = mysql_fetch_assoc($cli);
  }
?>
      </select>
      </span></th>
    </tr>
    <tr>
      <td>ID<a  onclick="abre()" ><img src="buscar.jpg" width="20" height="20" /></a></td>
      <td align="center"><label for="V_1"></label>
      <input name="V_1" type="text" id="V_1" value="" /></td>
      <td>Comentario</td>
      <td align="center"><label for="comen1"></label>
      <input type="text" name="comen1" id="comen1" /></td>
    </tr>
    <tr>
      <td>ID</td>
      <td align="center"><label for="V_3"></label>
      <input name="V_3" type="text" id="V_3" value="" /></td>
      <td>Comentario</td>
      <td align="center"><label for="V_4"></label>
      <input type="text" name="comen2" id="comen2" /></td>
    </tr>
    <tr>
      <td>ID</td>
      <td align="center"><input type="text" name="V_5" id="V_5" /></td>
      <td>Comentario</td>
      <td align="center"><input type="text" name="comen3" id="comen3" /></td>
    </tr>
    <tr>
      <td>ID</td>
      <td align="center"><input type="text" name="V_6" id="V_6" /></td>
      <td>Comentario</td>
      <td align="center"><input type="text" name="comen4" id="comen4" /></td>
    </tr>
    <tr>
      <td>ID</td>
      <td align="center"><input type="text" name="V_7" id="V_7" /></td>
      <td>Comentario</td>
      <td align="center"><input type="text" name="comen5" id="comen5" /></td>
    </tr>
    <tr>
      <th colspan="4"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar"  onclick="return confirm('Desea Generar La Palpación ');"/></th>
    </tr>
  </table>
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($cli);

mysql_free_result($hda);
?>


<?
//$id =$_GET['id'];
@$hda =$_POST['hda'];
@$respon =$_POST['respon'];
@$estado=VCN;
@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$fecha_palpa=$anob.'-'.$mesb.'-'.$diab;
@$comen1=$_POST['comen1'];
@$comen2=$_POST['comen2'];
@$comen3=$_POST['comen3'];
@$comen4=$_POST['comen4'];
@$comen5=$_POST['comen5'];

?>
<?

if ($anob != 0 ){
	
	
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
	//echo"$responsable";
	//echo"$nombre";
	
		$V_1 =$_POST['V_1'];
 		if ($V_1 != ""){
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$V_1' and sexo = 'Hembra'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp['id_vacuno'];	
						$hacienda=	$rowEmp['ubicasion'];			
						}
					}
					//echo $id_vacuno = $V_1;
					echo "<br>";
					//echo $hacienda = $hda;		
  		
				if(($id_vacuno==$V_1) &&($hacienda==$hda)){
					
					
     					 $insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado,resp,hda,coment_pal,jornd)
						VALUES ('{$V_1}','{$fecha_palpa}','{$estado}','{$responsable}','{$hda}','{$comen1}','{$fecha_palpa}')");
						echo "<br>";
						echo "<font size=5 color='#0000FF'>$V_1--Registro  Exitoso</font>";
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `estrepr`='$estado', coment_pal='$comen1'  WHERE `id_vacuno`='$id_vacuno'");
		
					}else{
						echo "<br>";	
						echo "<font size=10 color='#FF0000'>$V_1--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
					}
					
		}
	
	
		
		$V_3 =$_POST['V_3'];
 		if ($V_3 != ""){
										
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$V_3' and sexo = 'Hembra'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp[id_vacuno];	
						$hacienda=	$rowEmp['ubicasion'];			
						}
					}
						
		
					if(($id_vacuno==$V_3) &&($hacienda==$hda)){
     					 $insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado,resp,hda,coment_pal,jornd)
						VALUES ('{$V_3}','{$fecha_palpa}','{$estado}','{$responsable}','{$hda}','{$comen2}','{$fecha_palpa}')");
						echo "<br>";
						echo "<font size=5 color='#0000FF'>$V_3--Registro  Exitoso</font>";
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `estrepr`='$estado', coment_pal='$comen2'  WHERE `id_vacuno`='$id_vacuno'");
		
					}else{
						echo "<br>";	
						echo "<font size=10 color='#FF0000'>$V_3--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
					}
		}
		
		
	//5
	
	$V_5 =$_POST['V_5'];
 		if ($V_5 != ""){
										
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$V_5' and sexo = 'Hembra'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp[id_vacuno];	
						$hacienda=	$rowEmp['ubicasion'];			
						}
					}
						
		
			  		
				if(($id_vacuno==$V_5) &&($hacienda==$hda)){
     					 $insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado,resp,hda,coment_pal,jornd)
						VALUES ('{$V_5}','{$fecha_palpa}','{$estado}','{$responsable}','{$hda}','{$comen3}','{$fecha_palpa}')");
						echo "<br>";
						echo "<font size=5 color='#0000FF'>$V_5--Registro  Exitoso</font>";
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `estrepr`='$estado', coment_pal='$comen3'  WHERE `id_vacuno`='$id_vacuno'");
		
					}else{
						echo "<br>";	
						echo "<font size=10  color='#FF0000'>$V_5--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
					}
		}
	
	
	
	$V_6 =$_POST['V_6'];
 		if ($V_6 != ""){
										
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$V_6' and sexo = 'Hembra'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp[id_vacuno];	
						$hacienda=	$rowEmp['ubicasion'];			
						}
					}
						
		
			  		
				if(($id_vacuno==$V_6) &&($hacienda==$hda)){
     					 $insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado,resp,hda,coment_pal,jornd)
						VALUES ('{$V_6}','{$fecha_palpa}','{$estado}','{$responsable}','{$hda}','{$comen4}','{$fecha_palpa}')");
						echo "<br>";
						echo "<font size=5 color='#0000FF'>$V_6--Registro  Exitoso</font>";
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `estrepr`='$estado', coment_pal='$comen4'  WHERE `id_vacuno`='$id_vacuno'");
		
					}else{
						echo "<br>";	
						echo "<font size=10  color='#FF0000'>$V_6--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
					}
		}
	
	
	
	$V_7 =$_POST['V_7'];
 		if ($V_7 != ""){
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$V_7' and sexo = 'Hembra'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$id_vacuno=	$rowEmp[id_vacuno];	
						$hacienda=	$rowEmp['ubicasion'];			
						}
					}
						
		
			  		
				if(($id_vacuno==$V_7) &&($hacienda==$hda)){
     					 $insertar = mysql_query("INSERT INTO d89xz_detalle_palpacion(vaca,f_palpa,estado,resp,hda,coment_pal,jornd)
						VALUES ('{$V_7}','{$fecha_palpa}','{$estado}','{$responsable}','{$hda}','{$comen5}','{$fecha_palpa}')");
						echo "<br>";
						echo "<font size=5 color='#0000FF'>$V_7--Registro  Exitoso</font>";
						$sql1 =mysql_query("UPDATE `d89xz_vacunos` SET `estrepr`='$estado', coment_pal='$comen5'  WHERE `id_vacuno`='$id_vacuno'");
		
					}else{
						echo "<br>";	
						echo "<font size=10  color='#FF0000'>$V_7--Vacuno  No Existe  O  No  Pertenece a esta  Hacienda</font>";
					}
		}
	
	
	
	
	
	
		mysql_close($conexion);
}
	   
?>	   






<script> 
function abre() { 
    window.open("kardex_palpacion.php","recogedor","width=300,height=500, top=100,left=100"); 
    return false; 
} 
</script> 

 
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


