<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

<?php
//echo $acceso.'-'.$usuario2.'-'.$usuario;
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

$c_url=$_GET['c'];

$i = 0;

date_default_timezone_set('America/Bogota');

mysql_select_db($database_conexion, $conexion);
$cierre = mysql_query("SELECT * FROM `h01sg_inventario_cierre` 
WHERE `delete`<>1 AND `consec`='$c_url' ", $conexion) or die(mysql_error());
$row_cierre = mysql_fetch_assoc($cierre);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Reporte de Cierre de Inventario</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/cierre2.js" type="text/javascript"></script>

</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<div id="dialog"></div>
<div id="recargar2">
<table width="100%" border="1" cellspacing="0" align="center">
	<tr>
    <td width="76%">
    <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
    </td>
    </tr>
    <tr class="tittle">
    <td colspan="5">Cierre de Inventario</td>
    </tr>
</table>
<table width="100%" border="1" cellspacing="0" align="center">   
    <tr>
        <td width="20%" align="center" class="bold">No</td>
        <td width="30%" class="cont bold"><label id="lb_consec" class="red"><?php echo $c_url?></label></td>
        <td align="center" class="bold" width="20%">Punto de Venta</td>
        <td class="cont bold" width="30%"><label class="red"><?php echo $row_cierre['punto_venta']?></label></td> 
    </tr>
    <tr>
        <td align="center" class="bold" width="20%">Provedor</td>
        <td class="cont bold" width="30%"><label class="red"><?php echo $row_cierre['prove']?></label></td> 
        <td width="20%" align="center" class="bold">NIT</td>
        <td width="30%" class="cont bold"><label id="lb_fecha" class="red"><?php echo $row_cierre['ced']?></label></td> 
    </tr>
    <tr>
    	<td width="20%" align="center" class="bold">Fecha</td>
        <td width="30%" class="cont bold"><label id="lb_fecha" class="red"><?php echo $row_cierre['fecha']?></label></td> 
        <td align="center" class="bold" width="20%">&nbsp;</td>
        <td class="cont bold" width="30%">&nbsp;</td> 
    </tr>

</table>

<div id="d_table">
<table width="100%" border="1" cellspacing="0" align="center" id="tb_detail">
  <tr class="stittle" id="tittle">
    <td width="10%">Referencia</td>
    <td width="20%">Descripción</td>
    <td width="10%">Inicial</td>
    <td width="10%">Traslados</td>
    <td width="10%">Vendida</td>
    <td width="10%">Devolución</td>
    <td width="10%">Disponible</td>
    <td width="10%">Física</td>
    <td width="10%">Diferencia</td>
    
  </tr>
  <?php
  	//echo '*'.$ptov_url.'*';
	mysql_select_db($database_conexion, $conexion);
	$query_inv = mysql_query("SELECT * FROM `h01sg_inventario_cierre_detalle` 
	WHERE `delete`<>1 AND `consec`='$c_url' ORDER BY `ref`", $conexion) or die(mysql_error());
	
	while($row_inv = mysql_fetch_assoc($query_inv)){
		$ini = $row_inv['cant_ini'];
		$inv = $row_inv['cant_final'];
		$ref=$row_inv['ref'];
		
  ?>
  <tr class="row" id="fila_<?php echo $i?>">    
  	<td align="center"><label id="ref<?php echo $i?>"><?php echo $ref?></label></td>
    <td align="left">
	<?php
		$query_det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ", $conexion) or die(mysql_error());
		$row_det = mysql_fetch_assoc($query_det);
		echo $row_det['desc'].' - '.$row_det['marca'];
    ?>
    </td>
    <td align="center"><label id="ini<?php echo $i?>" class="ini"><?php echo $ini?></label></td>
    <td align="center"><label id="tras<?php echo $i?>"><?php echo abs($row_inv['cant_trasl'])?></label></td>
    <td align="center"><label id="vent<?php echo $i?>"><?php echo $row_inv['cant_vend']?></label></td>
    <td align="center"><label id="devo<?php echo $i?>"><?php echo $row_inv['cant_devo']?></label></td>
    <td align="center"><label class="red" id="tot<?php echo $i?>"><?php echo $inv?></label></td>
    <td align="center"><label id="fis<?php echo $i?>" class=" cant red" ><?php echo $row_inv['cant_fisica']?></label></td>
    <td align="center"><label class="red" id="dif<?php echo $i?>"><?php echo $row_inv['diferencia']?></label></td>
    
  </tr>
  <?php
		
  $i++;
	}
  ?>
  <tr>
  <td colspan="9" class="cont bold" align="left">Comentarios: 
  <label><?php echo $row_cierre['obs']?></label>
  </td>
  </tr>
</table>
<table width="98%" align="center">
	<tr>
    <td align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.close();">
    </td>
    </tr>
</table>
</div> 
</div>

</body>
</html>
<?php
}
?>