 <?
 //session_start();
 
/*$ruta_a_joomla = "/../../agrotin/";

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
	

	//seguridad
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder a esta página sin estar logueado.");
$userx = JFactory::getUser();*/


?>
<?php require_once('Connections/conexion.php'); ?>
<?
@$b = stripslashes(trim($_GET["busqueda"]));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#apDiv5 {position:absolute;
	width:206px;
	height:65px;
	z-index:2;
	left: 1px;
	top: -20px;
}
#apDiv1 {
	position:absolute;
	width:114px;
	height:29px;
	z-index:3;
	top: 57px;
}
</style>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" /><?php
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
$query_solicitud = "SELECT DISTINCT solicitud FROM d89xz_bascula where  placa<>''";
$solicitud = mysql_query($query_solicitud, $conexion) or die(mysql_error());
$row_solicitud = mysql_fetch_assoc($solicitud);
$totalRows_solicitud = mysql_num_rows($solicitud);

$query_solicitud2 = "SELECT DISTINCT cons_fac FROM d89xz_bascula ";
$solicitud2 = mysql_query($query_solicitud2, $conexion) or die(mysql_error());
$row_solicitud2 = mysql_fetch_assoc($solicitud2);
$totalRows_solicitud2 = mysql_num_rows($solicitud2);



//$nom_hacienda_m = strtoupper($nom_hacienda);
mysql_select_db($database_conexion, $conexion);


?>
<script type="text/javascript">
</script>
<style type="text/css">
#apDiv2 {
	position:absolute;
	width:536px;
	height:67px;
	z-index:1;
	left: 683px;
	top: 21px;
}
</style>
</head>

<body>
<?

?>


