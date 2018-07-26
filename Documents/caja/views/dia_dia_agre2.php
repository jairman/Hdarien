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

/*mysql_select_db($database_conexion, $conexion);
$query_drio = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY id DESC";
$drio = mysql_query($query_drio, $conexion) or die(mysql_error());
$row_drio = mysql_fetch_assoc($drio);
$totalRows_drio = mysql_num_rows($drio);*/

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_clientes where  `delete`= '0'";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);

mysql_select_db($database_conexion, $conexion);
$query_prove = "SELECT * FROM d89xz_prove where  `delete`= '0'";
$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
$row_prove = mysql_fetch_assoc($prove);
$totalRows_prove = mysql_num_rows($prove);

//echo $usuario2;
mysql_select_db($database_conexion, $conexion);
if ($usuario2 == 'general'){
       
      	    $query_centro = "SELECT * FROM d89xz_prove where  `delete` = '0'";
                 
        }else{
      		$query_centro = "SELECT * FROM d89xz_prove where  `delete` = '0'";  
          
	         }
        
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);

//echo $fecha;
//$date = strtotime($fecha);
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
<script src="../js/dia_dia_agre2.js" type="text/javascript"></script>

<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/jquery.mask.js" type="text/javascript"></script>



		
</head>

<body>
<input name="gen" id="gen" type="hidden" value="<?php echo $usuario2 ?>" />
<DIV ID="seleccion">
  
   <form id="formulario" name="formulario" method="post" action="">
   <input name="concepto" id="concepto" type="hidden" value="Egreso" />
  <table width="90%" border="1" align="center" cellspacing="0">
    <tr>
      <td colspan="6" align="center"  class="tittle">Detalle Factura </td>
    </tr>
    <tr >
      <th width="102" align="left" class="bold">Sucursal</th>
      <th width="184" align="center" class="cont"><?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_hac" id="sl_hac" style="width:98%" required="required">
          <option value=""  >Seleccione</option>
          <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
          <option value="<?php echo htmlspecialchars($row_hac['hacienda'])?>"><?php echo htmlspecialchars($row_hac['hacienda1'])?></option>
          <?php
        } 
        ?>
        </select>
        <?php 
        }else{
        ?>
        <input type="text" readonly="readonly" id="tf_hac" name="tf_hac" style="width:95%" value="<?php echo htmlspecialchars($usuario2) ?>" />
        <?php
        }
        ?></th>
      <td width="182" align="left" class="bold">Fecha Factura</td>
      <td colspan="3" class="cont"><input type="text" name="tf_fecha" id="tf_fecha"  value="<?php echo date ('Y-m-d') ?>" style="width:95%" /></td>
    </tr>
    <tr align="center" class="tittle">
      <td colspan="3" >CuotasDescripcion</td>
      <td width="178" colspan="2">Valor Unitario</td>
      <td>Valor Total</td>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip" type="text" id="descrip"  style="width:98%" value="VENTA COMIDA" readonly="readonly" />       
        <input name="cantidad" type="hidden" id="cantidad" style="width:98%" value="1" />      </th>
      <th colspan="2" class="cont"><input name="valor_unt" type="text" id="valor_unt" style="width:98%" onkeyup="checkNum(this)" required="required"/>
      </th>
      <th width="182" class="cont"><input name="tal1" type="text" id="tal1" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip2" type="text" id="descrip2" style="width:98%" value="COMPRA COMIDA" readonly="readonly"/>        <input name="cantidad2" type="hidden" id="cantidad2" style="width:98%" value="1" /></th>
      <th colspan="2" class="cont"><label for="valor_unt2"></label>
        <input name="valor_unt2" type="text" id="valor_unt2" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal2" type="text" id="tal2" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip3" type="text" id="descrip3" style="width:98%" value="VENTA HOTEL" readonly="readonly" />        <input name="cantidad3" type="hidden" id="cantidad3" style="width:98%" value="1"  /></th>
      <th colspan="2" class="cont"><input name="valor_unt3" type="text" id="valor_unt3" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal3" type="text" id="tal3" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip4" type="text" id="descrip4" style="width:98%" value="COMPRA HOTEL" readonly="readonly" />        <input name="cantidad4" type="hidden" id="cantidad4" style="width:98%" value="1" /></th>
      <th colspan="2" class="cont"><input name="valor_unt4" type="text" id="valor_unt4" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal4" type="text" id="tal4" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip5" type="text" id="descrip5" style="width:98%" value="VENTA ALMACEN" readonly="readonly" />        <input name="cantidad5" type="hidden" id="cantidad5" style="width:98%" value="1"  /></th>
      <th colspan="2" class="cont"><input name="valor_unt5" type="text" id="valor_unt5" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal5" type="text" id="tal5" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip6" type="text" id="descrip6" style="width:98%"  value="COMPRA ALMACEN" readonly="readonly"/></th>
      <th colspan="2" class="cont"><input name="valor_unt6" type="text" id="valor_unt6" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal6" type="text" id="tal6" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip7" type="text" id="descrip7" style="width:98%" value="VENTA BEBIDAS" readonly="readonly" /></th>
      <th colspan="2" class="cont"><input name="valor_unt7" type="text" id="valor_unt7" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal7" type="text" id="tal7" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip8" type="text" id="descrip8" style="width:98%" value="COMPRA BEBIDAS" readonly="readonly" /></th>
      <th colspan="2" class="cont"><input name="valor_unt8" type="text" id="valor_unt8" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal8" type="text" id="tal8" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr class="row">
      <th colspan="3" align="center" class="cont"><input name="descrip9" type="text" id="descrip9" style="width:98%"  value="ACPM" readonly="readonly"/></th>
      <th colspan="2" class="cont"><input name="valor_unt9" type="text" id="valor_unt9" style="width:98%"  onkeyup="checkNum(this)"  /></th>
      <th class="cont"><input name="tal9" type="text" id="tal9" readonly="readonly" style="width:98%" /></th>
    </tr>
    <tr>
      <td colspan="6" align="center">
        <input name="button" type="submit" class="ext" id="button" value="Aceptar" onclick="confirmar();return false;"/>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="button2" type="submit" class="ext" id="button2" value="Cancelar" onClick=" window.parent.Shadowbox.close();" /></td>
    </tr>
    </table>
 
  </form>
