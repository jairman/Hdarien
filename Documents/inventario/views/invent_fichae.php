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

$ref_url = $_GET['r']; 

mysql_select_db($database_conexion, $conexion);
$query_prod = "SELECT * FROM `h01sg_producto` WHERE `ref`='$ref_url' AND `delete`<>1 ";
$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
$row_prod = mysql_fetch_assoc($prod);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ficha del Producto</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/invent_fichae.js" type="text/javascript"></script>

<style>
.picture{
	width:170px;
	height:170px;
}
.img{
	padding-top:2px;
}
</style>
</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">

<div id="dialog"></div>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="invent_ficha.php?r=<?php echo $ref_url ?>" class='active'>Información del Producto</a>
      </li>
      <li>
      <a  href="invent_mov.php?r=<?php echo $ref_url ?>" >Historial de Entradas</a>
      </li>
      <li>
      <a  href="../../facturacion/views/fact_phisto.php?r=<?php echo $ref_url ?>">Historial de Salidas</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="right">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
    </td>
  </tr>
</table>
<div id="recargar2">
<div id="main">
&nbsp;
<table width="95%" align="center" id="table_header">
    <tr>
      <td align="left" width="90%" >
      <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
      <td align="right" width="10%">&nbsp;</td>
    </tr>
</table>
<form id="form1" name="form1">
<table width="95%" border="1" cellspacing="0" align="center">
  <tr class="tittle">
    <td colspan="4">Detalle del Producto</td>
  </tr>
  <tr>
    <td class="bold" width="20%">Referencia</td>
    <td class="cont" width="30%">
    <input type="text" class="long red" id="tf_ref" value="<?php echo  $ref_url?>" readonly></td>
    <td class="bold" width="20%" >Fecha de Creación</td>
    <td class="cont" width="30%" ><input name="tf_fecha" type="text" class="long" id="tf_fecha" value="<?php echo $row_prod['fecha']?>" 
    readonly></td>
    </tr>
    <tr>
    <td class="bold">Cod. Barras</td>
    <td class="cont"><input type="text" class="long" id="tf_codb" value="<?php echo $row_prod['cod_barra']?>"></td>
    <td class="bold">RFID</td>
    <td class="cont"><input type="text" class="long" id="tf_rfid" value="<?php echo $row_prod['rfid']?>"></td>
    </tr>
    <tr>
    <td class="bold">Descripcion</td>
    <td class="cont"><input type="text" class="long" id="tf_desc" value="<?php echo $row_prod['desc']?>"></td>
    <td class="bold" >Talla</td>
    <td class="cont" ><input type="text" class="long" id="tf_talla" value="<?php echo $row_prod['talla']?>"></td>
    <tr>
    <tr>
    <td class="bold">Color</td>
    <td class="cont"><input type="text" class="long" id="tf_color" value="<?php echo $row_prod['color']?>"></td>
   	<td class="bold" >Marca</td>
    <td class="cont" >
    <select name="tf_marca" id="tf_marca" class="long">
    <option value="">Seleccione</option>
	<?php
    mysql_select_db($database_conexion, $conexion);
    $query_clr = "SELECT DISTINCT * FROM `h01sg_marca_prod` WHERE `delete`<>1 ORDER BY `marca` ASC ";
    $clr = mysql_query($query_clr, $conexion) or die(mysql_error());
    //$row_clr = mysql_fetch_assoc($clr);
    while ($row_clr = mysql_fetch_assoc($clr)){
        if (ucwords(strtolower($row_clr['marca'])) == ucwords(strtolower($row_prod['marca']))){
    ?>
    <option value="<?php echo ucwords(strtolower($row_clr['marca']))?>" selected>
    <?php echo ucwords(strtolower($row_clr['nombre']))?>
    </option>
    <?php
        }else{
    ?>
    <option value="<?php echo ucwords(strtolower($row_clr['marca']))?>">
    <?php echo ucwords(strtolower($row_clr['nombre']))?>
    </option>
    <?php
        }
    } 
    ?>
    </select>
    </td>
    </tr>
    <tr>
   	<td class="bold" >Categoria</td>
    <td class="cont" >
    <select name="tf_cat" id="tf_cat" class="long">
    <option value="">Seleccione</option>
	<?php
    mysql_select_db($database_conexion, $conexion);
    $query_clr1 = "SELECT DISTINCT * FROM `h01sg_categoria_prod` WHERE `delete`<>1 ORDER BY `cat` ASC ";
    $clr1 = mysql_query($query_clr1, $conexion) or die(mysql_error());
    //$row_clr = mysql_fetch_assoc($clr);
    while ($row_clr1 = mysql_fetch_assoc($clr1)){
        if (ucwords(strtolower($row_clr1['cat'])) == ucwords(strtolower($row_prod['categoria']))){
    ?>
    <option value="<?php echo ucwords(strtolower($row_clr1['cat']))?>" selected>
    <?php echo ucwords(strtolower($row_clr1['nombre']))?>
    </option>
    <?php
        }else{
    ?>
    <option value="<?php echo ucwords(strtolower($row_clr1['cat']))?>">
    <?php echo ucwords(strtolower($row_clr1['nombre']))?>
    </option>
    <?php
        }
    } 
    ?>
    </select>
    </td>
    <td class="bold">Sub-Categoria</td>
    <td class="cont"><input type="text" class="long" id="tf_scat" value="<?php echo $row_prod['sub_cat']?>"></td>
    </tr>
    <tr>
   	<td class="bold" >Precio Mayorista</td>
    <td class="cont" ><input type="text" class="long" id="tf_preciom" value="<?php echo $row_prod['precio_mayo']?>" 
    onKeyUp="checkNum(this)"></td>
    <td class="bold" >Precio Venta</td>
    <td class="cont" ><input type="text" class="long" id="tf_precio" value="<?php echo $row_prod['precio_und']?>" 
    onKeyUp="checkNum(this)"></td>
    </tr>
	<!--
    <tr>
      <td colspan="4" align="center" class="cont" valign="middle">
        <div align="center" id="d_img" style="width:180px; height:180px" name=divs class="img">
          <div>
            <img src="../controllers/invent_agregarimg.php?idnum=< echo $row_prod['img_id']?>" alt="Img" id="art< echo $row_prod['img_id']?>" name="imgs" class="picture" />
            </div>
          </div>
      </td>
    </tr>-->
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="4" align="center">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close()">
    </td>
  </tr>
</table>
</form>
&nbsp;
</div>
</div>
</body>
</html>
<?php
}
?>