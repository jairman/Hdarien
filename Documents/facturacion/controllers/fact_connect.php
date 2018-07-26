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

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");
$c_date = date('Y-m-d');

/*variable para definir que funcion se va a realizar*/
$action=$_POST["action"];

mysql_select_db($database_conexion, $conexion);

//--------------------------------
// fact_ini.php
//--------------------------------

if (isset($_GET['getcliente'])){
	$cliente=$_GET["getcliente"];
	
	$searchCliente = mysql_query("SELECT * FROM `d89xz_clientes` 
	WHERE `cedula`='$cliente' AND `delete`<>1 ") or die(mysql_error());
	
	$rows = array();
	while($r = mysql_fetch_assoc($searchCliente)) {
		$rows[] = $r;
	}
	if($searchCliente){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getref'])){
	$ref=$_GET["getref"];
	$orig=$_GET["orig"];
	if ($ref != ' '){
		$getRef = mysql_query("SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto` ON h01sg_inventario.ref=h01sg_producto.ref
		WHERE (h01sg_inventario.ref='$ref' OR h01sg_producto.cod_barra='$ref' OR h01sg_producto.rfid='$ref') 
		AND h01sg_inventario.delete<>1 AND h01sg_producto.delete<>1 AND h01sg_inventario.punto_venta='$orig' 
		AND h01sg_inventario.cant_final>0") or die(mysql_error());
	}
	$num = mysql_num_rows($getRef);
	if($num > 0){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getinfo'])){
	$ref=$_GET["getinfo"];
	$tipo=trim($_GET["tipo"]);
	
	if ($tipo == 'Mayor'){
		$getInfo = mysql_query("SELECT  `ref`, `fecha`, `cod_barra`, `rfid`, `marca`, `desc`, `talla`, `color`, `precio_mayo` as precio, `costo_und` 
	FROM `h01sg_producto` WHERE (`ref`='$ref' OR `cod_barra`='$ref' OR `rfid`='$ref')  AND `delete`<>1 ") or die(mysql_error());
	}else{
		$getInfo = mysql_query("SELECT  `ref`, `fecha`, `cod_barra`, `rfid`, `marca`, `desc`, `talla`, `color`, `precio_und` as precio, `costo_und` 
	FROM `h01sg_producto` WHERE (`ref`='$ref' OR `cod_barra`='$ref' OR `rfid`='$ref') AND `delete`<>1 ") or die(mysql_error());
	}
	
	$rows = array();
	while($r = mysql_fetch_assoc($getInfo)) {
		$rows[] = $r;
	}
	if($getInfo){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getcantr'])){
	$ref=$_GET["getcantr"];
	$origen=$_GET["orig"];
	
	$searchCant = mysql_query("SELECT  `cant_final` FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto` ON h01sg_inventario.ref=h01sg_producto.ref
	WHERE (h01sg_inventario.ref='$ref' OR h01sg_producto.cod_barra='$ref' OR h01sg_producto.rfid='$ref') 
	AND h01sg_inventario.delete<>1 AND h01sg_producto.delete<>1 AND h01sg_inventario.punto_venta='$origen'") 
	or die(mysql_error());
	$cant = mysql_fetch_assoc($searchCant);
	if($searchCant){
		echo json_encode($cant);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getconsec'])){
	$ptov = $_GET['getconsec'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_venta` 
	WHERE `delete`<>1 AND `punto_venta`='$ptov' ORDER BY `consec` DESC ") or die(mysql_error());
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

if (isset($_GET['getconsec2'])){
	$ptov = $_GET['getconsec2'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `z01sg_corte` 
	WHERE `delete`<>1 AND `punto_venta`='$ptov' ORDER BY `consec` DESC ") or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['consec'];
	if($factura1!=''){
		$factura2=$factura1;
	}else{
		$factura2=1000000000;	
	}
	$factura=$factura2 + 1;
	
	if($factura){
		echo json_encode($factura);
	}else{
		echo "noexitoso";
	}
	return false;	
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

if (isset($_GET['getconsecd2'])){
	$ptov = $_GET['getconsecd2'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `z01sg_ids` 
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

if ($action == "new_client"){
	$user=$_POST["user"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$nombre=$_POST["nombre"];
	$dir=$_POST["dir"];
	$email=$_POST["email"];
	$cumple=$_POST["cumple"];
	
	$newfact = mysql_query("INSERT INTO `d89xz_clientes`(`cedula`, `nombre`, `telefono`, `cumple`, `mail`, `dir`,`user`) VALUES 	
	('$ced','$nombre','$tel','$cumple','$email','$dir','$user')") or die(mysql_error());
	
	if($newfact){
		echo "Se creo el cliente con exito";
	}
	else{
		echo "No se creo el cliente con exito";
	}
}

if ($action == "new_fact"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$ptov= $_POST["ptov"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$nombre=$_POST["nombre"];
	$items=$_POST["items"];
	$total=$_POST["total"];
	$dcto=$_POST["dcto"];
	$tipo=$_POST["tipo"];
	$fechap=$_POST["fechap"];
	$formap=$_POST["formap"];
	$iva=$_POST["iva"];
	$subtotal=$_POST["subtotal"];
	$d=$_POST["d"];
	
	$newfact = mysql_query("INSERT INTO `h01sg_venta`(`consec`, `fecha`, `fecha_p`, `tipo`,`forma_pago`,`punto_venta`, `cliente`,
	`ced`, `tel`, `total_items`, `valor_tot`,`dscto`,`sub_total`,`iva`, `tot_final`, `dctof`, `user` ) 
	VALUES ('$consec','$fecha','$fechap','$tipo','$formap', '$ptov','$nombre','$ced','$tel','$items','$total','$dcto','$subtotal',
	'$iva','$total','$d','$user')") or die(mysql_error());
	
	if($newfact){
		echo "Se creo la factura con exito";
	}
	else{
		echo "No se creo la factura con exito";
	}
}

if ($action == "new_fact2"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$ptov= $_POST["ptov"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$nombre=$_POST["nombre"];
	$items=$_POST["items"];
	$total=$_POST["total"];
	$dcto=$_POST["dcto"];
	$tipo=$_POST["tipo"];
	$fechap=$_POST["fechap"];
	$formap=$_POST["formap"];
	$iva=$_POST["iva"];
	$subtotal=$_POST["subtotal"];
	
	$newfact = mysql_query("INSERT INTO `z01sg_corte`(`consec`, `fecha`, `fecha_p`, `tipo`,`forma_pago`,`punto_venta`, `cliente`,
	`ced`, `tel`, `total_items`, `valor_tot`,`dscto`,`sub_total`,`iva`, `tot_final`, `user` ) 
	VALUES ('$consec','$fecha','$fechap','$tipo','$formap', '$ptov','$nombre','$ced','$tel','$items','$total','$dcto','$subtotal','$iva','$total',
	'$user')") or die(mysql_error());
	
	if($newfact){
		echo "Se creo la factura con exito";
	}
	else{
		echo "No se creo la factura con exito";
	}
}

if ($action == "new_inventreg"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$fecha=$_POST["fecha"];
	$ptov=$_POST["ptov"];
	$cant=$_POST["cant"];
	$valor=$_POST["valor"];
	$dcto=$_POST["dcto"];
	$total=$_POST["total"];
	$user=$_POST["user"];
	
	$newInve = mysql_query("INSERT INTO `h01sg_venta_detalle`( `consec`, `fecha`, `punto_venta`, `ref`, `cant`, `valor`, `dscto`,
	`total`, `user`) VALUES('$consec','$fecha','$ptov','$ref','$cant','$valor','$dcto','$total',
	'$user')") or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "new_inventreg2"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$fecha=$_POST["fecha"];
	$ptov=$_POST["ptov"];
	$cant=$_POST["cant"];
	$valor=$_POST["valor"];
	$dcto=$_POST["dcto"];
	$total=$_POST["total"];
	$user=$_POST["user"];
	
	$newInve = mysql_query("INSERT INTO `z01sg_corte_detalle`( `consec`, `fecha`, `punto_venta`, `ref`, `cant`, `valor`, `dscto`,
	`total`, `user`) VALUES('$consec','$fecha','$ptov','$ref','$cant','$valor','$dcto','$total',
	'$user')") or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "new_cantreg"){
	$ref= trim($_POST["ref"]);
	$cant=trim($_POST["cant"]);
	$puntov=trim($_POST["puntov"]);
	$user=$_POST["user"];
	//echo ' - ';	
	$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
	or die(mysql_error());
	
	$rev = mysql_num_rows($revref);
	
	if ($rev >=1){
		$row_rev = @mysql_fetch_assoc($revref);
		$vend = $row_rev['cant_vend'];
		//echo '-';
		$canti = $vend + $cant;
		//echo '-';
		$final = $row_rev['cant_final'];
		//echo '-';
		$tot = $final - $cant;
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_vend`='$canti',`cant_final`='$tot',
		`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
		if($updref){
			echo "exitoso";
		}
		else{
			echo "noexitoso";
		}
	}else{
		/*$insref = mysql_query("INSERT INTO `h01sg_inventario`( `ref`, `punto_venta`, `cant_ini`, `cant_final`, `user`) 
		VALUES ('$ref','$puntov','$cant','$cant','$user')  ")or die(mysql_error());
		if($insref){
			echo "exitoso";
		}
		else{
			echo "noexitoso";
		}*/
	}
}

if ($action == "updDiario"){
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

if ($action == "updDiario2"){
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
	  
	  $setDiairoV = mysql_query(" INSERT INTO `z01sg_ids`(`fecha`, `factura`, `f_alarma`, `concep`,`consec_fact`,`fact_data`, 
	  `estado`, `f_pago`, 
	  `valor`, `cliente`, `cedula`, `comentario`, `hacienda`, `user`) VALUES 
	  ('$fecha','$diario','$fecha_pago','$concepto','$consec','b', '$estado','$fpago','$precio','$cliente','$ced','$descr',
	  '$puntov','$user') ") or die(mysql_error()); 
	  
	  if($setDiairoV){
		echo "Se creo el registro en la tabla de diario";
	  }
	  else{
		echo "No se creo el registro en la tabla de diario";
	  }
}


if ($action == "updSaldo"){
	$user=$_POST["user"];
	$ced=$_POST["ced"];
	echo '-'.$dcto=$_POST["dcto"];
	
	$revcli = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$ced' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($revcli);
	$row_clie = mysql_fetch_assoc($revcli);
	if ($n >=1){
		echo '_'.$c= $row_clie['saldo_favor'];
		echo '*'.$canti = $c-$dcto;
		$setsaldo = mysql_query("UPDATE `d89xz_clientes` SET `saldo_favor`='$canti',`user`='$user' WHERE 
		`cedula`='$ced' AND `delete`<>1") or die(mysql_error()); 
	}
	
	if($setsaldo){
		echo "Se actualizo la tabla de cliente";
	}
	else{
		echo "No se actualizo la tabla de cliente";
	}
}

//--------------------------------
// fact_grap.php
//--------------------------------

if (isset($_GET['getmonths'])){
	$year=$_GET["getmonths"];
	$ptv=$_GET["ptv"];
	
	$getMonth = mysql_query("SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `h01sg_venta` WHERE `delete`<>1 AND YEAR(fecha)='$year' ".$ptv."ORDER BY MONTH(fecha) ASC") or die(mysql_error());
	$rows = array();
	$i = 0;
	while($r = mysql_fetch_assoc($getMonth)) {
		$rows[$i] = array(
			'nombre' => $r['MONTHNAME(fecha)'],
			'num' => $r['MONTH(fecha)'],
		);
		$i++;
	}
	if($getMonth){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;
	//echo json_encode($year);
}

if (isset($_GET['getmval'])){
	$year=$_GET["getmval"];
	$month=$_GET["month"];
	$ptv=$_GET["ptv"];
	
	$getmval = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `delete`<>1 AND `forma_pago`='Contado' AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' ".$ptv) or die(mysql_error());
	$getmval2 = mysql_query("SELECT sum(tot_final) as cred FROM `h01sg_venta` WHERE `delete`<>1 AND `forma_pago`='Credito' AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' ".$ptv) or die(mysql_error());
	
	$dev = 0;
	$getdev1 = mysql_query("SELECT `consec` FROM `h01sg_venta` WHERE `delete`=2 AND `forma_pago`='Contado' AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' ".$ptv) or die(mysql_error());
	while($d = mysql_fetch_assoc($getdev1)){
		$c = $d['consec'];
		$getdev2 = mysql_query("SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `delete`<>1 AND `consec`='$c' ".$ptv) or die(mysql_error());
		$d2 = mysql_fetch_assoc($getdev2);
		$dev = $dev+$d2['s_favor'];
	}
	
	$dev2 = 0;
	$getdev3 = mysql_query("SELECT `consec` FROM `h01sg_venta` WHERE `delete`=2 AND `forma_pago`='Credito' AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' ".$ptv) or die(mysql_error());
	while($d3 = mysql_fetch_assoc($getdev3)){
		$c = $d3['consec'];
		$getdev4 = mysql_query("SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `delete`<>1 AND `consec`='$c' ".$ptv) or die(mysql_error());
		$d4 = mysql_fetch_assoc($getdev4);
		$dev2 = $dev2+$d4['s_favor'];
	}
	
	$rows = array();
	$i = 0;
	$r = mysql_fetch_assoc($getmval);
	$r2 = mysql_fetch_assoc($getmval2);
	$c = $r2['cred'];
	if ($c == 0 || $c==''){
		$rows[$i] = array(
			'sum' =>  $r['sum']-$dev,
			'cred' => 0,
			'num' => $month,
		);
		$i++;
	}else{
		$rows[$i] = array(
			'sum' =>  $r['sum']-$dev,
			'cred' =>  $c-$dev2,
			'num' => $month,
		);
		$i++;
	}	
		
	if($getmval){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;
}

if (isset($_GET['getmonthval'])){
	$year=$_GET["getmonthval"];
	$month=$_GET["month"];
	$ptv=$_GET["ptv"];
	$rows = array();
	$i = 0;
	
	$getmoval = mysql_query("SELECT DISTINCT DAY(fecha) FROM `h01sg_venta` WHERE `delete`<>1 AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' ".$ptv) or die(mysql_error());
	
	$n = mysql_num_rows($getmoval);
	if ($n == 1){
		$rows[$i] = array(
			'sum' => 0,
			'day' => 0,
		);
		$i++;
	}
	
	while($row_day = mysql_fetch_assoc($getmoval)) {
		$day = $row_day['DAY(fecha)'];
		$getsval = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`<>1 AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' AND DAY(fecha)='$day' ".$ptv) or die(mysql_error());
		
		$dev = 0;
		$getdev1m = mysql_query("SELECT `consec` FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`=2 AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' AND DAY(fecha)='$day' ".$ptv) or die(mysql_error());
		while($d = mysql_fetch_assoc($getdev1m)){
			$c = $d['consec'];
			$getdev2 = mysql_query("SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `delete`<>1 AND `consec`='$c' ".$ptv) or die(mysql_error());
			$d2 = mysql_fetch_assoc($getdev2);
			$dev = $dev+$d2['s_favor'];
		}
		
		$cred = 0;
		$getcred = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `delete`=9 AND `forma_pago`='Credito' AND YEAR(fecha)='$year' AND MONTH(fecha)='$month' AND DAY(fecha)='$day' ".$ptv) or die(mysql_error());
		$cre = mysql_fetch_assoc($getcred);
		$cred = $cre['sum'];
		
		$r = mysql_fetch_assoc($getsval);
		$rows[$i] = array(
			'sum' => $r['sum']-$dev+$cred,
			'day' => $day,
		);
		$i++;	
	}
	
	if($getmoval && $getsval){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;
}

if (isset($_GET['getmt'])){
	$year=$_GET["getmt"];
	$enero=$_GET["enero"];
	$febrero=$_GET["febrero"];
	$marzo=$_GET["marzo"];
	$abril=$_GET["abril"];
	$mayo=$_GET["mayo"];
	$junio=$_GET["junio"];
	$julio=$_GET["julio"];
	$agosto=$_GET["agosto"];
	$septiembre=$_GET["septiembre"];
	$octubre=$_GET["octubre"];
	$noviembre=$_GET["noviembre"];
	$diciembre=$_GET["diciembre"];
	$ptv=$_GET["ptv"];
	$val = '';
	$months = array();
	if ($enero){
		$val = $val.'OR MONTH(fecha)='.$enero.' '; 
		$months[1] = $enero;
	}
	if ($febrero){
		$val = $val.'OR MONTH(fecha)='.$febrero.' '; 
		$months[2] = $febrero;
	}
	if ($marzo){
		$val = $val.'OR MONTH(fecha)='.$marzo.' '; 
		$months[3] = $marzo;
	}
	if ($abril){
		$val = $val.'OR MONTH(fecha)='.$abril.' '; 
		$months[4] = $abril;
	}
	if ($mayo){
		$val = $val.'OR MONTH(fecha)='.$mayo.' '; 
		$months[5] = $mayo;
	}
	if ($junio){
		$val = $val.'OR MONTH(fecha)='.$junio.' '; 
		$months[6] = $junio;
	}
	if ($julio){
		$val = $val.'OR MONTH(fecha)='.$julio.' ';
		$months[7] = $julio; 
	}
	if ($agosto){
		$val = $val.'OR MONTH(fecha)='.$agosto.' ';
		$months[8] = $agosto; 
	}
	if ($septiembre){
		$val = $val.'OR MONTH(fecha)='.$septiembre.' ';
		$months[9] = $septiembre; 
	}
	if ($octubre){
		$val = $val.'OR MONTH(fecha)='.$octubre.' ';
		$months[10] = $octubre; 
	}
	if ($noviembre){
		$val = $val.'OR MONTH(fecha)='.$noviembre.' ';
		$months[11] = $noviembre; 
	}
	if ($diciembre){
		$val = $val.'OR MONTH(fecha)='.$diciembre.' ';
		$months[12] = $diciembre; 
	}
	$rows = array();
	$j = 0;
	for($i=0;$i < 12; $i++){
		$m = $months[$i];
		if ($months[$i] != ''){
			$getmosval = mysql_query("SELECT DISTINCT DAY(fecha) FROM `h01sg_venta` WHERE `delete`<>1 AND YEAR(fecha)='$year'".$val.''.$ptv.' ORDER BY DAY(fecha) ASC') or die(mysql_error());
			
			while($row_day = mysql_fetch_assoc($getmosval)) {
				$day = $row_day['DAY(fecha)'];
				$getmsval = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`<>1 AND YEAR(fecha)='$year' AND MONTH(fecha)='$m' AND DAY(fecha)='$day' ".$ptv) or die(mysql_error());
				
				$dev = 0;
				$getdev1mt = mysql_query("SELECT `consec` FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`=2 AND YEAR(fecha)='$year' AND MONTH(fecha)='$m' AND DAY(fecha)='$day' ".$ptv) or die(mysql_error());
				while($d = mysql_fetch_assoc($getdev1mt)){
					$c = $d['consec'];
					$getdev2mt = mysql_query("SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `delete`<>1 AND `consec`='$c' ".$ptv) or die(mysql_error());
					$d2 = mysql_fetch_assoc($getdev2mt);
					$dev = $dev+$d2['s_favor'];
				}
				
				$cred2 = 0;
				$getcred2 = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `delete`=9 AND `forma_pago`='Credito' AND YEAR(fecha)='$year' AND MONTH(fecha)='$m' AND DAY(fecha)='$day' ".$ptv) or die(mysql_error());
				$cre2 = mysql_fetch_assoc($getcred2);
				$cred2 = $cre2['sum'];

				$r = mysql_fetch_assoc($getmsval);
				if ($r['sum']){
					$rows[$j] = array(
						'sum' => $r['sum']-$dev+$cred2,
						'day' => $day,
						'month' => $m,
					);
					$j++;
				}else{
					$rows[$j] = array(
						'sum' => 0,
						'day' => $day,
						'month' => $m,
					);
					$j++;
				}
				
			}
		}
	} 
	
	if($getmosval && $getmsval){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;
	/*$getmoval = mysql_query("SELECT DISTINCT DAY(fecha) FROM `h01sg_venta` WHERE `delete`<>1 AND YEAR(fecha)='$year' ".$val) or die(mysql_error());
	$n = mysql_num_rows($getmoval);*/
	//echo json_encode();
}

if (isset($_GET['getyears'])){
	$ptv=$_GET["ptv"];
	
	$getYear = mysql_query("SELECT DISTINCT YEAR(fecha) FROM `h01sg_venta` WHERE `delete`<>1 ".$ptv."ORDER BY YEAR(fecha) DESC") or die(mysql_error());
	$rows = array();
	$i = 0;
	while($r = mysql_fetch_assoc($getYear)) {
		$rows[$i] = array(
			'year' => $r['YEAR(fecha)'],
		);
		$i++;
	}
	if($getYear){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;
	//echo json_encode($year);
}

if (isset($_GET['getyearval'])){
	$year=$_GET["getyearval"];
	$ptv=$_GET["ptv"];
	$rows = array();
	$i = 0;
	
	/*$month = mysql_query("SELECT DISTINCT MONTH(fecha), MONTHNAME(fecha) FROM `h01sg_venta` WHERE `delete`<>1 AND YEAR(fecha)='$year' ".$ptv." ORDER BY MONTH(fecha) ASC") or die(mysql_error());
	$n = mysql_num_rows($month);
	if ($n == 1){
		$rows[$i] = array(
			'sum' => 0,
			'month' => 'Enero',
		);
		$i++;
	}*/
	
	for($j=1; $j<13;$j++) {
		
		$msum = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`<>1 AND YEAR(fecha)='$year' AND MONTH(fecha)='$j' ".$ptv) or die(mysql_error());
		$row_sum = mysql_fetch_assoc($msum);
		$ysum = $row_sum['sum'];
		
		$dev = 0;
		$devm = mysql_query("SELECT `consec` FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`=2 AND YEAR(fecha)='$year' AND MONTH(fecha)='$j' ".$ptv) or die(mysql_error());
		while($d = mysql_fetch_assoc($devm)){
			$c = $d['consec'];
			$devy2 = mysql_query("SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `delete`<>1 AND `consec`='$c' ".$ptv) or die(mysql_error());
			$d2 = mysql_fetch_assoc($devy2);
			$dev = $dev+$d2['s_favor'];
		}
		
		$msumc = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `delete`=9 AND `forma_pago`='Credito' AND YEAR(fecha)='$year' AND MONTH(fecha)='$j' ".$ptv) or die(mysql_error());
		$row_sumc = mysql_fetch_assoc($msumc);
		$ycred = $row_sumc['sum'];
		
		$mn = '';
		if($j == 1){
			$mn = 'Enero';	
		}
		if($j == 2){
			$mn = 'Febrero';	
		}
		if($j == 3){
			$mn = 'Marzo';	
		}
		if($j == 4){
			$mn = 'Abril';	
		}
		if($j == 5){
			$mn = 'Mayo';	
		}
		if($j == 6){
			$mn = 'Junio';	
		}
		if($j == 7){
			$mn = 'Julio';	
		}
		if($j == 8){
			$mn = 'Agosto';	
		}
		if($j == 9){
			$mn = 'Septiembre';	
		}
		if($j == 10){
			$mn = 'Octubre';	
		}
		if($j == 11){
			$mn = 'Noviembre';	
		}
		if($j == 12){
			$mn = 'Diciembre';	
		}
		
		$rows[$i] = array(
			'sum' => $ysum+$ycred-$dev,
			'month' => $mn,
		);
		$i++;
	}
	
	echo json_encode($rows);
	
	return false;
}

if (isset($_GET['getyeart'])){
	$year=$_GET["getyeart"];
	$ptv=$_GET["ptv"];
	$rows = array();
	$i = 0;
	$array = explode(',', $year);
	$l = sizeof($array);
	$j = 0;
	while ($j < $l){
		$y = $array[$j];
		for($k=1; $k<13;$k++) {
		
			$msum = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`<>1 AND YEAR(fecha)='$y' AND MONTH(fecha)='$k' ".$ptv) or die(mysql_error());
			$row_sum = mysql_fetch_assoc($msum);
			$ysum = $row_sum['sum'];
			
			$dev = 0;
			$devm = mysql_query("SELECT `consec` FROM `h01sg_venta` WHERE `forma_pago`='Contado' AND `delete`=2 AND YEAR(fecha)='$y' AND MONTH(fecha)='$k' ".$ptv) or die(mysql_error());
			while($d = mysql_fetch_assoc($devm)){
				$c = $d['consec'];
				$devy2 = mysql_query("SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `delete`<>1 AND `consec`='$c' ".$ptv) or die(mysql_error());
				$d2 = mysql_fetch_assoc($devy2);
				$dev = $dev+$d2['s_favor'];
			}
			
			$msumc = mysql_query("SELECT sum(tot_final) as sum FROM `h01sg_venta` WHERE `delete`=9 AND `forma_pago`='Credito' AND YEAR(fecha)='$y' AND MONTH(fecha)='$k' ".$ptv) or die(mysql_error());
			$row_sumc = mysql_fetch_assoc($msumc);
			$ycred = $row_sumc['sum'];
			
			$mn = '';
			if($k == 1){
				$mn = 'Enero';	
			}
			if($k == 2){
				$mn = 'Febrero';	
			}
			if($k == 3){
				$mn = 'Marzo';	
			}
			if($k == 4){
				$mn = 'Abril';	
			}
			if($k == 5){
				$mn = 'Mayo';	
			}
			if($k == 6){
				$mn = 'Junio';	
			}
			if($k == 7){
				$mn = 'Julio';	
			}
			if($k == 8){
				$mn = 'Agosto';	
			}
			if($k == 9){
				$mn = 'Septiembre';	
			}
			if($k == 10){
				$mn = 'Octubre';	
			}
			if($k == 11){
				$mn = 'Noviembre';	
			}
			if($k == 12){
				$mn = 'Diciembre';	
			}
			
			$rows[$i] = array(
				'sum' => $ysum+$ycred-$dev,
				'month' => $mn,
				'year' => $y,
			);
			$i++;
		}
		$j++;
	}
	echo json_encode($rows);
	
	//echo json_encode($l);
	
	return false;
}

//--------------------------------
// fact_cred1.php
//--------------------------------

if ($action == "upd_fact"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$ptov= $_POST["ptov"];
	$total=$_POST["total"];
	$dcto=$_POST["dcto"];
	$iva=$_POST["iva"];
	$subtotal=$_POST["subtotal"];
	$items=$_POST["items"];
	$d=$_POST["d"];
	
	$upd_fact = mysql_query("UPDATE `h01sg_venta` SET `total_items`='$items',`valor_tot`='$total',`dscto`='$dcto',`sub_total`='$subtotal',`iva`='$iva',
	`tot_final`='$total',`dctof`='$d',`user`='$user' WHERE `consec`='$consec' AND `punto_venta`='$ptov' AND `delete`<>1") or die(mysql_error());
	
	if($upd_fact){
		echo "Se actualizo factura con exito";
	}
	else{
		echo "No se actualizo factura con exito";
	}
}

if ($action == "upd_diario2"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$ptov= $_POST["ptov"];
	$total=$_POST["total"];
	$fecha=$_POST["fecha"];
	$fechap=$_POST["fechap"];
	$ced=$_POST["ced"];
	$cliente=$_POST["cliente"];
	
	$getdiario = mysql_query("SELECT * FROM `d89xz_diario` WHERE `concep`='Ingreso' AND `consec_fact`='$consec' 
	AND `hacienda`='$ptov' AND `delete`<>1 ") or die(mysql_error());
	
	echo $n = mysql_num_rows($getdiario);
	if ($n > 0){
		$upd_diario = mysql_query("UPDATE `d89xz_diario` SET `valor`='$total',`user`='$user' WHERE 
		`concep`='Ingreso' AND `consec_fact`='$consec' AND `estado`='Pendiente' AND `hacienda`='$ptov' AND `delete`<>1 
		AND `f_pago`='Crédito'") or die(mysql_error());
	}else{
		$concepto = "Ingreso";
		$descr = "Factura de Venta No: ".$consec;
		$fpago = 'Crédito';
		$estado = 'Pendiente';
		
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
		
		$upd_diario = mysql_query("INSERT INTO `d89xz_diario`(`fecha`, `factura`, `f_alarma`, `concep`,`consec_fact`, 
		`estado`, `f_pago`, `valor`, `cliente`, `cedula`, `comentario`, `hacienda`, `user`) VALUES 
		('$fecha','$factura','$fechap','$concepto','$consec','$estado','$fpago','$total','$cliente','$ced','$descr',
		'$ptov','$user')") or die(mysql_error());
	}
	
	if($upd_diario){
		echo "Se actualizo la diario con exito";
	}
	else{
		echo "No se actualizo la diario con exito";
	}
}

if ($action == "upd_inventreg"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$fecha=$_POST["fecha"];
	$ptov=$_POST["ptov"];
	$cant=$_POST["cant"];
	$canto=$_POST["canto"];
	$valor=$_POST["valor"];
	$dcto=$_POST["dcto"];
	$total=$_POST["total"];
	$user=$_POST["user"];
	
	$newInve = mysql_query("UPDATE `h01sg_venta_detalle` SET `cant`='$cant',`valor`='$valor',`dscto`='$dcto',
	`total`='$total',`user`='$user' WHERE `consec`='$consec' AND `punto_venta`='$ptov' 
	AND `ref`='$ref' AND`delete`<>1 ") or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "upd_cantreg"){
	$ref= trim($_POST["ref"]);
	$cant=trim($_POST["cant"]);
	$canto=$_POST["canto"];
	$puntov=trim($_POST["puntov"]);
	$user=$_POST["user"];
	
	if ($cant >= $canto){
		$c = $cant - $canto;
		//echo ' - ';	
		$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
		or die(mysql_error());
		
		$rev = mysql_num_rows($revref);
		
		if ($rev >=1){
			$row_rev = @mysql_fetch_assoc($revref);
			$vend = $row_rev['cant_vend'];
			//echo '-';
			$canti = $vend + $c;
			//echo '-';
			$final = $row_rev['cant_final'];
			//echo '-';
			$tot = $final - $c;
			$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_vend`='$canti',`cant_final`='$tot',
			`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1")or die(mysql_error());
			if($updref){
				echo "exitoso";
			}
			else{
				echo "noexitoso";
			}
		}		
	}else{
		$c = $canto - $cant;
		//echo ' - ';	
		$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") 
		or die(mysql_error());
		
		$rev = mysql_num_rows($revref);
		
		if ($rev >=1){
			$row_rev = @mysql_fetch_assoc($revref);
			$vend = $row_rev['cant_vend'];
			//echo '-';
			$canti = $vend - $c;
			//echo '-';
			$final = $row_rev['cant_final'];
			//echo '-';
			$tot = $final + $c;
			$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_vend`='$canti',`cant_final`='$tot',
			`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1")or die(mysql_error());
			if($updref){
				echo "exitoso";
			}
			else{
				echo "noexitoso";
			}
		}	
	}
}

/*
if ($action == "del_prod"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	
	$getDet = mysql_query("SELECT `cant` FROM `h01sg_venta_detalle` WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1
	AND `punto_venta`='$puntov' ") 
	or die(mysql_error());
	$row_det = mysql_fetch_assoc($getDet);
	$det = $row_det['cant'];
	
	$getInv = mysql_query("SELECT `cant_vend`,`cant_final` FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' ") 
	or die(mysql_error());
	$row_inv = mysql_fetch_assoc($getInv);
	$del = $row_inv['delete'];
	$inv = $row_inv['cant_vend'];
	$tot = $row_inv['cant_final'];
	if ($del == 0){
		echo $newcant = $inv - $det;
		echo $newtot = $tot + $det;
		
		$newInve = mysql_query("UPDATE `h01sg_venta_detalle` SET `user`='$user',`delete`='1' WHERE
		`ref`='$ref' AND `punto_venta`='$puntov' AND `consec`='$consec' AND `delete`<>1") 
		or die(mysql_error());
	
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_vend`='$newcant',`cant_final`='$newtot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
	}else{
		$newInve = mysql_query("UPDATE `h01sg_venta_detalle` SET `user`='$user',`delete`='1' WHERE
		`ref`='$ref' AND `punto_venta`='$puntov' AND `consec`='$consec' AND `delete`<>1") 
		or die(mysql_error());
	
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$det',`cant_final`='$det',`user`='$user', `delete`='0' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`=1  ")or die(mysql_error());
	}

	if($newInve && $updref){
		echo "se actualizo el producto";
	}
	else{
		echo "no se actualizo el producto";
	}
}*/

if(isset($_POST['del_prod'])){
	$refs= $_POST['del_prod'];
	$consec=$_POST['consec'];
	$fecha=$_POST['fecha'];
	$user=$_POST['user'];
	$puntov=$_POST['ptov'];
	$tama=$_POST['tama'];
	
	for($j=0;$j<$tama;$j++){
		echo $ref=trim($refs[$j]);
		if ($ref){
			$getDet = mysql_query("SELECT `cant` FROM `h01sg_venta_detalle` WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1
			AND `punto_venta`='$puntov' ") 
			or die(mysql_error());
			$row_det = mysql_fetch_assoc($getDet);
			$det = $row_det['cant'];
			
			$getInv = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' ") 
			or die(mysql_error());
			$row_inv = mysql_fetch_assoc($getInv);
			echo '-'.$del = $row_inv['delete'];
			$ini = $row_inv['cant_ini'];
			$inv = $row_inv['cant_vend'];
			$tot = $row_inv['cant_final'];
			if ($del != 1){
				echo '<>1-';
				echo $newini = $ini + $det;
				if($inv > $det){
					echo $newcant = $inv - $det;
				}else{
					echo $newcant = 0;
				}
				echo $newtot = $tot + $det;
				$newInve = mysql_query("UPDATE `h01sg_venta_detalle` SET `user`='$user',`delete`='1' WHERE
				`ref`='$ref' AND `punto_venta`='$puntov' AND `consec`='$consec' AND `delete`<>1") 
				or die(mysql_error());
				//$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$newini',`cant_vend`='$newcant',`cant_final`='$newtot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' ")or die(mysql_error());
				$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$newini',`cant_final`='$newtot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' ")or die(mysql_error());
			}
			if ($del == 1){
				echo '=1-';
				$newInve = mysql_query("UPDATE `h01sg_venta_detalle` SET `user`='$user',`delete`='1' WHERE
				`ref`='$ref' AND `punto_venta`='$puntov' AND `consec`='$consec' AND `delete`<>1") 
				or die(mysql_error());
				$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$det',`cant_final`='$det',`user`='$user', `delete`='0' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`='1'")or die(mysql_error());
			}
		
			if($newInve && $updref){
				echo "se actualizo el producto";
			}
			else{
				echo "no se actualizo el producto";
			}
		}	
	}
}


//--------------------------------
// fact_cred2.php
//--------------------------------

if ($action == "upd_factd"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$ptov= $_POST["ptov"];
	$total=$_POST["total"];
	$dcto=$_POST["dcto"];
	$iva=$_POST["iva"];
	$subtotal=$_POST["subtotal"];
	$devo=$_POST["devo"];
	$items=$_POST["items"];
	
	$upd_fact = mysql_query("UPDATE `h01sg_venta` SET `total_items`='$items',`valor_tot`='$total',`dscto`='$dcto',`sub_total`='$subtotal',`iva`='$iva',
	`tot_final`='$total',`user`='$user' WHERE `consec`='$consec' AND `punto_venta`='$ptov' AND `delete`<>1") or die(mysql_error());
	
	if($upd_fact){
		echo "Se actualizo factura con exito";
	}
	else{
		echo "No se actualizo factura con exito";
	}
}

if ($action == "upd_diariod"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$ptov= $_POST["ptov"];
	$total=$_POST["total"];
	$devo=$_POST["devo"];
	
	$upd_diario = mysql_query("UPDATE `d89xz_diario` SET `valor`='$total',`user`='$user' WHERE 
	`concep`='Ingreso' AND `consec_fact`='$consec' AND `estado`='Pendiente' AND `hacienda`='$ptov' AND `delete`<>1 
	AND `f_pago`='Crédito'") or die(mysql_error());
	
	if($upd_diario){
		echo "Se actualizo la diario con exito";
	}
	else{
		echo "No se actualizo la diario con exito";
	}
}

?>