<?
if ($b){
	?>
<?
}
else { ?> 


<h3> 



  <p>  
  <p>  </h3>
<table width="100%" border="1" cellspacing="0">
  <tr>
    <td colspan="2"><img src="idsolutions--este.png" width="177" height="61" /></td>
  </tr>
  <tr>
    <th>Buscar Báscula</th>
    <th><select name="select1" id="selecc" style="width:300px">
      <option value="value">Seleccionar Bascula</option>
      <?php
do {  
?>
      <option value="<?php echo $row_solicitud['solicitud']?>"><?php echo $row_solicitud['solicitud']?></option>
      <?php
} while ($row_solicitud = mysql_fetch_assoc($solicitud));
  $rows = mysql_num_rows($solicitud);
  if($rows > 0) {
      mysql_data_seek($solicitud, 0);
	  $row_solicitud = mysql_fetch_assoc($solicitud);
  }
}
?>
    </select>
   
    <? if ($b){
		$query_solicitud2 = "SELECT DISTINCT cons_fac FROM d89xz_bascula ";
$solicitud2 = mysql_query($query_solicitud2, $conexion) or die(mysql_error());
$row_solicitud2 = mysql_fetch_assoc($solicitud2);
$totalRows_solicitud2 = mysql_num_rows($solicitud2);
		@$fac=$row_solicitud['cons_fac']
		?> <input type="submit" name="Generar" id="generar" value="<? if ($fac==''){ ?>Generar Factura<? }else{ ?>Ver Factura Generada<? } ?>" align="right"/> <? } ?>
        
    <? if ($b){
		?> <a href="javascript:imprSelec('recargar2a')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a> <? } ?>
  </tr>
</table>
</p>

<div id="recargar2">
	<? 
	if($b){
		$queEmp ="SELECT * FROM d89xz_bascula WHERE solicitud='$b'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		$rowEmp = mysql_fetch_assoc($resEmp);
		
	?>
<div id="recargar2a">    
<table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr align="center" valign="top" >
        <td colspan="13" bgcolor="#4D68A2" style="color:#FFF; font-size:16" id="control"><strong> </strong></td>
  </tr>
      <tr align="center">
        <td colspan="13" bgcolor="#4D68A2"  style="font-size:13; color:#FFF">CONTROL DE BASCULA</td>
      </tr>
      <tr align="center">
        <td colspan="6" align="center" style="font-size:13"><strong>
        <?
		echo $rowEmp['accion'];
		?>
</strong>
       </td>
        
        
      </tr>
      <tr align="center">
        <td style="font-size:13" align="left"><strong>Cliente:</strong></td>
        <td colspan="5" style="font-size:13" align="left"><?
		echo $rowEmp['cliente'];
		?></td>
      </tr>
      <tr>
        <td width="18%" style="font-size:13"><strong>Cédula:</strong></td>
        <td colspan="3" style="font-size:13"><?
		echo $rowEmp['cedula_cliente'];
		?></td>
        <td width="4%" style="font-size:13"><strong>No</strong></td>
        <th width="13%" style="color:#F00;font-size:13 "><? echo $b; ?></th>
       
        
        
      </tr>
      <tr>
        <td style="font-size:13"><strong>Telefono:</strong></td>
        <td colspan="2" style="font-size:13"><?
		echo $rowEmp['tel_cliente'];
		?></td>
        <td colspan="2" style="font-size:13">DD/MM/AAAA</td>
        <td width="13%" style="font-size:13"><strong>Hora</strong> HH:MM</td>
      </tr>
      <tr>
        <td style="font-size:13"><strong>Forma de pago:</strong></td>
        <td width="22%" style="font-size:13"><?
		echo $rowEmp['forma_pago'];
		?></td>
        <td width="14%" colspan="-3" style="font-size:13"><strong>Fecha Pesaje:</strong></td>
        <td colspan="2" style="font-size:13"><?
		echo $rowEmp['fecha_pesaje'];
		?></td>
        <td style="font-size:13"><?
		echo $rowEmp['hora_pesaje'];
		?></td>
      </tr>
      <tr>
        <td style="font-size:13"><strong>Fecha de pago:</strong></td>
        <td style="font-size:13"><?
		echo $rowEmp['fecha_pago'];
		?></td>
        <td colspan="-3" style="font-size:13"><strong>Fecha Salida:</strong></td>
        <td colspan="2" style="font-size:13"><?
		echo $rowEmp['fecha_salida'];
		?></td>
        <td style="font-size:13"><?
		echo $rowEmp['hora_salida'];
		?></td>
      </tr>
      <tr>
        <td style="font-size:13"><strong>Ganado puesto en:</strong></td>
        <td style="font-size:13"><?
		echo $rowEmp['puesto_en'];
		?></td>
        <td style="font-size:13"><strong>Potrero:</strong></td>
        <td colspan="3" style="font-size:13"><?
		echo $rowEmp['potrero'];
		?></td>
      </tr>
  </table>
<table width="50%"   border="1" align="left" cellspacing="0">
      <tr align="center" bgcolor="#4D68A2">
        <td width="100px" style="color:#FFF; font-size:13" >Animal</td>
        <td width="50px" style="color:#FFF; font-size:13">Hierro</td>
        <td width="50px" style="color:#FFF; font-size:13" >Clasificación</td>
        <td width="50px" style="color:#FFF; font-size:13" >Peso</td>
    </tr>
    <?
	mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT animal_no, `animal_peso`, `animal_hierro`, `animal_clas` FROM  d89xz_bascula where solicitud ='$b' LIMIT 20" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$totalRows_histo = mysql_num_rows($histo);
while ($row_histo = mysql_fetch_assoc($histo)) {


	?>
      <tr align="center">
        <td width="100px" style="font-size:13"><? echo $row_histo['animal_no'] ?></td>
        <td width="50px" style="font-size:13"><? echo $row_histo['animal_hierro'] ?></td>
        <td style="font-size:13; width:110px"><? echo $row_histo['animal_clas'] ?></td>
        <td style="font-size:13"><? echo $row_histo['animal_peso'] ?></td>
      </tr>
      <?
	  
} 
	  ?>
  </table>
<table width="50%"  border="1" align="left" cellspacing="0">
      <tr align="center" bgcolor="#4D68A2">
        <td width="100px" style="color:#FFF; font-size:13" >Animal</td>
        <td width="50px" style="color:#FFF; font-size:13" >Hierro</td>
        <td width="50px" style="color:#FFF ; font-size:13" >Clasificación</td>
        <td width="50px" style="color:#FFF; font-size:13" >Peso</td>
    </tr>
    <?
	mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT animal_no, `animal_peso`, `animal_hierro`, `animal_clas` FROM  d89xz_bascula where solicitud ='$b' LIMIT 20,20" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$totalRows_histo = mysql_num_rows($histo);
while ($row_histo = mysql_fetch_assoc($histo)) {


	?>
      <tr align="center">
        <td width="100px" style="font-size:13"><? echo $row_histo['animal_no'] ?></td>
        <td width="50px" style="font-size:13"><? echo $row_histo['animal_hierro'] ?></td>
        <td width="50px" style="font-size:13; width:110px"><? echo $row_histo['animal_clas'] ?></td>
        <td width="50px" style="font-size:13"><? echo $row_histo['animal_peso'] ?></td>
      </tr>
      <?
	  
} 
	  ?>
  </table>


  <p>&nbsp;</p>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" >
 
    <tr>
      <td colspan="5" align="left" style="font-size:13"><strong> TOTAL DE ANIMALES PESADOS Y CLASIFICACION</strong></td>
      <th colspan="2" align="center" style="font-size:13"><?
		echo $rowEmp['total_ani'];
		?></th>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="left" style="font-size:13"><strong>PESO TOTAL</strong></td>
       
      <th colspan="2" align="center" style="font-size:13"><?
		echo $rowEmp['total_peso'];
		?></th>
      <td colspan="4" align="left" style="font-size:13"><strong>PESO PROMEDIO</strong></td>
      <th colspan="2" align="center" style="font-size:13"><?
		echo $rowEmp['prom_peso'];
		?></th>
      
      
    </tr>
    <tr>
      <td align="left" style="font-size:13"><strong>PRECIO POR KG</strong></td>
      <th colspan="2" align="center" style="font-size:13"><?
		echo $rowEmp['precio_x_k'];
		?></th>
      <td colspan="4" align="left" style="font-size:13"><strong>VALOR TOTAL</strong></td>
      <th colspan="2" align="center" style="font-size:13"><?
		echo $rowEmp['valor_total'];
		?></th>
    </tr>
    <tr>
      <td align="left" style="font-size:13"><strong>RESPONSABLE PESAJE</strong></td>
      <th colspan="2" align="left" style="font-size:13"><?
		echo $rowEmp['respon_pesaje'];
		?> </th>
      <td colspan="4" align="left" style="font-size:13"><strong>RECIBI A SATISFACCION</strong></td>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" style="font-size:13"><strong>CONDUCTOR</strong></td>
      <th colspan="2" align="left" style="font-size:13"><?
		echo $rowEmp['conductor'];
		?></th>
      <td width="10%" align="left" style="font-size:13"><strong>C.C.</strong></td>
      <td colspan="3" align="left" style="font-size:13"><?
		echo $rowEmp['cedula_cond'];
		?></td>
      <td width="21%" align="left" style="font-size:13"><strong>PLACA CAMION</strong></td>
      <td width="14%" align="center" style="font-size:13"><?
		echo $rowEmp['placa'];
		?></td>
    </tr>
  </table>

  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td height="154" align="left" valign="top"><strong>Observaciones:</strong></td>
    </tr>
  </table>
  <p>
    <?
	}
  ?>
</p>
</div>
</div>
</body>
</html>

<script type="text/javascript">

$('#selecc').change(function(){
	var hacienda = getUrlVars()["hacienda"];
	$('#recargar2').html("Cargando...");
	$('#recargar2').load('stin_buscar_bascula.php?busqueda='+$('#selecc').val().replace(/ /g,"+") + '&hacienda=' + hacienda );
	});
	
$('#generar').click(function(){
	var hacienda = getUrlVars()["hacienda"];
	var generar = $('#generar').val();
	var sol = $('#selecc').val();
	if (generar==="Generar Factura"){
		location.href= 'stin_bascula_gen_fac.php?hacienda=' + hacienda + '&sol=' + sol;
	};
	if (generar=="Ver Factura Generada"){
		location.href= 'stin_buscar_fac_bas.php?hacienda=' + hacienda + '&sol=' + sol;
	}
	});	
	
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
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
</body>
</html>
<?php
mysql_free_result($solicitud);

?>
