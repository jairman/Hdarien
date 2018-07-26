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

@$tipo =$_GET['tipo'];
@$nombre =$_GET['nombre'];
@$descrip = $_GET['descrip'];
@$coment = $_GET['comen'];
@$cont = $_GET['contenido'];
@$mark = $_GET['marca'];


@$id=$_GET['id'];
mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_tm = "SELECT * FROM d89xz_tipo_medininas";
$tm = mysql_query($query_tm, $conexion) or die(mysql_error());
$row_tm = mysql_fetch_assoc($tm);
$totalRows_tm = mysql_num_rows($tm);

mysql_select_db($database_conexion, $conexion);
$query_an = "SELECT * FROM d89xz_anos";
$an = mysql_query($query_an, $conexion) or die(mysql_error());
$row_an = mysql_fetch_assoc($an);
$totalRows_an = mysql_num_rows($an);
?>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<style type="text/css">
.x {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="ingreso_mas_medicinas_kardexINS.php?id=<?php echo $id ?>">Entrada / Salida</a>  </li>
  <li><a href="kardex_ingre_mas_mediciINS.php?id=<?php echo $id ?>">Historial</a></li>
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left"><a rel="shadowbox[ejemplos];options={continuous:true}" href="editar_ingre_medicinasINS.php?id=<?php echo $id ?>&amp;tipo=<?php echo $tipo?>&amp;nombre=<?php echo $nombre?>&amp;decrip=<?php echo $descrip?>&amp;coment=<?php echo $coment?>&amp;contenido=<?php echo $cont?>&amp;marca=<?php echo $mark?>"><img src="modificar.png" alt="" width="68" height="20" /></a></td>
    <td width="121" align="left"><a onclick="return confirm('Realmente Desea Eliminar INSUMO');" href="eliminar_medicinasINS.php?id=<?php echo $id ?>&amp;tipo=<?php echo $tipo?>&amp;nombre=<?php echo $nombre?>&amp;decrip=<?php echo $descrip?>&amp;coment=<?php echo $coment?>&amp;contenido=<?php echo $cont?>&amp;marca=<?php echo $mark?>"><img src="eliminar.png" alt="" width="68" height="20" /></a></td>
    <td width="308" align="center"><a href="kardex_medicinaINS.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<form name="form1" method="post" action="">
<table width="710" border="1" align="center" cellspacing="0">
  <tr>
    <th colspan="9" bgcolor="#4D68A2" style="color: #FFF"><?  echo "$tipo / $nombre/ $descrip";?></th>
  </tr>
  <tr>
    <th colspan="9" bgcolor="#4D68A2"><p class="x">Ingreso de  Insumos</p></th>
    </tr>
  <tr>
    <td width="58"><p>Cantidad</p></td>
    <td width="75"><span id="sprytextfield3">
      <label for="text_cantidad2"></label>
      <input name="text_cantidad" type="text" id="text_cantidad" size="12" />
      </span></td>
    <td width="84">Concepto</td>
    <td width="115"><span id="spryselect2">
      <label for="select_entrada2"></label>
      <select name="select_entrada" id="select_entrada2">
        <option selected="selected">Seleccione</option>
        <option value="Entrada">Entrada</option>
        <option value="Salida">Salida</option>
        </select>
      </span></td>
    <td width="51">Fecha</td>
    <td colspan="3">D<span id="spryselect4">
      <label for="select_dia2"></label>
      <select name="select_dia" id="select_dia2">
        <option value="">D</option>
        <?php
do {  
?>
        <option value="<?php echo $row_dia['dias']?>"><?php echo $row_dia['dias']?></option>
        <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
        </select>
      </span>M<span id="spryselect5">
        <label for="select_mes2"></label>
        <select name="select_mes" id="select_mes2">
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
        </span>A<span id="spryselect7">
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
        </span></td>
    <th width="51" rowspan="2"><input type="submit" name="button" id="button" value="Enviar" /></th>
  </tr>
  <tr>
    <td colspan="2">Comentario</td>
    <th colspan="6"><label for="comen"></label>
      <input name="comen" type="text" id="comen" size="50" /></th>
    </tr>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp; </p>


<?
@$id=$_GET['id'];
@$select_tipo =$_GET['tipo'];
@$select_nombre =$_GET['nombre'];
@$text_cantidad =$_POST['text_cantidad'];
@$select_descrip =$_GET['marca'];
@$select_contenido =$_GET['contenido'];

@$entrada = $_POST['select_entrada'];

$comentario=$_POST['comen'];


@$diab=trim(strip_tags($_POST['select_dia']));
@$mesb=trim(strip_tags($_POST['select_mes']));
@$anob=trim(strip_tags($_POST['text_anos']));
@$text_f_jornada=$anob.'-'.$mesb.'-'.$diab;



?>


<?


 
  	if ($entrada == Entrada ){
	@$dosis= $text_cantidad * $select_contenido;
	
	
		
		$insertar = mysql_query("INSERT INTO d89xz_total_medicinas_salidasins (tipo,nombre,cont,mark,cantid,fecha,concep,idm,comen)
		VALUES ('{$select_tipo}','{$select_nombre}','{$select_contenido}','{$select_descrip}','{$text_cantidad}','{$text_f_jornada}','{$entrada}','{$id}','{$comentario}')", $conexion);
				
		
$insertar1 = mysql_query("UPDATE  `d89xz_total_medicinasins` SET `cantid`=cantid + $text_cantidad, `dosis`= dosis + $dosis WHERE `id` = '$id'", $conexion);
		

echo "<script type=''>
		window.location='kardex_medicinaINS.php';
	</script>";

		}
	
 
?>

<?

 
  	if ($entrada == Salida ){
	
$dosis= $text_cantidad * $select_contenido;
echo $dosis;
		
				
		$insertar1 = mysql_query("INSERT INTO d89xz_total_medicinas_salidasins (tipo,nombre,cont,mark,cantid,fecha,concep,idm,comen)
		VALUES ('{$select_tipo}','{$select_nombre}','{$select_contenido}','{$select_descrip}','{$text_cantidad}','{$text_f_jornada}','{$entrada}','{$id}','{$comentario}')", $conexion);
		
$insertar = mysql_query("UPDATE  `d89xz_total_medicinasins` SET `cantid`=`cantid`- $text_cantidad, `dosis`= dosis - '$dosis' WHERE `id` = '$id'", $conexion);
		


$select_descrip =$_POST['select_descrip'];

		


echo "<script type=''>
		window.location='kardex_medicinaINS.php';
	</script>";

		}
	
 
?>


<?php
mysql_close($conexion);

mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($tm);

mysql_free_result($an);
?>



<script type="text/javascript">
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {validateOn:["blur"]});
var sprytejamaneld3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
