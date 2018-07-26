<?
 //session_start();
 
$ruta_a_joomla = "/../../agrotin/";

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
	

	//seguridad
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder a esta página sin estar logueado.");
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

$sol=$_GET['sol'];
$nom_hacienda=$_GET['hacienda'];

$nom_hacienda_m = strtoupper($nom_hacienda);
mysql_select_db($database_conexion, $conexion);
$query_fac = "SELECT * FROM d89xz_bascula WHERE solicitud='$sol'";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

mysql_select_db($database_conexion, $conexion);
$query_cons = "SELECT solicit FROM d89xz_consecu_orden";
$cons = mysql_query($query_cons, $conexion) or die(mysql_error());
$row_cons = mysql_fetch_assoc($cons);
$totalRows_cons = mysql_num_rows($cons);

mysql_select_db($database_conexion, $conexion);
$query_vacunos = "SELECT d89xz_vacunos.cos_entro FROM d89xz_vacunos";
$vacunos = mysql_query($query_vacunos, $conexion) or die(mysql_error());
$row_vacunos = mysql_fetch_assoc($vacunos);
$totalRows_vacunos = mysql_num_rows($vacunos);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#apDiv5 {
	position:absolute;
	width:206px;
	height:44px;
	z-index:2;
	left: 1px;
	top: -20px;
}
#factura_venta {
	font-size: 30px;
	text-align:right
}
#apDiv2 {
	position:absolute;
	width:67px;
	height:67px;
	z-index:1;
	left: 2px;
	top: 23px;
}
</style>
</head>

<body>
<div id="apDiv5">
  <h3>Hacienda <? echo $nom_hacienda_m;?></h3>
</div>
<div id="apDiv2"><input name="" type="button" value="Registrar Factura" id="reg_fac"/></div>
<div id="recargar2">
<h2 id="factura_venta"><strong>FACTURA DE VENTA HACIENDA <? echo $nom_hacienda_m;?></strong></h2><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td width="18%"><strong>Empresa</strong></td>
    <td width="31%"><? echo $row_fac['cliente'] ?></td>
    <td width="24%"><strong>Factura No</strong></td>
    <td width="27%"><? echo $row_cons['solicit'] ?>
     
        <input type="hidden" name="consecutivo" id="consecutivo" value="<? echo $row_cons['solicit'] ?>" />
     </td>
  </tr>
  <tr>
    <td><strong>Cedula/Nit</strong></td>
    <td><? echo $row_fac['cedula_cliente'] ?></td>
    <td><strong>Fecha</strong> DD/MM/AAAA</td>
    <td>
      <input type="text" name="fecha" id="fecha" />
   </td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><strong>Contacto</strong></td>
    <td><? echo $row_fac['cliente'] ?></td>
    <td><strong>Telefono</strong></td>
    <td><? echo $row_fac['tel_cliente'] ?></td>
  </tr>
</table><table width="886"   border="1" align="left">
      <tr align="center">
        <td width="170" bgcolor="#000000" style="color:#FFF; font-size:13" >Animal</td>
        <td width="192" bgcolor="#000000" style="color:#FFF; font-size:13">Peso(Kg)</td>
        <td width="183" bgcolor="#000000" style="color:#FFF; font-size:13" ><span style="color:#FFF ; font-size:13">Precio(Kg)</span></td>
        <td width="183" bgcolor="#000000" style="color:#FFF; font-size:13" >Precio Venta</td>
        <td width="133" bgcolor="#000000" style="color:#FFF; font-size:13" >Precio Entrada</td>
  </tr>
    <?
	mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT * FROM  d89xz_bascula where solicitud ='$sol'" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$totalRows_histo = mysql_num_rows($histo);
while ($row_histo = mysql_fetch_assoc($histo)) {
	$animal=$row_histo['animal_no'];
	$query_vacunos = "SELECT d89xz_vacunos.cos_entro FROM 	d89xz_vacunos WHERE id_vacuno='$animal'";
	$vacunos = mysql_query($query_vacunos, $conexion) or die(mysql_error());
	$row_vacunos = mysql_fetch_assoc($vacunos);
	$cos_entro=$row_vacunos['cos_entro'];


	?>
      <tr align="center">
        <td style="font-size:13"><? echo $row_histo['animal_no'] ?></td>
        <td style="font-size:13"><? echo $row_histo['animal_peso'] ?></td>
        <td style="font-size:13"><span style="font-size:13"><? echo $row_histo['precio_x_k'] ?></span></td>
        <td style="font-size:13"><? echo number_format($row_histo['precio_x_k']*$row_histo['animal_peso']) ?></td>
        <td style="font-size:13"><? echo $cos_entro ?></td>
      </tr>
      <?
	  
} 
	  ?>
  </table>
