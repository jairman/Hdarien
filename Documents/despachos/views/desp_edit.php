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

$consec_url=$_GET['c'];

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_despachos` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	

$i = 1;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Edición de Despacho</title>
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
    <label class="red" id="lb_consec"><?php echo $consec_url?></label>
    </td>
    <td class="bold" width="15%">Fecha</td>
    <td width="35%" align="center" class="cont"><label id="lb_fecha"><?php echo $row_fact['fecha']?></label></td>
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
			if (ucwords(strtolower($row_clr['hacienda'])) == ucwords(strtolower($row_fact['punto_ini']))){
	?>
    			<option value="<?php echo $row_hac['hacienda']?>" selected><?php echo $row_hac['hacienda1']?></option>		
	<?php	
			}else{
    ?>
    			<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
    <?php
			}
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
			if (ucwords(strtolower($row_clr['hacienda'])) == ucwords(strtolower($row_fact['punto_venta']))){
    ?>
    			<option value="<?php echo $row_hac['hacienda']?>" selected><?php echo $row_hac['hacienda1']?></option>
    <?php
			}else{
	?>
    			<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
    <?php
			}
    	} 
    ?>
    	</select>
    </td>
    <td class="bold" >Observaciones</td>
    <td class="cont">
    <input name="tf_obs" type="text" id="tf_obs" style="width:85%" value="<?php echo $row_fact['obs']?>">&nbsp;
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
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `consec`='$consec_url' 
  AND `mov`='d' AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
  	<td class="cont"><input type="text" id="tf_ref<?php echo $i?>" style="width:80%" class="ref" readonly 
    value="<?php echo $ref = $row_prod['ref']?>"></td>
    <td align="center">
    <?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det);
	?>
    <label id="lb_desc<?php echo $i?>"><?php echo $row_det['desc']?></label></td>
    <td align="center"><label id="lb_talla<?php echo $i?>"><?php echo $row_det['talla']?></label></td>
    <td align="center"><label id="lb_marca<?php echo $i?>"><?php echo $row_det['marca']?></label></td>
    <td align="center"><label id="lb_costo<?php echo $i?>" class="costo"><?php echo $row_prod['costo']?></label></td>
    <td class="cont" align="center">
    <input type="text" id="tf_cant<?php echo $i?>" class="long cant" required 
    onkeyup="checkNum(this)" onChange="totcant();totcosto()" value="<?php echo $row_prod['cant']?>">
    <?php
	$p = $row_fact['punto_ini'];
    mysql_select_db($database_conexion, $conexion);
    $det2 = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$p'
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det2 = mysql_fetch_assoc($det2);
	?>
    <input type="hidden" id="tf_cantmax<?php echo $i?>" value="<?php echo $row_det2['cant_final']?>">
    <input type="hidden" id="tf_canto<?php echo $i?>" value="<?php echo $row_prod['cant']?>">
    </td>
    <td align="center">
    <img src="../../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" onClick="quitarm('<?php echo $i?>')">
    </td>
  </tr>
  <?php
  	$i++; 
  }
  $j = $i;
  ?>
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