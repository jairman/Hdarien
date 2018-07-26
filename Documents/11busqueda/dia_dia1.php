<?
$ruta_a_joomla = "/../../Sganadero/";

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
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('Connections/conexion.php'); ?>
<?php
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
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
$mess= date("m"); // Year (2003)


mysql_select_db($database_conexion, $conexion);

$query_drio = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY fecha DESC";
$drio = mysql_query($query_drio, $conexion) or die(mysql_error());
$row_drio = mysql_fetch_assoc($drio);
$totalRows_drio = mysql_num_rows($drio);

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_clientes";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);

mysql_select_db($database_conexion, $conexion);
$query_prove = "SELECT * FROM d89xz_prove";
$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
$row_prove = mysql_fetch_assoc($prove);
$totalRows_prove = mysql_num_rows($prove);

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.z {
	color: #FFF;
}
.x {
	color: #FFF;
}
.s {
	color: #FFF;
}
</style>

<script> 
// Para la manito
function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
} 
</script> 

<script langiage="javascript" type="text/javascript">

// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
    location.href=url;
}
</script>



</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />


<script>
function comprobar() {
    if((document.formulario.concepto[1].selected)) {
        
		document.formulario.cliente.disabled=true;
		document.formulario.prove.disabled=false;
      
    }
    else {
        
        document.formulario.cliente.disabled=false;
		document.formulario.prove.disabled=true;
		
    }
	
}

function comprobar1() {
    if((document.formulario.estado[1].selected)) {
        
		document.formulario.dia.disabled=true;
		document.formulario.mes.disabled=true;
		document.formulario.anos.disabled=true;
      
    }
    else {
        
       document.formulario.dia.disabled=false;
		document.formulario.mes.disabled=false;
		document.formulario.anos.disabled=false;
		
    }
	
}
function compruebaCombo() {
    if((document.formulario.concepto[0].selected)) {
        alert("Elija Una Opcion en Nacimiento.");
    }
}
</script>

<body>




<ul id="MenuBar1" class="MenuBarHorizontal">
 <li></li>
 <li></li>
 <li><a href="dia_dia.php" class="current">Manejo De Caja</a> </li>
  <li><a href="bus_detalle_dia_dia.php" >Reportes De Ventas</a>  </li>
  <li><a href="bus_detalle_dia_dia_compras.php">Reportes De Compras</a></li>
  <li><a href="bus_detalle_dia_dia_caja.php">Reporte Mensual Caja</a></li>
</ul>
  
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="dia_dia_pendiente.php" >Facturas  Pendientes</a> </li>
  <li><a href="dia_dia_histo.php" >Historial</a> </li>

</ul>
  
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>

<form id="formulario" name="formulario" method="post" action="">
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="7" bgcolor="#4D68A2" class="s">Flujo de Caja </th>
    </tr>
    <tr>
      <td width="201">Descripcion</td>
      <th colspan="2"><label for="descrip"></label>
      <input name="descrip" type="text" id="descrip" size="25" /></th>
      <td width="167">Concepto</td>
      <td width="167"><span id="spryselect1">
      <label for="concepto2"></label>
      <select name="concepto" id="concepto" onChange="comprobar();">
        <option>Seleccione</option>
<option value="Egreso">Egreso</option>
        <option value="Ingreso">Ingreso</option>
      </select>
      </span></td>
      <td width="171">Condición Pago</td>
      <td width="112"><span id="spryselect2">
        <label for="estado"></label>
        <select name="estado" id="estado" onChange="comprobar1();">
          <option>Seleccione</option>
          <option value="Pago">Pago</option>
          <option value="Pendiente">Pendiente</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td>Cliente</td>
      <th colspan="2"><span id="spryselect3">
      <label for="cliente"></label>
      <select name="cliente" id="cliente" style="width:180px">
        <option value="">Cliente</option>
        <?php
do {  
?>
        <option value="<?php echo $row_cli['cedula']?>"><?php echo $row_cli['nombre']?></option>
        <?php
} while ($row_cli = mysql_fetch_assoc($cli));
  $rows = mysql_num_rows($cli);
  if($rows > 0) {
      mysql_data_seek($cli, 0);
	  $row_cli = mysql_fetch_assoc($cli);
  }
