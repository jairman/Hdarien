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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {			   
					   
  $insertSQL = sprintf("INSERT INTO d89xz_total_medicinas (tipo, nombre, descrip, cont, mark, coment, m_uso, p_act, admin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['descrip'], "text"),
                       GetSQLValueString($_POST['cont'], "text"),
					   GetSQLValueString($_POST['mark'], "text"),
					   GetSQLValueString($_POST['coment'], "text"),
					   GetSQLValueString($_POST['m_uso'], "text"),
					   GetSQLValueString($_POST['activo'], "text"),
						GetSQLValueString($_POST['admin'], "text"));
					  
					   

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
}



mysql_select_db($database_conexion, $conexion);
$query_md = "SELECT * FROM d89xz_tipo_medininas";
$md = mysql_query($query_md, $conexion) or die(mysql_error());
$row_md = mysql_fetch_assoc($md);
$totalRows_md = mysql_num_rows($md);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.c {
	color: #FFF;
}
#form2 table tr th {
	color: #FFF;
}
c {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head><body>
<p>&nbsp; </p>
<DIV ID="seleccion">
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table width="500" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2">
      <th colspan="2">Registrar medicinas</th>
    </tr>
    <tr>
      <td width="175" bgcolor="#FFFFFF" style="color: #000"><strong>Tipo</strong></td>
      <!--<td><input type="text" name="tipo" value="" size="25" /></td>-->
   	   <td bgcolor="#FFFFFF" ><span id="spryselect1">
     	   <select  type="text" name="tipo" value="" style="width:335px"  >
     	     <option value="">Seleccione</option>
     	     <?php
do {  
?>
     	     <option value="<?php echo $row_md['tipo']?>"><?php echo $row_md['tipo']?></option>
     	     <?php
} while ($row_md = mysql_fetch_assoc($md));
  $rows = mysql_num_rows($md);
  if($rows > 0) {
      mysql_data_seek($md, 0);
	  $row_md = mysql_fetch_assoc($md);
  }
?>
   	     </select>
     	 </span>
     	   <input name="cantidad" type="hidden" id="cantidad" value="0" />
     	   <input name="entrada" type="hidden" id="entrada" value="Entrada" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Nombre</strong></td>
      <td bgcolor="#FFFFFF"><span id="sprytextfield2">
        <input type="text" name="nombre" value="" size="50" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Descripción</strong></td>
      <td bgcolor="#FFFFFF"><input type="text" name="descrip" value="" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Presentación</strong></td>
     
      <td bgcolor="#FFFFFF"><input type="text" name="m_uso" value="" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Dosificación</strong></td>
      <td bgcolor="#FFFFFF"><label for="coment"></label>
      <input name="coment" type="text" id="coment" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Contenido(ml)</strong></td>
      <td bgcolor="#FFFFFF"><span id="sprytextfield1">
      <input type="text" name="cont" value="" size="50" />
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Vía Admin</strong></td>
      <td bgcolor="#FFFFFF"><input name="admin" type="text" id="admin" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>Marca</strong></td>
      <td bgcolor="#FFFFFF"><input type="text" name="mark" value="" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" style="color: #000"><strong>P. Activo</strong></td>
      <td bgcolor="#FFFFFF"><input name="activo" type="text" id="activo" size="50" /></td>
    </tr>
    <tr bgcolor="#4D68A2">
      <td colspan="2" align="center" bgcolor="#FFFFFF">
        <input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" />
      <a  href="kardex_medicina.php" onclick="javascript:window.parent.Shadowbox.close();"><img src="cancelar.png" alt="" width="68" height="20" /></a> </a></td>
    </tr>
  </table>
<input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
//mysql_free_result($med);

mysql_free_result($md);
?>



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
<?
$tipo =$_POST['tipo'];
$nombre =$_POST['nombre'];
$descrip = $_POST['descrip'];
$coment = $_POST['coment'];
$cont = $_POST['cont'];
$mark = $_POST['mark'];

?>
<?
if($tipo!= ''){
	



if ($tipo == Vacuna){	
		$id_dep = 1;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);
				
		}

if ($tipo == Antibiotico){
		
	$id_dep = 2;
		
$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);


}

if ($tipo == Desparasitante){	

$id_dep = 3;

$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}

if ($tipo == Analgesicos){	

$id_dep = 4;

$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);


}

if ($tipo == Hormonas){	

$id_dep = 5;
		
$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}

	if ($tipo == Medicina_Preventiva){	

		$id_dep = 6;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

		}
		
		
		
if ($tipo == Antiparasitario_Interno){	

		$id_dep = 7;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}	

if ($tipo == Antiparasitario_Externo){	

		$id_dep = 8;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}	
if ($tipo == Antiparasitario_Oral){	

		$id_dep = 9;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}		
		
if ($tipo == Oxitetraciclina){	

		$id_dep = 10;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}		

if ($tipo == Promotores_de_Crecimiento){	

		$id_dep = 11;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}	

if ($tipo == Analgesicos){	

		$id_dep = 12;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}	

if ($tipo == Antiespasmodicos){	

		$id_dep = 13;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}		
if ($tipo == Suplementos_Multivitaminicos){	

		$id_dep = 14;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}
if ($tipo == Vitaminas){	

		$id_dep = 15;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}		

if ($tipo == Vermifugos){	

		$id_dep = 16;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}		
if ($tipo == Jeringas_Desechables){	

		$id_dep = 17;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}

if ($tipo == Agujas){	

		$id_dep = 18;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}

if ($tipo == Dextrosa){	

		$id_dep = 19;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}

if ($tipo == Venoclisis){	

		$id_dep = 20;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}
if ($tipo == Insumos_IATF){	

		$id_dep = 21;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}

if ($tipo == Tranquilizantes){	

		$id_dep = 22;
				
		$insertar = mysql_query("INSERT INTO d89xz_provincia(`id_dep`,`det_pro`,`tipo`,`descrip`,`coment`,`cont`,`mark`) VALUES ('{$id_dep}','{$nombre}','{$tipo}','{$descrip}','{$coment}','{$cont}','{$mark}')",$conexion);

}
echo "<script type=''>
      window.location='kardex_medicina.php';
		
	</script>";

}
mysql_close($conexion);
?>
