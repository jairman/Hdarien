<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
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

//header("Content-Type: text/html;charset=UTF-8");
date_default_timezone_set('America/Bogota');

$consec_url=$_GET['c'];

$c_date = date('Y-m-d');

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);			

$i = 0;

$config = mysql_query("SELECT * FROM `h01sg_compras_config` WHERE `delete`<>1") 
or die(mysql_error());
$row_conf = @mysql_fetch_assoc($config);

$conf = array();
$string = '';
$conf[0]=$row_conf['cod_barra'];
$conf[1]=$row_conf['rfid'];
$conf[2]=$row_conf['marca'];
$conf[3]=$row_conf['talla'];
$conf[4]=$row_conf['color'];
$conf[5]=$row_conf['categoria'];
$conf[6]=$row_conf['sub_cat'];
$conf[7]=$row_conf['precio_mayo'];
$string = $row_conf['cod_barra'].','.$row_conf['rfid'].','.$row_conf['marca'].','.$row_conf['talla'].','.$row_conf['color'].','.$row_conf['categoria'].','.$row_conf['sub_cat'].','.$row_conf['precio_mayo'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Editar Compra</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="js/compras_edit.js" type="text/javascript"></script>
<style>
.picture{
	width:80px;
	height:80px;
}
.img{
	padding-top:2px;
}
</style>
</head>

<body>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_exist" >
<input type="hidden" id="tf_config" value="<?php echo $string ?>" >

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

<table width="98%" align="center" id="table_header">
    <tr>
      <td width="70%" rowspan="3" align="left">
      <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td width="20%" align="center">&nbsp;</td>
      <td width="10%" rowspan="3" align="right">
        <input type="image" src="../img/reprog.png" alt="" width="48" height="48" border="0" 
        align="right" title="Reprogramar Productos" style="cursor:pointer" id="bt_repprod" 
        onClick="searchp()"/ >
      </td>
    </tr>
    <tr>
      <td align="center">
      <label style="font-weight:bold; font-size:16px">Orden No</label>
      <label class="red" id="tf_consec" style="font-weight:bold; font-size:16px"><? echo $row_fact['consec']?></label>
      </td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="tittle">Registro de Compra</td>
    </tr>
   </table>
<form id="form1" name="form1">
<table width="98%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">Punto de venta</td>
      <td align="center" class="cont" width="30%">
        <input type="text" readonly id="tf_ptov" class="long" value="<? echo $row_fact['punto_venta']?>">
      </td>
      <td class="bold" width="20%">Fecha</td>
      <td width="30%" align="center" class="cont"><input name="tf_fecha" type="text" 
      class="long" id="tf_fecha" value="<? echo $row_fact['f_fact']?>" readonly> </td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
        <!--<input type="text" name="tf_prove" id="tf_prove" style="width:35%" onkeyup="des1()"
        value="< echo ucwords(strtolower($row_fact['cliente']))?>" >--> 
        <select name="sl_prove" id="sl_prove" style="width:80%" >
        <option value="">Seleccione</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_clr = "SELECT DISTINCT `nombre` FROM `d89xz_prove` WHERE `delete`<>1 ORDER BY `nombre` ASC ";
        $clr = mysql_query($query_clr, $conexion) or die(mysql_error());
        //$row_clr = mysql_fetch_assoc($clr);
        while ($row_clr = mysql_fetch_assoc($clr)){
        	if (ucwords(strtolower($row_clr['nombre'])) == ucwords(strtolower($row_fact['cliente']))){
        ?>
        <option value="<?php echo ucwords(strtolower($row_clr['nombre']))?>" selected>
        <?php echo ucwords(strtolower($row_clr['nombre']))?>
        </option>
        <?php
        	}else{
        ?>
        <option value="<?php echo ucwords(strtolower($row_clr['nombre']))?>">
        <?php echo ucwords(strtolower($row_clr['nombre']))?>
        </option>
        <?php
        	}
        } 
        ?>
        </select>
        &nbsp;
        <img src="../img/addpersonas.png" width="25" height="25" title="Registrar Proveedor" style="cursor:pointer"  
      onclick="creatProve()" />
        
      </td>
      <td class="bold" > NIT</td>
      <td align="center" class="cont"><input name="tf_ced" type="text" 
      class="long" id="tf_ced" value="<? echo $row_fact['ced']?>" readonly> </td>
    </tr>
    <tr>
      <td class="bold" >Telefono</td>
      <td align="center" class="cont"><input name="tf_tel" type="text" 
      class="long" id="tf_tel" value="<? echo $row_fact['tel']?>" readonly></td>
      <td class="bold" >Forma de Pago</td>
      <td align="center" class="cont">
      	<select name="sl_fpago" id="sl_fpago" class="long" align="center">
        <?php
        $default = $row_fact['forma_pago'];
        $options = array(''=>"Seleccione",  
			'Efectivo'=>"Efectivo", 
			'Consignacion'=>"Consignación",
			'Credito'=>"Credito");  
        foreach($options as $key=>$val) {
        	echo ($key == $default) ? "<option selected=\"selected\" value=\"$key\">$val</option>":"<option value=\"$key\">$val</option>";
        }
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="bold" width="20%">Fecha Pago</td>
      <td align="center" class="cont"><input name="tf_fechap" type="text" 
      class="long" id="tf_fechap" value="<? echo $row_fact['f_pago']?>"></td>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont">
      <input name="tf_obs" type="text" style="width:80%" id="tf_obs" value="<? echo $row_fact['obs']?>">
      <img src="../img/add.png" alt="" width="25" height="25" border="0" align="right" 
      title="Agregrar Registro Sin Imagen" style="cursor:pointer" id="bt_add" />
      </td>
    </tr>
  </table>
  
  <table width="98%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="stittle" id="tittle">
    <td align="center" >Referencia</td>
	<?php 
	if($conf[0]==1){
	?>
    <td align="center" >Cod. Barras</td>
    <?php
	}
	if($conf[1]==1){
	?>
    <td align="center" >RFID</td>
    <?php
	}
	?>
    <td align="center" >Descripción</td>
    <?php
    if($conf[3]==1){
	?>
    <td align="center" >talla</td>
    <?php
	}
	if($conf[2]==1){
	?>
    <td align="center" >Marca</td>
    <?php
	}
	if($conf[4]==1){
	?>
    <td align="center" >Color</td>
    <?php
	}
	if($conf[5]==1){
	?>
    <td align="center" >Categoria</td>
    <?php
	}
	if($conf[6]==1){
	?>
    <td align="center" >Sub-categoria</td>
    <?php
	}
	?>
    <td align="center" >Cantidad</td>
    <td align="center" >Costo</td>
    <?php
    if($conf[7]==1){
	?>
    <td align="center" >P. por Mayor</td>
    <?php
	}
	?>
    <td align="center" >Precio Detal</td>
    <td align="center" >&nbsp;</td>
  
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `consec`='$consec_url' 
  AND `mov`='c' AND `delete`<>1 ORDER BY `ref`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr id="fila_<?php echo $i?>" class="row"> 
    <?
    $ref = $row_prod['ref'];
	mysql_select_db($database_conexion, $conexion);
	$det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_det = mysql_fetch_assoc($det);		
	?>
    <td class="cont" align="center">
    <input type="text" id="tf_ref<?php echo $i?>" class="ref long" required onChange="checkref(<?php echo $i?>)" 
    value="<?php echo $ref ?>" readonly>
    </td> 
    <td class="cont" id="td_codb<?php echo $i?>">
    <input type="text" id="tf_codb<?php echo $i?>" class="long" value="<?php echo $row_det['cod_barra'] ?>">
    </td>
    <td class="cont" id="td_rfid<?php echo $i?>">
    <input type="text" id="tf_rfid<?php echo $i?>" class="long" value="<?php echo $row_det['rfid'] ?>">
    </td>
    <td class="cont">
    <input type="text" id="tf_desc<?php echo $i?>" class="long" value="<?php echo $row_det['desc'] ?>">
    </td>
    <td class="cont" id="td_talla<?php echo $i?>">
    <input type="text" id="tf_talla<?php echo $i?>" class="long" value="<?php echo $row_det['talla'] ?>">
    </td>
    <td class="cont" id="td_marca<?php echo $i?>">
    <input type="text" id="tf_marca<?php echo $i?>" class="long" value="<?php echo $row_det['marca'] ?>">
    </td>
    <td class="cont" id="td_color<?php echo $i?>">
    <input type="text" id="tf_color<?php echo $i?>" class="long" value="<?php echo $row_det['color'] ?>">
    </td>
    <td class="cont" id="td_cat<?php echo $i?>">
    <input type="text" id="tf_cat<?php echo $i?>" class="long" value="<?php echo $row_det['categoria'] ?>">
    </td>
    <td class="cont" id="td_scat<?php echo $i?>">
    <input type="text" id="tf_scat<?php echo $i?>" class="long" value="<?php echo $row_det['sub_cat'] ?>">
    </td>
    <td class="cont">
    <input type="text" id="tf_cant<?php echo $i?>" class="long cant" required onkeyup="checkNum(this)" 
    onChange="totcant();totcosto()" value="<?php echo $row_prod['cant'] ?>">
    <input type="hidden" id="tf_cantc<?php echo $i?>" value="<?php echo $row_prod['cant'] ?>" >
    </td>
    <td class="cont">
    <input type="text" id="tf_costo<?php echo $i?>" class="long costo" required onkeyup="checkNum(this)" 
    onChange="totcant();totcosto()" value="<?php echo $row_det['costo_und'] ?>" >
    </td>
    <td class="cont" id="td_preciom<?php echo $i?>">
    <input type="text" id="tf_preciom<?php echo $i?>" class="long" onkeyup="checkNum(this)"
    value="<?php echo $row_det['precio_mayo'] ?>">
    </td>
    <td class="cont">
    <input type="text" id="tf_precio<?php echo $i?>" class="long" required onkeyup="checkNum(this)"
    value="<?php echo $row_det['precio_und'] ?>" >
    </td>
    <td align="center">
    <img src="../img/erase.png" id="img<?php echo $i?>" width="20" height="20" style="cursor:pointer;" 
    title="Eliminar" onClick="quitarsaved(<?php echo $i?>)">
    </td>
  </tr>
  <?php
  $i++;
  }
  ?>  
</table>
<input type="hidden" id="tf_i" value="<?php echo $i ?>">
<input type="hidden" id="tf_j" value="<?php echo $j ?>">
<table width="98%" border="1" cellspacing="0" align="center">
  <tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"><? echo number_format($row_fact['cant'],2)?></label></td>
    <td width="20%" class="bold"> Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"><? echo number_format($row_fact['costo'],2)?></label></td>
  </tr>
  <tr>
    <td align="center" colspan="4">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close();">
    </td>
  </tr>
</table>
</form>
    
</body>

</html>
<?php
}
?>