?>
      </select>
      </span></th>
      <td colspan="2">Proveedor</td>
      <td colspan="2"><label for="prove"></label>
        <select name="prove" id="prove" style="width:210px">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_prove['cedula']?>"><?php echo $row_prove['nombre']?></option>
          <?php
} while ($row_prove = mysql_fetch_assoc($prove));
  $rows = mysql_num_rows($prove);
  if($rows > 0) {
      mysql_data_seek($prove, 0);
	  $row_prove = mysql_fetch_assoc($prove);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Cantidad (U)</td>
      <th colspan="2"><span id="cantidad">
        <label for="cantidad"></label>
        <span id="sprytextfield3">
        <label for="cantidad"></label>
        <input name="cantidad" type="text" id="cantidad" size="25" />
      <span class="textfieldInvalidFormatMsg"></span></span>      <span class="textfieldInvalidFormatMsg"></span></span></th>
      <td colspan="2">Valor Unitario</td>
      <td colspan="2"><span id="sprytextfield2">
        <label for="valor_unt"></label>
        <input name="valor_unt" type="text" id="valor_unt" size="24" />
      <span class="textfieldInvalidFormatMsg"></span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <th colspan="2">&nbsp;</th>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">Fecha De Pago</td>
      <th colspan="3">D
        <label for="dia"></label>
        <select name="dia" id="dia">
          <option value="">D</option>
          <?php
do {  
?>
          <option value="<?php echo $row_dia['dias']?>"><?php echo $row_dia['dias']?></option>
          <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
        </select>
        -M-
        <label for="mes"></label>
        <select name="mes" id="mes">
          <option value="">M</option>
          <?php
do {  
?>
          <option value="<?php echo $row_mes['meses']?>"><?php echo $row_mes['meses']?></option>
          <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
        </select>
        -A-
        <label for="anos"></label>
        <select name="anos" id="anos">
          <option value="">A</option>
          <?php
do {  
?>
          <option value="<?php echo $row_anos['anos']?>"><?php echo $row_anos['anos']?></option>
          <?php
} while ($row_anos = mysql_fetch_assoc($anos));
  $rows = mysql_num_rows($anos);
  if($rows > 0) {
      mysql_data_seek($anos, 0);
	  $row_anos = mysql_fetch_assoc($anos);
  }
?>
        </select></th>
      <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<p>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"]});
  </script>
  <?
$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where `estado`= 'Pago' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'"); 
 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
?>

</p>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" class="z">
    <th colspan="8" align="left" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="177" height="61" /></th>
    </tr>
  <tr bgcolor="#4D68A2" class="z">
    <th colspan="5" bgcolor="#4D68A2">Caja Mensual</th>
    <td width="95" align="center" ><? echo number_format ($row["total"]) ?></td>
    <td colspan="2" align="center" ><? date_default_timezone_set("America/bogota"); echo date ( "d-m-Y" );  ?></td>
    </tr>
  <tr bgcolor="#4D68A2" class="x">
    <th width="84">Factura</th>
    <th width="242">Descripción</th>
    <th width="83">Estado</th>
    <th width="79">Cantidad</th>
    <th width="79">Unitario</th>
    <th width="95">Total</th>
    <th width="251">Cliente</th>
    <th width="135">Fecha</th>
    </tr>
  <?php do { ?>
  <?
 @ $eco =$row["fecha"];
   ?> 
	 <tr align="center" id="fila_<? echo $row_drio['id']; ?>" onMouseOver="ResaltarFila('fila_<? echo $row_drio['id']; ?>');mano(this);"  onMouseOut="RestablecerFila('fila_<? echo $row_drio['id']; ?>')" onClick="CrearEnlace('factura_diario.php?id=<?php echo $row_drio['id']; ?>');">
      <td width="84"><?php echo $row_drio['factura']; ?></td>
      <td><?php echo $row_drio['descrip']; ?></td>
      <td width="83"><?php echo $row_drio['estado']; ?></a></td>
      <td width="79"><?php echo $row_drio['cantid']; ?></td>
      <td width="79"><?php echo number_format ($row_drio['v_unit']); ?></td>
      <td width="95"><?php echo number_format ($row_drio['v_tal']); ?></td>
      <td><?php echo $row_drio['cliente']; ?></td>
      <td><?php echo $row_drio['fecha']; ?></td>
      </tr>
    <?php } while ($row_drio = mysql_fetch_assoc($drio)); ?>
</table>
</DIV> 

<script language="Javascript">
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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var sprjamanect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($drio);

mysql_free_result($cli);

mysql_free_result($prove);

mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);
?>
<?

	



@$descrip =$_POST['descrip'];
@$concepto =$_POST['concepto'];
@$estado =$_POST['estado'];
@$cantidad =$_POST['cantidad'];
@$valor_unt =$_POST['valor_unt'];
@$cliente =$_POST['cliente'];
@$provedor=$_POST['prove'];

@$dia=$_POST['dia'];
@$mes=$_POST['mes'];
@$anos=$_POST['anos'];
$f_pago=$anos.'-'.$mes.'-'.$dia;

?>


<?
if($valor_unt!= 0){
	
	
if ($concepto == Egreso){	
$valor_t = $valor_unt * $cantidad * -1;

					$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$factura=	$rowEmp['factura'];	
								
							}
					}
		@$queEmp ="SELECT * FROM   d89xz_prove where cedula='$provedor'";
		@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombrep=	$rowEmp['nombre'];
							
							
						}
					}
@$prevee="$nombrep";

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);


		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_prove`,`f_alarma`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$prevee}','{$factura}','{$provedor}','{$f_pago}')",$conexion);

if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`) VALUES ('{$f_pago}','{$estado}','Compra :Pendiente Pago de Factura N°.$factura','Compra De Caja ')",$conexion);
		
		
		}

}

if ($concepto == Ingreso){	
$valor_t = $valor_unt * $cantidad;

	$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$factura=	$rowEmp['factura'];	
								
							}
					}
					
				@$queEmp ="SELECT * FROM   d89xz_clientes where cedula='$cliente'";
		@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombre=	$rowEmp['nombre'];
							
							
						}
					}
@$clientee="$nombre";		

$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);


		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_client`,`f_alarma`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$clientee}','{$factura}','{$cliente}','{$f_pago}')",$conexion);

	if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,`jorn`) VALUES ('{$f_pago}','{$estado}','Venta :Pendiente Pago de Factura N°.$factura','Venta De Caja ','{$f_pago}')",$conexion);
		
		
		}

}
echo "<script type=''>
		window.location='dia_dia.php';
	</script>";

}
mysql_close($conexion);
?>

