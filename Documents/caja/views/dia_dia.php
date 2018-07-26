<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
<?php
//////////////////////// Acceso///
if ($acceso =='0'){
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
$dia=date("d");


////////////////////////////////////////////////////////////////////////
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



//--------------------------------------------------------------------------------------------------------------------

$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);

mysql_select_db($database_conexion, $conexion);
$query_fpago = "SELECT DISTINCT f_pago FROM d89xz_diario where fecha='$fecha'";
$fpago= mysql_query($query_fpago, $conexion) or die(mysql_error());
$row_fpago = mysql_fetch_assoc($fpago);
$totalRows_fpago = mysql_num_rows($fpago);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Caja</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/dia_dia.js" type="text/javascript"></script>



<body dir="ltr" lang="es-ES" xml:lang="es-ES">


<table width="98%" border="1" align="center" cellspacing="0">
  <tr >
    <th width="206" align="left" >&nbsp;</th>
    <td width="154" align="center" >&nbsp;</td>
    <td width="256" align="center" >&nbsp;</td>
    <td width="79" align="center" ><img src="../../img/money.png" width="48" height="48" onClick="agre1()"  title="Pago De Nomina" style="cursor:pointer"></td>
    <td width="66" align="center" ><!--<img src="../img/cierre.png" width="48" height="48"  title="Cierre Caja" style="cursor:pointer" />--><img src="../../img/dollar-icon.png" width="48" height="48" onClick="histo1()" title="Historial De Facturas Total" style="cursor:pointer" ></td>
    <td width="63" align="center" ><img src="../../img/historial.png" width="48" height="48" onClick="histo()" title="Historial De Facturas" style="cursor:pointer" /></td>
    <td width="83" align="center" ><img src="../../img/pendiente.png" width="48" height="48" onClick="pendi()" title="Facturas Pendientes" style="cursor:pointer" /></td>
    <td width="65" align="center" ><img src="../../img/productm.png" width="48" height="48" onClick="agre()"  title="Añadir Registro" style="cursor:pointer"/></td>
    <td width="82" align="center" ><img src="../../img/abonar2.png" width="48" height="48" onClick="agre2()"  title="Añadir Registros Multiples" style="cursor:pointer"/></td>
  </tr>
  <tr  class="tittle">
<td colspan="9" >Reporte De  Caja</td>
</tr>
<tr  class="subtitle">
  <td >&nbsp;</td>
  <td align="center" >Sucursal:</td>
  <td colspan="2" ><?= @$hda=$_GET['hda'];
		
        if ($usuario2 == 'general'){
        ?>
    <select name="sl_hac" id="sl_hac" style="width:98%">
      <option value="">Todas</option>
      <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
      <option value="<?= $row_hac['hacienda']?>"><?= $row_hac['hacienda1']?></option>
      <?php
        } 
        ?>
    </select>
    <?php 
        }else{
        ?>
    <input type="text" readonly id="tf_hac" name="tf_hac" style="width:98%" value="<?= $usuario2 ?>" />
    <?php
        }
        ?></td>
  <td align="right" >&nbsp; </td>
  <td colspan="4" align="center" >&nbsp;</td>
</tr>

</table>

<DIV ID="seleccion">

<div id="seleccion1" >
<?php
$anoss= date("Y"); // Year (2003)
$mess= date("m"); // Year (2003)
$dia=date("d");
 

 	mysql_select_db($database_conexion, $conexion);
	//echo $usuario2;
	if ($usuario2 == 'general'){
		if ($hda != ''){
			//echo 1;
			$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `estado`= 'Pago' and        		            YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and `hacienda`='$hda'  ");
			
		}else{
			//echo 2;
			$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `estado`= 'Pago' and             YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia'   ");
		}
	
	
	}else{
		//echo 3;
		$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `estado`= 'Pago' and YEAR(fecha) =       '$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and `hacienda`='$usuario2'  ");	
		
	}
$row = mysql_fetch_array($result, MYSQL_ASSOC);



?>

