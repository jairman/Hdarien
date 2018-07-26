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

date_default_timezone_set('America/Bogota');
$c_date = date('Y-m-d');

/*variable para definir que funcion se va a realizar*/
$action=$_POST["action"];

mysql_select_db($database_conexion, $conexion);

//--------------------------------
// invent_reg.php
//--------------------------------

if (isset($_GET['getref'])){
	$ref=$_GET["getref"];
	
	$newProd = mysql_query("SELECT  *
	FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ") 
	or die(mysql_error());
	$rows = array();
	while($r = mysql_fetch_assoc($newProd)) {
		$rows[] = $r;
	}
	if($newProd){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getbarcod'])){
	$code=$_GET["getbarcod"];
	
	$newProd = mysql_query("SELECT * FROM `h01sg_producto` WHERE `cod_barra`='$code' AND `delete`<>1 ") 
	or die(mysql_error());
	$rows = array();
	while($r = mysql_fetch_assoc($newProd)) {
		$rows[] = $r;
	}
	if($newProd){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getcantr'])){
	$ref=$_GET["getcantr"];
	$origen=$_GET["orig"];
	
	$searchCant = mysql_query("SELECT  `cant_final` FROM `h01sg_inventario` 
	WHERE `ref`='$ref' AND `punto_venta`='$origen' AND `delete`<>1 ") 
	or die(mysql_error());
	$cant = mysql_fetch_assoc($searchCant);
	if($searchCant){
		echo json_encode($cant);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getconsect'])){
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_despachos` 
	WHERE `delete`<>1 ORDER BY `consec` DESC ") or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['consec'];
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

if ($action == "new_desp"){
	$consec=$_POST["consec"];
	$cant=$_POST["cant"];
	$costo=$_POST["costo"];
	$fecha=$_POST["fecha"];
	$obs=$_POST["obs"];
	$puntov=$_POST["puntov"];
	$puntovd=$_POST["puntovd"];
	$user=$_POST["user"];
		
	$newDesp = mysql_query("INSERT INTO `h01sg_despachos`( `punto_ini`,`punto_venta`,`cant`, `obs`, `consec`, `costo`, `fecha`, 
	`user`) VALUES ('$puntov','$puntovd','$cant','$obs','$consec','$costo','$fecha','$user')") 
	or die(mysql_error());
	
	if($newDesp){
		echo "Se creo la factura de despacho";
	}
	else{
		echo "No se creo la factura de despacho";
	}
}

if ($action == "new_inventreg2"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$costo=$_POST["costo"];
	$fecha=$_POST["fecha"];
	$tipo=$_POST["tipo"];
	$mov=$_POST["mov"];
	$obs=$_POST["obs"];
	$pre=$_POST["pre"];
	$puntov=$_POST["puntov"];
	$puntovd=$_POST["puntovd"];
	$user=$_POST["user"];
		
	$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_ini`, `punto_venta`, `cant`, 
	`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntovd',
	'$cant','$obs','$pre','$consec','$costo','$fecha','$user')") 
	or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "new_cantreg2"){
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$mov=$_POST["mov"];
	$puntov=$_POST["puntov"];
	$puntovd=$_POST["puntovd"];
	$user=$_POST["user"];
	$tipo=$_POST["tipo"];
		
	$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($revref);
	//echo 'inv'.$n.' 2 ';
	if ($n >=1){
		$row_rev = mysql_fetch_assoc($revref);
		$canti = $row_rev['cant_trasl']-$cant;
		$tot = $row_rev['cant_final']-$cant;
		
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_trasl`='$canti',`cant_final`='$tot',
		`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
		
		$revref2 = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntovd' AND `delete`<>1  ")or die(mysql_error());
		$nn = mysql_num_rows($revref2);
		if ($nn > 0){
			$row_rev2= mysql_fetch_assoc($revref2);
			$cants = $row_rev2['cant_ini']+$cant;
			$tots = $row_rev2['cant_final']+$cant;
			$createinv =  mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$cants',`cant_final`='$tots',
			`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntovd' AND `delete`<>1")or die(mysql_error());
		}else{
			$createinv =  mysql_query("INSERT INTO `h01sg_inventario`(`ref`, `punto_venta`, `cant_ini`, `cant_final`, 
			`user`) VALUES ('$ref','$puntovd','$cant','$cant','$user')")or die(mysql_error());
		}
	}
}

if (isset($_GET['getconsecd'])){
	$ptov = $_GET['getconsecd'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `d89xz_diario` 
	WHERE `delete`<>1 AND `hacienda`='$ptov' ORDER BY `factura` DESC ") or die(mysql_error());
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

if ($action == "newDiario"){
	  $consec=$_POST["consec"];
	  $ced=$_POST["ced"];
	  $cliente=$_POST["cliente"];
	  $fpago=$_POST["fpago"];
	  $estado=$_POST["estado"];
	  $descr=$_POST["descr"];
	  $fecha_pago=$_POST["fecha_pago"];
	  $fecha=$_POST["fecha"];
	  $qty=$_POST["qty"];
	  $precio=$_POST["precio"];
	  $user=$_POST["user"];
	  $concepto = $_POST["concepto"];
	  $puntov = $_POST["puntov"];
	  $diario = $_POST["diario"];
	  
	  $setDiairoV = mysql_query(" INSERT INTO `d89xz_diario`(`fecha`, `factura`, `f_alarma`, `concep`,`consec_fact`, 
	  `estado`, `f_pago`, 
	  `valor`, `cliente`, `cedula`, `comentario`, `hacienda`, `user`) VALUES 
	  ('$fecha','$diario','$fecha_pago','$concepto','$consec','$estado','$fpago','$precio','$cliente','$ced','$descr',
	  '$puntov','$user') ") or die(mysql_error()); 
	  
	  if($setDiairoV){
		echo "Se creo el registro en la tabla de diario";
	  }
	  else{
		echo "No se creo el registro en la tabla de diario";
	  }
}


?>