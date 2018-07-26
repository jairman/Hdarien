<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>

<?php
if ($acceso !='0'){ 
//echo "hola ". $acceso;
?>
<table width="70%" align="center">
  <tr>
    <td><img src="img/Logo SAGA sin texto.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>

<?php 
} else {
//echo "hola ". $acceso;
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

@$day_url=$_GET['d'];
@$month_url=$_GET['m'];
@$year_url=$_GET['y'];

@$hac_url=$_GET['h'];
@$tipo_url=$_GET['t'];
@$order_url=$_GET['o'];
//echo "Holaa". date('d-m-Y',strtotime('-30 day')); 

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

//echo $hac_url.'-'.$year_url.'-'.$month_url.'-'.$day_url.'-'.$tipo_url;



mysql_select_db($database_conexion, $conexion);
$query_fpago = "SELECT DISTINCT f_pago FROM d89xz_diario";
$fpago = mysql_query($query_fpago, $conexion) or die(mysql_error());
$row_fpago = mysql_fetch_assoc($fpago);
@$f11=date('Y-m-d',strtotime('-1 day'));
@$f22=date('Y-m-d');
@$hda=$usuario2;
mysql_select_db($database_conexion, $conexion);
$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 `hacienda`='$hda' and fecha >= '$f11'  AND  fecha <='$f22'   order by factura desc  ";

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Caja  Historial</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/basc_hist.js" type="text/javascript"></script>

 
</head>

<body>
<p>
  <input type="hidden" id="tf_user" value="<?= $usuario2 ?>">
  <input type="hidden" id="tf_user2" value="<?= $usuario ?>">
</p>
<table width="98%" border="0" align="center" cellspacing="0">
  <tr >
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right">&nbsp;</td>
  </tr>
</table>

<DIV ID="seleccion">

<table width="98%"  align="center" id="table_header">
    <tr>
    <td width="91%" colspan="1" align="left" ><input name="imgb" type="image" src="../../../img/Logo.png" alt="logo"  width="200" height="70" id="logo" />
    </td>
    <td width="9%" colspan="3" align="center" valign="baseline"><input name="imgb2" type="image"   title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0"  style="cursor:pointer" onClick="imprimir_esto('seleccion')"/></td>
    </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr  class="tittle">
    <td width="182" >Punto de Venta</td>
    <td width="233" align="center" ><?= @$hda=$_GET['hda'];
		
        if ($usuario2 == 'general'){
        ?>
      <select name="sl_hac" id="sl_hac" style="width:90%">
        <option value=" ">Todas</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
        <option value="<?= $row_hac['hacienda']?>">
          <?= $row_hac['hacienda1']?>
          </option>
        <?php
        } 
        ?>
        </select>
      <?php 
        }else{
        ?>
      <input type="text" readonly id="tf_hac" name="tf_hac" style="width:90%" value="<?= $usuario2 ?>" />
      <?php
        }
        ?></td>
    <td width="65" align="left" >Concepto</td>
    <td width="148" align="left" >
    	<select name="concep" id="concep" style="width:90%">
        <option value=" ">Todos</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `concep` as hacienda , `concep` as hacienda1 FROM 
        `d89xz_diario` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
        <option value="<?= $row_hac['hacienda']?>">
          <?= $row_hac['hacienda1']?>
          </option>
        <?php
        } 
        ?>
        </select>
    </td>
    <td width="79" align="right" > Desde </td>
    <td width="145" align="left" ><input  name="tf_fecha" type="text" id="tf_fecha" style="width:80%"  value="<?= date('Y-m-d',strtotime('-1 day')) ?>" /></td>
    <td width="56" align="left" >&nbsp; Hasta &nbsp;</td>
    <td width="150" align="left" ><input  name="tf_fecha2" type="text" id="tf_fecha2" style="width:80%"       oninvalid="setCustomValidity('Esta fecha debe ser MAYOR  a la Inicial')"    value="<?= date('Y-m-d') ?>"/></td>
  </tr>
</table>

