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
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$fecha=$_POST["fecha"];
	$tipo=$_POST["tipo"];
	$mov=$_POST["mov"];
	$obs=$_POST["obs"];
	$pre=$_POST["pre"];
	$puntov=$_POST["ptov"];
	$puntovd=$_POST["ptovd"];
	$user=$_POST["user"];
	
	$cedula_arr=array();
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$cant=trim($vals[$j+1]);//
		$costo=trim($vals[$j+2]);//
		
		if($j%3==0){
			
			if ($ref){
				$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_ini`, `punto_venta`, `cant`, 
				`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntovd',
				'$cant','$pre','$consec','$costo','$fecha','$user')") 
				or die(mysql_error());
				
				$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
				or die(mysql_error());
				$n = mysql_num_rows($revref);
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