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
	$marca=$_POST['marca'];
	
	$cedula_arr=array();
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$ini=trim($vals[$j+1]);//
		$tras=trim($vals[$j+2]);//
		$vent=trim($vals[$j+3]);//
		$devo=trim($vals[$j+4]);//
		$tot=trim($vals[$j+5]);//
		$fis=trim($vals[$j+6]);//
		$dif=trim($vals[$j+7]);//
		
		if($j%8==0){
			
			if ($ref){
				
				$setdetail = mysql_query("INSERT INTO `h01sg_inventario_cierre_detalle`(`consec`, `ref`, `punto_venta`, `cant_ini`, 
				`cant_trasl`, `cant_devo`, `cant_vend`, `cant_final`, `cant_fisica`, `diferencia`, `user`) VALUES 
				('$consec','$ref','$ptov','$ini','$tras','$devo','$vent','$tot','$fis','$dif','$user') ") or die(mysql_error()); 
							
				if ($fis > 0){
					$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$fis',`cant_trasl`='0',
					`cant_devo`='0',`cant_vend`='0',`cant_final`='$fis',`user`='$user'
					 WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ") or die(mysql_error()); 
				}
				if ($fis == 0){
					$delInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='0',`cant_trasl`='0',
					`cant_devo`='0',`cant_vend`='0',`cant_final`='0',`user`='$user', `delete`='1'
					 WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ") or die(mysql_error());
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
	$user=$_POST['user'];
	$ptov=$_POST['ptov'];
	
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$ini=trim($vals[$j+1]);//
		$tras=trim($vals[$j+2]);//
		$vent=trim($vals[$j+3]);//
		$devo=trim($vals[$j+4]);//
		$tot=trim($vals[$j+5]);//
		$fis=trim($vals[$j+6]);//
		$fiso=trim($vals[$j+7]);//
		$dif=trim($vals[$j+8]);//
		
		if($j%9==0){
			
			if ($ref){
				$setdetail = mysql_query("UPDATE `h01sg_inventario_cierre_detalle` SET `cant_fisica`='$fis',`diferencia`='$dif',
				`user`='$user' WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1 ") or die(mysql_error()); 
				
				if($setdetail){
					$res = $fis - $fiso;
						
					$getInve = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov'") or die(mysql_error()); 
					$row_inve = mysql_fetch_assoc($getInve);
					$delete = $row_inve['delete'];
					
					if ($delete != 1){
						$inic = $row_inve['cant_ini'] + $res;
						$fin = $row_inve['cant_final'] + $res;	
						
						$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$inic', `cant_final`='$fin',`user`='$user'
						 WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ") or die(mysql_error()); 
					}else{
						$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$fis',`cant_trasl`='0',
						`cant_devo`='0',`cant_vend`='0',`cant_final`='$fis',`user`='$user', `delete`='0'
						 WHERE `ref`='$ref' AND `punto_venta`='$ptov'") or die(mysql_error()); 
					}//if
				}//if
			}//if
		}//if
	}//for
	
	$arreglo=array(
		'progreso_r' => $i,
		'arreglo' => $vals,
		'tama' => $tama,
	);
		
	$arreglo=json_encode($arreglo);
	echo $arreglo;
	//echo json_encode('hola');
	//echo $i." ".$tama;
}
		
if(isset($_POST['vals3'])){
	$i= $_POST['j'];
	$vals= $_POST['vals3'];
	$tama=$_POST['tam_env'];
	$consec=$_POST['consec'];
	$conseca=$_POST['conseca'];
	$consecb=$_POST['consecb'];
	$fecha=$_POST['fecha'];
	$user=$_POST['user'];
	$puntov=$_POST['ptov'];
	
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$ini=trim($vals[$j+1]);//
		$tras=trim($vals[$j+2]);//
		$vent=trim($vals[$j+3]);//
		$devo=trim($vals[$j+4]);//
		$tot=trim($vals[$j+5]);//
		$fis=trim($vals[$j+6]);//
		$dif=trim($vals[$j+7]);//
		$costo=trim($vals[$j+8]);//
		
		if($j%9==0){
			
			if ($ref){
				
				//createDetail()
				$setdetail = mysql_query("INSERT INTO `h01sg_inventario_cierre_detalle`(`consec`, `ref`, `punto_venta`, `cant_ini`, 
				`cant_trasl`, `cant_devo`, `cant_vend`, `cant_final`, `cant_fisica`, `diferencia`, `user`) VALUES 
				('$consec','$ref','$puntov','$ini','$tras','$devo','$vent','$tot','$fis','$dif','$user') ") or die(mysql_error()); 
				
				if($setdetail){
					if ($fis > 0){
						$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$fis',`cant_trasl`='0',
						`cant_devo`='0',`cant_vend`='0',`cant_final`='$fis',`user`='$user'
						 WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error()); 
					}
					if ($fis == 0){
						$delInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='0',`cant_trasl`='0',
						`cant_devo`='0',`cant_vend`='0',`cant_final`='0',`user`='$user', `delete`='1'
						 WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
					}  
				}
				
				//createDetail2()
				$c = 0;
				$c = $ini-$fis;
				if ($dif > 0){
					$tipo = 'Inventario Bodega';
					$mov = 'Entrada';
					$obs = 'Cierre Inventario';
					$pre = 'c';
					
					$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, `cant`, 
					`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
					'$c','$obs','$pre','$conseca','$costo','$fecha','$user')") 
					or die(mysql_error());
				}
				/*if ($dif < 0){
					$tipo = 'Inventario Bodega';
					$mov = 'Entrada';
					$obs = 'Cierre Inventario';
					$pre = 'c';
					$b = 0;
					$b = ($tot-$fis)+$dif;
					$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, `cant`, 
					`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
					'$b','$obs','$pre','$conseca','$costo','$fecha','$user')") 
					or die(mysql_error());
				}*/
				
				//createDetail3
				if ($fis > 0){
					$tipo = 'Inventario Bodega';
					$mov = 'Entrada';
					$obs = 'Entrada por Compra';
					$pre = 'c';
					$newInve2 = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, `cant`, 
					`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
					'$fis','$obs','$pre','$consecb','$costo','$fecha','$user')") 
					or die(mysql_error());
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