<div id="table" >    
<table width="98%" border="1" align="center" cellspacing="0">
    <tr>
    <td colspan="10" align="center" class="tittle">
    <label style="font-size:18px">
    Reporte  de Caja</label> </td>
    </tr>
    <tr class="tittle">
    <td width="91" align="center" onClick="orden_bus('factura')" style="cursor:pointer"
     				title="Ordenar por Factuta" >N° Factura</td>
    <td width="83" align="center" onClick="orden_bus('fecha')" style="cursor:pointer" 
    				title="Ordenar por Fecha" >Fecha</td>
    <td width="183" align="center"  onClick="orden_bus('cliente')" style="cursor:pointer"  	 
    				title="Ordenar por Cliente/Proveedor">Cliente/Proveedor</td>
    <td width="245" align="center"  onClick="orden_bus('comentario')" style="cursor:pointer" 
    				title="Ordenar por Comentario">Comentario</td>
    <td width="84"  onClick="orden_bus('valor')" style="cursor:pointer" title="Valor Total">Valor Total</td>
    <td width="76" align="center" onClick="orden_bus('concep')" style="cursor:pointer" 
    				title="Ordenar por Concepto">Concepto</td>
    <td width="68" align="center"  onClick="orden_bus('estado')" style="cursor:pointer"
    				 title="Ordenar por Estado">Estado</td>
    <td width="171" align="center" onClick="orden_bus('hacienda')" style="cursor:pointer"
    				 title="Ordenar por Sucursal">Sucursal</td>
    <td width="53" align="center" >Anular</td>
    </tr>
    
  <input type="hidden" id="tf_fecha" value="<?= $usuario2 ?>">
  <input type="hidden" id="tf_fecha2" value="<?= $usuario ?>"> 
	<?php
	echo $tipo_url;
	
	
 @$f1=$_GET['f1'];
 @$f2=$_GET['f2'];
 @$fecha= date("Y-m-d");
 @$hda=$_GET['hda'];
 @$concep=$_GET['con'];
mysql_select_db($database_conexion, $conexion);


	if($usuario_nivel !='general'){
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "-1a-";
		$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 `hacienda`='$hda' and fecha >= '$f1'  AND  fecha <='$f2' and concep='$concep'  order by factura desc  ";
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			  //  echo "1b__";
			  $query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 `hacienda`='$hda' and fecha >= '$f1'  AND  fecha <='$f2'  order by factura desc  ";
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	  	  
if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
 // echo $concep;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "-1a-";
		$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 `hacienda`='$hda' and fecha >= '$f1'  AND  fecha <='$f2' and concep='$concep'  order by factura desc  ";

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "-1b-";
		$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 `hacienda`='$hda' and fecha >= '$f1'  AND  fecha <='$f2'  order by factura desc  ";

	}
	//-----------------------------------------------------------------------------------
	
	
	if($hda ==' ' && $f2 !='' && $concep !=' ' ) {
		//echo "-1a-";
		$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 fecha >= '$f1'  AND  fecha <='$f2' and concep='$concep'  order by factura desc  ";

	  }
	  if($hda ==' ' && $f2 !='' && $concep ==' ' ) {
		//echo "-1b-";
		$query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
			 fecha >= '$f1'  AND  fecha <='$f2'  order by factura desc  ";

	  }
	  //-----------------------------------------------------------------------------------
	if( $hda ==''   && $f2 ==''   ){
	//echo "-3a-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		 $query_basc = "SELECT DISTINCT factura,estado,cliente,hacienda,fecha,concep FROM `d89xz_diario` where 
		 fecha >= '$f11'  AND  fecha <='$f22'  order by factura desc  ";
	  }
	
			  
}
	
	
	@$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
	//$row_basc = mysql_fetch_assoc($basc);
   	$num = mysql_num_rows($basc);
    while($row_basc = mysql_fetch_assoc($basc)){
    
     ?>
    
  
    <tr align="center"  class="row" >
    <td onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?= $row_basc['factura']; ?></td>
    <td  onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?= $row_basc['fecha']; ?></td>
    <td align="left"  onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"> <?= $row_basc['cliente']; ?></td>
    <td align="left"  onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?php
			
			mysql_select_db($database_conexion, $conexion);
			$query_hd = "SELECT * FROM d89xz_diario where factura='$row_basc[factura]' and hacienda='$row_basc[hacienda]'";
			$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
			$row_hd = mysql_fetch_assoc($hd);
			$totalRows_hd = mysql_num_rows($hd);
	
	 		echo $row_hd['comentario']; ?>
    
    
    </td>
    <td align="right"  onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?php 
	 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where `hacienda`='$row_basc[hacienda]' AND      factura = '$row_basc[factura]' ",$conexion);
	 @$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Total= ($row07["total"]);
	echo  number_format(abs($Total));
	
	 ?></td>
    <td  onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?= $row_basc['concep']; ?></td>
    <td onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?= $row_basc['estado']; ?></td>
    <td  onClick="CrearEnlace('factura_diario_h.php?id=<?= $row_basc['factura']; ?>&amp;hda=<?=  $row_basc['hacienda'] ?>');"><?= $row_basc['hacienda']; ?></td>
    <td colspan="3">
    <?php // if($auto =='1'){ ?>
      <input name="imgb3" type="image" src="../../img/erase.png" alt="" width="20" height="20" style="cursor:pointer"  onclick="anular('<?= $row_basc['factura']?>', '<?= $row_basc['hacienda']?>')" />
      <?php // } ?>
    </td>
    </tr>
   <?php 
    //linea para repetir el while mientras se cumpla la siguiente condicion
    }
    ?>  
    <tr class="row" >
      <td colspan="3" align="right"  >
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
   
