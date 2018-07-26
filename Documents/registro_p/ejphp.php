<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
ini_set('date.timezone', 'America/Bogota');
$today = date("Y-m-d");//
if(isset($_POST['vals2'])){
	$i= $_POST['j'];
	$vals= $_POST['vals2'];
	$tama=$_POST['tam_env'];
	$cedula_arr=array();
	for($j=0;$j<$tama;$j++){
		$cedula=$vals[$j];//
		$nombre=$vals[$j+1];//
		$mail=$vals[$j+2];//
		$cel=$vals[$j+3];//
		$telefono=$vals[$j+4];//
		$contacto1=$vals[$j+5];//
		$cargoc1=$vals[$j+6];//
		$telefonoc1=$vals[$j+7];;//
		$mailc1=$vals[$j+8];//
		$dir=$vals[$j+9];//
		$ciudad=$vals[$j+10];//	
		$banco=$vals[$j+11];
		$cuenta=$vals[$j+12];
		$tipocuenta=$vals[$j+13];
		$formapago=$vals[$j+14];
		$periodopago=$vals[$j+15];
		if($j%16==0){
			$rs_buscar_id=mysql_query("SELECT cedula FROM d89xz_prove WHERE cedula='$cedula' and `delete`=0") or die(mysql_error());
			if(mysql_num_rows($rs_buscar_id)>0){
				array_push($cedula_arr, $cedula);
			}else{
				mysql_query("INSERT INTO d89xz_prove (cedula, nombre, mail, cel, telefono, contacto1, cargoc1, telefonoc1, mailc1, dir, ciudad, user, banco, cuenta, tipocuenta, formapago, periodopago) 
					VALUES('$cedula', '$nombre', '$mail', '$cel', '$telefono', '$contacto1', '$cargoc1', '$telefonoc1', '$mailc1', '$dir', '$ciudad', 'hoy', '$banco', '$cuenta', '$tipocuenta', '$formapago', '$periodopago')") or die(mysql_error());
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

if(isset($_POST['ctos'])){
	$rs_tot=mysql_query("SELECT `user` FROM d89xz_prove WHERE `user`='hoy'") or die(mysql_error());
	$tot_rs=mysql_num_rows($rs_tot);
	mysql_query("UPDATE d89xz_prove SET `user`='$usuario_nom' WHERE `user`='hoy'") or die(mysql_error());	
	echo $tot_rs;
}
		
?>