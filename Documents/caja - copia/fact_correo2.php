<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

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

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$c_date = date('Y-m-d');

$ptov_url=$_GET['p'];

$consec_url=$_GET['c'];

mysql_select_db($database_conexion, $conexion);
$fact = mysql_query("SELECT * FROM `h01sg_venta` WHERE `consec`='$consec_url' AND `punto_venta`='$ptov_url' AND `delete`<>1 ", $conexion) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);	

$i = 1;
//------------------------------Abonos-----------------------------------------------------------------
@$hacienda = $_GET['p'];
$factura = $_GET['factura'];
@$colname_abon = "-1";
if (isset($_GET['factura'])) {
$colname_abon = $_GET['factura'];
}
mysql_select_db($database_conexion, $conexion);
$query_abon = sprintf("SELECT * FROM d89xz_abonos WHERE hacienda='$hacienda'and  orden = %s ORDER BY orden DESC", GetSQLValueString($colname_abon, "text"));
$abon = mysql_query($query_abon, $conexion) or die(mysql_error());
$row_abon = mysql_fetch_assoc($abon);
$totalRows_abon = mysql_num_rows($abon);



@$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE  hacienda='$hacienda'and`factura` = '$factura'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total=$row['total'];

$tal1 = abs($total);
$tal = number_format(abs($tal1));

//el total de abonos

@$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE hacienda='$hacienda'and `orden` = '$factura'"); 
$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
$total_abono1=$row_abono['total'];
$total_abono2= abs($total_abono1);

$total_abono = number_format($total_abono1);

// Saldo
	$saldo1 = $tal1 - $total_abono1;
  $saldo =  number_format($saldo1);
	
	