</table>
<table width="98%" align="center">
  <tr>
    <td height="59" colspan="8" align="center" class="tittle">Resumen</td>
  </tr>
  <tr class="tittle">
    <td width="16%" rowspan="2" align="center">Forma De Pago</td>
    <td colspan="3" align="center">Ingresos</td>
    <td colspan="3" align="center">Egresos</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr class="tittle">
    <td width="13%" align="center">Ventas</td>
    <td width="12%" align="center">Recibo Caja</td>
    <td width="14%" align="center">Abonos</td>
    <td width="12%" align="center">Compras</td>
    <td width="16%" align="center">
      <p>Comprobante Egreso</p></td>
    <td width="9%" align="center">Abonos</td>
    <td width="8%" align="center">Base</td>
  </tr>
  <?php do { ?>
  <tr class="row">
    <td align="left"><?= $row_fpago['f_pago']; ?></td>
    <td align="right"><?php
	
	
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
			and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda'  ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
			and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda'  ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
		
if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !=''  ) {
		//echo "2a__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion !='3'  and  devolucion !='4'  ",             $conexion);
		

	  }

	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion !='3'  and  devolucion !='4' ",             $conexion);
		
	  }
			  
}	
				

    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
    @$Totalin= number_format ($row07in["total"]);
    echo $Totalin;
//	--------------------------- Fin Ingresos---------------------------------------------------------------------------
		
		
		
		
		
        ?></td>
    <td align="right"><?php
	
//-----------------------------------------------------------------------recibo Caja ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		    AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		    and devolucion ='4' and `hacienda`='$hda'  ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		    AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		    and devolucion ='4' and `hacienda`='$hda'  ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion ='4' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion ='4' and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !=''  ) {
		//echo "2__";
		$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and  devolucion ='4'  ",             $conexion);
		

	  }
	/*  if($hda ==' ' && $f2 !='' && $concep ==' ' ) {
		echo "2b__";
		$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion ='4' ",             $conexion);
		

	  }*/
	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion ='4' ",             $conexion);
		
	  }
			  
}	



		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07injuliabon = mysql_fetch_array($juliabon, MYSQL_ASSOC);
    @$TotalinC= number_format ($row07injuliabon["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin Recibo Cajas---------------------------------------------------------------------------	
		
        ?></td>
    <td align="right"><?php

//-----------------------------------------------------------------------Abono Ingresos ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juliab = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
			and  devolucion ='3' and `hacienda`='$hda' ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juliab = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
			and  devolucion ='3' and `hacienda`='$hda' ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliab = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		devolucion ='3' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliab = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and  devolucion ='3' and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !=''  ) {
		//echo "2__";
		$juliab = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and  devolucion ='3'  ",             $conexion);
		

	  }
	/*  if($hda ==' ' && $f2 !='' && $concep ==' ' ) {
		echo "2b__";
		$juliabon = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion ='4' ",             $conexion);
		

	  }*/
	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliab = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  
		and devolucion ='3' ",             $conexion);
		
	  }
			  
}	



	
	
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07in = mysql_fetch_array($juliab, MYSQL_ASSOC);
    @$TotalinC= number_format ($row07in["total"]);
    echo $TotalinC;
