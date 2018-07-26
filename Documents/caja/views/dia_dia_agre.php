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

/*mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM d89xz_costos where  `delete` = '0'";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);*/

$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);


$i = 1;

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
<script src="../js/dia_dia_agre.js" type="text/javascript"></script>

</head>

<body>

<DIV ID="seleccion">
  
   <blockquote>
   
   <input type="hidden" id="tf_i" value="<?php echo $i?>">
   <input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
    <input type="hidden" id="factura" value="">
   
   
   
     <form id="formulario" name="formulario" method="post" action="">
       <p>&nbsp;</p>
       <table width="95%" border="1" align="center" cellspacing="0" class="a">
         <tr>
           <td colspan="6" align="center"  class="tittle">Detalle Factura </td>
         </tr>
         <tr id="tittle">
           <th width="124" align="left" class="bold">Punto De Venta</th>
           <th width="275" align="center" class="cont">
            <label for="concepto"></label>
<?php
        if ($usuario2 == 'general'){
        ?>
<select name="sl_hac" id="sl_hac" style="width:98%" required="required" >
<option value="Todo">Todas</option>
<?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
<?php
        } 
        ?>
</select>
<?php 
        }else{
        ?>
<input type="text" readonly="readonly" id="tf_hac" name="tf_hac" style="width:98%" value="<?php echo $usuario2 ?>" />
<?php
        }
        ?></th>
           <td width="82" align="left" class="bold">Concepto</td>
           <td class="cont">
             
            <select name="concepto" style="width:98%" id="concepto" required="required" >
            <option>Seleccione</option>
            <option value="Egreso">Compra</option>
            <option value="Ingreso">Venta</option>
            
            </select>
            </td>
<td width="143" class="bold">Estado</td>
<td class="cont"><select name="estado" id="estado"   style="width:98%"  required="required"  >
    <option value="Pago">Pago</option>
    <option value="Pendiente">Pendiente</option>
    
    </select></td>
  </tr>
         <tr >
           <th align="left"  class="bold"><label id="lb_c1">Cliente:</label></th>
           <th align="center" class="cont"><input type="text" name="tf_resp" id="tf_resp" style="width:95%"></th>
           <td align="left" class="bold">Cedula / NIT</td>
           <td class="cont">
             <input type="text" name="tf_cedula" id="tf_cedula" 
        style="width:98%" align="center"
        required="required" 
        />
           </td>
           <td class="bold">Forma De Pago</td>
           <td class="cont"><select name="formapago" id="formapago"   style="width:98%"  required="required"  >
             <option value="Efectivo">Efectivo</option>
             <option value="Pac">Pac</option>
           </select></td>
         </tr>
         <tr >
           <th align="left" class="bold">Categoría</th>
           <th align="center" class="cont">
           	<select name="lado" id="lado"  style="width:98%">
                    <option value="">Seleccione</option>
                    <option value="Hotel">Hotel</option>
                    <option value="Restaurante">Restaurante</option>
                    <option value="Almacen">Almacen</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Otros">Otros</option>
             </select>
           </th>
           <td align="left" class="bold">Fecha  Factura</td>
           <td width="182" class="cont"><input type="text" name="tf_fecha" id="tf_fecha"  value="<?php echo date ('Y-m-d') ?>" style="width:98%" /></td>
           <td class="bold">Fecha Pago</td>
           <td width="182" class="cont"><input type="text" name="tf_fecha2" id="tf_fecha2"   style="width:98%" /></td>
         </tr>
       </table>
       <p>&nbsp;</p>
       <table width="95%" border="1" align="center" cellspacing="0" class="a" id="tb_prod">
         <tr align="center" class="tittle">
           <td >Articulo</td>
           <td width="372" >Descripcion</td>
           <td>Valor Unitario</td>
           <td>Valor Total</td>
           <td bgcolor="#FFFFFF"><span class="cont"><img src="../../img/add.png" alt="" width="20" height="20"  onclick="agregarFila()"/></span></td>
         </tr>
         
         
         <tr id="fila_<?php echo $i?>">
           <td width="135" align="center" class="bold"><?php echo $i ?></td>
           <td align="center" class="cont"><input name="descrip" type="text" id="descrip<?php echo $i?>"  style="width:98%"  class="a"/></td>
           <td width="183" class="cont"><input name="valor_unt" type="text" id="valor_unt<?php echo $i?>" style="width:98%" onKeyUp="checkNum(this),total('<?php echo $i?>')" /></td>
           <td width="305" class="cont"><input name="tal" type="text" id="tal<?php echo $i?>" readonly="readonly" style="width:98%" /></td>
           <td width="46" align="center" class="cont"><img src="../../img/erase.png" id="bt_img<?php echo $i?>" width="20" height="20" 
    style="cursor:pointer;" onClick="quitar('<?php echo $i?>')"></td>
         </tr>
         
       
         
         
         
         
         
       </table>
       <p>&nbsp;</p>
       <table width="80%">
         <tr>
          <td align="center"><input name="button2" type="submit" class="ext" id="button2" value="Aceptar"  onclick="confirmar();  return false" style="width:100px" /> &nbsp;&nbsp;<input type="submit" name="button1" id="button1" value="Cancelar"  onclick="window.parent.Shadowbox.close();" class="ext" style="width:100px"/></td>
         </tr>
       </table>
       <div id="dialog" >

		</div>
     </form>
   </blockquote>