<table width="98%" border="1" align="center" cellspacing="0">

 
  <tr align="center"  class="tittle">
    <td width="65" >Factura</td>
    <td width="129" >Sucursal</td>
    <td width="167" >Origen</td>
    <td width="210" >Descripción</td>
    <td width="116" >Forma de Pago</td>
    <td width="89" >Concepto</td>
    <td width="81" >Total</td>
    <td width="134" >Estado</td>
    <td width="41" >Anular</td>
    </tr>
    <?php
    	mysql_select_db($database_conexion, $conexion);
	//echo $usuario2;
	if ($usuario2 == 'general'){
		if ($hda != ''){
			//echo 1;
			$query_drio = "SELECT DISTINCT factura,cliente,estado,f_pago,hacienda,concep FROM d89xz_diario WHERE    	            YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and `hacienda`='$hda'  ORDER BY             id DESC";
			
		}else{
			//echo 2;
			$query_drio = "SELECT DISTINCT factura,cliente,estado,f_pago,hacienda,concep FROM d89xz_diario WHERE               YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia'    ORDER BY id DESC";
		}
	
	
	}else{
		//echo 3;
		$query_drio = "SELECT DISTINCT factura,cliente,estado,f_pago,hacienda,concep FROM d89xz_diario WHERE                   YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and `hacienda`='$usuario2'    ORDER         BY id DESC";	
		
	}
	
		$drio = mysql_query($query_drio, $conexion) or die(mysql_error());
		$row_drio = mysql_fetch_assoc($drio);
		$totalRows_drio = mysql_num_rows($drio);
	
	
    
   do { ?>
  <?php
 @ $eco =$row["fecha"];
   ?> 
  <tr  class="row" align="center" id="fila_<?= $row_drio['factura']; ?>"  >
  
      <td width="65" onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"><?= $row_drio['factura']; ?></td>
      <td onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"><?= $row_drio['hacienda']; ?></td>
      <td onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"></a><?= $row_drio['cliente']; ?></td>
      <td onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');" align="center"><?php
	  
	  	mysql_select_db($database_conexion, $conexion);
		$query_hd = "SELECT * FROM d89xz_diario where factura='$row_drio[factura]' and hacienda='$row_drio[hacienda]'";
		$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
		$row_hd = mysql_fetch_assoc($hd);
		$totalRows_hd = mysql_num_rows($hd);
	  
	  
	   echo $row_hd['comentario']; 
	   
	   
	   ?></td>
      <td  align="center" onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"><?= $row_drio['f_pago']; ?></td>
      <td  align="center" onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"><?= $row_drio['concep']; ?></td>
      <td  align="center" style="font-size: 14px" onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"><?php
	  $result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `factura`= '$row_drio[factura]' and      
	  		hacienda ='$row_drio[hacienda]'  and f_pago='$row_drio[f_pago]'"); 
      $row = mysql_fetch_array($result, MYSQL_ASSOC);

	  echo number_format (abs ($row["total"]))
	    ?></td>
      <td  onClick="CrearEnlace('factura_diario.php?id=<?= $row_drio['factura']; ?>&hda=<?= $row_drio['hacienda']; ?>');"><?= $row_drio['estado']; ?></td>
      <td  >
       <?php //if($auto =='1'){ ?>
      <input name="imgb" type="image" src="../../img/erase.png" alt="" width="20" height="20" style="cursor:pointer"  onclick="anular('<?= $row_drio['factura']?>', '<?= $row_drio['hacienda']?>', '<?= $row_drio['concep']?>')" />
       <?php //} ?>
      </td>
      </tr>
    <?php } while ($row_drio = mysql_fetch_assoc($drio)); ?>
</table>

