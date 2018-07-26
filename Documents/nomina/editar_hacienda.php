<?
$ruta_a_joomla = "/../../../saga/";

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
<?php require_once('../Connections/conexion.php'); ?>

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
 $id_vacuno=$_GET['id_vacuno'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/*if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if ($_POST['en_sa']=='Entrada'){
	 $insertar = mysql_query("UPDATE d89xz_semen SET  edad= edad +'$_POST[canti]' WHERE id_vacuno='$id_vacuno'",$conexion);
	}else{
	$insertar = mysql_query("UPDATE d89xz_semen SET  edad= edad -'$_POST[canti]' WHERE id_vacuno='$id_vacuno'",$conexion);	
	}
  $insertSQL = sprintf("INSERT INTO d89xz_semen_detalle (, , fecha,  ,  , sell, unit, total,, hacienda, comen, lote) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['en_sa'], "text"),
                       GetSQLValueString($_POST['lab'], "text"),
                       GetSQLValueString($_POST['tf_fecha'], "date"),
                      
                       GetSQLValueString($_POST['canti'], "text"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['ubic'], "text"),
                       GetSQLValueString($_POST['sell'], "text"),
                       GetSQLValueString($_POST['unit'], "text"),
                       GetSQLValueString($_POST['total'], "text"),
					   GetSQLValueString($id_vacuno, "text"),
					   
					 
					   GetSQLValueString($_POST['hacienda'], "text"),
					   
                       GetSQLValueString($_POST['comen'], "text"),
					   GetSQLValueString($_POST['tf_fecha2'], "text")
					   );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
 

  echo " <script type='text/javascript'>
  
  		alert(' Registrado  Exitoso');

  		 parent.location.reload();

			</script>";
}*/

$colname_vas = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_vas = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_vas = sprintf("SELECT * FROM d89xz_semen WHERE id_vacuno = %s", GetSQLValueString($colname_vas, "text"));
$vas = mysql_query($query_vas, $conexion) or die(mysql_error());
$row_vas = mysql_fetch_assoc($vas);
$totalRows_vas = mysql_num_rows($vas);

$colname_hac = "-1";
if (isset($_GET['id'])) {
   $colname_hac = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_hac = sprintf("SELECT * FROM d89xz_hacienda WHERE id = %s", GetSQLValueString($colname_hac, "int"));
$hac = mysql_query($query_hac, $conexion) or die(mysql_error());
$row_hac = mysql_fetch_assoc($hac);
$totalRows_hac = mysql_num_rows($hac);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kardex Semen</title>

<link href="../semen/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../semen/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../semen/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="../semen/js/shadowbox.js" type="text/javascript"></script>
<script src="../semen/js/jquery.validate.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="70%" border="1" align="center" cellspacing="0">
    <tr>
      <td height="38" colspan="4" align="center"  class="tittle"> Información Básica  Del Propietario o Administrador </td>
    </tr>
    <tr>
      <td  class="bold">Nombre</td>
      <td align="center" ><input id="nombre" type="text" name="registro" style="width:98%" value="<?php echo $row_hac['nombre']; ?>" /></td>
      <td align="left" class="bold">Apellido</td>
      <td align="center" ><input id="apellido" type="text"  name="registro" style="width:98%" value="<?php echo $row_hac['apellido']; ?>" /></td>
    </tr>
    <tr>
      <td class="bold">CC ó NIT</td>
      <td align="center" ><input id="cc" type="text"  name="registro" style="width:98%" value="<?php echo $row_hac['cc']; ?>" /></td>
      <td align="left" class="bold">Dirección</td>
      <td align="center" ><input id="direc" type="text"  name="registro" style="width:98%" value="<?php echo $row_hac['direc']; ?>" /></td>
    </tr>
    <tr>
      <td class="bold">Teléfono</td>
      <td align="center" >
        <input name="registro" type="text"  id="telefono" style="width:98%" value="<?php echo $row_hac['telefono']; ?>" /></td>
      <td align="left" class="bold">celular</td>
      <td align="center" ><input id="cel" type="text"  name="registro" style="width:98%" value="<?php echo $row_hac['cel']; ?>" /></td>
    </tr>
    <tr >
      <td colspan="4" align="center"  class="tittle">Información Básica  De  Hacienda</td>
    </tr>
    <tr>
      <td class="bold">Nombre </td>
      <td align="center" >
          <input name="registro" type="text"  id="hacienda" style="width:98%" value="<?php echo $row_hac['hacienda']; ?>" readonly="readonly" /></td>
      <td align="left" class="bold">Departamento</td>
      <td align="center" >
        <input name="registro" type="text"  id="departamento" style="width:98%" value="<?php echo $row_hac['departamento']; ?>" /></td>
    </tr>
    <tr>
      <td class="bold">Municipio </td>
      <td align="center" >
        
        <input name="registro" type="text"  id="municipio" style="width:98%" value="<?php echo $row_hac['municipio']; ?>" />
      </td>
      <td align="left" class="bold">Vereda</td>
      <td align="center" ><input id="vereda" type="text"  name="registro" style="width:98%" value="<?php echo $row_hac['vereda']; ?>" /></td>
    </tr>
    <tr>
      <td class="bold">Extensión</td>
      <td align="center" >
        
        <input name="registro" type="text"  id="extension" style="width:98%" value="<?php echo $row_hac['extension']; ?>" /></td>
        
      <td align="left" class="bold">Registro ICA</td>
      <td  align="center" ><input id="ica" type="text" name="registro" style="width:98%" value="<?php echo $row_hac['ica']; ?>" /></td>
    </tr>
    <tr>
      <td class="bold">Temperatura °C</td>
      <td align="center" >
        
        <input name="registro" type="text"  id="temperatura" style="width:98%" value="<?php echo $row_hac['temperatura']; ?>" />
      </td>
      <td align="left" class="bold">Tipo Explotación</td>
      <td align="center" >
        
        <input name="registro" type="text"  id="latitud" style="width:98%" value="<?php echo $row_hac['latitud']; ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="4" align="center" ><input name="button" type="submit" class="ext" id="button" value="Actualizar registro" onclick="comp1('<? echo $row_ins['id'] ?>'); return false" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<div id="dialog" >

</div>
</body>
</html>
<?php
mysql_free_result($vas);

mysql_free_result($hac);
?>
<script type="text/javascript">
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');


overlay.click(function(){
	window.win.focus()
});



///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function comp(id){
	//alert(idn)
	overlay.show()
	$("#dialog").html('&nbsp;&nbsp;&nbsp;&nbsp;  Desea  Actualizar Registro... ?    ').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="img/warning.png" width="40" height="40"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="img/good.png" width="40" height="40" title="Aceptar" style="cursor:pointer" onclick="comp2('+id+')"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="img/erase.png" width="40" height="40" style="cursor:pointer" title="Cancelar" onclick="cerrar_dialogo2()"/>');
}
function comp2(id){
	var vals=[];
	var ids=[];
	$('[name="registro"]').each(function(index, element) {
                ids.push(element.id);
				vals.push(element.value);
            });
						//alert(vals)
		$.ajax({
			type: "POST",
			url: "base_conex.php",
			data: {editar: ids, vals: vals},
			success: function(datos){ 
			//console.log(datos)
			$("#dialog").html("Actualización Exitosa");
			$("span.ui-dialog-title").text('Información Importante');
			$("#dialog").prepend('<img id="theImg2" src="img/good.png" width="40" height="40"/>')
			$("#dialog").dialog("open");
							
				setTimeout(function () {
				
			    $("#dialog").dialog("close");
				  parent.location.reload();
				$('#tabla').load('kardex_semen.php'  + ' #tabla ' )  
			}, 2000); 
			},   
		})
}
function comp1(id){ 
	 	if($('#form1')[0].checkValidity()){
			comp(id)
		}else{			
			$('#form1')[0].find(':submit').click()			
		}
}

$(function() {
	//console.log($(window).width())
	var dialogwidth=400
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [500, 150],
	  toolbar: false, 	     
    });
})
// Cerrar
function cerrar_dialogo2(){
	overlay.hide()
	$("#dialog").dialog("close");
}

/////////////////////////Validar  Entero /////////////
$("#canti, #unit").keyup(function(e) {
	var valor=this.value;
	//console.log(valor)
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)){
		var valor=valor.substring(0,valor.length-1);
		this.value=valor;		
	}
})



</script>


