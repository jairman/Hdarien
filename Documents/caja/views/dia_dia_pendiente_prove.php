<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>

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

@$day_url=$_GET['d'];
@$month_url=$_GET['m'];
@$year_url=$_GET['y'];
$idc_url=$_GET['id'];

@$hac_url=$_GET['h'];
@$tipo_url=$_GET['t'];


mysql_select_db($database_conexion, $conexion);
@$query_clien = sprintf("SELECT * FROM d89xz_prove WHERE id ='$idc_url'", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
$id=$row_clien['cedula'];
$c_ced = $row_clien['cedula'];
$c_nombre = $row_clien['nombre'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facturas Pendientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/dia_dia_pendiente_prove.js" type="text/javascript"></script>



</head>
<body>

<table width="98%" border="0" align="center" cellspacing="0">
  <tr >
    <td width="858" align="left" ><div id="menu">
     <ul >
      <ul>
        <li><a href="../../proveedores/views/verProve.php?id=<?= $idc_url ?>" >Información del Provedor</a></li>
        <li><a href="../../proveedores/views/compras_ini.php?id=<?= $idc_url ?>">Historial de Facturación</a></li>
        <li> <a href="dia_dia_pendiente_prove.php?id=<?= $idc_url ?>"  class='active'>Cuentas Por Pagar</a> </li>
           
           
         
        
          </ul>
        </ul>
    </div>     </td>
    <td width="94" align="center">&nbsp;</td>
    <td width="58" align="left" >&nbsp;</td>
  </tr>
</table>
<div id="main">




<DIV ID="seleccion2">
  <p>
    <input type="hidden" id="tf_user" value="<?= $usuario2 ?>">
    <input type="hidden" id="tf_user2" value="<?= $usuario ?>">
    <input type="hidden" id="id" value="<?= $id ?>">
  </p>
 
  <p>&nbsp;</p>
<p>&nbsp;</p>
<table width="99%" border="1" align="center">
<tr>
<td><img src="../../../img/Logo.png" alt="" width="200" height="70" /></td>
<td align="center"><input name="imgb" type="image"  title="Imprimir" src="../../img/imprimir.png" alt=""  width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('seleccion2')"/></td>
</tr>
<tr>
<td colspan="2"  class="tittle">Cuentas Por Pagar</td>
</tr>
</table>

<table width="99%" border="1" align="center" cellspacing="0">
  <tr  class="subtitle">
    <th align="left" class="bold" >Nombre</th>
<td colspan="2" align="center" ><?= $c_nombre?></td>
    <td width="94" align="left" class="bold" >Cedula</td>
    <td width="152" align="center" ><?= $c_ced ?></td>
    <td width="58" align="center" >&nbsp;</td>
    <td width="159" align="center" >&nbsp;</td>
</tr>
  <tr  class="subtitle">
    <td width="149"  class="bold">Punto de Venta </td>
    <td width="192" align="center" ><?= @$hda=$_GET['hda'];
		
        if ($usuario2 == 'general'){
        ?>
      <select name="sl_hac" id="sl_hac" style="width:90%">
        <option value=" ">Seleccione</option>
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
      <input type="text" readonly="readonly" id="tf_hac" name="tf_hac" style="width:90%" value="<?= $usuario2 ?>" />
      <?php
        }
        ?></td>
    <td width="144" align="center" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" class="bold" >  Desde  </td>
    <td align="center" ><input  name="tf_fecha" type="text" id="tf_fecha" style="width:80%"  value="<?= date('Y-m-d') ?>" /> </td>
    <td align="left" class="bold" >&nbsp; Hasta &nbsp;</td>
    <td align="center" ><input  name="tf_fecha2" type="text" id="tf_fecha2" style="width:80%"       oninvalid="setCustomValidity('Esta fecha debe ser MAYOR  a la Inicial')"    value="<?= date('Y-m-d') ?>"/></td>
</tr>
</table>



<div id="seleccion11" >


 <input type="hidden" id="tf_fecha" value="<?= $usuario2 ?>">
  <input type="hidden" id="tf_fecha2" value="<?= $usuario ?>">
  <input type="hidden" id="id" value="<?= $id ?>">
<?php





 @$f1=$_GET['f1'];
 @$f2=$_GET['f2'];
 @$fecha= date("Y-m-d");
 $id=$_GET['id'];
	
 @$hda=$_GET['hda'];
	
	mysql_select_db($database_conexion, $conexion);
 $usuario_nivel;
	  if($usuario_nivel !='general'){
		 
		      if( $usuario_nivel !=''   &&  $f2 =='' ){
				  
				  echo "1".$usuario_nivel;
	  		 $query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE   estado = 'Pendiente' and  concep='Egreso' and	hacienda='$usuario_nivel' and cedula='$id'         ORDER BY factura desc";
			  }
	
	
	
	    if( $usuario_nivel!='general'   &&  $f2 !='' ){
			echo "2".$usuario_nivel.'-'.$f1.'-'.$f2;
			$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma       		    				,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   
						 and  concep='Egreso' and    hacienda='$usuario_nivel' and    fecha >= '$f1'  AND  fecha <='$f2'                   and cedula='$id'       ORDER BY factura desc"; 	
			
				  }
	
	
	  }
	  




	  
	    if($usuario_nivel =='general'){
		  //echo $usuario_nivel;
	  			
					if($hda !=' ' && $f2 !='' ) {
					//echo "1";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE  estado = 'Pendiente'   
						 and   concep='Egreso' and   hacienda='$hda'   and    fecha >= '$f1'  AND  fecha <='$f2'  and cedula='$id' ORDER BY factura desc"; 
				  }
				  
	  
				if($hda ==' ' && $f2 !='' ) {
					//echo "2";
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE  estado = 'Pendiente'   
						 and  concep='Egreso' and  fecha >= '$f1'  AND  fecha <='$f2' and cedula='$id'   ORDER BY factura desc"; 
				  }
				  
				  
				  if( $hda ==''   && $f2 =='' ){
				// echo "3".$id;
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      
						estado = 'Pendiente'   and concep='Egreso' and cedula='$row_clien[cedula]' 	ORDER BY factura desc"; 	
			
				  }
				  
				    if( $hda !=''   &&  $f2 =='' ){
					//echo "4".$usuario_nivel;
						$query_pen = "SELECT DISTINCT factura,cliente,estado,comentario,hacienda,f_pago,concep,f_alarma ,fecha,consec_fact  FROM d89xz_diario WHERE      estado = 'Pendiente'   
						 and  concep='Egreso' and    hacienda='$hda' and cedula='$id'    ORDER BY factura desc"; 	
			
				  }
				  
	  }


		$pen = mysql_query($query_pen, $conexion) or die(mysql_error());
		$row_pen = mysql_fetch_assoc($pen);
		$totalRows_pen = mysql_num_rows($pen);

//Detalle
			
			$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and 
									`hacienda` = '$row_pen[hacienda]'"); 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$total=$row['total'];			
			$tal1 = abs($total);
			
			//el total de abonos
			@$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]' and                	 											                                `hacienda`='$row_pen[hacienda]'");$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
					$total_abono1=$row_abono['total'];
					$total_abono2= abs($total_abono1);
					
			// Saldo
				$saldo1 = $tal1 - $total_abono1;
				$saldo =  number_format($saldo1);
	
	
	
	
	
	
	
?>

<table width="99%" border="1" align="center" cellspacing="0" id="t_suma">
  <tr align="center"   class="tittle" id="tittle">
    <td width="7%">Fecha </td>
    <td width="11%">Factura No</td>
    <td width="13%">Punto de Venta</td>
    <td colspan="2">  Fecha Pago</td>
    <td width="30%">Descripción</td>
    <td width="7%">Valor</td>
    <td width="7%">Saldo</td>
    <td width="6%">Abonar</td>
    <td width="4%">&nbsp;</td>
  </tr>
  <?php 
  				$i =1;
  
  do {
	 
	  
	   ?>
   
      <tr class="row" align="center" >
        <td   align="center" onClick="mostrar('compras_fact.php?c=<?= $row_pen['consec_fact'] ?>&p=<?= $row_pen['hacienda'] ?>&factura=<?= $row_pen['factura'] ?>')"><?= $row_pen['fecha']; ?></td>
      <td   align="center" onClick="mostrar('compras_fact.php?c=<?= $row_pen['consec_fact'] ?>&p=<?= $row_pen['hacienda'] ?>&factura=<?= $row_pen['factura'] ?>')"><?= $row_pen['factura']; ?></td>
      <td   align="center" onClick="mostrar('compras_fact.php?c=<?= $row_pen['consec_fact'] ?>&p=<?= $row_pen['hacienda'] ?>&factura=<?= $row_pen['factura'] ?>')" ><?= $row_pen['hacienda']; ?></td>
      <td colspan="2"   align="center" onClick="mostrar('compras_fact.php?c=<?= $row_pen['consec_fact'] ?>&p=<?= $row_pen['hacienda'] ?>&factura=<?= $row_pen['factura'] ?>')" >&nbsp;<?= $row_pen['f_alarma']; ?></td>   
      <td  align="center" onClick="mostrar('compras_fact.php?c=<?= $row_pen['consec_fact'] ?>&p=<?= $row_pen['hacienda'] ?>&factura=<?= $row_pen['factura'] ?>')" ><?= $row_pen['comentario']; ?></td>
      <td  align="right" onClick="mostrar('compras_fact.php?c=<?= $row_pen['consec_fact'] ?>&p=<?= $row_pen['hacienda'] ?>&factura=<?= $row_pen['factura'] ?>')"><?php 
				  $result12 = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and `hacienda` =                  '$row_pen[hacienda]'"); 
			      $row12 = mysql_fetch_array($result12, MYSQL_ASSOC);
			      $total12=$row12['total'];
	  
	              echo number_format (abs($total12));
	  
	   ?></td>
      <td align="right" > <label id="suma_<?= $i ?>"  class="costo">
      <?php
	  //Detalle

			$result = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_diario WHERE `factura` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]'"); 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$total=$row['total'];
			
			$tal1 = abs($total);
			//el total de abonos
			$result = mysql_query("SELECT SUM(`abono`) as total FROM  d89xz_abonos WHERE  `orden` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]'"); 
			$row_abono = mysql_fetch_array($result, MYSQL_ASSOC);
			@$total_abono1=$row_abono['total'];
			@$total_abono2= abs($total_abono1);
// Saldo
	@$saldo1 = $tal1 - $total_abono1;
	@$saldo =  number_format($saldo1);
	  
	  echo $saldo;
	/*____________________________________Termino de abono Cancela Factura-------------------------------*/  
	  if ($saldo <= 0){
			
	 /*$insertar1 = mysql_query("UPDATE `d89xz_diario` SET `estado`= 'Cancelada' where `factura` = '$row_pen[factura]' and `hacienda` = '$row_pen[hacienda]' ", $conexion);
	 
	 			mysql_select_db($database_conexion, $conexion);
				$query_prove = "SELECT * FROM `d89xz_diario` where `factura` = '$row_pen[factura]' ";
				$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
				$row_prove = mysql_fetch_assoc($prove);
				$totalRows_prove = mysql_num_rows($prove);
				$consec_fact=$row_prove['consec_fact'];
	 
	 
	 	 $insertar2 = mysql_query("UPDATE `h01sg_venta` SET `delete`= '9' where `consec`='$consec_fact' and `punto_venta`= '$row_pen[hacienda]' ", $conexion);
*/	 
	 
	 
	  }
	  

	
		
		
/*____________________________________________________________________________________________________________*/		
	   ?>
      
      </label></td>
      
      <td  align="center" onClick="mostrar('detalle_abono.php?factura=<?= $row_pen['factura']; ?>&hacienda=<?= $row_pen['hacienda']; ?>&concep=<?= $row_pen['concep']; ?>&cliente=<?= $row_pen['cliente']; ?>')" ><input name="imgb" type="image" src="../../img/Calculator.png" width="25" height="25" title="Abonar"  class="calc"/></td>
      
<td   align="center" >&nbsp;</td>
    </tr>
        <?php 
		
		$i ++;
		
		
		} while ($row_pen = mysql_fetch_assoc($pen)); ?>
        
        
        <tr class="row" align="center" >
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <td   align="center" >&nbsp;</td>
          <td width="8%"   align="center" >&nbsp;</td>
          <th width="7%"  align="center" >&nbsp;</th>
          <td colspan="3"  align="center" >&nbsp;</td>
          <td  class="row" align="center" style="font-weight: bold">&nbsp;</td>
<td  class="row" align="center" style="font-weight: bold">&nbsp;</td>
        </tr>
        <tr class="row" align="center" >
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <td   align="center" >&nbsp;</td>
        <th  align="center" >TOTAL</th>
        <td colspan="3"  align="center" ><label id="total_sum"></label>&nbsp;</td>
        <td   align="center" style="font-weight: bold">&nbsp;</td>
<td   align="center" style="font-weight: bold">&nbsp;</td>
      </tr>

</table>

<p>&nbsp;</p>
<table width="99%" align="center">
  <tr>
    <td align="center"><input name="button2" type="button" class="ext" id="button2" value="Cancelar" onclick="window.close();" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>


</DIV>
</div>

</body>
</html>
<?php
mysql_free_result($pen);
?>
