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
    location.href=url;
}
</script>
<script>
  
  function checkSubmit() {
    document.getElementById("btsubmit").value = "Enviando Registro De Caja...";
    document.getElementById("btsubmit").disabled = true;
    return true;
}
  
  </script>
</head>
<body>
</ul>

<p>&nbsp;</p>
<form id="formulario" name="formulario" method="post" action="" onsubmit="return checkSubmit();">
<table width="563" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="3" bgcolor="#4D68A2" class="s">Detalle Factura </th>
    </tr>
    <tr>
      <th align="left">Fecha</th>
      <th colspan="2"><div id="cid_3" class="form-input"><span class="form-sub-label-container"> D
        <input class="form-textbox" id="day_3" name="dia" type="tel" size="2" maxlength="2" value="<? echo date("d", $date);?>" />
        <span class="date-separate">&nbsp;M</span> <span class="form-sub-label-container">
          <input class="form-textbox" id="month_3" name="mes" type="tel" size="2" maxlength="2" value="<? echo date("m", $date);?>" />
          <span class="date-separate">&nbsp;A</span></span><span class="form-sub-label-container">
            <input class="form-textbox" id="year_3" name="anos" type="tel" size="4" maxlength="4" value="<? echo date("Y", $date);?>" />
            </span><span class="form-sub-label-container"><img class="showAutoCalendar" alt="Seleccióna una fecha" id="input_3_pick" src="http://cdn.jotfor.ms/images/calendar.png" align="absmiddle" />
              <label class="form-sub-label" for="input_3_pick"> </label>
      </span></div></th>
    </tr>
    <tr>
      <th width="201" align="left">Descripcion</th>
      <th width="352" colspan="2"><label for="descrip"></label>
      <input name="descrip" type="text" id="descrip" size="50" /></th>
    </tr>
    <tr>
      <th align="left">Valor Unitario</th>
      <th colspan="2"><span id="sprytextfield2">
        <label for="valor_unt3"></label>
        <input name="valor_unt" type="text" id="valor_unt3" size="50" />
      <span class="textfieldInvalidFormatMsg"></span></span></th>
    </tr>
    <tr>
      <th align="left">Concepto</th>
      <th colspan="2"><span id="spryselect1" >
        <label for="concepto2"></label>
        <select name="concepto" id="concepto" onchange="comprobar();" style="width:330px">
          <option>Seleccione</option>
          <option value="Egreso">Compra</option>
          <option value="Ingreso">Venta</option>
        </select>
      </span></th>
    </tr>
    
    <tr>
      <th align="left">Cliente</th>
      <th colspan="2"><span id="spryselect3">
        <label for="cliente"></label>
        <select name="cliente" id="cliente" style="width:330px">
          <option value="">Cliente</option>
          <?php
do {  
?>
          <option value="<?php echo $row_cli['cedula']?>"><?php echo $row_cli['nombre'].'   '.$row_cli['apellido']?></option>
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
    </tr>
    <tr>
      <th align="left">Proveedor</th>
      <th colspan="2"><select name="prove" id="prove" style="width:330px">
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
      </select></th>
    </tr>
    <tr>
      <th align="left">Categoría</th>
      <th colspan="2"><span id="spryselect2">
      <label for="estado3"></label>
      <select name="obser" id="estado3" onchange="comprobar1();" style="width:330px">
        <option selected="selected">Seleccione</option>
        <option value="Hotel">Hotel</option>
        <option value="Restaurante">Restaurante</option>
        <option value="Almacen">Almacen</option>
        <option value="Bebidas">Bebidas</option>
        <option value="Otros">Otros</option>
      </select>
      </span></th>
    </tr>
    <tr>
      <th colspan="3" align="center"><input type="submit" name="btsubmit" id="btsubmit" value="Registrar" /></th>
    </tr>
  </table>
</form>
<p>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
  </script>
  <?
$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where `estado`= 'Pago' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY fecha DESC"); 
 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
?>


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
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var sprjamanect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
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
@$cantidad =1;
@$valor_unt =$_POST['valor_unt'];
@$cliente =$_POST['cliente'];
@$provedor=$_POST['prove'];
@$coment=$_POST['obser'];

@$dia=$_POST['dia'];
@$mes=$_POST['mes'];
@$anos=$_POST['anos'];
$f_pago=$anos.'-'.$mes.'-'.$dia;

@$diab=trim(strip_tags($_POST['dia']));
@$mesb=trim(strip_tags($_POST['mes']));
@$anob=trim(strip_tags($_POST['anos']));
@$siembra=$anob.'-'.$mesb.'-'.$diab;

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


		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_prove`,`f_alarma`,`comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}','{$siembra}','{$prevee}','{$factura}','{$provedor}','{$f_pago}','{$coment}')",$conexion);

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


		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`cel_client`,`f_alarma`,`comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$cantidad}','{$valor_unt}','{$valor_t}','{$siembra}','{$clientee}','{$factura}','{$cliente}','{$f_pago}','{$coment}')",$conexion);

	if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,jorn) VALUES ('{$f_pago}','{$estado}','Venta :Pendiente Pago de Factura N°.$factura','Venta De Caja ','{$f_pago}')",$conexion);
		
		
		}

}
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";

}
mysql_close($conexion);
?>

