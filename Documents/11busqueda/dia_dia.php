<?
$ruta_a_joomla = "/../../Hdarien/";
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
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
$mess= date("m"); // Year (2003)

mysql_select_db($database_conexion, $conexion);
$query_drio = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY fecha DESC";
$drio = mysql_query($query_drio, $conexion) or die(mysql_error());
$row_drio = mysql_fetch_assoc($drio);
$totalRows_drio = mysql_num_rows($drio);
$query_drio = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY factura DESC";
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
$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
<!--  esto para el calendario -->
<script src="http://spanish.jotform.com/min/g=jotform?3.1.176" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      JotForm.setCalendar("1");
      JotForm.setCalendar("3");
   });
</script>
<link href="http://spanish.jotform.com/min/g=formCss?3.1.176" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://spanish.jotform.com/css/styles/nova.css?3.1.176" />
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>


<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,


});
// </script>

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
<script> 
function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
} 
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {

Shadowbox.open({
content: url,
player: "iframe",
options: {  modal: true	
}})
}

</script>

<body>




<ul id="MenuBar1" class="MenuBarHorizontal">
 <li></li>
 <li></li>
 <li><a href="dia_dia.php" class="current">Registro Diario</a> </li>
  <li><a href="dia_dia_pendiente.php" >Facturas  Pendientes</a> </li>
  <li><a href="bus_detalle_dia_dia.php" >Reportes</a>  </li>
  <li><a href="dia_dia_histo.php" >Historial</a> </li>
</ul>
  
</ul>

<p>&nbsp;</p>

<p>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
  </script>
  <?
$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where `estado`= 'Pago' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY fecha DESC"); 
 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
?>


<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" class="z">
    <th colspan="5" align="left" bgcolor="#FFFFFF"><img src="idsolutions--este.png" alt="" width="177" height="61" /></th>
  </tr>
  <tr bgcolor="#4D68A2" class="z">
    <th colspan="5" align="right" bgcolor="#4D68A2"><input type="submit" name="button" id="button" value="Añadir Registro" onclick="agre()" /></th>
    </tr>
  <tr bgcolor="#4D68A2" class="z">
    <th colspan="2" bgcolor="#4D68A2">Registro Mensual</th>
    <th colspan="2" bgcolor="#4D68A2"><? echo number_format ($row["total"]) ?></th>
    <td width="245" align="center" bgcolor="#4D68A2" ><? date_default_timezone_set("America/bogota"); echo date ( "d-m-Y" );  ?></td>
    </tr>
  <tr bgcolor="#4D68A2" class="x">
    <th width="84" bgcolor="#4D68A2">Factura</th>
    <th width="547" bgcolor="#4D68A2">Descripción</th>
    <th width="112" bgcolor="#4D68A2">Unitario</th>
    <th width="105" bgcolor="#4D68A2">Total</th>
    <th bgcolor="#4D68A2">Cliente/Método</th>
    </tr>
  <?php do { ?>
  <?
 @ $eco =$row["fecha"];
   ?> 
  <tr align="center" id="fila_<? echo $row_drio['id']; ?>"  onMouseOver="ResaltarFila('fila_<? echo $row_drio['id']; ?>');mano(this);" onMouseOut="RestablecerFila('fila_<? echo $row_drio['id']; ?>')" onClick="CrearEnlace('factura_diario.php?id=<?php echo $row_drio['id']; ?>');">
      <td width="84"><?php echo $row_drio['factura']; ?></td>
      <td align="left"><?php echo $row_drio['descrip']; ?></a></td>
      <td width="112"><?php echo number_format ($row_drio['v_unit']); ?></td>
      <td width="105"><?php echo number_format ($row_drio['v_tal']); ?></td>
      <td style="font-size: 14px"><?php echo $row_drio['cliente']; ?></td>
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
@$estado =Pago;
@$cantidad =$_POST['cantidad'];
@$valor_unt =$_POST['valor_unt'];
@$cliente =$_POST['cliente'];
@$provedor=$_POST['prove'];
@$coment=$_POST['obser'];

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


		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_prove`,`f_alarma`,`comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$prevee}','{$factura}','{$provedor}','{$f_pago}','{$coment}')",$conexion);

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


		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_client`,`f_alarma`,`comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}',NOW(),'{$clientee}','{$factura}','{$cliente}','{$f_pago}','{$coment}')",$conexion);

	if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,jorn) VALUES ('{$f_pago}','{$estado}','Venta :Pendiente Pago de Factura N°.$factura','Venta De Caja ','{$f_pago}')",$conexion);
		
		
		}

}
echo "<script type=''>
		window.location='dia_dia.php';
	</script>";

}
mysql_close($conexion);
?>

<script type="text/javascript">



function agre(){
	var url = 'dia_dia_agregar.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
</script>