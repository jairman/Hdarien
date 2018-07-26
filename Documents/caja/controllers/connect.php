<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
<?php

/*variable para definir que funcion se va a realizar*/
@$action=$_POST["action"];
mysql_select_db($database_conexion, $conexion);
//funcion para obtener los clientes, para el autocomplete
if ($action == "getCliente"){
		$cliente=$_POST['cliente'];
	 	$getCliente = mysql_query("SELECT `id`,`nombre` FROM `d89xz_clientes` WHERE `nombre` LIKE '%".mysql_real_escape_string($cliente)."%' ") or die(mysql_error());
	  	
		$rows = array();
		while($r = mysql_fetch_assoc($getCliente)) {
    		$rows[] = $r;
		}
		if($rows){
			echo json_encode($rows);
	  	}else{
			echo "No se obtuvo la lista de clientes";
	  	}
}

//funcion para obtener los clientes, para el autocomplete
if ($action == "getProveedor"){
		$cliente=$_POST['cliente'];
	 	$getCliente = mysql_query("SELECT `id`,`nombre` FROM `d89xz_prove` WHERE `nombre` LIKE '%".mysql_real_escape_string($cliente)."%' ") or die(mysql_error());
	  	
		$rows = array();
		while($r = mysql_fetch_assoc($getCliente)) {
    		$rows[] = $r;
		}
		if($rows){
			echo json_encode($rows);
	  	}else{
			echo "No se obtuvo la lista de clientes";
	  	}
}

/*funcion para sacar el numero de cedula del cliente*/
if ($action == "getCedulaC"){
	  $cliente=$_POST['cliente'];
	  $getCedula = mysql_query("SELECT `cedula`, `telefono`  FROM `d89xz_clientes` WHERE `nombre`='$cliente' ") or die(mysql_error()); 
	  $cedula = mysql_fetch_row($getCedula);   
	  if($getCedula){
		echo json_encode($cedula);
	  }
	  else{
		echo "No se obtuvo el numero de cedula";
	  }
}

