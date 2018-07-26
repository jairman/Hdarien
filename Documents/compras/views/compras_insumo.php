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

/*SELECT MAX(consec) FROM `h01sg_inventario_detalle` 
WHERE `delete`<>1 AND `mov`='c'*/
mysql_select_db($database_conexion, $conexion);
$drio1 = mysql_query("SELECT * FROM `h01sg_compra` 
WHERE `delete`<>1 ORDER BY `consec` DESC ", $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);			
$factura1= $row_drio1['consec'];
if($factura1!=''){
	$factura2=$factura1;
}else{
	$factura2=0;	
}
$factura=$factura2 + 1;

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
$conf[8]=$row_conf['ins_color'];
$conf[9]=$row_conf['ins_marca'];
$string = $row_conf['cod_barra'].','.$row_conf['rfid'].','.$row_conf['marca'].','.$row_conf['talla'].','.$row_conf['color'].','.$row_conf['categoria'].','.$row_conf['sub_cat'].','.$row_conf['precio_mayo'].','.$row_conf['ins_color'].','.$row_conf['ins_marca'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registrar Factura</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/compras_insumos.js" type="text/javascript"></script>
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
<input type="hidden" id="tf_i" value="<?php echo $i ?>">
<input type="hidden" id="tf_consecf" >
<input type="hidden" id="tf_config" value="<?php echo $string ?>" >
<input type="hidden" id="tf_exist" >

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

<table width="95%" align="center">
	<tr>
    <td width="68%">
    <div id="menu">
      <ul>
      <li>
      <a href="../views/invent_prod.php" >Productos</a>
      </li>
      <li>
      <a  href="../views/compras_insumo.php" class='active'>Insumos</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    </tr>
</table>

<div id="main">
&nbsp;

<table width="98%" align="center" id="table_header">
    <tr>
      <td width="60%" rowspan="3" align="left">
      <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td align="left" width="20%">&nbsp;</td>
      <td align="right" rowspan="3" width="10%">
      <input type="image" src="../../img/Excell_Up.png" alt="" width="48" height="48" border="0" 
        align="right" style="cursor:pointer" id="bt_excel" 
       title="Agregar Excel"  onclick="agregar_excel()"> 
      </td>
      <td width="10%" rowspan="3" align="right">
      <input type="image" src="../../img/reprog.png" alt="" width="48" height="48" border="0" 
        align="right" title="Reprogramar Productos" style="cursor:pointer" id="bt_repprod" 
        onClick="searchp()">  
      </td>
    </tr>
    <tr>
      <td align="center">
      <label style="font-weight:bold; font-size:16px">Orden No</label>
      <label id="lb_consec" class="red" style="font-weight:bold; font-size:16px"><?php echo $factura?></label>
      </td>
    </tr>
    <tr>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" class="tittle">Registro de Compra</td>
    </tr>
</table>
<form id="form1" name="form1">
  <table width="98%" border="1" cellspacing="0" align="center">
    <tr>
      <td class="bold" width="20%">Punto de venta</td>
      <td align="center" class="cont" width="30%">
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
        <input type="text" readonly id="tf_ptov" class="long" value="<?php echo $usuario2 ?>">
        <?php
        }
        ?>
      </td>
      <td class="bold" width="20%">Fecha</td>
      <td width="30%" align="center" class="cont">
      <input type="text" id="lb_fecha" value="<?php echo $c_date?>" class="long" >
      </td>
    </tr>
    <tr>
      <td class="bold" >Provedor</td>
      <td align="center" class="cont">
      <!--<input type="text" name="tf_prove" id="tf_prove" style="width:35%" onkeyup="des1()" > -->
      <select name="sl_prove" id="sl_prove" style="width:80%" >
      <option value="">Seleccione</option>
      <?php
        mysql_select_db($database_conexion, $conexion);
        $query_clr = "SELECT DISTINCT `nombre` FROM `d89xz_prove` WHERE `delete`<>1 ORDER BY `nombre` ASC ";
        $clr = mysql_query($query_clr, $conexion) or die(mysql_error());
        //$row_clr = mysql_fetch_assoc($clr);
        while ($row_clr = mysql_fetch_assoc($clr)){
        ?>
      <option value="<?php echo ucwords(strtolower($row_clr['nombre']))?>">
	  <?php echo ucwords(strtolower($row_clr['nombre']))?>
      </option>
		<?php
        } 
        ?>
      </select>
      &nbsp;
        <img src="../../img/addpersonas.png" width="25" height="25" title="Registrar Proveedor" style="cursor:pointer"  
      onclick="creatProve()" />
      </td>
      <td class="bold" >NIT</td>
      <td align="center" class="cont"><input name="tf_ced" type="text" class="long" id="tf_ced" readonly ></td>
    </tr>
    <tr>
      <td class="bold" >Telefono</td>
      <td align="center" class="cont"><input name="tf_tel" type="text" class="long" id="tf_tel" readonly ></td>
      <td class="bold" >Forma de Pago</td>
      <td align="center" class="cont">
      <select name="sl_fpago" id="sl_fpago" class="long" align="center">
        <option value="">Seleccione</option>
        <option value="Efectivo">Efectivo</option>
        <option value="Credito">Credito</option>
        </select></td>
    </tr>
    <tr>
      <td class="bold" width="20%">Fecha Pago</td>
      <td align="center" class="cont">
      <input type="text" name="tf_fechap" id="tf_fechap" class="long" value="<? echo date ('Y-m-d') ?>" >
      </td>
      <td class="bold" >Observaciones</td>
      <td align="center" class="cont">
      <input type="text" name="tf_obs" id="tf_obs" style="width:80%">
      <img src="../../img/add.png" alt="" width="25" height="25" border="0" align="right" 
      title="Agregrar Producto" style="cursor:pointer" id="bt_add" />
      </td>
    </tr>
  </table>
  <table width="98%" border="1" cellspacing="0" align="center" id="tb_data">
  <tr class="stittle" id="tittle">
    <td align="center" >Referencia</td>
    <td align="center" >descripción</td>
    <td align="center" >Presentación</td>
    <td align="center" >Contenido</td>
    <td align="center" >Unidad</td>
    <td align="center" >Código</td>
	<?php
	if($conf[8]==1){
	?>
    <td align="center" >Color</td>
    <?
	}
	if($conf[9]==1){
	?>
    <td align="center" >Marca</td>
    <?
	}
	?>
    <td align="center" >Categoria</td>
    <td align="center" >Cantidad</td>
    <td align="center" >Costo Und.</td>
    <td align="center" >Total</td>
    <td align="center" >&nbsp;</td>
  </tr>
</table>
<table width="98%" border="1" cellspacing="0" align="center">
  <tr>
  	<td width="20%" class="bold">Total Items</td>
    <td width="30%" class="bold"><label id="lb_toti" class="red"></label></td>
    <td width="20%" class="bold">Total</td>
    <td width="30%" class="bold"><label id="lb_totc" class="red"></label></td>
  </tr>
  <tr>
    <td colspan="4" align="center">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close();">
    </td>
  </tr>
</table>
</form>
&nbsp;
</div>  
</body>
<script>


</script>
</html>
<?php
}
?>