</DIV>
<div id="dialog" >

</div>


</body>
</html>
<?php
//mysql_free_result($drio);

mysql_free_result($cli);

mysql_free_result($prove);

mysql_free_result($centro);

@$descrip =$_POST['descrip'];
@$concepto =$_POST['concepto'];
@$estado =$_POST['estado'];
@$cantidad =$_POST['cantidad'];
@$valor_unt =$_POST['valor_unt'];
@$cliente =$_POST['tf_cedula'];
@$provedor=$_POST['tf_cedula'];
@$coment=$_POST['obser'];
@$f_pago=$_POST['tf_fecha2'];
@
$fecha=$_POST['tf_fecha'];

@$clientee=$_POST['tf_resp'];
@$prevee=$_POST['tf_resp'];

@$cuota1=$_POST['cuota'];
@$cuota2=$_POST['cuota2'];
@$cuota3=$_POST['cuota3'];
@$cuota4=$_POST['cuota4'];
@$cuota5=$_POST['cuota5'];

@$salario=$_POST['salario'];


 @$prin1 =$_POST['centro'];
 @list($color1,$vari1)=explode("/",$prin1);
 $provedorcentro =$vari1;
 $centro =$color1;
///////////////////////////////////////Hacienda/////////////////////////////////////////////////////////////////////

if($usuario2=='general'){
	@$hacienda=($_POST["sl_hac"]);
}else{
	@$hacienda=($_POST["tf_hac"]);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
mysql_select_db($database_conexion, $conexion);
$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$hacienda'  ORDER BY factura DESC";
$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);
$totalRows_drio1 = mysql_num_rows($drio1);
		if($valor_unt){
			$factura1= $row_drio1['factura'];
			if($factura1!=''){
				$factura2=$factura1;
				
			}else{
				$factura2=1000000;	
			}
		}

