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

echo $ptov_url=$_GET['p'];
echo $prove_url=$_GET['c'];

$i = 0;

date_default_timezone_set('America/Bogota');

$c_date = date('Y-m-d');

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Cierre Inventario</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/invent_cierre2.js" type="text/javascript"></script>

</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_consecf" >
<input type="hidden" id="tf_conseca" >
<input type="hidden" id="tf_consecb" >

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
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="76%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="invent_cierre.php" class='active'>Cierre de inventario</a>
      </li>
      <li>
      <a  href="invent_cierre2.php">Cierre productos consignación</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
  </tr>
</table>
<div id="main">

&nbsp;

<form id="form1" name="form1">

<table width="95%" border="1" cellspacing="0" align="center">
	<tr>
    <td width="76%">
    <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    </tr>
    <tr class="tittle">
    <td colspan="5">Cierre de Inventario</td>
    </tr>
</table>
<table width="95%" border="1" cellspacing="0" align="center">   
    <tr>
        <td align="center" class="bold" width="20%">Punto de Venta</td>
        <td class="cont bold" width="30%"><?php
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
        <input type="text" readonly id="tf_ptov" class="long" value="<?php echo $usuario2 ?>">
        <?php
        }
        ?>
        </td>
        <td width="20%" align="center" class="bold">No</td>
        <td width="30%" class="cont bold">
        
        <label id="lb_consec" class="red">
        <?php
        mysql_select_db($database_conexion, $conexion);
        $drio1 = mysql_query("SELECT * FROM `h01sg_inventario_cierre` 
        WHERE `delete`<>1 ORDER BY `consec` DESC ", $conexion) or die(mysql_error());
        $row_drio1 = mysql_fetch_assoc($drio1);			
        $factura1= $row_drio1['consec'];
        if($factura1!=''){
        	$factura2=$factura1;
        }else{
        	$factura2=0;	
        }
        $factura=$factura2 + 1;
        echo $factura
        ?>
        </label>
        
        </td>          
    </tr>
    <tr>
        <td align="center" class="bold" >Provedor</td>
        <td class="bold cont" >
        <div id="d_prove">
        <select name="sl_prove" id="sl_prove" class="long" onChange="load2()">
        <option value="">Seleccione</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_clr = "SELECT DISTINCT `cliente`, `ced` FROM `h01sg_compra` WHERE `punto_venta`='$ptov_url' 
		AND `forma_pago`='Consignación' AND `delete`<>1 ";
        $clr = mysql_query($query_clr, $conexion) or die(mysql_error());
        while ($row_clr = mysql_fetch_assoc($clr)){
        ?>
        <option value="<?php echo ucwords(strtolower($row_clr['ced']))?>">
        <?php echo ucwords(strtolower($row_clr['cliente']))?>
        </option>
        <?php
        } 
        ?>
        </select>
        </div>
        </td>
        <td align="center" class="bold">NIT</td>
        <td class="cont bold">
        <div id="d_ced">
        <input type="text" id="tf_ced" class='long' readonly value="<?php echo $prove_url?>">
        <?php
		//echo $prove_url;
        mysql_select_db($database_conexion, $conexion);
        $clien = mysql_query("SELECT  `nombre`, `telefono` FROM `d89xz_prove` WHERE `cedula`='$prove_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
        $row_clien = mysql_fetch_assoc($clien);		
		?>
        <input type="hidden" id="tf_prove" value="<?php echo $row_clien['nombre']?>">
        <input type="hidden" id="tf_tel" value="<?php echo $row_clien['telefono']?>">
        </div>
        </td> 
    </tr>
    <tr>
        <td align="center" class="bold">Fecha</td>
        <td class="cont bold"><label id="lb_fecha"><?php echo $c_date?></label></td> 
        <td align="center" class="bold">&nbsp;</td>
        <td class="cont bold">&nbsp;</td> 
    </tr>
    
</table>

<div id="d_table">
<table width="95%" border="1" cellspacing="0" align="center" id="tb_detail">
  <tr class="stittle" id="tittle">
    <td width="13%">Referencia</td>
    <td width="17%">Descripción</td>
    <td width="10%">Inicial</td>
    <td width="10%">Traslados</td>
    <td width="10%">Vendida</td>
    <td width="10%">Devolución</td>
    <td width="10%">Disponible</td>
    <td width="10%">Física</td>
    <td width="10%">Diferencia</td>
    
  </tr>
  <?php
  	//echo '*'.$ptov_url.'*'.$prove_url;
	mysql_select_db($database_conexion, $conexion);
	$query_inv = mysql_query("SELECT DISTINCT h01sg_inventario_detalle.ref as rf FROM `h01sg_inventario_detalle` LEFT JOIN  `h01sg_compra`
	ON h01sg_compra.consec=h01sg_inventario_detalle.consec
	WHERE h01sg_compra.delete <>1 AND h01sg_inventario_detalle.delete<>1 
	AND h01sg_compra.punto_venta='$ptov_url' AND h01sg_compra.ced='$prove_url' 
	AND h01sg_inventario_detalle.mov='c'  AND h01sg_compra.forma_pago='Consignación'
	ORDER BY h01sg_inventario_detalle.ref ASC ", $conexion) or die(mysql_error());
	
	while($row_inv = mysql_fetch_assoc($query_inv)){
		$ref=$row_inv['rf'];
		
		$query_inv1 = mysql_query("SELECT * FROM `h01sg_inventario` 
		WHERE `ref`='$ref' AND `delete`<>1 AND `punto_venta`='$ptov_url' ", $conexion) or die(mysql_error());
		$row_inv1 = mysql_fetch_assoc($query_inv1);
		$ini = $row_inv1['cant_ini'];
		$inv = $row_inv1['cant_final'];
		if ($ini>0){
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
    <td align="center">
    <label id="ini<?php echo $i?>" class="ini"><?php echo $ini?></label>
    </td>
    <td align="center">
    <label id="tras<?php echo $i?>"><?php echo abs($row_inv1['cant_trasl'])?></label>
    </td>
    <td align="center">
    <label id="vent<?php echo $i?>"><?php echo $row_inv1['cant_vend']?></label>
    </td>
    <td align="center">
    <label id="devo<?php echo $i?>"><?php echo $row_inv1['cant_devo']?></label>
    </td>
    <td align="center">
    <label class="red" id="tot<?php echo $i?>"><?php echo $inv?></label>
    </td>
    <td align="center">
    <input type="text" id="fis<?php echo $i?>" class="long cant" 
    onkeyup="checkNum(this), total('<?php echo $i?>'), tot()" onChange="total('<?php echo $i?>')" required>
    </td>
    <td align="center">
    <label class="red" id="dif<?php echo $i?>"></label>
    <input type="hidden" id="tf_precio<?php echo $i?>" value="<?php echo $row_det['costo_und']?>">
    </td>
  </tr>
  <?php
		}
  $i++;
	}
  ?>
  <tr>
  <td colspan="9" class="cont" align="left">Comentarios: <br>
  <input type="hidden" id="tf_totalc" >
  <input type="hidden" id="tf_total" >
  <input type="hidden" id="tf_items" >
  <input type="hidden" id="tf_itemsc" >
  <textarea name="ta_coment" id="ta_coment" cols="" rows="2" class="long"></textarea>
  </td>
  </tr>
</table>
<table width="95%" align="center">
	<tr>
    <td align="center">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close();">
    </td>
    </tr>
</table>
</div> 
</form>

&nbsp;
</div>
</body>

</html>
<?php
}
?>