//---------------------- Fin  Abonos Ingreso---------------------------------------------------------------------------	
		
        ?></td>
    <td align="right"><?php
	

if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juliEgC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
			and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda' ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juliEgC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
			and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda' ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliEgC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliEgC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion !='3'  and  devolucion !='4' and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
	/*if($hda ==' ' && $f2 !='' && $concep !=' ' ) {
		//echo "2__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion !='3'  and  devolucion !='4' and concep='$concep' ",             $conexion);
		

	  }*/
	  if($hda ==' ' && $f2 !=''  ) {
		//echo "2__";
		$juliEgC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion !='3'  and  devolucion !='4' ",             $conexion);
		

	  }
	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliEgC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion !='3'  and  devolucion !='4' ",             $conexion);
		
	  }
			  
}	
		
		
			
	  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4'  ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4' ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion !='3'  and  devolucion !='4' ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4' ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' ", $conexion);
		  }
		
		   
	  }
    @$row07inEgC = mysql_fetch_array($juliEgC, MYSQL_ASSOC);
    @$TotalEn= number_format (abs($row07inEgC["total"]));
    echo $TotalEn;
//	----------------------------------------------- Fin Egresos---------------------------------------------------------------------------
		
		
		
		
		
        ?></td>
    <td align="right"><?php

//-----------------------------------------------------------------------recibo Caja ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
			and devolucion ='4' and `hacienda`='$hda' ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
			and devolucion ='4' and `hacienda`='$hda' ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='4' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='4' and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
	/*if($hda ==' ' && $f2 !='' && $concep !=' ' ) {
		//echo "2__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='4' and concep='$concep' ",             $conexion);
		

	  }*/
	  if($hda ==' ' && $f2 !='') {
		//echo "2__";
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='4' ",             $conexion);
		

	  }
	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='4' ",             $conexion);
		
	  }
			  
}	




	
	
	
	
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07inECC = mysql_fetch_array($juliECC, MYSQL_ASSOC);
    @$TotalEnC= number_format (abs($row07inECC["total"]));
    echo $TotalEnC;
//	----------------------------------------------- Fin Recibo Cajas---------------------------------------------------------------------------	
		
        ?></td>
    <td align="right"><?php

//-----------------------------------------------------------------------Abono EGRESOS ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
			and devolucion ='3' and `hacienda`='$hda'  ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
			and devolucion ='3' and `hacienda`='$hda'  ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='3' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='3' and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
/*	if($hda ==' ' && $f2 !='' && $concep !=' ' ) {
		//echo "2__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='3' and concep='$concep' ",             $conexion);
		

	  }*/
	  if($hda ==' ' && $f2 !='' ) {
		//echo "2__";
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='3' ",             $conexion);
		

	  }
	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		mysql_select_db($database_conexion, $conexion);
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliECC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  
		and devolucion ='3' ",             $conexion);
		
	  }
			  
}	
	
	
	
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07inECC = mysql_fetch_array($juliECC, MYSQL_ASSOC);
    @$TotalEGC= number_format (abs($row07inECC["total"]));
    echo $TotalEGC;
//	----------------------------------------------- Fin  Abonos ---------------------------
//-----------------------------------------Bse-----------------------------------	
		
        ?></td>
    <td colspan="3" align="right"><?php
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
			//echo "-1a-";
			$juliBase = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
			and `hacienda`='$hda'  ",$conexion);
			}
	  if( $hda !=' '   &&  $f2 !='' && $concep ==' ' ){
			//echo "1b__";
			$juliBase = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
			AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
			and `hacienda`='$hda'  ",$conexion);
		 
		    }
	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	