$mensaje = '
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
	</head>
	<style>
		.sub{
			font-size:12px;
			font-weight:bold}
			
			/* 	
		---------------------------
		Con los siguientes Selectores no hay que hacer nada en el html
		ya que se le asigna directamente a los elementos html
		---------------------------
		*/
		/*Selector para darle propiedades al body*/
		body{
			padding: 10px;
			font: 12px "Trebuchet MS", Helvetica, sans-serif !important;
			/*font-family:Arial;
			font-size:12px;*/
			margin-top:5px;
		}
		/*Selector para darle propiedades a la Tabla*/
		table{ 
			margin-left: auto;
			margin-right: auto;
		}
		/*Selector para darle propiedades a la primera fila de una tabla*/
		tr:first-child {
			border-top:3px solid rgba(0, 0, 0, 0,3);
			border-opacity:0.9;
			height:20px;
		}
		/*Selector para darle propiedades a todos los "td" de una tabla*/
		td{	
			height:20px !important;
			vertical-align:middle;
		}
		/*Selector para darle propiedades a todos los "th" de una tabla*/
		th{	
			height:20px !important;
			vertical-align:middle;
		}
		/*Selector para darle propiedades a todos los "tr" de una tabla*/
		tr{
			/*margin:5px;*/
			border-bottom: 3px solid rgba(0, 0, 0, 0);	
		}

		form.form1 fieldset {
		    border: none;
		    border-top: 1px solid #C9DCA6;
		    background-color: #F8FDEF;
		}

		form.form1 fieldset fieldset {
		    background: none;
		}
		form.form1 label.error, label.error {
		    /* remove the next line when you have trouble in IE6 with labels in list */
		    color: red;
		    font-family:Arial;
		    font-size:12px;
			font-style:italic;
		}
		div.error { display: none; }
		input.checkbox { border: none }
		input:focus { border: 1px dotted black; }
		input.error { border: 1px dotted red; }

		/*Selector para darle propiedades a los text fields*/
		input[type=text]{
			border:1px solid #aaa;
			box-shadow: 1px 2px 0px #ccc, 0 10px 15px #eee inset;
			border-radius:6px;
			height:18px;
			padding-left:10px;
			/*padding-right:30px;*/
			/*width:85%*/
		}
		/*Selector para darle propiedades a los selects*/
		select{
			border:1px solid #aaa;
			box-shadow: 1px 2px 0px #ccc, 0 10px 15px #eee inset;
			border-radius:6px;
			/*width:18px;*/
			padding-left:10px;
			/*width:85%*/
		}
		/*Selector para darle propiedades a los select en focus*/
		select:focus{
			background: #fff; 
			border:1px solid #555; 
			box-shadow: 0 0 3px #aaa; 
			/*padding-right:70px;*/
		}
		/*Selector para darle propiedades a los select cuando estan deshabilitados*/
		select:disabled{
			background: #f2f2f2; 
			border:1px solid #555; 
			box-shadow: 0 0 3px #aaa; 
			/*padding-right:70px;*/
		}
		/*Selector para darle propiedades a los text field en focus*/
		input[type=text]:focus{
			background: #FFF; 
			border:1px solid #DBB2AD ; 
			box-shadow: 0 0 3px #aaa; 
			/*padding-right:70px;*/
		}
		/*Selector para darle propiedades a los text field cuando estan deshabilitados*/
		input[type=text]:disabled{
			background: #f2f2f2; 
			border:1px solid #555; 
			box-shadow: 0 0 3px #aaa; 
			/*padding-right:70px;*/
		}
		/*Selector para darle propiedades a los text field cuando son de solo lectura*/
		input[readonly]{
			background: #ebebeb; 
			border:1px solid #555; 
			box-shadow: 0 0 3px #aaa; 
			/*padding-right:70px;*/
		}

		*:focus {outline: none;}
		/*Selector para cambiarle el tampaño de la letra a los dialogs*/
		#dialog{
			font-size:16px;
			font-weight:bold
		}
		#dialog2{
			font-size:16px;
			font-weight:bold
		}
		span.ui-dialog-title{
			font-size:18px;
			font-weight:bold
		}
		/*Selector para el estilo del autocomplete*/
		.ui-autocomplete {	
		    font-family: Arial;
		    font-size:12px;
		}
		#overlay {
		    position: fixed; 
		    top: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
		    background: #000;
		    opacity: 0.8;
		    filter: alpha(opacity=80);
		    z-index:50;
			display:none;
		}

		/* 	
		---------------------------
		Con los siguientes Selectores hay que asignarlos a los elementos 
		agregandole la clase apropiada a cada elemento
		---------------------------
		*/

		/*
		-------------------
		asignale las propiedades en hover/focus y adicionalmente agregarle la manito cuando se esta sobre el elemento
		-------------------
		*/
		.row:nth-child(2n){
			border-bottom: 1px #D9D9D9 solid;
		/*	border:1px solid black;*/
			font-size:14px;
			height:18px;
			vertical-align:central;
		}
		.row:nth-child(2n+1){
			background: #eeeeee;
			border-bottom: 1px #D9D9D9 solid;
			/*border:1px solid black;*/
			font-size:14px;
			height:18px;
			vertical-align:central;
		}
		.row:hover {
			background: #a7d6ef;
			color: #000;
			cursor: pointer;
		}

		/*
		-------------------
		la clase big se le pone a los elementos que queremos con un tamaño mas grande
		-------------------
		*/
		.big{
			font-size:16px;
		}
		/*
		-------------------
		Selector para darle longitud a los inputs
		-------------------
		*/
		.long{
			width:98%;
		}
		/*
		-------------------
		la clase name se usa para el nombre del producto
		-------------------
		*/
		.name{
			font-size:24px;
			font-weight:bold;
			vertical-align:text-bottom;
		}

		/*
		-------------------
		Selector para el estilo de las filas principales Azul oscura
		-------------------
		*/
		.tittle{
			background:#2089c2;
			background:-o-linear-gradient(bottom, #1C7AAC 5%, #39a3db 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1C7AAC), color-stop(1, #39a3db) );
			background:-moz-linear-gradient( center top, #1C7AAC 5%, #39a3db 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#1C7AAC", endColorstr="#39a3db");		
			background: -o-linear-gradient(top,#1C7AAC,#39a3db);

			background-color:#2089c2;
			border:0px solid #999999;
			text-align:center;
			border-width:0px 0px 1px 1px;
			font-weight:bold;
			color: #fff;
			font-size:16px;
			padding:5px, 10px;
			text-shadow:0px 1px 2px rgba(0,0,0,0.9);
			height:35px;
			vertical-align:middle;
			border-bottom:2px solid white;
		}

		.stittle{
			background:#3694c8;
			background:-o-linear-gradient(bottom, #3694c8 5%, #79b8da 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3694c8), color-stop(1, #79b8da) );
			background:-moz-linear-gradient( center top, #3694c8 5%, #79b8da 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#3694c8", endColorstr="#79b8da");		
			background: -o-linear-gradient(top,#3694c8,#79b8da);

			background-color:#3694c8;
			border:0px solid #999999;
			text-align:center;
			border-width:0px 0px 1px 1px;
			font-weight:bold;
			color: white;
			font-size:14px;
			padding:5px, 10px;
			text-shadow:0px 1px 2px rgba(0,0,0,0.9);
			height:20px;
			vertical-align:middle;
			border-bottom:2px solid white;
		}
		/*
		-------------------
		la clase red esta para poner el texto en rojo
		-------------------
		*/
		.red{
			font-size:14px;
			color:#b03535;
		}
		/*
		-------------------
		la clase res se usa para resaltar texto dentro de las filas azules, les agrega un color amarillo fuerte
		-------------------
		*/
		.res{
			color:#CCCC00;
			font-size:18px
		}

		.green{
			font-size:14;
			color:#007f00;
		}
		/*
		-------------------
		la clase agrega un estilo para resaltar subtitulos
		-------------------
		*/
		.subtitle{
			font-style:italic;
			font-size:14px;
			font-weight:bold}
		.subtitle2{
			font-style:italic;
			font-size:14px;
		}
		/*
		-------------------
		Selector para el estilo de las celdas con texto gris claro
		-------------------
		*/
		.bold{
			font-weight:bold;
			padding:3px 15px 3px 15px ;
			background-color: #D9D9D9 ;
			/*background-image:url(../img/osb.png);*/
			border-bottom:2px solid #2f2f2f;
			color: #222222;
		}
		/*
		-------------------
		Selector para el estilo de las celdas con imputs
		-------------------
		*/
		.cont{
			padding:3px 15px 3px 15px;
		}
		/*
		-------------------
		Selector para los botones que estan afuera de las celdas azul oscuras 
		-------------------
		*/
		.ext {
			font-family: Arial;
			font-size: 14px;
			font-weight:bold;
			color: #ffffff;
			text-shadow:0px 1px 2px rgba(0,0,0,0.9);
			padding: 5px 10px;
			
			background:#1C7AAC;
			background:-o-linear-gradient(bottom, #1C7AAC 5%, #39a3db 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1C7AAC), color-stop(1, #39a3db) );
			background:-moz-linear-gradient( center top, #1C7AAC 5%, #39a3db 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#1C7AAC", endColorstr="#39a3db");		
			background: -o-linear-gradient(top,#1C7AAC,#39a3db);

			background-color:#1C7AAC;
			
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			border: 1px solid #1f2a4a;
			-moz-box-shadow:
				0px 1px 3px rgba(31,42,74,0.5),
				inset 0px 0px 1px rgba(255,255,255,0.6);
			-webkit-box-shadow:
				0px 1px 3px rgba(31,42,74,0.5),
				inset 0px 0px 1px rgba(255,255,255,0.6);
			box-shadow:
				0px 1px 3px rgba(31,42,74,0.5),
				inset 0px 0px 1px rgba(255,255,255,0.6);
			text-shadow:
				0px -1px 0px rgba(000,000,000,1),
				0px 1px 0px rgba(255,255,255,0.2);
			cursor:pointer;
		} 
		/*boton cuando estoy sobre el */
		.ext:hover{
			font-family: Arial;
			font-size: 14px;
			text-shadow:0px 1px 2px rgba(0,0,0,0.9);
			color: #ffffff;
			padding: 5px 10px;
			background:#3694c8;
			background:-o-linear-gradient(bottom, #3694c8 5%, #79b8da 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3694c8), color-stop(1, #79b8da) );
			background:-moz-linear-gradient( center top, #3694c8 5%, #79b8da 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#3694c8", endColorstr="#79b8da");		
			background: -o-linear-gradient(top,#3694c8,#79b8da);

			background-color:#3694c8;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			border: 1px solid #1f2a4a;
			-moz-box-shadow:
				0px 1px 3px rgba(31,42,74,0.5),
				inset 0px 0px 1px rgba(255,255,255,0.6);
			-webkit-box-shadow:
				0px 1px 3px rgba(31,42,74,0.5),
				inset 0px 0px 1px rgba(255,255,255,0.6);
			box-shadow:
				0px 1px 3px rgba(31,42,74,0.5),
				inset 0px 0px 1px rgba(255,255,255,0.6);
			text-shadow:
				0px -1px 0px rgba(000,000,000,1),
				0px 1px 0px rgba(255,255,255,0.2);
			cursor:pointer;
		}

		/* 	
		---------------------------
		El codigo acontinuación es para el estilo del menu horizontal
		solo para las paginas que contengan un menu horizontal

		el menu desplegable se debe componer de una lista con los enlaces
		a las diferentes paginas y adicional a esto la lista debe estar contenida 
		dentro de un div con el id

		- a la pestaña que este activa se le agrega la clase 

		- adicional a esto se crea un div main el cual va a contener el resto de
		la informacion de la pagina.

		por esto podriamos decir que el menu horizontal se compone de un div con la clase
		y despues un segundo div con la clase  la cual va a contener toda la informacion de la pagina
		---------------------------
		*/

		#menu { margin:40px 0 0 20px; }
		#menu ul { list-style:none; }
		#menu ul li { display:inline; float:left; margin-bottom:20px; }

		/* :first-child pseudo selector with rounded top left corner */
		#menu ul li:first-child a { 
			-moz-border-radius-topleft: 12px; 
			-webkit-border-top-left-radius:12px; 
		}

		/* :last-child pseudo selector with rounded top right corner */
		#menu ul li:last-child a { 
			-moz-border-radius-topright: 12px; 
			-webkit-border-top-right-radius:12px; 
		}

		/* background color set to RGBA, with opacity on 0.3 and also using text-shadow */
		#menu ul li a { 
			padding:15px; 
			background: rgba(28,122,172,0.9); 
			text-decoration: none; 
			font: 12px Arial; 
			letter-spacing: 0px; 
			color: #fff;
			text-shadow: #000 0px 0px 2px; 
		}
			
		/* hover state shows a linear gradient and opacity it brought down to 0.9 and also shows a very slight grey gradient on top */
		#menu ul li a:hover { 
			-moz-box-shadow: 0 -5px 10px #777; 
			-webkit-box-shadow: 0 -5px 10px #777;
			background:-o-linear-gradient(bottom, #1C7AAC 5%, #39a3db 100%);	
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1C7AAC), color-stop(1, #39a3db) );
			background:-moz-linear-gradient( center top, #1C7AAC 5%, #39a3db 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#1C7AAC", endColorstr="#39a3db");		
			background: -o-linear-gradient(top,#1C7AAC,#39a3db);

			background-color:#1C7AAC;
			-moz-opacity:.90; 
			filter:alpha(opacity=90); 
			opacity:.90; 
			font-weight:bold;
			color:#fff;
		}

		/* another RGBA background, now with an opacity of 0.8 */
		#menu ul li a.active { 
			background: rgba(77,104,162,0.1) !important;
			color:#000; 
			text-shadow: #fff 0px 0px 2px; 
		}

		#main { clear:both; 
			background: rgba(77,104,162,0.1); 
			/*width:500px; 
			/*margin-left:150px;*/
			-moz-border-radius-topleft: 12px;
			-moz-border-radius-topright: 12px; 
			-moz-border-radius-bottomright: 12px; 
			-moz-border-radius-bottomleft: 12px;
			-webkit-border-top-left-radius:12px; 
			-webkit-border-top-right-radius:12px; 
			-webkit-border-bottom-right-radius:12px; 
			-webkit-border-bottom-left-radius:12px;
			margin-left:3%;
			margin-right:3%;
		}

		table img{
			margin:auto;
		}
</style>
	
	
	<body>
	
	
	
	
	

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">


<div id="dialog"></div>

<form id="form1" name="form1">
<table width="90%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">&nbsp;
     
    </td>
    <td width="7%" align="left"><img  title="Imprimir" src="../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')"/></td>
  </tr>
</table>
<div id="recargar2">

<table width="90%" align="center" id="tb_header">
  <tr>
    <td rowspan="3" width="34%"><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
    <td rowspan="2" align="center" width="33%">
    <label class="sub">
	<?php
	//echo '-'.$ptov_url.'-';
    if ($ptov_url == 'Laureles'){
		echo 'Wanitta laureles <br> 
		Carrera 73 # circular 1 - 23 . Laureles <br>
		Telefono : 2504478';
	}
	if ($ptov_url == 'Centro'){
		echo 'Wanitta metropolis <br>
		Calle 46 # 53-72 , local 331, centro comercial paseo real metropolis. <br>
		Telefono : 5141845';
	}
	if ($ptov_url == 'Lleras'){
		echo 'Wanitta lleras <br>
		Carrera 37 # 8a - 32 <br>
		Telefono : 3115756';
	}
	?>
    </label>
    </td>
    <td align="center" width="33%"><label class="sub">FACTURA DE VENTA</label></td>
  </tr>
  <tr>
    <td align="center">
    <div id="d_consec">
    No: <label id="lb_consec" class="red"><?php echo $consec_url?></label>
    </div>
    </td>
  </tr>
  <tr>
    <td align="center">
    <label class="sub">
	<?php
	//echo '-'.$ptov_url.'-';
    if ($ptov_url == 'Laureles'){
		echo 'Nit: 1128264152';
	}
	if ($ptov_url == 'Centro'){
		echo 'Nit: 1128264152-1';
	}
	if ($ptov_url == 'Lleras'){
		echo 'Nit: 32540178-5';
	}
	?>
    </label>
    </td>
    <td align="center">Fecha: <label id="lb_fecha"><?php echo $row_fact['fecha']?></label></td>
  </tr>
</table>

<table width="90%" align="center" id="tb_cdata">
  <tr class="tittle">
    <td colspan="4"><label style="font-size:18px">Información de Venta</label></td>
  </tr>
  <tr>
  	<td class="bold">Punto de Venta</td>
  	<td class="cont"><label><?php echo $ptov_url?></label></td>
    <td class="bold" >Tipo</td>
    <td class="cont"><label><?php echo $row_fact['tipo']?></label></td>
  </tr>
  <tr>
  	<td width="20%" class="bold">Cedula/Nit</td>
    <td width="30%" class="cont">
    <label><?php echo $nit = $row_fact['ced']?></label>
    </td>
    <td width="20%" class="bold">Cliente</td>
    <td width="30%" class="cont">
    <label><?php echo $row_fact['cliente']?></label>
    </td>
    
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <?php
    mysql_select_db($database_conexion, $conexion);
    $dir = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_dir = mysql_fetch_assoc($dir)
    ?>
    <td class="cont"><label><?php echo $row_dir['dir']?></label></td>
    <td class="bold">Telefono</td>
    <td class="cont"><label><?php echo $row_fact['telefono']?></label></td>
  </tr>
  <tr>
  	<td class="bold">Forma de Pago</td>
    <td class="cont"><label><?php echo $row_fact['forma_pago']?></label></td>
    <td class="bold">Fecha Pago</td>
    <td class="cont"><label><?php echo $row_fact['fecha_p']?></label></td>
  </tr>
</table>

<table width="90%" align="center" id="tb_prod">
  <tr align="center" class="tittle">
    <td colspan="6">Detalle de Venta</td>
  </tr>
  <tr align="center" class="tittle">
    <td width="20%">Referencia</td>
    <td width="30%">Descripción</td>
    <td width="13%">Cantidad</td>
    <td width="12%">Precio</td>
    <td width="13%">Descuento</td>
    <td width="12%">Valor</td>
  </tr>
  <?php
  mysql_select_db($database_conexion, $conexion);
  $prod = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `consec`='$consec_url' 
  AND `punto_venta`='$ptov_url' AND `delete`<>1 ORDER BY `id`", $conexion) or die(mysql_error());
  while ($row_prod = mysql_fetch_assoc($prod)) {
  ?>
  <tr id="fila_<?php echo $i?>">
    <td class="cont">
    <label><?php echo $ref = $row_prod['ref']?></label>
	</td>
    <td class="cont">
	<?php
    mysql_select_db($database_conexion, $conexion);
    $det = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' 
	AND `delete`<>1 ", $conexion) or die(mysql_error());
    $row_det = mysql_fetch_assoc($det)
    ?>
    <label><?php echo $row_det['desc']?></label>
    </td>
    <td class="cont">
    <label><?php echo $row_prod['cant']?></label>
    </td>
    <td class="cont">
    <label><?php echo number_format($row_prod['valor'], 2)?></label>
    </td>
    <td class="cont">
    <label><?php echo number_format($row_prod['dscto'], 2)?></label>
    </td>
    <td class="cont">
    <label><?php echo number_format($row_prod['total'], 2)?></label>
    </td> 
    <?php 
	$i++;
  }
	?>  
  </tr>
</table>
<table width="90%" align="center" id="tb_cost">
  <tr align="center">
    <td width="20%" class="bold">Descuentos</td>
    <td width="30%" class="cont"><label class="red"><?php echo number_format($row_fact['dscto'], 2)?></label></td>
    <td width="20%" class="bold">SUBTOTAL</td>
    <td width="30%" class="cont"><label class="red"><?php echo number_format($row_fact['sub_total'], 2)?></label></td>
  </tr>
  <tr align="center">
    <td width="20%" class="bold">Items</td>
    <td width="30%" class="cont"><label id="lb_itemst" class="red"><?php echo $row_fact['total_items']?></label></td>
    <td width="20%" class="bold">IVA</td>
    <td width="30%" class="cont"><label class="red"><?php echo number_format($row_fact['iva'], 2)?></label></td>
  </tr>
  <tr  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" class="bold">TOTAL</td>
    <td class="cont"><label id="lb_total" class="red"><?php echo number_format($row_fact['tot_final'], 2)?></label></td>
  </tr>
</table>
<table width="90%" border="1" align="center" cellspacing="0">
<tr align="center" bgcolor="#54B948" style="color: #000">
<td colspan="3" align="center"  class="tittle"><p>Relación De Pagos</p></td>
</tr>
<tr align="center" bgcolor="#4D68A2" class="tittle" style="color: #FFF">
<td style="font-family: Helvetica">Total ($)</td>
<td style="font-family: Helvetica">Total Abonos ($)</td>
<td width="366" style="font-family: Helvetica">Saldo ($)</td>
</tr>
<tr align="center" bgcolor="#E5F1D4" class="bold" style="color: #FFF">
<th bgcolor="#FFFFFF" style="font-family: Helvetica"><span style="color: #000"><?php echo $tal; ?></span></th>
<th bgcolor="#FFFFFF" style="color: #000"><?php echo $total_abono; ?></th>
<th bgcolor="#FFFFFF" style="color: #000"><?php echo $saldo; ?></th>
</tr>
<tr align="center" >
<td colspan="3" class="tittle" style="font-family: Helvetica">Detalle de Abonos</td>
</tr>
<tr align="center" bgcolor="#4D68A2" class="tittle" style="color: #FFF">
<td style="font-family: Helvetica">Comentario</td>
<td style="font-family: Helvetica">Abono</td>
<td style="font-family: Helvetica">Fecha De Abono</td>
</tr>
<?php do { ?>
<tr align="center" class="row">
<td style="font-family: Helvetica" ><?php echo $row_abon['empre']; ?></td>
<td style="font-family: Helvetica" ><?php echo number_format($row_abon['abono']); ?></td>
<td style="font-family: Helvetica" ><?php echo $row_abon['fecha']; ?></td>
</tr>
<?php } while ($row_abon = mysql_fetch_assoc($abon)); ?>
</table>
<p>&nbsp;</p>
<table width="90%" align="center" id="tb_footer">
  <tr>
    <td align="center">
    <label class="subtitle" style="font-size:10px">
    <?php
	//echo '-'.$ptov_url.'-';
    if ($ptov_url == 'Laureles'){
		echo 'Resolución DIAN No 110000557012 noviembre 25 , 2013';
	}
	if ($ptov_url == 'Centro'){
		echo 'Resolución DIAN No 110000568103 febrero 19 , 2014 ';
	}
	if ($ptov_url == 'Lleras'){
		echo 'Resolución DIAN No 110000426845';
	}
	?>
    </label>
    </td>
  </tr>
  <tr>
    <td align="center" >
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.parent.Shadowbox.close();">
    </td>
  </tr>
</table>
</div>
</form>
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