<table width="98%" border="1">
  <tr>
    <td><table width="100%" align="left">
      <tr>
        <td height="59" colspan="8" align="center" class="tittle">Resumen</td>
      </tr>
      <tr class="tittle">
        <td width="15%" rowspan="2" align="center">Forma De Pago</td>
        <td colspan="3" align="center">Ingresos</td>
        <td colspan="3" align="center">Egresos</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr class="tittle">
        <td width="14%" align="center">Ventas</td>
        <td width="12%" align="center">Recibo Caja</td>
        <td width="14%" align="center">Abonos</td>
        <td width="12%" align="center">Compras</td>
        <td width="16%" align="center"><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
          <!--  		@page { margin: 2cm }  		p { margin-bottom: 0.25cm; line-height: 120% }  	-->
          <p>Comprobante Egreso</p></td>
        <td width="9%" align="center">Abonos</td>
        <td width="8%" align="center">Base</td>
      </tr>
      <?php do { ?>
      <tr class="row">
        <td align="left"><?= $row_fpago['f_pago']; ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and  devolucion ='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'   and devolucion !='3'  and  devolucion !='4'  ", $conexion);
			}else{
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'   and devolucion !='3'  and  devolucion !='4'   ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4'   ",$conexion);
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2= ($row072["total"]);
	echo  number_format(abs($Total2));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ", $conexion);
			}else{
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'   ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2= ($row072["total"]);
	echo  number_format(abs($Total2));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli3 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Base'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado='Base'  ", $conexion);
			}else{
					$juli3 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Base'
					               and f_pago='$row_fpago[f_pago]' and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado='Base'  ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli3 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Base' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and f_pago='$row_fpago[f_pago]' and 
							 estado='Base'  ",$conexion);
			 
		 }
		
	 @$row0723 = mysql_fetch_array($juli3, MYSQL_ASSOC);
    @$Total3= ($row0723["total"]);
	//if($Total3 ==''){
		
		echo  number_format(abs($Total3));
	//}
		
        ?></td>
      </tr>
       <?php } while ($row_fpago = mysql_fetch_assoc($fpago)); ?>
       <tr class="bold">
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
         <td align="right">&nbsp;</td>
       </tr>
       <tr class="row">
        <td align="right"><strong>Sub Total:</strong></td>
        <td align="right"><strong>
          <?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' and  devolucion !='5'   and   f_pago !='Consignación'  and   f_pago !='Saldo'    ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' and  devolucion !='5'    and   f_pago !='Consignación'  and   f_pago !='Saldo'   ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' and  devolucion !='5'    and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINV= ($row07["total"]);
	echo  number_format(abs($TotalINV));
		
		
        ?>
        </strong></td>
        <td align="right"><strong>
          <?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4' ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and  devolucion ='4' ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and  
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINC= ($row07["total"]);
	echo  number_format(abs($TotalINC));
		
		
        ?>
        </strong></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Ingreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Ingreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINA= ($row07["total"]);
	echo  number_format(abs($TotalINA));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4' and  devolucion !='5'    and   f_pago !='Consignación'  and   f_pago !='Saldo'   ", $conexion);
			}else{
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion !='3'  and  devolucion !='4'and  devolucion !='5'    and   f_pago !='Consignación'  and   f_pago !='Saldo'    ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'   and devolucion !='3'  and  devolucion !='4' and  devolucion !='5'   and   f_pago !='Consignación'  and   f_pago !='Saldo'   ",$conexion);
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2C= ($row072["total"]);
	echo  number_format(abs($Total2C));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					              and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ", $conexion);
			}else{
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					               and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'   ", $conexion);
			}
		
		 }else{
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and   devolucion ='4'  ",$conexion);
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2R= ($row072["total"]);
	echo  number_format(abs($Total2R));
		
		
        ?></td>
        <td align="right"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
					                and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}else{
					$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
					             and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND 
								   DAY(fecha) = '$dia' and estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ", $conexion);
			}
		
		 }else{
			 
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and devolucion='3'  ",$conexion);
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total2A= ($row07["total"]);
	echo  number_format(abs($Total2A));
		
		
        ?></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr class="row">
        <td align="right">TOTAL</td>
        <td colspan="3" align="center" style="color: #093"><?= number_format($finalingresos = $TotalINA + $TotalINC + $TotalINV )?></td>
        <td colspan="3" align="center" style="color:#F00"><?= number_format(abs($finalegresos =   $Total2A + $Total2C + $Total2R) )?></td>
          
        <td align="right">&nbsp;</td>
      </tr>
      <tr class="row">
        <td align="right">SUBTOTAL EFECTIVO</td>
        <td colspan="3" align="center" style="color: #093"><strong>
          <?php
		 if ($usuario2 == 'general'){
			if($hda !=''){ 
			// echo"uno".'-';
				$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND 
					concep='Ingreso' and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND  DAY(fecha) = '$dia' and 
					estado!='Anulada'  and  estado !='Cancelada'  and   f_pago !='Consignación'  and   f_pago !='Saldo'                     and  f_pago ='Efectivo' ", $conexion);
					 
		//-------------------------------------------------------------------------------------------------------------------
				$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND 
					concep='Base' and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND  DAY(fecha) = '$dia' and 
					estado!='Anulada'  and  estado !='Cancelada'  and   f_pago ='Base' ", $conexion);
					 	 					   
			}else{
				//echo"dos".'-';
				$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  
					concep='Ingreso' and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND  DAY(fecha) = '$dia' and 
					estado!='Anulada'  and  estado !='Cancelada'  and   f_pago !='Consignación'  and   f_pago !='Saldo' and  
					 f_pago ='Efectivo' ", $conexion);
					 
		//-------------------------------------------------------------------------------------------------------------------
				$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  
					concep='Base' and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND  DAY(fecha) = '$dia' and 
					estado!='Anulada'  and  estado !='Cancelada'  and   f_pago ='Base' ", $conexion);					   
			}		
		 }else{
			// echo"tres".'-';
			
			
	$juli25 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  
		concep ='Ingreso' and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and f_pago ='Efectivo'   ",$conexion);
//----------------------------------------------------------------------------------------------------------------

$juli255 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  `hacienda`='$usuario2' AND
					concep='Base' and  YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND  DAY(fecha) = '$dia' and 
					estado!='Anulada'  and  estado !='Cancelada'  and   f_pago ='Base' ", $conexion);	
			
			 
		 }
		
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$TotalINV1= ($row07["total"]);
	//echo  number_format(abs($TotalINV1));
	//---------------------------------------------------------
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$TotalINV12= ($row072["total"]);
	//_-------------------------------------------_
	
	 @$row025 = mysql_fetch_array($juli25, MYSQL_ASSOC);
    @$TotalINV25= ($row025["total"]);
	//echo  number_format(abs($TotalINV1));
	//---------------------------------------------------------
	 @$row0255 = mysql_fetch_array($juli255, MYSQL_ASSOC);
    @$TotalINV255= ($row0255["total"]);
	//_--------------------------------------------------_
	//echo  number_format(abs($TotalINV12));	
	$finalingre=$TotalINV1+$TotalINV12+$TotalINV25+$TotalINV255;
	
		echo  number_format(abs($finalingre));
        ?>
        </strong></td>
        <td colspan="3" align="center" style="color:#F00"><?php
		 if ($usuario2 == 'general'){
			if($hda !=''){
				// echo"uno".'-'; 
		$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
		      and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and estado !='Anulada'  and  
			  estado !='Cancelada'    and f_pago ='Contado' ", $conexion);
//----------------------------------------------------------------------------------------------------------------

$juli22 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$hda' AND concep ='Egreso'
		      and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and estado !='Anulada'  and  
			  estado !='Cancelada'    and f_pago ='Efectivo' ", $conexion);			  
			  
			}else{
				// echo"dos".'-';
					$juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
		      and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and estado !='Anulada'  and  
			  estado !='Cancelada'    and f_pago ='Contado' ", $conexion);
//----------------------------------------------------------------------------------------------------------------

$juli22 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where  concep ='Egreso'
		      and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and estado !='Anulada'  and  
			  estado !='Cancelada'    and f_pago ='Efectivo' ", $conexion);
								   
			}
		
		 }else{
			 // echo"tres".'-';
			// echo "Hola";
			 $juli2 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND  concep ='Egreso' and 
			                 YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and 
							 estado !='Anulada'  and  estado !='Cancelada'  and f_pago ='Efectivo'   ",$conexion);
//----------------------------------------------------------------------------------------------------------------

$juli223 = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$usuario2' AND concep ='Egreso'
		      and YEAR(fecha) ='$anoss' AND MONTH(fecha) = '$mess' AND DAY(fecha) = '$dia' and estado !='Anulada'  and  
			  estado !='Cancelada'    and f_pago ='Contado' ", $conexion);							 
							 
			 
		 }
		
	 @$row072 = mysql_fetch_array($juli2, MYSQL_ASSOC);
    @$Total2C1= ($row072["total"]);
	//echo  number_format(abs($Total2C1));
	//-------------------------------------
	@$row0722 = mysql_fetch_array($juli22, MYSQL_ASSOC);
    @$Total2C12= ($row0722["total"]);
	//-------------------------------------
	@$row07223 = mysql_fetch_array($juli223, MYSQL_ASSOC);
    @$Total2C123= ($row07223["total"]);
	$finaegre=$Total2C1 + $Total2C12+ $Total2C123;
	echo  number_format(abs($finaegre));
		
		
        ?></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr class="row">
        <td align="right">TOTAL EFECTIVO</td>
        <td colspan="6" align="center" ><?= number_format($finaegre + $finalingre) ?></td>
        <td align="right">&nbsp;</td>
      </tr>
     
    </table></td>
  </tr>
</table>
 </div>
</DIV> 
<div id="dialog" ></div>
<!------------------- Anular------------------>
<div id="dialog2" title="Anular Factura">
<form action="" id="formulario" method="post">
<input type="hidden" id="f" >
<input type="hidden" id="h" >
<input type="hidden" id="c" >
<table align="center" width="90%">
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td align="right" class="bold" width="50%">Comentario</td>
  <td class="cont" width="50%">
    <input name="comen" type="text" class="long" id="comen"style="width:95%" />
    </td>
</tr>
<tr>
  <td align="center">
    <img id="theImg" src="../../img/good.png" width="48" height="48" 
    style="cursor:pointer" onclick="insert_anular();return false" title="Aceptar"/>
    </td>
  <td align="center">
    <img src="../../img/erase.png" width="48" height="48" 
    style="cursor:pointer" onclick="cerrar_dialogo2()" title="Pago en Tarjeta" />
    
    </td>
</tr>
</table>
</form>
</div>

<!------------------Fin Anular---------------->
</body>
</html>
<?php
mysql_free_result($drio);

mysql_free_result($cli);

mysql_free_result($prove);

mysql_free_result($fpago);

mysql_close($conexion);
?>
<?php }else{ ?>


<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo.png" width="886" height="408" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>

<?php } ?>