if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliBase = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
		and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliBase = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
		and `hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------------
	/*if($hda ==' ' && $f2 !='' && $concep !=' ' ) {
		//echo "2__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
		and concep='$concep' ",             $conexion);
		

	  }*/
	  if($hda ==' ' && $f2 !=''  ) {
		//echo "2__";
		$juliBase = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
		 ",             $conexion);
		

	  }
	  //------------------------------------------------------------------------------------------------
	if( $hda ==''   && $f2 =='' ){
		//echo "3__";
		mysql_select_db($database_conexion, $conexion);
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliBase = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  
		 ",             $conexion);
		
	  }
			  
}	




	
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' 
			  AND concep = 'Base'    ",$conexion);
		  }
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'    ",$conexion);
		  }
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  ",             $conexion);
		  }
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'  ", $conexion);
		  }
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ",$conexion);
		  }
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ",$conexion);
		  }
		  // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ", $conexion);
		  }		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' and f_pago='$row_fpago[f_pago]' AND concep = 'Base'   ", $conexion);
		  }
		
		   
	  }
    @$row07inbBase = mysql_fetch_array($juliBase, MYSQL_ASSOC);
    @$TotalEnCb= number_format (abs($row07inbBase["total"]));
    echo $TotalEnCb;
//	----------------------------------------------- FinBase------------------------------------------------
 //-------------------------------------------Cajas-----------------------------------------------------------	
		
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
    <td align="right">SUB TOTAL</td>
    <td align="right"><strong>
<?php

if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
			$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  
				and  devolucion !='4' and devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo' and
				f_pago!='Credito' and `hacienda`='$hda' ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  
				and  devolucion !='4' and devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo' and
				f_pago!='Credito' and `hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  
				and  devolucion !='4' and devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo' and
				f_pago!='Credito' and `hacienda`='$hda' ",$conexion);

	}
	
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-1-";
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  
				and  devolucion !='4' and devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo' and
				f_pago!='Credito'   ",$conexion);
		

	  }
	 
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
	//echo "-1-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  
				and  devolucion !='4' and devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo' and
				f_pago!='Credito'   ",$conexion);
		
	  }
			  
}
		
		/*  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  
			  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='3'  and  devolucion !='4' and  
			  devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_ur' and          
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion !='3'  and      	               devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo'  
			   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   
			 and devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  
			 and   f_pago !='Saldo'  ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'                AND concep = 'Ingreso'    and devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and  
			 f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			   `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'    and                devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  and   
			   f_pago !='Saldo'  ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and                devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   f_pago !='Consignación'  and   
			  f_pago !='Saldo'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			   MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion !='3'  and  devolucion !='4' and  devolucion !='5' and   
			   f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			 MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and `hacienda`='$hac_url' AND estado !='Anulada' 
			  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion !='3'  and  devolucion !='4' and                devolucion !='5' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		   
	  }*/
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
		$Totalin1=  ($row07in["total"]);
    @$Totalin= number_format ($row07in["total"]);
    echo $Totalin;
//	----------------------------------------------- Fin Sub Total---------------------------------------------------------------------------
		
		
        ?>
    </strong></td>
    <td align="right"><strong>
