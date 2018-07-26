<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
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
		$cant=trim($vals[$j+1]);//
		$valor=trim($vals[$j+2]);//
		$dcto=trim($vals[$j+3]);//
		$total=trim($vals[$j+4]);//
		
		if($j%5==0){
			if ($ref){
				//crear el detalle de la venta
				$newInve = mysql_query("INSERT INTO `h01sg_venta_detalle`( `consec`, `fecha`, `punto_venta`, `ref`, `cant`, `valor`, `dscto`,
				`total`, `user`) VALUES('$consec','$fecha','$ptov','$ref','$cant','$valor','$dcto','$total',
				'$user')") or die(mysql_error());
				
				//actualizar el inventario
				$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ") 
				or die(mysql_error());
				$rev = mysql_num_rows($revref);
				if ($rev >=1){
					$row_rev = @mysql_fetch_assoc($revref);
					$vend = $row_rev['cant_vend'];
					$canti = $vend + $cant;
					$final = $row_rev['cant_final'];
					$tot = $final - $cant;
					
					$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_vend`='$canti',`cant_final`='$tot',
					`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ")or die(mysql_error());	
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
	$ptov=$_POST['ptov'];
	
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$cant=trim($vals[$j+1]);//
		$valor=trim($vals[$j+2]);//
		$dcto=trim($vals[$j+3]);//
		$total=trim($vals[$j+4]);//
		$canto=trim($vals[$j+5]);//
		$nuevo=trim($vals[$j+6]);//
		
		if($j%7==0){
			if ($ref){
				
				if ($cant <> $canto){
				
					//crear Detalle de la compra
					$revref = mysql_query("SELECT * FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ") 
					or die(mysql_error());
					$n = mysql_num_rows($revref);
					if ( $n > 0){
						$newInve = mysql_query("UPDATE `h01sg_venta_detalle` SET `cant`='$cant',`valor`='$valor',`dscto`='$dcto',
						`total`='$total',`user`='$user' WHERE `consec`='$consec' AND `punto_venta`='$ptov' 
						AND `ref`='$ref' AND`delete`<>1 ") or die(mysql_error());	
					}
					if ($n == '' || $n == 0 || $nuevo == 'N'){
						$newInve = mysql_query("INSERT INTO `h01sg_venta_detalle`( `consec`, `fecha`, `punto_venta`, `ref`, `cant`, 
						`valor`, `dscto`,`total`, `user`) VALUES('$consec','$fecha','$ptov','$ref','$cant','$valor','$dcto','$total',
						'$user')") or die(mysql_error());
					}
					
					//Crear Inventario
					$cantt=0;
					if ($canto == 0){
						$cantt = $cant;
					}else{
						$cantt = $cant - $canto;	
					}
					
					$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov' ") 
					or die(mysql_error());
					$x = mysql_num_rows($revref);
					$row_rev = @mysql_fetch_assoc($revref);
					
					$est = $row_rev['delete'];
					
					if ($est != 1){
						$ini = $row_rev['cant_ini'];
						$cantini = $ini - $cantt;
						$vend = $row_rev['cant_vend'];
						if($vend > $cant){
							$canti = $vend + $cantt;
						}else{
							$canti = 0;
						}
						$final = $row_rev['cant_final'];
						$tot = $final - $cantt;
						//$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$cantini',`cant_vend`='$canti',`cant_final`='$tot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ")or die(mysql_error());
						$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$cantini',`cant_final`='$tot',
						`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ")or die(mysql_error());
					}
					if ($est == 1){
						$cantt = abs($cantt);
						$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$cantt',`cant_final`='$cantt',
						`user`='$user',`delete`='0' WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`='1'")or die(mysql_error());
					}
				}
			}
		}
	}
	$arreglo=array(
		'progreso_r' => $i,
		'arreglo' => $vals,
		'tama' => $tama,
	);	
	$arreglo=json_encode($arreglo);
	echo $arreglo;
	//echo $i." ".$tama;
}	
?>