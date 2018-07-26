<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}else{
	
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

date_default_timezone_set('America/Bogota');
$c_date = date('Y-m-d');

mysql_select_db($database_conexion, $conexion);
$drio1 = mysql_query("SELECT * FROM `h01sg_despachos` 
WHERE `delete`<>1 ORDER BY `consec` DESC" , $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);			
$factura1= $row_drio1['consec'];
if($factura1!=''){
	$factura2=$factura1;
	
}else{
	$factura2=0;	
}
$factura=$factura2 + 1;

$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Formulario de Despacho</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/desp_form.js" type="text/javascript"></script>
</head>

<body>
<div id="dialog2">
    <div class="demo-wrapper html5-progress-bar" align="center">
        <div class="progress-bar-wrapper">
            <progress id="progressbar" value="0" max="100" style="width:98%"></progress>
            <span class="progress-value" id="progreso">0%</span>
        </div>
    </div>
	<input type="button" id="aceptar" style="width:150px; display:none" value="Aceptar" class="ext" />
</div>
<div id="dialog"></div>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_i" value="<?php echo $i?>">
<input type="hidden" id="tf_consecf" >
<input type="hidden" id="tf_exist" >

<form id="form1" name="form1">
<table width="98%" align="center" id="table_header">
    <tr>
      <td align="left" >
      <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
    </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr class="tittle">
    <td colspan="4">Despachos</td>
  </tr>
  <tr>
    <td class="bold" width="15%">Consecutivo</td>
    <td width="35%" align="center" class="cont">
    <label class="red" id="lb_consec"><?php echo $factura?></label>
    </td>
    <td class="bold" width="15%">Fecha</td>
    <td width="35%" align="center" class="cont"><label id="lb_fecha"><?php echo $c_date?></label></td>
  </tr>
  <tr>
    <td class="bold">Tipo Movimiento</td>
    <td class="cont">
    <label id="sl_tipo">Despacho</label>
    </td>
    <td class="bold" width="15%">Origen</td>
    <td class="cont" width="35%">
	<?php
    if ($usuario2 == 'general'){
    ?>
        <select name="sl_ptov" id="sl_ptov" class="long">
	    <option value="">Seleccione</option>
    <?php
		mysql_select_db($database_conexion, $conexion);
		$query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
		`d89xz_hacienda` WHERE `delete`=0 order by hacienda";
		$hac = mysql_query($query_hac, $conexion) or die(mysql_error());
		while ($row_hac = mysql_fetch_assoc($hac)){
    ?>
    	<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
    <?php
    } 
    ?>
    	</select>
    <?php 
    }else{
    ?>
    	<input type="text" readonly id="tf_ptov" class="long" value="Bodega">
    <?php
    }
    ?>
    </td>
  </tr>
  <tr>
  	<td class="bold">Destino</td>
    <td class="cont">
        <select name="sl_ptovd" id="sl_ptovd" class="long">
	    <option value="">Seleccione</option>
    <?php
		mysql_select_db($database_conexion, $conexion);
		$query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
		`d89xz_hacienda` WHERE `delete`=0 order by hacienda";
		$hac = mysql_query($query_hac, $conexion) or die(mysql_error());
		while ($row_hac = mysql_fetch_assoc($hac)){
    ?>
    	<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
    <?php
    } 
    ?>
    	</select>
    </td>
    <td class="bold" >Observaciones</td>
    <td class="cont">
    <input name="tf_obs" type="text" id="tf_obs" style="width:85%" >&nbsp;
    <img src="../../img/add.png" alt="" width="25" height="25" border="0" align="right" 
    title="Agregrar Detalle" style="cursor:pointer" id="bt_add" />
    </td>
  </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0" id="tb_detail">
  <tr class="stittle" id="tittle">
    <!--<td width="15%">Cod. Barras</td>-->
    <td width="20%">Referencia</td>
    <td width="15%">Descripcion</td>
    <td width="12%">talla</td>
    <td width="12%">Marca</td>
    <td width="12%">Costo</td>
    <td width="20%">Cantidad</td>
    <td width="9%">&nbsp;</td>
  </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
	<tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"></label></td>
    <td width="20%" class="bold">Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"></label></td>
  </tr>
    <td align="center" colspan="4">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close()">
    </td>
</table>

</form>

</body>
<script>

</script>
</html>
<?php
}
?>