<?php
////-------------------------------------------------------recibo  Sub TotalCaja ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
		$juliRcS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'  and 
		`hacienda`='$hda' ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliRcS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'  and 
		`hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliRcS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'  and 
		`hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-1-";
		$juliRcS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'   ",$conexion);

	}
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
	//echo "-1-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliRcS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'   ",$conexion);
		
	  }
			  
}

		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07inRcS = mysql_fetch_array($juliRcS, MYSQL_ASSOC);
	@$TotalinC1=  ($row07inRcS["total"]);
    @$TotalinC= number_format ($row07inRcS["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin  Sub total Recibo Cajas---------------------------------------------------------------------------	
		
	
		
		
        ?>
    </strong></td>
    <td align="right"><?php
//-----------------------------------------------------------------Abono sub total Ingresos ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
		$juliAbS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='3'  and 
		`hacienda`='$hda'  ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
		if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliAbS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='3'  and 
		`hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliAbS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='3'  and 
		`hacienda`='$hda' ",$conexion);

	}
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-1-";
		$juliAbS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='3'   ",$conexion);

	  }
	
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
	//echo "-1-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliAbS = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'   and devolucion ='3'   ",$conexion);
		
	  }
			  
}	
	
	
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Ingreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Ingresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Ingresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Ingreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07inAbS = mysql_fetch_array($juliAbS, MYSQL_ASSOC);
	    @$TotalINV= ($row07inAbS["total"]);
    @$TotalinC= number_format ($row07inAbS["total"]);
    echo $TotalinC;
//	----------------------------------------------- Fin   sub totalAbonos Ingreso---------------------------------------------------------------------------	
	
		
		
        ?></td>
    <td align="right"><?php
	
//-----------------------------------------Sub Total Compras-----------------------------------------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
			$juliStC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='3'  
		and  devolucion !='4'  and   f_pago !='Consignación'  and   f_pago !='Saldo'  and 
		`hacienda`='$hda'  ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliStC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='3'  
		and  devolucion !='4'  and   f_pago !='Consignación'  and   f_pago !='Saldo'  and 
		`hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliStC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='3'  
		and  devolucion !='4'  and   f_pago !='Consignación'  and   f_pago !='Saldo'  and 
		`hacienda`='$hda' ",$conexion);

	}
	
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-1-";
		$juliStC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='3'  
				and  devolucion !='4'  and   f_pago !='Consignación'  and   f_pago !='Saldo'   ",$conexion);
		

	  }
	 
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
		mysql_select_db($database_conexion, $conexion);
		//echo "-1-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliStC = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='3'  
				and  devolucion !='4'  and   f_pago !='Consignación'  and   f_pago !='Saldo' 
				  ",$conexion);
		
	  }
			  
}	
	
	if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and 
			   estado !='Cancelada'  AND concep = 'Egreso'   and devolucion !='3'  and  devolucion !='4' and   
			   f_pago !='Consignación'  and   f_pago !='Saldo'  
			     ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' 
			  AND  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and devolucion !='3'  and                devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'   ",$conexion);
		  }
		 
		 
		    // Ingresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and             devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'              AND concep = 'Egreso'    and devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and            f_pago !='Saldo'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'
			 and devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",             $conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and             devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and   f_pago !='Saldo'  ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			  MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			 AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' and   f_pago !='Consignación'  and             f_pago !='Saldo'  ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			 MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and `hacienda`='$hac_url' AND estado !='Anulada'  and              estado !='Cancelada'  AND concep = 'Egreso'  and devolucion !='3'  and  devolucion !='4' and   
			 f_pago !='Consignación'  and   f_pago !='Saldo'  ", $conexion);
		  }
		
		   
	  }
    @$row07inStC = mysql_fetch_array($juliStC, MYSQL_ASSOC);
		 @$TotalEn1= (abs($row07inStC["total"]));
    @$TotalEn= number_format (abs($row07inStC["total"]));
    echo $TotalEn;
//	----------------------------------------------- Fin Egresos---------------------------------------------------------------------------
		
		
			
        ?></td>
    <td align="right"><?php