</DIV>
</body>
</html>




<?php
//mysql_free_result($drio);
/*
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
$f_pago=$_POST['tf_fecha2'];
@$f_factu=$_POST['tf_fecha'];
@$centro=$_POST['centro'];
@$clientee=$_POST['tf_resp'];
@$prevee=$_POST['tf_resp'];
///////////////////////////////////////Hacienda/////////////////////////////////////////////////////////////////////

if($usuario2=='general'){
	$hacienda=$_POST['sl_hac'];
}else{
	$hacienda=$_POST['tf_hac'];
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
mysql_select_db($database_conexion, $conexion);
$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$hacienda'  ORDER BY factura DESC";
$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);
$totalRows_drio1 = mysql_num_rows($drio1);
		if($descrip){
			$factura1= $row_drio1['factura'];
			if($factura1!=''){
				$factura2=$factura1;
				
			}else{
				$factura2=1000000;	
			}
		}

$factura=$factura2 + 1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($valor_unt!= 0){
	
	
if ($concepto == Egreso){	
echo "<script type=''>
		alert('Registro Exitoso');
	</script>";

$valor_t = $valor_unt *  -1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$f_factu}','{$prevee}','{$factura}','{$provedor}','{$f_pago}','{$usuario_resp}','{$hacienda}')",$conexion);
////  2 


///////////////////////------------------------------------------------------------------------------///////////////////////////////////////
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,hac,user) VALUES ('{$f_pago}','{$estado}','Compra Pendiente Pago de Factura N°.$factura','Compra De Caja ','{$hacienda}','{$usuario_resp}')",$conexion);
		}
		
		
		
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
		
}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//



if ($concepto == Ingreso){	
echo "<script type=''>
		alert('Registro Exitoso');
	</script>";

$valor_t = $valor_unt ;

///////////////////////------------------------------------------------------------------------------/////////////////
		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$f_factu}','{$prevee}','{$factura}','{$provedor}','{$f_pago}','{$usuario_resp}','{$hacienda}')",$conexion);



///////////////////////------------------------------------------------------------------------------///////////////////////////////////////
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
	if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,jorn,hac,user) VALUES ('{$f_pago}','{$estado}','Venta Pendiente Pago de Factura N°.$factura','Venta De Caja ','{$f_pago}','{$hacienda}','{$usuario_resp}')",$conexion);
		
		
		}


echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
}


}
mysql_close($conexion);*/
?>

