<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
<?php
ini_set('date.timezone', 'America/Bogota');
$c_date = date('Y-m-d');
$today = date("Y-m-d");//

if(isset($_POST['vals'])){
	$i= $_POST['j'];
	$vals= $_POST['vals'];
	$tama=$_POST['tam_env'];
	$consec=$_POST['consec'];
	$fecha=$c_date;
	$user=$_POST['user'];
	$ptov=$_POST['ptov'];
	
	$cedula_arr=array();
	for($j=0;$j<$tama;$j++){
		$ref=trim($vals[$j]);//
		$dev=trim($vals[$j+1]);//
		$ed=trim($vals[$j+2]);//
		
		if($j%3==0){
			if ($ref){
				if($dev > 0 || $dev != 0){
					
					//Crear devolución
					$getInve = mysql_query("SELECT * FROM `h01sg_compras_devoluciones_detalle` WHERE `consec`='$consec' 
					AND `punto_venta`='$ptov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
					$n = mysql_num_rows($getInve);
					
					if ($n == 0){	
						$newInve = mysql_query("INSERT INTO `h01sg_compras_devoluciones_detalle`( `consec`, `punto_venta`, `fecha`, `ref`, `cant_dev`, 
						`user`) VALUES ('$consec','$ptov','$fecha','$ref','$dev','$user')") or die(mysql_error());
					}else{
						if ($dev == 0){
							$newInve = mysql_query("UPDATE `h01sg_compras_devoluciones_detalle` SET `fecha`='$fecha',`cant_dev`='$dev',
							`user`='$user',`delete`='1' WHERE `consec`='$consec' 
							AND `punto_venta`='$ptov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
						}else{
							$newInve = mysql_query("UPDATE `h01sg_compras_devoluciones_detalle` SET `fecha`='$fecha',`cant_dev`='$dev',
							`user`='$user' WHERE `consec`='$consec' 
							AND `punto_venta`='$ptov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
						}
					}
					
					//Actualizar inventario
					$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ") 
					or die(mysql_error());
					$n = mysql_num_rows($revref);
					//echo 'dev'.$n.' 1 ';
					if ($n >=1){
						$row_rev = mysql_fetch_assoc($revref);
						if ($ed == 0){
							$canti = $row_rev['cant_ini']-$dev;
							$tot = $row_rev['cant_final']-$dev;
						}else{
							if ($cant>$eds){
								$r = $dev - $ed;
								$canti = $row_rev['cant_ini']-$r;
								$tot = $row_rev['cant_final']-$r;
							}
							if ($cant<$ed){
								$r = $ed - $dev;
								$canti = $row_rev['cant_ini']+$r;
								$tot = $row_rev['cant_final']+$r;
							}
						}
						//echo 'd:'.$canti.' t:'.$tot;
						$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$canti',`cant_final`='$tot',
						`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1  ")or die(mysql_error());
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