</p>
<p>&nbsp;</p>
<table width="100%" border="1" cellspacing="1" cellpadding="0">
<?
$query_fac = "SELECT valor_total FROM d89xz_bascula WHERE solicitud='$sol'";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$queEmp= "SELECT SUM(cos_entro) as total FROM d89xz_bascula WHERE solicitud='$sol'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$row = mysql_fetch_array($resEmp, MYSQL_ASSOC);

?>
  	
  <tr>
    <td colspan="2" align="center"><strong>Descuentos</strong></td>
    <td width="42%"><strong>Subtota</strong>l</td>
    <td width="5%"><input type="text" name="subtotal" id="subtotal" value="<? echo $row_fac['valor_total'] ?>"/></td>
  </tr>
  <tr>
    <td width="25%"><strong>B.N.A</strong></td>
    <td width="28%">
     
      <input type="text" name="bna" id="bna" />
    </td>
    <td colspan="2" align="center"><strong>TOTALES</strong>
     
      <input type="hidden" name="totale" id="totale" value="<? echo $row['total'] ?>"/>
   </td>
  </tr>
  <tr>
    <td><strong>Fomento</strong></td>
    <td><input type="text" name="fomento" id="fomento" /></td>
    <td><strong>Total-Descuentos</strong></td>
    <td><input type="text" name="total_desc" id="total_desc" /></td>
  </tr>
  <tr>
    <td><strong>Fletes</strong></td>
    <td><input type="text" name="fletes" id="fletes" /></td>
    <td><strong>Ganancia Neta</strong></td>
    <td><input type="text" name="ganacia" id="ganancia" value=""/></td>
  </tr>
  <tr>
    <td><strong>Otros</strong></td>
    <td><input type="text" name="otros" id="otros"  /></td>
    <td><strong>Utilidad</strong>      <input type="text" name="porcentaje" id="porcentaje" style="width:60px"/>
      <strong>%</strong></td>
    <td><input type="text" name="utilidad" id="utilidad" /></td>
  </tr>
</table>
</div>
<div id="terminando2a">
       <?
	   @$f = stripslashes(trim($_GET["fomento"]));
      if ($f){
		$sol=$_GET['sol'];
		$hacienda= $_GET['hacienda'];
		$fomento=$_GET['fomento'];
		$fletes=$_GET['fletes'];
		$otros=$_GET['otros'];
		$porcentaje=$_GET['porcentaje'];
		$total_desc=$_GET['total_desc'];
		$bna=$_GET['bna'];
		$ganancia=$_GET['ganancia'];
		$utilidad=$_GET['utilidad'];
		$fecha=$_GET['fecha'];
		$consecutivo=$_GET['consecutivo'];
		$query_ing2="UPDATE d89xz_bascula SET  neta='$ganancia', utilidad='$utilidad', fecha_fac='$fecha', cons_fac='$consecutivo', fomento='$fomento', fletes='$fletes', otros='$otros', porcentaje='$porcentaje', total_desc='$total_desc', bna='$bna' WHERE solicitud='$sol'";
		$my_query_ing=mysql_query($query_ing2, $conexion);
		$insertar = mysql_query("UPDATE  `d89xz_consecu_orden` SET `solicit`=solicit + 1", $conexion);	

	  }
	  ?>
       </div>
</body>
</html>
<?php
mysql_free_result($fac);

mysql_free_result($cons);