@$factura=$factura2 + 1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($valor_unt!= 0){
	
	
if ($valor_unt != ''){	

if($valor_unt !=''){
//////////////////////////////////////////////////////   ///////////////////////////////////////////////////////////	
	$valor_t = $valor_unt ;
	$valor_t1 = $valor_unt * $cantidad ;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Ingreso','{$descrip}','Pago','{$valor_t}','{$fecha}','Hotel Darien','{$factura}','35870115','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Restaurante' )",$conexion);
}
//// //////////////////////////////////    2   ///////////////////////////////////////////////////////////////////////////
@$descrip2 =$_POST['descrip2'];
@$cantidad2 =$_POST['cantidad2'];
@$valor_unt2 =$_POST['valor_unt2'];

if($valor_unt2 !=''){
	$valor_t2 = $valor_unt2 * -1;
	$factura2=$factura + 1;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Egreso','{$descrip2}','Pago','{$valor_t2}','{$fecha}','Altipal S.A','{$factura2}','800186960-6','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Restaurante' )",$conexion);
}
/////////////////////////////  3  //////////////////////////////////////////////////////////
@$descrip3 =$_POST['descrip3'];
@$cantidad3 =$_POST['cantidad3'];
echo "valor 3-".$valor_unt3 =$_POST['valor_unt3'];

if($valor_unt3 !=''){
	$valor_t3 = $valor_unt3;
	$factura3=$factura + 2;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Ingreso','{$descrip3}','Pago','{$valor_t3}','{$fecha}','Hotel Darien','{$factura3}','35870115','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Hotel' )",$conexion);
}
//////////////////////////////  4 /////////////////////////////////////////////////
@$descrip4 =$_POST['descrip4'];
@$cantidad4 =$_POST['cantidad4'];
@$valor_unt4 =$_POST['valor_unt4'];

if($valor_unt4 !=''){
	$valor_t4 = $valor_unt4 * -1;
	$factura4=$factura + 3;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Egreso','{$descrip4}','Pago','{$valor_t4}','{$fecha}','Altipal S.A','{$factura4}','800186960-6','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Hotel' )",$conexion);
}
///////////////////  5 //////////////////////

@$descrip5 =$_POST['descrip5'];
@$cantidad5 =$_POST['cantidad5'];
@$valor_unt5 =$_POST['valor_unt5'];
if($valor_unt5 !=''){
	$valor_t5 = $valor_unt5 * $cantidad5 * 1;
	$factura5=$factura +4;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Ingreso','{$descrip5}','Pago','{$valor_t5}','{$fecha}','Hotel Darien','{$factura5}','35870115','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Almacen' )",$conexion);

}
@$descrip6 =$_POST['descrip6'];
@$cantidad6 =$_POST['cantidad6'];
@$valor_unt6 =$_POST['valor_unt6'];
if($valor_unt6 !=''){
	$valor_t6 = $valor_unt6 * -1;
	$factura6=$factura +5;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Egreso','{$descrip6}','Pago','{$valor_t6}','{$fecha}','General','{$factura6}','1234567','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Almacen' )",$conexion);

}
@$descrip7 =$_POST['descrip7'];
@$cantidad7 =$_POST['cantidad7'];
@$valor_unt7 =$_POST['valor_unt7'];
if($valor_unt7 !=''){
	$valor_t7 = $valor_unt7 ;
	$factura7=$factura +6;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Ingreso','{$descrip7}','Pago','{$valor_t7}','{$fecha}','Hotel Darien','{$factura7}','35870115','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Bebidas' )",$conexion);

}

@$descrip8 =$_POST['descrip8'];
@$cantidad8 =$_POST['cantidad8'];
@$valor_unt8 =$_POST['valor_unt8'];
if($valor_unt8 !=''){
	$valor_t8 = $valor_unt8 * -1;
	$factura8=$factura +7;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Egreso','{$descrip8}','Pago','{$valor_t8}','{$fecha}','Lidis S.A','{$factura8}','7890','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Bebidas' )",$conexion);

}
@$descrip9 =$_POST['descrip9'];
@$cantidad9 =$_POST['cantidad9'];
@$valor_unt9 =$_POST['valor_unt9'];
if($valor_unt9 !=''){
	$valor_t9 = $valor_unt9 * -1 ;
	$factura9=$factura +8;
	$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('Egreso','{$descrip9}','Pago','{$valor_t9}','{$fecha}','General','{$factura9}','1234567','{$fechapago}','{$usuario2}','{$hacienda}','Efectivo'  ,4 ,'Bebidas' )",$conexion);

}

	
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";	
	
		

		
}

}
mysql_close($conexion);
?>

