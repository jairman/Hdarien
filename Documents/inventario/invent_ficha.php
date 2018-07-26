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
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>

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

<div id="dialog"></div>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../inventario/invent_ficha.php?r=<?php echo $ref_url ?>" class='active'>Información del Producto</a>
      </li>
      <li>
      <a  href="../inventario/invent_mov.php?r=<?php echo $ref_url ?>" >Historial de Entradas</a>
      </li>
      <li>
      <a  href="../facturacion/fact_phisto.php?r=<?php echo $ref_url ?>">Historial de Salidas</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left">
    <input type="image" title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
    </td>
  </tr>
</table>
<div id="recargar2">
<div id="main">
&nbsp;
<table width="95%" align="center" id="table_header">
    <tr>
      <td align="left" >
      <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
    </tr>
</table>
<table width="95%" border="1" cellspacing="0" align="center">
  <tr class="tittle">
    <td colspan="3">Detalle del Producto</td>
  </tr>
  <tr>
    <td class="bold" width="15%">Referencia</td>
    <td class="cont" width="35%"><input name="tf_ref" type="text" class="long red" id="tf_ref" 
    readonly="readonly" value="<?php echo $row_prod['ref']?>"></td>
    <td align="center" class="bold">Imagen</td>
    </tr>
    <tr>
      <td class="bold" >Descripcion</td>
    <td class="cont" ><input name="tf_desc" type="text" class="long" id="tf_desc" 
    readonly="readonly" value="<?php echo $row_prod['desc']?>"></td>
      <td rowspan="7" align="center" class="cont" valign="middle">
        <div align="center" id="d_img" style="width:180px; height:180px" name=divs class="img">
          <div>
            <img src="invent_agregarimg.php?idnum=<?php echo $row_prod['img_id']?>" alt="Img" id="art<?php echo $row_prod['img_id']?>" name="imgs" class="picture" />
            </div>
          </div>
      </td>
    </tr>
    <tr>
    <td class="bold" >Talla</td>
    <td class="cont" ><input name="tf_desc" type="text" class="long" id="tf_desc" 
    readonly="readonly" value="<?php echo $row_prod['talla']?>"></td>
    </tr>
  <tr>
    <td class="bold" >Marca</td>
    <td class="cont" ><input name="tf_marca" type="text" class="long" id="tf_marca" 
    readonly="readonly" value="<?php echo $row_prod['marca']?>"></td>
    </tr>
  <!--<tr>
    <td class="bold" >Codigo de Barras</td>
    <td class="cont" ><input name="tf_barc" type="text" class="long" id="tf_barc" 
    readonly="readonly" value="< echo $row_prod['cod_barra']?>"></td>
    </tr>-->
  
  <tr>
    <td class="bold" >Precio Mayorista</td>
    <td class="cont" ><input name="tf_costo" type="text" class="long" id="tf_costo" 
    readonly="readonly" value="<?php echo $row_prod['precio_mayo']?>" ></td>
    </tr>
  <tr >
    <td class="bold" >Precio Venta</td>
    <td class="cont" ><input name="tf_precio" type="text" class="long" id="tf_precio" 
    readonly="readonly" value="<?php echo $row_prod['precio_und']?>" ></td>
    </tr>
    <tr>
    <td class="bold" width="15%">Fecha de Creación</td>
    <td width="35%" align="center" class="cont"><input name="tf_fecha" type="text" class="long" id="tf_fecha" 
    readonly="readonly" value="<?php echo $row_prod['fecha']?>"></td>
    </tr>
    <tr>
    <td class="bold" width="15%">&nbsp;</td>
    <td width="35%" align="center" class="cont">&nbsp;</td>
    </tr>  
  <tr>
    <td colspan="3" align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.close();">
    </td>
  </tr>
</table>
&nbsp;
</div>
</div>
</body>
<script>

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
} 

</script>
</html>
<?php
}
?>