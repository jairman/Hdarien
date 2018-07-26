<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php

ini_set('date.timezone', 'America/Bogota');
$c_date = date('Y-m-d');
$today = date("Y-m-d");//

if(isset($_POST['vals2'])){
	$i= $_POST['j'];
	$vals= $_POST['vals2'];
	$tama=$_POST['tam_env'];
	$consec=$_POST['consec'];
	$fecha=$_POST['fecha'];
	$user=$_POST['user'];
	$ptov=$_POST['ptov'];
	
	$cedula_arr=array();
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$bcode=trim($vals[$j+1]);//
		$rfid=trim($vals[$j+2]);//
		$marca=trim($vals[$j+3]);//
		$desc=trim($vals[$j+4]);//
		$talla=trim($vals[$j+5]);//
		$color=trim($vals[$j+6]);//
		$cat=trim($vals[$j+7]);//
		$scat=trim($vals[$j+8]);//
		$cant=trim($vals[$j+9]);//
		$costo=trim($vals[$j+10]);//
		$precio=trim($vals[$j+11]);//
		$preciom=trim($vals[$j+12]);//
		
		if($j%13==0){
			
			if ($ref){
				//crear el producto
				$revref = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1  ") 
				or die(mysql_error());
				$n = mysql_num_rows($revref);
				if ( $n >= 1){
					$newProd = mysql_query("UPDATE `h01sg_producto` SET `fecha`='$c_date',`cod_barra`='$bcode',`rfid`='$rfid',
					`marca`='$marca',`desc`='$desc',`talla`='$talla',`color`='$color',`categoria`='$cat',`sub_cat`='$scat',
					`precio_mayo`='$preciom',`precio_und`='$precio',`costo_und`='$costo',`user`='$user'
					 WHERE `ref`='$ref' AND `delete`<>1") 
					or die(mysql_error());	
				}else{
					$newProd = mysql_query("INSERT INTO `h01sg_producto` (`ref`, `fecha`, `cod_barra`, `rfid`, `marca`, `desc`, 
					`talla`, `color`, `categoria`, `sub_cat`, `precio_mayo`, `precio_und`, `costo_und`, `user`) 
					VALUES ('$ref','$c_date','$bcode','$rfid','$marca','$desc','$talla','$color','$cat','$scat','$preciom',
					'$precio','$costo','$user')") or die(mysql_error());	
				}
				
				//crear el detalle de la compra
				$tipo = 'Inventario Bodega';
				$mov = 'Entrada';
				$obs = 'Entrada por Compra';
				$pre = 'c';
				$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, `cant`, 
				`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$ptov','$ptov',
				'$cant','$obs','$pre','$consec','$costo','$fecha','$user')") 
				or die(mysql_error());
				
				//Crear inventario
				$revref2 = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ") 
				or die(mysql_error());
				$rev2 = mysql_num_rows($revref2);
				$row_rev2 = @mysql_fetch_assoc($revref2);
				if ($rev2 >=1){
					$canti = $row_rev2['cant_ini']+$cant;
					$tot = $row_rev2['cant_final']+$cant;
					$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$canti',`cant_final`='$tot',
					`user`='$user', `delete`='0' WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ")or die(mysql_error());
				}else{
					$insref = mysql_query("INSERT INTO `h01sg_inventario`( `ref`, `punto_venta`, `cant_ini`, `cant_final`, `user`) 
					VALUES ('$ref','$ptov','$cant','$cant','$user')  ")or die(mysql_error());
				}
			}
		}
	}
	$arreglo=array(
		'progreso_r' => $i,
		'arreglo' => $vals,
		'tama' => $tama,
		'cedula' => $cedula_arr,
	);	
	$arreglo=json_encode($arreglo);
	echo $arreglo;
	//echo $i." ".$tama;
}

if(isset($_POST['vals'])){
	$i= $_POST['j'];
	$vals= $_POST['vals'];
	$tama=$_POST['tam_env'];
	$consec=$_POST['consec'];
	$fecha=$_POST['fecha'];
	$user=$_POST['user'];
	$puntov=$_POST['ptov'];
	
	$cedula_arr=array();
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$bcode=trim($vals[$j+1]);//
		$rfid=trim($vals[$j+2]);//
		$marca=trim($vals[$j+3]);//
		$desc=trim($vals[$j+4]);//
		$talla=trim($vals[$j+5]);//
		$color=trim($vals[$j+6]);//
		$cat=trim($vals[$j+7]);//
		$scat=trim($vals[$j+8]);//
		$cant=trim($vals[$j+9]);//
		$costo=trim($vals[$j+10]);//
		$precio=trim($vals[$j+11]);//
		$preciom=trim($vals[$j+12]);//
		$cantc=trim($vals[$j+13]);//
		$nuevo=trim($vals[$j+14]);//
		
		if($j%15==0){
			if ($ref){
				
				//Crear el Producto
				$revref = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1  ") 
				or die(mysql_error());
				$n = mysql_num_rows($revref);
				if ( $n >= 1){
					$newProd = mysql_query("UPDATE `h01sg_producto` SET `fecha`='$c_date',`cod_barra`='$bcode',`rfid`='$rfid',
					`marca`='$marca',`desc`='$desc',`talla`='$talla',`color`='$color',`categoria`='$cat',`sub_cat`='$scat',
					`precio_mayo`='$preciom',`precio_und`='$precio',`costo_und`='$costo',`user`='$user'
					 WHERE `ref`='$ref' AND `delete`<>1") 
					or die(mysql_error());	
				}else{
					$newProd = mysql_query("INSERT INTO `h01sg_producto` (`ref`, `fecha`, `cod_barra`, `rfid`, `marca`, `desc`, 
					`talla`, `color`, `categoria`, `sub_cat`, `precio_mayo`, `precio_und`, `costo_und`, `user`) 
					VALUES ('$ref','$c_date','$bcode','$rfid','$marca','$desc','$talla','$color','$cat','$scat','$preciom',
					'$precio','$costo','$user')") 
					or die(mysql_error());	
				}
				
				//Crear detalle de compra
				$tipo = 'Inventario Bodega';
				$mov = 'Entrada';
				$obs = 'Entrada por Compra';
				$pre = 'c';
				
				$revinve = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `ref`='$ref' AND `delete`<>1  
				AND `consec`='$consec' AND `punto_venta`='$puntov'") 
				or die(mysql_error());
				$n = mysql_num_rows($revinve);
				if ($n >= 1){
					$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `punto_venta`='$puntov', `punto_ini`='$puntov', 
					`cant`='$cant', `obs`='$obs',`mov`='$pre',`fecha`='$fecha', `user`='$user', `costo`='$costo'
					 WHERE `ref`='$ref' AND `delete`<>1  AND `consec`='$consec' AND `punto_venta`='$puntov'") 
					or die(mysql_error());
				}else{
					$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, 
					`cant`, `obs`,`mov`, `consec`,`costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
					'$cant','$obs','$pre','$consec','$costo','$fecha','$user')") 
					or die(mysql_error());	
				}
				
				//Crear Inventario
				$cantt=0;
				if ($cantc == 0){
					$cantt = $cant;
				}else{
					if ( $cant > $cantc ){
						$cantt = $cant - $cantc;
					}
					if ($cant < $cantc){
						$cantt = $cant - $cantc;	
					}
				}
				
				$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") 
				or die(mysql_error());
				$rev = mysql_num_rows($revref);
				$row_rev = @mysql_fetch_assoc($revref);
				if ($rev >=1){
					$ini = $row_rev['cant_ini'];
					$final = $row_rev['cant_final'];
					
					$cantb = $cantt+$ini;
					$tot = $cantt+$final;	
					
					$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$cantb',`cant_final`='$tot',
					`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
				}else{
					$insref = mysql_query("INSERT INTO `h01sg_inventario`( `ref`, `punto_venta`, `cant_ini`, `cant_final`, `user`) 
					VALUES ('$ref','$puntov','$cantt','$cantt','$user')  ")or die(mysql_error());
				}
			}
		}
	}
	$arreglo=array(
		'progreso_r' => $i,
		'arreglo' => $vals,
		'tama' => $tama,
		'cedula' => $cedula_arr,
	);	
	$arreglo=json_encode($arreglo);
	echo $arreglo;
	//echo $i." ".$tama;
}
		
?>