/*funcion para sacar el numero de cedula del Proveedor*/
if ($action == "getCedulaP"){
	  $cliente=$_POST['cliente'];
	  $getCedula = mysql_query("SELECT `cedula`, `telefono`  FROM `d89xz_prove` WHERE `nombre`='$cliente' ") or die(mysql_error()); 
	  $cedula = mysql_fetch_row($getCedula);   
	  if($getCedula){
		echo json_encode($cedula);
	  }
	  else{
		echo "No se obtuvo el numero de cedula";
	  }
}
////////////////////////////////Insertar Diario /////////////////////////////////////////////////////////////////////////
if ($action == "pedido"){
	
		
	 
	echo $fecha=$_POST["fecha"];
	echo $cliente=$_POST["cliente"];
	echo $sucursal= $_POST["sucursal"];
	echo $estado=$_POST["estado"];
	echo $concepto=$_POST["concepto"];
	echo $cedula=$_POST["cedula"];
	echo $fechapago=$_POST["fechapago"];
	echo $formapago=$_POST["formapago"];
	echo $descrip=$_POST["descrip"];
	echo $valor_unt=$_POST["valor_unt"];
	echo $factura=$_POST["factura"];
	echo $lado=$_POST["lado"];
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
if ($concepto =='Egreso'){	

$valor_t = $valor_unt *  -1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion`, `comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$fecha}','{$cliente}','{$factura}','{$cedula}','{$fechapago}','{$usuario2}','{$sucursal}','{$formapago}'  ,4 ,'{$lado}' )",$conexion);
////  2 
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
if($estado=='Pendiente'){
		
$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha_actividad`,`fecha_ingreso`,`descripcion`,`actividad`,punto_venta,user,comen) VALUES ('{$fechapago}','{$fechapago}','Pago de Factura de Compra Pendiente N°.$factura','Compra De Caja ','{$sucursal}','{$usuario_resp}','Pago de Factura de Compra Pendiente N°.$factura')",$conexion);
		}
		
}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
if ($concepto =='Ingreso'){	
$valor_t = $valor_unt ;

///////////////////////------------------------------------------------------------------------------/////////////////
		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`  , `devolucion` , `comen`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$fecha}','{$cliente}','{$factura}','{$cedula}','{$fechapago}','{$usuario2}','{$sucursal}','{$formapago}'   ,4 ,'{$lado}')",$conexion);
///////////////////////------------------------------------------------------------------------------///////////////////////////////////////
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
	if($estado=='Pendiente'){
		
	$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha_actividad`,`fecha_ingreso`,`descripcion`,`actividad`,punto_venta,user,comen) VALUES ('{$fechapago}','{$fechapago}','Pago  Factura de Venta Pendiente N°.$factura','Venta De Caja ','{$sucursal}','{$usuario_resp}','Pago  Factura de Venta Pendiente N°.$factura')",$conexion);
		
		
		}
}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
if ($concepto == Base){	
$valor_t = $valor_unt ;

///////////////////////------------------------------------------------------------------------------/////////////////
		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`,`f_pago`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$fecha}','{$cliente}','{$factura}','{$cedula}','{$fechapago}','{$usuario2}','{$sucursal}','{$formapago}')",$conexion);
///////////////////////------------------------------------------------------------------------------///////////////////////////////////////
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
	if($estado==Pendiente){
		
	//	$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,jorn,hac,user) VALUES ('{$f_pago}','{$estado}','Venta Pendiente Pago de Factura N°.$factura','Venta De Caja ','{$f_pago}','{$hacienda}','{$usuario_resp}')",$conexion);
		
		
		}
}	
	
}
/*--------------------------------Consecutivo de la factura--------------------------------*/
if (isset($_GET['sucursal'])){
	 $sucursal = $_GET['sucursal'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `d89xz_diario` where `hacienda`='$sucursal'  ORDER BY factura DESC ") or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['factura'];
	if($factura1!=''){
		$factura2=$factura1;
	}else{
		$factura2=0;	
	}
	$factura=$factura2 + 1;

	if($factura){
		echo json_encode($factura);
	}else{
		echo "noexitoso";
	}
	return false;	
}
//-------------------------------------Abonos--------------------------------------------------------------------

if ($action == "abonos"){

$fecha=date("Y-m-d");
$date = strtotime($fecha);
@$factura = $_POST['factura'];
@$hacienda = $_POST['hacienda'];
//@$docum=$_GET['docu'];
@$abono=$_POST['abono'];
@$formapago=$_POST['formapago'];
@$fecha=$_POST['tf_fecha'];
@$comen=$_POST['comen'];

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
mysql_select_db($database_conexion, $conexion);
$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$hacienda'  ORDER BY factura DESC";
$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);
$totalRows_drio1 = mysql_num_rows($drio1);
		//if($coment){
			$factura1= $row_drio1['factura'];
			if($factura1!=''){
				$factura2=$factura1;
				
			}else{
				$factura2=1000000;	
			}
		//}

 $facturad=$factura2 + 1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

@$queEmp ="SELECT * FROM   d89xz_diario where factura='$factura' and hacienda ='$hacienda'";
		@$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		@$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombrep=$rowEmp['cliente'];
						@$concep=$rowEmp['concep'];
						@$clien=$rowEmp['cedula'];
						@$centr=$rowEmp['centro'];
						@$preve=$rowEmp['cedula'];
							
							
						}
					}
@$prevee="$nombrep";
@$prevee1="$concep";
@$concep1 = $concep;
@$cliente= $clien;
@$centro=$centr;
//echo $concep1;
/*if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {*/
	
	if($abono != 0){
$insertar = mysql_query("INSERT INTO `d89xz_abonos`( `orden`,`abono`,`fecha`,`empre`,`docu`,`hacienda`,`cuenta`) VALUES ('{$factura}','{$abono}','{$fecha}','{$comen}','{$prevee1}','{$hacienda}','{$formapago}')",$conexion);

if ($concep1=='Ingreso'){
				$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`user`,`hacienda`,`f_pago` , `devolucion`) VALUES ('Ingreso','Abono Factura $factura.$comen','Pago','{$abono}','{$fecha}','{$prevee}','{$facturad}','{$cliente}','{$usuario2}','{$hacienda}','{$formapago}'   ,3 )",$conexion);
				//`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`


			}else{
			$prove1=$preve;
				$abono1= $abono * -1;
				$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`user`,`hacienda`,`f_pago`, `devolucion`) VALUES ('Egreso','Abono Factura $factura.$comen','Pago','{$abono1}','{$fecha}','{$prevee}','{$facturad}','{$cliente}','{$usuario2}','{$hacienda}','{$formapago}'  ,3   )",$conexion);
				
				
			}

				

			}else{
								
			}
}

/*}*/
?>