mysql_free_result($vacunos);
?>
<script>
$('#reg_fac').click(function(){
	var hacienda = getUrlVars()["hacienda"];
	var sol = getUrlVars()["sol"];
	var consecutivo = $('#consecutivo').val();
	var subtotal= $('#subtotal').val();
	var fomento= $('#fomento').val();
	var fletes= $('#fletes').val();
	var otros= $('#otros').val();
	var porcentaje= $('#porcentaje').val()
	var total_desc= $('#total_desc').val()
	var bna= $('#bna').val();
	var ganancia= $('#ganancia').val();
	var utilidad= $('#utilidad').val();
	var fecha= $('#fecha').val();
	$('#terminando2a').load('stin_bascula_gen_fac.php?sol=' +sol + '&hacienda=' + hacienda + '&subtotal='+ subtotal + '&fomento='+ fomento + '&fletes='+ fletes + '&otros='+ otros + '&porcentaje='+ porcentaje + '&total_desc=' + total_desc + '&bna='+ bna + '&ganancia='+ ganancia + '&utilidad='+ utilidad + '&fecha='+ fecha + '&consecutivo=' + consecutivo);
	alert('Factura Número ' + consecutivo + ' Asociada A Báscula Número ' + sol +' realizada exitosamente');
	location.href= 'stin_buscar_fac_bas.php?hacienda=' + hacienda + '&sol=' + sol;
	 
})

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
$('#bna').keyup(function(){
	var subtotal= $('#subtotal').val();
	var subtotal2= Number(subtotal.replace(/[^0-9\.]+/g,""));
	var bna= $('#bna').val();
	var fomento= $('#fomento').val();
	var fletes= $('#fletes').val();
	var otros= $('#otros').val();
	var totale= $('#totale').val();
	var total=numberWithCommas(subtotal2-bna-fomento-fletes-otros);
	var neta=numberWithCommas(subtotal2-bna-fomento-fletes-otros-totale);
	$('#total_desc').val(total)
	$('#ganancia').val(neta)
	var porcentaje= $('#porcentaje').val()/100;
	var ganancia= $('#ganancia').val();
	var ganancia= Number(ganancia.replace(/[^0-9\.]+/g,""));
	var total=numberWithCommas(ganancia*porcentaje);
	$('#utilidad').val(total)
	});
$('#fomento').keyup(function(){
	var subtotal= $('#subtotal').val();
	var subtotal2= Number(subtotal.replace(/[^0-9\.]+/g,""));
	var bna= $('#bna').val();
	var fomento= $('#fomento').val();
	var fletes= $('#fletes').val();
	var otros= $('#otros').val();
	var totale= $('#totale').val();
	var total=numberWithCommas(subtotal2-bna-fomento-fletes-otros);
	var neta=numberWithCommas(subtotal2-bna-fomento-fletes-otros-totale);
	$('#total_desc').val(total)
	$('#ganancia').val(neta)
	var porcentaje= $('#porcentaje').val()/100;
	var ganancia= $('#ganancia').val();
	var ganancia= Number(ganancia.replace(/[^0-9\.]+/g,""));
	var total=numberWithCommas(ganancia*porcentaje);
	$('#utilidad').val(total)
	});
$('#fletes').keyup(function(){
	var subtotal= $('#subtotal').val();
	var subtotal2= Number(subtotal.replace(/[^0-9\.]+/g,""));
	var bna= $('#bna').val();
	var fomento= $('#fomento').val();
	var fletes= $('#fletes').val();
	var otros= $('#otros').val();
	var totale= $('#totale').val();
	var total=numberWithCommas(subtotal2-bna-fomento-fletes-otros);
	var neta=numberWithCommas(subtotal2-bna-fomento-fletes-otros-totale);
	$('#total_desc').val(total)
	$('#ganancia').val(neta)
	var porcentaje= $('#porcentaje').val()/100;
	var ganancia= $('#ganancia').val();
	var ganancia= Number(ganancia.replace(/[^0-9\.]+/g,""));
	var total=numberWithCommas(ganancia*porcentaje);
	$('#utilidad').val(total)
	});
$('#otros').keyup(function(){
	var subtotal= $('#subtotal').val();
	var subtotal2= Number(subtotal.replace(/[^0-9\.]+/g,""));
	var bna= $('#bna').val();
	var fomento= $('#fomento').val();
	var fletes= $('#fletes').val();
	var otros= $('#otros').val();
	var totale= $('#totale').val();
	var total=numberWithCommas(subtotal2-bna-fomento-fletes-otros);
	var neta=numberWithCommas(subtotal2-bna-fomento-fletes-otros-totale);
	$('#total_desc').val(total)
	$('#ganancia').val(neta)
	var porcentaje= $('#porcentaje').val()/100;
	var ganancia= $('#ganancia').val();
	var ganancia= Number(ganancia.replace(/[^0-9\.]+/g,""));
	var total=numberWithCommas(ganancia*porcentaje);
	$('#utilidad').val(total)
	});
	
$('#porcentaje').keyup(function(){
	var ganancia= $('#ganancia').val();
	var ganancia= Number(ganancia.replace(/[^0-9\.]+/g,""));
var porcentaje= $('#porcentaje').val()/100;
	var total=numberWithCommas(ganancia*porcentaje);
	$('#utilidad').val(total)
	});

function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 
function numberWithCommas(n) {
    var parts=n.toString().split(".");
    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
}
</script>