//--------------------------------------------------------------Sub Total recibo Caja ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
		$juliStCE = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='4'  and 
		`hacienda`='$hda'  ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliStCE = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='4'  and 
		`hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliStCE = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='4'  and 
		`hacienda`='$hda' ",$conexion);

	}
	
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-12-";
		mysql_select_db($database_conexion, $conexion);
		$juliStCE = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='4' ",$conexion);
		

	  }
	 
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
		mysql_select_db($database_conexion, $conexion);
		//echo "-1-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliStCE = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion ='4' 
				  ",$conexion);
		
	  }
			  
}	

		  
		  
		  
		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and devolucion ='4'  ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion ='4' ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion ='4' ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion ='4' ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion ='4' ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			   AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'  and devolucion ='4' ", $conexion);
		  }
		
		   
	  }
    @$row07inStCE = mysql_fetch_array($juliStCE, MYSQL_ASSOC);
	@$TotalEnC1=  (abs($row07inStCE["total"]));
    @$TotalEnC= number_format (abs($row07inStCE["total"]));
    echo $TotalEnC;
//	----------------------------------------------- Fin  Sub Total Recibo Cajas---------------------------------------------------------------------------	
		

		
        ?></td>
    <td align="right"><?php

//----------------------------------------------------Abono Sub  total EGRESOS ---------------------------------
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
		$juliStCA = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='3'  and 
		`hacienda`='$hda'  ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
		$juliStCA = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='3'  and 
		`hacienda`='$hda'  ",$conexion);

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
		//echo "1b__";
		$juliStCA = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='3'  and 
		`hacienda`='$hda' ",$conexion);

	}
	
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-12-";
		mysql_select_db($database_conexion, $conexion);
		$juliStCA = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso' and  devolucion ='3' ",$conexion);
		

	  }
	 
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
		mysql_select_db($database_conexion, $conexion);
		//echo "-1-";
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juliStCA = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and estado !='Cancelada' AND concep = 'Egreso'   and devolucion ='3' 
				  ",$conexion);
		
	  }
			  
}





		  if($hac_url =='Todo'){
		  //Solo Ingresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		
		
		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url=='' ){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND                
			  estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'   and devolucion='3'   ",$conexion);
		  }
		 
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion='3'  ",             $conexion);
		  }
		 
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND             MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url' AND estado !='Anulada'  and  estado !='Cancelada'   AND concep = 'Egreso'    and devolucion='3'  ", $conexion);
		  }
		
		 
	  }else{
		 //Solo Egresos y Egresos
		  if($year_url=='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where          
			      `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'    and devolucion='3'  ",$conexion);
		  }
		
		  		   // Egresos , Egresos y Años///////////////////////////////////////////////////
		  if($year_url!='' && $month_url=='' && $day_url==''){
			  $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND              `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'   and devolucion='3'  ",$conexion);
		  }
		
		 
		    // Egresos , Egresos , Años y Mes///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url=='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada' 
			  AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		
		    // Egresos , Egresos , Años , Mes Y Dia///////////////////////////////////////////////////
		  if($year_url!='' && $month_url!='' && $day_url!='' ){
			 $juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where YEAR(fecha) = '$year_url' AND  
			            MONTH(fecha)='$month_url' AND DAY(fecha) = '$day_url'  and            
						 `hacienda`='$hac_url' AND estado !='Anulada'  and  estado !='Cancelada'  AND concep = 'Egreso'  and devolucion='3'  ", $conexion);
		  }
		
		   
	  }
    @$row07inStCA = mysql_fetch_array($juliStCA, MYSQL_ASSOC);
	 @$TotalEGC1= (abs($row07inStCA["total"]));
    @$TotalEGC= number_format (abs($row07inStCA["total"]));
    echo $TotalEGC;
//	----------------------------------------------- Fin  Abonos Egreso---------------------------------------------------------------------------	
		
		
		
        ?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right" style="font-size: 12px">TOTAL MOVIMIENTOS</td>
    <td colspan="3" align="center" style="color: #093"><?= number_format($finalingresos = $Totalin1 + $TotalinC1 + $TotalINV )?></td>
    <td colspan="3" align="center" style="color:#AEB404"><?= number_format(abs($finalegresos =   $TotalEn1 + $TotalEnC1 + $TotalEGC1) )?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right" style="font-size: 12px">SUBTOTAL EFECTIVO</td>
    <td colspan="3" align="center" style="color: #093"><strong>
<?php
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
			$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo' and `hacienda`='$hda'  ",$conexion);
			   //________________________________________________________________________________________
		 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Base' and `hacienda`='$hda'  ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
	
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo' and `hacienda`='$hda'  ",$conexion);
			   //________________________________________________________________________________________
		 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Base' and `hacienda`='$hda'  ",$conexion);			

	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
					
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo' and `hacienda`='$hda' ",$conexion);
			   //________________________________________________________________________________________
		 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Base' and `hacienda`='$hda'   ",$conexion);		
		
		

	}
	
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-1-";
		
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo'  ",$conexion);
			   //________________________________________________________________________________________
		 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Base'    ",$conexion);		
		

	  }
	 
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
	//echo "-3-";
		 mysql_select_db($database_conexion, $conexion);	
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Ingreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo'  ",$conexion);
			   //________________________________________________________________________________________
		 $julib = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Base'    ",$conexion);
		
	  }
			  
}
    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
	$Totalin1=  ($row07in["total"]);
    
	//___________________________________________
	@$row07inb = mysql_fetch_array($julib, MYSQL_ASSOC);
	 $Totalin1b=  ($row07inb["total"]);
	 @$Totalin1bbI=  ($Totalin1+$Totalin1b);
   	@$Totalin1bb= number_format ($Totalin1+$Totalin1b);
	
    echo $Totalin1bb;
//	----------------------------- Fin Sub Total-------------------------------------------------------------
		
		
        ?>
    </strong></td>
    <td colspan="3" align="center" style="color:#AEB404"><strong>
<?php
if($usuario_nivel !='general'){
	 mysql_select_db($database_conexion, $conexion);
		
		if($hda !=' ' && $f2 !=''  ) {
			//echo "-1a-";
			$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo' and `hacienda`='$hda'  ",$conexion);
			}

	}
//*******++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


if($usuario_nivel =='general'){
 mysql_select_db($database_conexion, $conexion);	
  //echo $usuario_nivel.$hda;
		
	if($hda !=' ' && $f2 !='' && $concep !=' ' ) {
		//echo "1a__";
	
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo' and `hacienda`='$hda'  ",$conexion);
		
	}
	if($hda !=' ' && $f2 !='' && $concep ==' ' ) {
					
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo' and `hacienda`='$hda' ",$conexion);
		
	}
	
	//------------------------------------------------------------------------------------------
	if($hda ==' ' && $f2 !='' ) {
		//echo "-1-";
		
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f1'  AND  fecha <='$f2' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo'  ",$conexion);
		  }
	 
	//------------------------------------------------------------------------------------------ 
	if( $hda ==''   && $f2 =='' ){
	//echo "-3-";
		 mysql_select_db($database_conexion, $conexion);	
		$f11=date('Y-m-d',strtotime('-1 day'));
 		$f22=date('Y-m-d');
		$juli = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where fecha >= '$f11'  AND  fecha <='$f22' 
		        AND estado !='Anulada'  and  estado !='Cancelada' AND concep = 'Egreso'   and devolucion !='5'    
			   and  f_pago ='Efectivo'  ",$conexion);
		
		
	  }
			  
}	

    @$row07in = mysql_fetch_array($juli, MYSQL_ASSOC);
		$Totalin1E=  ($row07in["total"]);
    @$Totalin= number_format (abs($row07in["total"]));
    echo $Totalin;
//	----------------------------------------------- Fin Sub Total---------------------------------------------------------------------------
		
		
        ?>
    </strong></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="row">
    <td align="right" style="font-size: 12px">TOTAL EFECTIVO</td>
    <?php
    $final= number_format($Totalin1bbI + $Totalin1E);
		$final1=number_format(abs($Totalin1bbI + $Totalin1E));
	if($final>0){
			
		echo "<td colspan='6' align='center' style='color: #093'>$final1</td>";
	}else{
		echo "<td colspan='6' align='center' style='color: #FF0000'>$final1</td>";
	}
    ?>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</DIV>

</body>

</html>
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
    style="cursor:pointer" onClick="insert_anular();return false" title="Aceptar"/>
    </td>
  <td align="center">
    <img src="../../img/erase.png" width="48" height="48" 
    style="cursor:pointer" onClick="cerrar_dialogo2()" title="Pago en Tarjeta" />
    
    </td>
</tr>
</table>
</form>
</div>

<!------------------Fin Anular---------------->
<?php
@mysql_free_result($years_query);
@mysql_free_result($months_q);
@mysql_free_result($peso_tot_q);
}
?>