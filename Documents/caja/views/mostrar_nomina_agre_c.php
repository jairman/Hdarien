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


$fecha=$_POST['tf_fecha'];
//echo $fecha;
$date = strtotime($fecha);



$queEmp ="SELECT * FROM `d89xz_empleados` where esta !='no' ";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
if ($totEmp> 0) {
	while ($rowEmp = mysql_fetch_assoc($resEmp)) {
		$pago= $rowEmp['pago'];
		if($pago =='Pago'){
			
			$nombre=$rowEmp['nombre'];
			 $sede1= $rowEmp['hacienda'];
			 $valor= $rowEmp['sueldo']*-1;
			 $cedula= $rowEmp['cedula'];
			 $id= $rowEmp['id'];
			$descrip = "Pago Nomina";
			
			
			 	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `d89xz_diario` where `hacienda`='Hdarien'  ORDER BY factura DESC ") or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['factura'];
	if($factura1!=''){
		$factura2=$factura1;
	}else{
		$factura2=0;	
	}
	echo"factura". $factura=$factura2 + 1;

			
			
			
			
			
			$insertar1 = mysql_query("UPDATE  `d89xz_empleados` SET `pago`= 'Pendiente' WHERE `id` = '$id'", $conexion);
			
			$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`hacienda`,`fecha`,`cliente`,`factura`,`comen`,`cedula`,`f_pago`) VALUES ('Egreso','{$descrip}','Pago','{$valor}','Hdarien','$fecha','{$nombre}','{$factura}','{$sede1}','{$cedula}', 'Efectivo')",$conexion);
			
		
			}
		}
}
							//echo $sede1;

 
/*		
		
if ($tipo == Pago ){
	
	
		$queEmp ="SELECT * FROM  d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$factura=	$rowEmp['factura'];	
								
							}
					}
	
	
	$queEmp ="SELECT * FROM `d89xz_empleados` WHERE `cedula`= '$cedula'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);

					if ($totEmp> 0) {
							 
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$sueldo=	$rowEmp['sueldo'];
						$prestamo=	$rowEmp['s_total'];
						$bonificasiones= $rowEmp['bonifi'];
						
										
						}
					}
			
		
$descrip = "Pago Nomina : $nombre";
$concepto = Egreso;
$estado =Pago;
$cantidad =1;
$valor_unt =$valor;
$valor_t = $cantidad * $valor_unt * -1;


					


$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);	

echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";

}
*/ 

mysql_close($conexion);



?>
