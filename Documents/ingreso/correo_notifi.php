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

mysql_select_db($database_conexion, $conexion);
$query_corr = "SELECT * FROM nomina_ingreso where final='00:00:00'";
$corr = mysql_query($query_corr, $conexion) or die(mysql_error());
$row_corr = mysql_fetch_assoc($corr);
$totalRows_corr = mysql_num_rows($corr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asistencia</title>
</head>


<?php
if($totalRows_corr > 0){
$mensaje.= "  
<table width='98%' border='1' align='center' cellspacing='0'>
  <tr>
    <td colspan='6' align='center' bgcolor='#fb7c1f' style='color: #FFF'><strong style='font-size: 16px'>Listado de empleados Sin Registro De Salida</strong></td>
  </tr>
  <tr align='center' bgcolor='#6b6b6b'>
  <td style='color: #FFF'><strong>Fecha</strong></td>
    <td style='color: #FFF'><strong>Cédula</strong></td>
	<td width='26%' style='color: #FFF'><strong>Nombre</strong></td>
    
    <td style='color: #FFF'><strong>Hora inicio</strong></td>
    <td style='color: #FFF'><strong>Hora Final</strong></td>
    <td style='color: #FFF'><strong>Sucursal</strong></td>
  </tr>";
  do { 
  $mensaje.= "  
    <tr>
	<td align='center'>$row_corr[fecha]</td>
      <td align='right'>$row_corr[cedulaorg]</td>
	   <td align='center'>";
	  
	  		mysql_select_db($database_conexion, $conexion);
			$query_corr1 = "SELECT * FROM nomina_valle WHERE id='$row_corr[cedula]'";
			$corr1 = mysql_query($query_corr1, $conexion) or die(mysql_error());
			$row_corr1 = mysql_fetch_assoc($corr1);
			$totalRows_corr1 = mysql_num_rows($corr1);
	  		
	  
      $mensaje.= " 
	   $row_corr1[nombre] 
      </td>
      
      <td align='center'>$row_corr[inicio]</td>
      <td align='center'>$row_corr[final]</td>
      <td align='center'>$row_corr[hacienda]</td>
    </tr>";
	
  }while ($row_corr = mysql_fetch_assoc($corr)); 
  
 $mensaje.= "    
</table>";



$docu1='gerencia@carnesdana.com';
//$docu1='juan.zapata@idsolutions-group.com';
//$email ir='azapata@profesionalesenimportacion.com';
//$docu1="gerencia@carnesdana.com"; //me envio una copia oculta
$sBCC="jair.quinto@idsolutions-group.com"; //me envio una copia oculta
//$sBCC="juan.zapata@idsolutions-group.com"; //me envio una copia oculta
$cabeceras .= 'From: CARNES DANA  <chigorodo@carnesdana.com>'."\r\n"; 
//if($hacienda=='CARNES DANA MD'){ $cabeceras .= 'From: CARNES DANA MD <itagui@carnesdana.com>'."\r\n"; }
//if($hacienda=='CARNES DANA APARTADO'){ $cabeceras .= 'From:  CARNES DANA APARTADO <apartado@carnesdana.com>'."\r\n"; }
$cabeceras .= "BCC: <$sBCC>\n"; //aqui fijo el BCC 
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
     
//Se manda el correo 
mail("$docu1","Listado de empleados Sin Registro De Salida", $mensaje, $cabeceras);  
//mail('jair.quinto@idsolutions-group.com',"Cotizacion Profesionales En Importacion", $mensaje, $cabeceras); 




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
}

mysql_free_result($corr);
?>
