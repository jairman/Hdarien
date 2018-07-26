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
				}else{
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
		
?>